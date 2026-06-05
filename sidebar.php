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

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LÓGICA DA PREVISÃO DO TEMPO ---
            // Usando o serviço gratuito wttr.in, focado apenas na cidade de Turvo.
            
            const city = 'Turvo'; 
            const container = document.getElementById('weather-widget-container');

            async function fetchWeather() {
                // A URL para o wttr.in que retorna dados em JSON.
                const url = `https://wttr.in/${encodeURIComponent(city)}?format=j1`;

                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Erro ao buscar dados do tempo.');
                    const data = await response.json();
                    renderWeather(data);
                } catch (error) {
                    container.innerHTML = `<p class="text-center text-red-500 text-sm">${error.message}</p>`;
                    console.error(error);
                }
            }

            function renderWeather(weather) {
                // Extrai os dados do formato do wttr.in
                const current = weather.current_condition[0];
                const forecast = weather.weather[0];
                const cityName = weather.nearest_area[0].areaName[0].value;

                const maxRainChance = Math.max(...forecast.hourly.map(h => parseInt(h.chanceofrain, 10)));

                const html = `
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-bold text-gray-800">Turvo, SC</h4>
                        <p class="text-base font-medium text-gray-500">${current.weatherDesc[0].value}</p>
                    </div>
                    <div class="text-center my-5">
                        <span class="text-7xl font-light text-gray-900 tracking-tight">${current.temp_C}°</span>
                    </div>
                    <div class="flex justify-around text-center text-gray-700 border-t border-gray-100 pt-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Mín.</p>
                            <p class="font-bold text-lg">${forecast.mintempC}°</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Máx.</p>
                            <p class="font-bold text-lg">${forecast.maxtempC}°</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Chuva</p>
                            <p class="font-bold text-lg">${maxRainChance}%</p>
                        </div>
                    </div>
                    <a href="https://wttr.in/${encodeURIComponent(cityName)}" target="_blank" rel="noopener noreferrer" class="block text-center text-sm text-[#1E73BE] hover:underline mt-5 font-semibold">
                        Ver previsão completa &rarr;
                    </a>
                `;
                container.innerHTML = html;
            }
            
            fetchWeather();
        });
        </script>
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

    <?php // Bloco 3: Mais Lidas ?>
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