<?php
/**
 * A página principal (Home)
 *
 * @package Radio_News_Theme
 */

get_header();

// --- LÓGICA DO HERO SECTION ---

$exclude_ids = array();
$main_post = null;

// 1. Tentar buscar o post marcado como Destaque via custom field
$main_args = array(
    'posts_per_page' => 1,
    'meta_query' => array(
        array(
            'key' => 'Destaque', // Campo personalizado "Destaque"
            'value' => '1',
            'compare' => '=='
        )
    ),
    'ignore_sticky_posts' => 1,
);
$main_query = new WP_Query( $main_args );

// 2. Se não houver, tenta posts fixados (sticky)
if ( ! $main_query->have_posts() ) {
    $sticky = get_option( 'sticky_posts' );
    if ( ! empty( $sticky ) ) {
        $main_args = array(
            'posts_per_page' => 1,
            'post__in'       => $sticky,
            'ignore_sticky_posts' => 1,
        );
        $main_query = new WP_Query( $main_args );
    }
}

// 3. Se não houver, tenta da categoria "Notícias locais e regionais"
if ( ! $main_query->have_posts() ) {
    $main_args = array(
        'posts_per_page' => 1,
        'category_name' => 'noticias-locais-e-regionais',
        'ignore_sticky_posts' => 1,
    );
    $main_query = new WP_Query( $main_args );
}

// 4. Se não houver, pega o mais recente
if ( ! $main_query->have_posts() ) {
    $main_args = array(
        'posts_per_page' => 1,
        'ignore_sticky_posts' => 1,
    );
    $main_query = new WP_Query( $main_args );
}

if ( $main_query->have_posts() ) {
    $main_query->the_post();
    $main_post = get_post();
    $exclude_ids[] = get_the_ID();
}
wp_reset_postdata();

// Secundárias: Agro, Política, Saúde
$secondary_posts = array();
$categories_sec = array('conteudo-agro', 'politica-regional', 'saude');

foreach($categories_sec as $cat) {
    $sec_args = array(
        'posts_per_page' => 1,
        'category_name' => $cat,
        'post__not_in' => $exclude_ids,
        'ignore_sticky_posts' => 1,
    );
    $sec_query = new WP_Query( $sec_args );
    if ( $sec_query->have_posts() ) {
        $sec_query->the_post();
        $secondary_posts[] = get_post();
        $exclude_ids[] = get_the_ID();
    }
    wp_reset_postdata();
}

// Preencher secundárias se não tiver as 3
if ( count($secondary_posts) < 3 ) {
    $needed = 3 - count($secondary_posts);
    $fill_args = array(
        'posts_per_page' => $needed,
        'post__not_in' => $exclude_ids,
        'ignore_sticky_posts' => 1,
    );
    $fill_query = new WP_Query( $fill_args );
    if ( $fill_query->have_posts() ) {
        while ( $fill_query->have_posts() ) {
            $fill_query->the_post();
            $secondary_posts[] = get_post();
            $exclude_ids[] = get_the_ID();
        }
    }
    wp_reset_postdata();
}
?>

<!-- Seção de Manchetes (Hero Section) -->
<section class="hero-section container mx-auto px-4 py-6 max-w-7xl">
    <div class="flex flex-col lg:flex-row gap-4 lg:h-[500px]">
        
        <!-- Hero Principal (60% da largura em Desktop) -->
        <div class="lg:w-3/5 relative rounded-lg overflow-hidden group h-[400px] lg:h-full shadow-lg">
            <?php if ($main_post) : 
                $post = $main_post;
                setup_postdata($post);
                $thumbnail = get_the_post_thumbnail_url($post->ID, 'large') ?: 'https://via.placeholder.com/800x600?text=Sem+Imagem';
            ?>
            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-6 w-full">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<span class="inline-block bg-[#c4170c] text-white text-xs font-bold uppercase px-3 py-1.5 mb-3 rounded-sm">' . esc_html( $categories[0]->name ) . '</span>';
                }
                ?>
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight drop-shadow-md">
                    <a href="<?php the_permalink(); ?>" class="hover:text-gray-200 transition-colors"><?php the_title(); ?></a>
                </h2>
                <div class="text-gray-200 text-sm mb-5 line-clamp-2 md:line-clamp-3 w-11/12 drop-shadow">
                    <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-300 text-xs font-medium"><i class="far fa-clock mr-1"></i> <?php echo get_the_date(); ?></span>
                    <a href="<?php the_permalink(); ?>" class="text-white border border-white/50 hover:bg-white hover:text-black hover:border-white transition-all duration-300 px-5 py-2 text-sm font-semibold rounded-sm">Leia mais</a>
                </div>
            </div>
            <?php wp_reset_postdata(); endif; ?>
        </div>

        <!-- Notícias Secundárias (40% da largura em Desktop) -->
        <div class="lg:w-2/5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 lg:grid-rows-3 gap-4 h-full">
            <?php foreach ( $secondary_posts as $post ) : 
                setup_postdata($post);
                $thumbnail = get_the_post_thumbnail_url($post->ID, 'medium_large') ?: 'https://via.placeholder.com/400x300?text=Sem+Imagem';
            ?>
            <a href="<?php the_permalink(); ?>" class="flex-1 relative rounded-lg overflow-hidden group block min-h-[220px] sm:min-h-[180px] lg:min-h-0 shadow-md">
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-4 w-full">
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        echo '<span class="inline-block bg-[#c4170c] text-white text-[10px] font-bold uppercase px-2 py-1 mb-2 rounded-sm">' . esc_html( $categories[0]->name ) . '</span>';
                    }
                    ?>
                    <h3 class="text-lg md:text-xl lg:text-lg font-bold text-white mb-2 leading-snug line-clamp-2 group-hover:text-gray-200 transition-colors drop-shadow-md">
                        <?php the_title(); ?>
                    </h3>
                    <span class="text-gray-300 text-xs font-medium"><i class="far fa-clock mr-1"></i> <?php echo get_the_date(); ?></span>
                </div>
            </a>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
        
    </div>
</section>

<!-- Últimas Notícias (Lista Padrão) -->
<section class="container mx-auto px-4 py-8 max-w-7xl mb-24">
    <header class="mb-8 border-b-2 border-[#c4170c] pb-2">
        <h2 class="text-2xl font-bold uppercase text-[#c4170c]">Últimas Notícias</h2>
    </header>

    <?php
    // Query para as últimas notícias, ignorando os posts já exibidos no Hero
    $latest_args = array(
        'post__not_in' => $exclude_ids,
        'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
        'ignore_sticky_posts' => 1
    );
    $latest_query = new WP_Query( $latest_args );

    if ( $latest_query->have_posts() ) {
        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">';

        while ( $latest_query->have_posts() ) {
            $latest_query->the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        }

        echo '</div>';

        // Navegação
        $total_pages = $latest_query->max_num_pages;
        if ($total_pages > 1) {
            $current_page = max(1, get_query_var('paged'));
            echo '<div class="mt-8 flex justify-between">';
            if ($current_page > 1) {
                echo '<a href="' . get_pagenum_link($current_page - 1) . '" class="font-bold text-[#c4170c] uppercase">← Mais recentes</a>';
            } else {
                echo '<div></div>'; // Espaçador
            }
            if ($current_page < $total_pages) {
                echo '<a href="' . get_pagenum_link($current_page + 1) . '" class="font-bold text-[#c4170c] uppercase">Anteriores →</a>';
            }
            echo '</div>';
        }

    } else {
        get_template_part( 'template-parts/content', 'none' );
    }
    wp_reset_postdata();
    ?>
</section>

<?php
get_footer();
