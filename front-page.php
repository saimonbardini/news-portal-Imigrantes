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
<section class="hero-section container mx-auto px-4 py-6 max-w-[1440px]">
    <div class="flex flex-col lg:flex-row gap-4 lg:h-[500px]">
        
        <!-- Hero Principal (Aproximadamente 66% da largura em Desktop) -->
        <div class="lg:w-2/3 relative rounded-lg overflow-hidden group h-[400px] lg:h-full shadow-lg">
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
                    echo '<span class="inline-block bg-[#1E73BE] text-white text-xs font-bold uppercase px-3 py-1.5 mb-3 rounded-sm">' . esc_html( $categories[0]->name ) . '</span>';
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

        <!-- Notícias Secundárias (Aproximadamente 33% da largura em Desktop) -->
        <div class="lg:w-1/3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 lg:grid-rows-3 gap-4 h-full">
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
                        echo '<span class="inline-block bg-[#1E73BE] text-white text-[10px] font-bold uppercase px-2 py-1 mb-2 rounded-sm">' . esc_html( $categories[0]->name ) . '</span>';
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

<!-- Conteúdo Principal com Sidebar -->
<div class="container mx-auto px-4 py-8 max-w-[1440px] mb-24">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
        
        <!-- Coluna de Notícias -->
        <main class="lg:w-[70%]">
            <header class="mb-8 border-b-2 border-[#1E73BE] pb-2">
                <h2 class="text-2xl font-bold uppercase text-[#1E73BE]">Últimas Notícias</h2>
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
                // Alterado para layout em lista (uma abaixo da outra)
                echo '<div class="flex flex-col gap-6">';

                $post_counter = 0;
                while ( $latest_query->have_posts() ) {
                    $latest_query->the_post();
                    $post_counter++;
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://via.placeholder.com/600x400?text=Sem+Imagem';
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col sm:flex-row bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all group'); ?>>
                        <!-- Imagem Reduzida na Lateral (Aprox 30% em Desktop) -->
                        <div class="sm:w-1/3 lg:w-[30%] flex-shrink-0 relative h-52 sm:h-auto overflow-hidden bg-gray-100">
                            <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </a>
                        </div>
                        
                        <!-- Conteúdo Textual ao lado -->
                        <div class="p-5 md:p-6 flex flex-col justify-center flex-1">
                            <?php
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                echo '<span class="text-[#1E73BE] text-xs font-bold uppercase mb-2 block tracking-wider">' . esc_html( $categories[0]->name ) . '</span>';
                            }
                            ?>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-[#1E73BE] transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="text-gray-600 text-sm mb-4 line-clamp-2 md:line-clamp-3">
                                <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                            </div>
                            <div class="flex items-center text-xs font-medium text-gray-400 mt-auto">
                                <span><i class="far fa-clock mr-1"></i> <?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php

                    // Banner Promocional "Memórias da Imigrantes" após a 3ª notícia
                    if ( $post_counter == 3 ) {
                        ?>
                        <div class="relative overflow-hidden rounded-xl shadow-md bg-[#1E73BE] text-white p-6 md:p-8 group border border-[#4392C9]/30 hover:shadow-lg transition-shadow">
                            <!-- Imagem Histórica de Fundo -->
                            <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                                <!-- Usando mask-image para desvanecer a borda esquerda da imagem graciosamente -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/imigrantes-de-turvo.png" alt="Memórias Rádio Imigrantes" class="absolute right-0 top-0 w-full md:w-[70%] h-full object-cover object-top opacity-60 md:opacity-80 group-hover:scale-105 group-hover:opacity-100 transition-all duration-700 grayscale" style="-webkit-mask-image: linear-gradient(to right, transparent 0%, black 30%); mask-image: linear-gradient(to right, transparent 0%, black 30%);">
                                <!-- Degradê para garantir leitura do texto na esquerda -->
                                <div class="absolute inset-0 bg-gradient-to-r from-[#1E73BE] via-[#1E73BE]/80 md:via-[#1E73BE]/30 to-transparent"></div>
                            </div>
                            
                            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                                <div class="md:w-2/3">
                                    <h3 class="text-2xl md:text-3xl font-black mb-2 flex items-center gap-3 drop-shadow-md">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Memórias da Imigrantes
                                    </h3>
                                    <p class="text-blue-50 text-sm leading-relaxed opacity-95">
                                        Você tem uma história especial com a nossa rádio? Queremos reviver os momentos marcantes com você! Acesse nossa galeria de fotos históricas e envie as suas próprias recordações.
                                    </p>
                                </div>
                                <div class="md:w-1/3 md:text-right w-full text-center">
                                    <?php
                                    // Busca automaticamente o link da página que utiliza o template 'page-memorias.php'
                                    $memorias_pages = get_pages( array(
                                        'meta_key'   => '_wp_page_template',
                                        'meta_value' => 'page-memorias.php',
                                        'number'     => 1
                                    ) );
                                    $memorias_url = ! empty( $memorias_pages ) ? get_permalink( $memorias_pages[0]->ID ) : home_url( '/memorias/' );
                                    ?>
                                    <a href="<?php echo esc_url( $memorias_url ); ?>" class="inline-block bg-white text-[#1E73BE] font-bold py-3 px-6 rounded-full shadow-md hover:shadow-xl hover:scale-105 transition-all text-sm">
                                        Visitar Galeria <i class="fa-solid fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                echo '</div>';

                // Navegação de paginação aprimorada
                $total_pages = $latest_query->max_num_pages;
                if ($total_pages > 1) {
                    $current_page = max(1, get_query_var('paged'));
                    echo '<div class="mt-12 flex justify-center items-center gap-4">';
                        echo get_previous_posts_link( '&larr; Mais recentes' );
                        echo '<span class="text-sm text-gray-500">Página ' . $current_page . ' de ' . $total_pages . '</span>';
                        echo get_next_posts_link( 'Anteriores &rarr;', $total_pages );
                    echo '</div>';
                }

            } else {
                get_template_part( 'template-parts/content', 'none' );
            }
            wp_reset_postdata();
            ?>
        </main>

        <!-- Sidebar Editorial -->
        <aside class="lg:w-[30%]">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php
get_footer();
