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
            // Esta é uma implementação de exemplo. Você precisará de uma chave de API de um serviço como
            // a HG Brasil, que é excelente para o território nacional.
            //
            // 1. Obtenha uma chave de API em https://console.hgbrasil.com/
            // 2. Substitua 'SUA_CHAVE_API' pela sua chave.
            
            const apiKey = 'SUA_CHAVE_API'; // IMPORTANTE: Substitua pela sua chave!
            const defaultCity = 'Araranguá'; 
            const container = document.getElementById('weather-widget-container');
            const cities = ['Turvo', 'Timbé do Sul', 'Ermo', 'Morro Grande', 'Meleiro', 'Jacinto Machado', 'Criciúma', 'Araranguá'];

            async function fetchWeather(city) {
                // A URL pode precisar de ajustes dependendo da documentação da API
                const url = `https://api.hgbrasil.com/weather?key=${apiKey}&city_name=${city}&format=json-cors`;

                try {
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Erro ao buscar dados do tempo.');
                    const data = await response.json();
                    renderWeather(data.results);
                } catch (error) {
                    container.innerHTML = `<p class="text-red-500 text-sm">${error.message} Verifique a chave da API.</p>`;
                    console.error(error);
                }
            }

            function getIconForPeriod(period) {
                if (period === 'morning') return 'fa-sun';
                if (period === 'afternoon') return 'fa-cloud-sun';
                if (period === 'night') return 'fa-moon';
                return 'fa-cloud';
            }

            function renderWeather(weather) {
                let citySelector = `<select id="city-selector" class="w-full p-2 border rounded-md bg-gray-50 mb-4 text-sm">`;
                cities.forEach(c => {
                    citySelector += `<option value="${c}" ${weather.city_name === c ? 'selected' : ''}>${c}</option>`;
                });
                citySelector += `</select>`;

                const html = `
                    ${citySelector}
                    <div class="text-center">
                        <p class="text-gray-600 text-lg">${weather.description}</p>
                        <div class="flex items-center justify-center my-3">
                            <span class="text-6xl font-bold text-gray-800">${weather.temp}°</span>
                        </div>
                        <div class="flex justify-around text-gray-600 border-t pt-3 mt-3">
                            <div class="text-sm"><span class="font-bold">MÍN</span><p>${weather.forecast[0].min}°</p></div>
                            <div class="text-sm"><span class="font-bold">MÁX</span><p>${weather.forecast[0].max}°</p></div>
                            <div class="text-sm"><span class="font-bold">CHUVA</span><p>${weather.forecast[0].rain_probability}%</p></div>
                        </div>
                    </div>
                    <div class="flex justify-around text-center mt-4 bg-gray-50 p-2 rounded-md">
                        <div><i class="fas ${getIconForPeriod('morning')} text-yellow-500"></i><p class="text-xs">Manhã</p></div>
                        <div><i class="fas ${getIconForPeriod('afternoon')} text-orange-400"></i><p class="text-xs">Tarde</p></div>
                        <div><i class="fas ${getIconForPeriod('night')} text-indigo-500"></i><p class="text-xs">Noite</p></div>
                    </div>
                    <a href="#" class="block text-center text-[#1E73BE] hover:underline text-sm mt-4 font-semibold">Ver previsão completa</a>
                `;
                container.innerHTML = html;

                document.getElementById('city-selector').addEventListener('change', function() {
                    container.innerHTML = '<div class="text-center text-gray-500 py-10"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">Carregando...</p></div>';
                    fetchWeather(this.value);
                });
            }
            
            if (apiKey === 'SUA_CHAVE_API' || !apiKey) {
                 container.innerHTML = '<p class="text-sm text-orange-600">Configure sua chave de API para exibir a previsão do tempo.</p>';
            } else {
                fetchWeather(defaultCity);
            }
        });
        </script>
    </div>

    <?php // Bloco 2: Leia Também ?>
    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-100">
        <h3 class="text-xl font-bold text-gray-800 border-b-2 border-[#1E73BE] pb-2 mb-4 uppercase">Leia Também</h3>
        <?php
        $related_posts_args = array(
            'posts_per_page' => 4,
            'post__not_in' => array( get_the_ID() ),
            'category__in' => wp_get_post_categories( get_the_ID() ),
            'ignore_sticky_posts' => 1,
        );
        $related_posts_query = new WP_Query( $related_posts_args );

        // Fallback para posts mais recentes se não houver relacionados
        if ( ! $related_posts_query->have_posts() ) {
            $related_posts_args = array(
                'posts_per_page' => 4,
                'post__not_in' => array( get_the_ID() ),
                'ignore_sticky_posts' => 1,
            );
            $related_posts_query = new WP_Query( $related_posts_args );
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