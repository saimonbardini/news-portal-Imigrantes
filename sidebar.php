<?php
/**
 * A sidebar editorial inteligente.
 *
 * Contém os blocos de Previsão do Tempo, Leia Também e Mais Lidas.
 *
 * @package Radio_News_Theme
 */
?>

<div class="space-y-8 sticky top-8">

    <?php // Bloco 1: Previsão do Tempo ?>
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 border-b-2 border-[#1E73BE] pb-2 mb-4 uppercase">Previsão do Tempo</h3>
        
        <div id="weather-widget-container">
            <!-- O conteúdo do tempo será carregado aqui via JavaScript -->
            <div class="text-center text-gray-500">
                <i class="fas fa-spinner fa-spin fa-2x"></i>
                <p class="mt-2">Carregando previsão...</p>
            </div>
        </div>
    </div>

    <?php // Bloco 2: Leia Também ?>
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 border-b-2 border-[#1E73BE] pb-2 mb-4 uppercase">Leia Também</h3>
        <?php
        if ( is_front_page() ) {
            // Na página inicial, mostra posts de uma categoria em destaque ou os mais recentes.
            $related_posts_args = array(
                'posts_per_page'      => 4,
                'category_name'       => 'noticias-locais-e-regionais', // Categoria em destaque para a home
                'ignore_sticky_posts' => 1,
            );
        } else {
            // Em páginas de post, busca posts da mesma categoria.
            $related_posts_args = array(
                'posts_per_page'      => 4,
                'post__not_in'        => array( get_the_ID() ),
                'category__in'        => wp_get_post_categories( get_the_ID() ),
                'ignore_sticky_posts' => 1,
            );
        }
        $related_posts_query = new WP_Query( $related_posts_args );

        // Fallback para os posts mais recentes se a query principal não retornar nada.
        if ( ! $related_posts_query->have_posts() ) {
            $fallback_args = array(
                'posts_per_page'      => 4,
                'post__not_in'        => is_singular() ? array( get_the_ID() ) : array(), // Exclui o post/página atual, se aplicável
                'ignore_sticky_posts' => 1,
            );
            $related_posts_query = new WP_Query( $fallback_args );
        }

        if ( $related_posts_query->have_posts() ) : ?>
            <ul class="space-y-4">
                <?php while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="flex items-center gap-4 group">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-700 group-hover:text-[#1E73BE] leading-tight text-base"><?php the_title(); ?></h4>
                            </div>
                            <div class="w-24 h-16 flex-shrink-0 rounded-md overflow-hidden bg-gray-200">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p class="text-sm text-gray-500">Nenhuma notícia relacionada encontrada.</p>
        <?php endif;
        wp_reset_postdata();
        ?>
    </div>

    <?php // Bloco 3: App Promo Editorial ?>
    <div class="relative overflow-hidden rounded-xl shadow-2xl bg-gradient-to-br from-gray-900 via-[#4392C9] to-gray-900 p-6 border border-gray-700/50 group">
        <!-- Elementos Tecnológicos / Brilhos (Glows) -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full blur-3xl transform translate-x-10 -translate-y-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-[#4392C9] opacity-40 rounded-full blur-2xl transform -translate-x-10 translate-y-10 pointer-events-none"></div>
        
        <!-- Conteúdo Principal -->
        <div class="relative z-10 flex flex-col items-center text-center">
            <!-- Header -->
            <div class="mb-5">
                <span class="inline-block px-3 py-1 bg-white/10 text-white/90 rounded-full text-[10px] font-bold tracking-widest uppercase mb-3 border border-white/20 backdrop-blur-sm shadow-sm">Novo</span>
                <h3 class="text-2xl font-black text-white leading-tight mb-2 tracking-tight drop-shadow-md">Baixe o App da Rádio</h3>
                <p class="text-blue-50 text-sm font-medium leading-relaxed opacity-90">Ouça ao vivo, acompanhe as notícias da região e receba notificações em tempo real.</p>
            </div>

            <!-- Visuais Centrais (Celular + QR Code) -->
            <div class="relative w-full flex justify-center items-center h-48 mb-6">
                <!-- Mockup de Smartphone (Fundo) -->
                <div class="absolute left-[5%] top-2 w-28 h-44 bg-gradient-to-b from-gray-800 to-gray-900 rounded-[20px] border-4 border-gray-600 shadow-xl opacity-90 transform -rotate-6 transition-transform group-hover:-rotate-12 duration-500 flex flex-col overflow-hidden z-10">
                    <div class="h-3 w-full bg-gray-900 flex justify-center items-end pb-0.5"><div class="w-8 h-1 bg-gray-700 rounded-full"></div></div>
                    <div class="flex-1 p-2 flex flex-col gap-2 relative">
                        <div class="absolute top-1 right-1 w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></div>
                        <div class="h-10 bg-[#4392C9]/20 rounded-lg flex items-center justify-center mt-2 border border-[#4392C9]/30"><i class="fa-solid fa-play text-[#4392C9] text-xs"></i></div>
                        <div class="h-2 w-3/4 bg-gray-600 rounded-full mt-1"></div>
                        <div class="h-2 w-full bg-gray-700 rounded-full"></div>
                        <div class="h-2 w-1/2 bg-gray-700 rounded-full"></div>
                        <div class="mt-auto flex gap-1 justify-between">
                             <div class="h-6 w-6 bg-gray-700 rounded-md"></div>
                             <div class="h-6 flex-1 bg-gray-700 rounded-md"></div>
                        </div>
                    </div>
                </div>

                <!-- Bloco QR Code (Frente) -->
                <div class="relative z-20 bg-white p-2 rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.5)] transform translate-x-[20%] rotate-3 group-hover:rotate-0 transition-transform duration-500 border border-white/40 ring-4 ring-[#4392C9]/50">
                    <div class="absolute -inset-1 bg-white/30 blur-md rounded-xl -z-10"></div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data=https://play.google.com/&color=111827" alt="QR Code para Download" class="w-[110px] h-[110px] rounded-lg">
                    <!-- Ícone centralizado no QR Code -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-full p-1 shadow-lg border border-gray-100 flex items-center justify-center">
                        <i class="fa-solid fa-microphone-lines text-[#4392C9] text-lg w-7 h-7 text-center leading-7"></i>
                    </div>
                </div>
            </div>

            <!-- Botões das Lojas -->
            <div class="flex flex-row gap-2 w-full justify-center">
                <a href="#" class="flex-1 bg-black/50 hover:bg-black/80 border border-white/20 text-white rounded-lg p-2.5 flex items-center justify-center gap-2 backdrop-blur-sm transition-all shadow-md group/btn">
                    <i class="fa-brands fa-apple text-2xl group-hover/btn:scale-110 transition-transform text-gray-200"></i>
                    <div class="text-left flex flex-col justify-center">
                        <span class="text-[9px] uppercase tracking-wider text-gray-400 leading-none">Baixar na</span>
                        <span class="text-sm font-bold leading-tight mt-0.5">App Store</span>
                    </div>
                </a>
                <a href="#" class="flex-1 bg-black/50 hover:bg-black/80 border border-white/20 text-white rounded-lg p-2.5 flex items-center justify-center gap-2 backdrop-blur-sm transition-all shadow-md group/btn">
                    <i class="fa-brands fa-google-play text-xl text-green-400 group-hover/btn:scale-110 transition-transform"></i>
                    <div class="text-left flex flex-col justify-center">
                        <span class="text-[9px] uppercase tracking-wider text-gray-400 leading-none">Disponível no</span>
                        <span class="text-sm font-bold leading-tight mt-0.5">Google Play</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php // Bloco 4: Mais Lidas ?>
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 border-b-2 border-[#1E73BE] pb-2 mb-4 uppercase">Mais Lidas</h3>
        <?php
        $popular_posts_args = array(
            'posts_per_page' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'ignore_sticky_posts' => 1,
        );
        $popular_posts_query = new WP_Query( $popular_posts_args );
        $counter = 1;

        if ( $popular_posts_query->have_posts() ) : ?>
            <ol class="space-y-4">
                <?php while ( $popular_posts_query->have_posts() ) : $popular_posts_query->the_post(); ?>
                    <li class="flex items-start gap-3">
                        <span class="text-2xl font-bold text-[#1E73BE]/50 w-8 text-center"><?php echo $counter; ?></span>
                        <div class="flex-1">
                            <a href="<?php the_permalink(); ?>" class="font-semibold text-gray-700 hover:text-[#1E73BE] leading-tight">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </li>
                <?php $counter++; endwhile; ?>
            </ol>
        <?php else : ?>
            <p class="text-sm text-gray-500">Ainda não há dados de notícias mais lidas.</p>
        <?php endif;
        wp_reset_postdata();
        ?>
    </div>

</div>