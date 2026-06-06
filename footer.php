<?php
/**
 * O template para exibir o rodapé
 *
 * @package Radio_News_Theme
 */

?>

	</main><!-- #swup -->

    <!-- Força o rodapé para a base da tela e remove paddings em branco deixados por scripts antigos -->
    <style>
        html, body {
            min-height: 100vh;
        }
        body {
            display: flex;
            flex-direction: column;
            /* Remove padding fantasma injetado dinamicamente (comum em arquivos .js de players fixed) */
            padding-bottom: 0 !important; 
        }
        #page { flex: 1 0 auto; }
        #site-footer { flex-shrink: 0; }
    </style>

    <!-- Player Sticky Wrapper para docking nativo e fluido sem bugs de JS -->
    <div id="player-sticky-wrapper" class="sticky bottom-0 z-30 w-full transition-all duration-300 ease-in-out">
        
        <!-- Persistent Radio Player (Outside SWUP to keep playing) -->
        <div id="radio-player-container" class="w-full bg-gray-900 text-white border-t border-gray-800 flex items-center justify-between px-4 py-3 transition-transform duration-300 ease-in-out">
            
            <div class="flex items-center space-x-4 w-1/3">
                <div class="w-14 h-14 bg-[#336666] flex items-center justify-center rounded overflow-hidden shadow">
                    <!-- Radio Logo / Thumbnail -->
                    <i class="fa-solid fa-radio text-2xl"></i>
                </div>
                <div class="hidden sm:block">
                    <h4 class="font-bold text-sm leading-tight text-white">Rádio Imigrantes de Turvo 94,1 FM</h4>
                    <p class="text-xs text-gray-400">Ao vivo</p>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center w-1/3">
                <div class="flex items-center space-x-6">
                    <button class="text-gray-400 hover:text-white transition-colors" title="Volume Down">
                        <i class="fa-solid fa-volume-low"></i>
                    </button>
                    
                    <button id="play-pause-btn" class="w-10 h-10 bg-white text-black rounded-full flex items-center justify-center hover:scale-105 transition-transform" title="Play">
                        <i class="fa-solid fa-play ml-1"></i>
                    </button>
                    
                    <button class="text-gray-400 hover:text-white transition-colors" title="Volume Up">
                        <i class="fa-solid fa-volume-high"></i>
                    </button>
                </div>
                <div class="w-full max-w-md mt-2 flex items-center space-x-2">
                    <span class="text-[10px] text-gray-400">AO VIVO</span>
                    <div class="h-1 bg-gray-600 rounded-full flex-grow overflow-hidden relative">
                        <div class="absolute top-0 left-0 h-full w-full bg-[#336666] opacity-50 animate-pulse"></div>
                    </div>
                    <span class="text-[10px] text-[#336666] font-bold"><i class="fa-solid fa-circle text-[8px] mr-1 blink"></i>ON AIR</span>
                </div>
            </div>

            <div class="w-1/3 flex justify-end items-center pr-2 space-x-3">
                <i class="fa-solid fa-headphones text-gray-400 text-sm hidden sm:inline-block"></i>
                <span class="text-xs font-semibold text-gray-300 hidden sm:inline-block">Streaming</span>
                <button id="minimize-player-btn" class="text-gray-400 hover:text-white transition-colors ml-2" title="Minimizar Player">
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
            </div>

            <!-- Hidden Audio Element for Streaming -->
            <audio id="radio-audio" preload="none">
                <!-- Example free stream URL, replace with actual radio stream URL -->
                <source src="https://stream.pacificaservice.org:9000/kkfi_128" type="audio/mpeg">
                Seu navegador não suporta o elemento de áudio.
            </audio>
        </div>
    </div>

</div><!-- #page -->

    <!-- Rodapé do Site (Fora do #page para que o sticky player estacione perfeitamente acima dele) -->
    <footer id="site-footer" class="bg-[#111827] text-gray-300 pt-12 pb-12 relative z-40">
        <div class="container mx-auto px-4 max-w-[1440px]">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                
                <!-- Bloco 1: Sobre a Rádio -->
                <div>
                    <h4 class="text-white text-lg font-bold mb-4 uppercase tracking-wider flex items-center">
                        <i class="fa-solid fa-radio text-[#4392C9] mr-2"></i> Rádio Imigrantes
                    </h4>
                    <p class="text-sm text-gray-400 mb-4 leading-relaxed">
                        A sua rádio de notícias 24 horas. Levando até você as melhores informações de Turvo e região com credibilidade e imparcialidade.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-[#1877F2] transition-colors" title="Facebook"><i class="fa-brands fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#E4405F] transition-colors" title="Instagram"><i class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#FF0000] transition-colors" title="YouTube"><i class="fa-brands fa-youtube text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-[#25D366] transition-colors" title="WhatsApp"><i class="fa-brands fa-whatsapp text-xl"></i></a>
                    </div>
                </div>

                <!-- Bloco 2: Links Úteis -->
                <div>
                    <h4 class="text-white text-lg font-bold mb-4 uppercase tracking-wider">Links Úteis</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-[#4392C9] transition-colors">Início</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Sobre a Rádio</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Anuncie Conosco</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Fale Conosco</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/lgpd/' ) ); ?>" class="hover:text-[#4392C9] transition-colors">LGPD & Sorteios</a></li>
                    </ul>
                </div>

                <!-- Bloco 3: Editorias -->
                <div>
                    <h4 class="text-white text-lg font-bold mb-4 uppercase tracking-wider">Editorias</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Política</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Economia</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Agronegócio</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Esportes</a></li>
                        <li><a href="#" class="hover:text-[#4392C9] transition-colors">Segurança</a></li>
                    </ul>
                </div>

                <!-- Bloco 4: Contato -->
                <div>
                    <h4 class="text-white text-lg font-bold mb-4 uppercase tracking-wider">Contato</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 mr-3 text-[#4392C9]"></i>
                            <span>Turvo - SC, 88930-000</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-phone mr-3 text-[#4392C9]"></i>
                            <span>(48) 3525-0000</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-envelope mr-3 text-[#4392C9]"></i>
                            <span>contato@radioimigrantes.com.br</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright e Assinatura -->
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
                <p>&copy; <?php echo date('Y'); ?> Rádio Imigrantes de Turvo LTDA. Todos os direitos reservados.</p>
                <p class="mt-3 md:mt-0 text-sm">
                    Feito com <i class="fa-solid fa-heart text-red-500 mx-1 animate-pulse"></i> por <a href="https://instagram.com/saimon.bardini" target="_blank" class="text-gray-300 hover:text-white transition-colors font-medium">@saimon.bardini</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Maximized Player Button -->
    <button id="maximize-player-btn" class="fixed bottom-4 right-4 bg-[#336666] text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg z-[60] hidden hover:scale-105 transition-transform" title="Abrir Player Ao Vivo">
        <i class="fa-solid fa-radio text-xl animate-pulse"></i>
    </button>

    <!-- Script para gerenciar a altura do player minimizado -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const playerWrapper = document.getElementById('player-sticky-wrapper');
            const playerContainer = document.getElementById('radio-player-container');
            const maximizeBtn = document.getElementById('maximize-player-btn');
            
            function handlePlayerMinimize() {
                if (!playerWrapper || !maximizeBtn || !playerContainer) return;
                
                // O botão maximizar aparece quando minimizamos o player
                const isMinimized = !maximizeBtn.classList.contains('hidden');
                
                if (isMinimized) {
                    // O z-30 no wrapper faz o player deslizar para trás do footer (z-40).
                    // A margem negativa puxa o footer para cima suavemente, sincronizado com o movimento do player.
                    const playerHeight = playerContainer.offsetHeight || 72;
                    playerWrapper.style.marginBottom = `-${playerHeight}px`;
                } else {
                    playerWrapper.style.marginBottom = '0px';
                }
            }

            if (maximizeBtn) {
                new MutationObserver(handlePlayerMinimize).observe(maximizeBtn, { attributes: true, attributeFilter: ['class'] });
                handlePlayerMinimize();
            }
        });
    </script>

    <!-- Script global para carregar a previsão do tempo independentemente da navegação do SWUP -->
    <script>
        function initSidebarWeather() {
            const container = document.getElementById('weather-widget-container');
            
            // Se não existir o widget na tela atual ou se ele já foi carregado, não faz nada
            if (!container || container.dataset.loaded) return;
            
            // Marca como carregado para evitar requisições repetidas
            container.dataset.loaded = 'true';
            
            const city = 'Turvo'; 
            const url = `https://wttr.in/${encodeURIComponent(city)}?format=j1`;

            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Erro ao buscar dados do tempo.');
                    return response.json();
                })
                .then(weather => {
                    const current = weather.current_condition[0];
                    const forecast = weather.weather[0];
                    const cityName = weather.nearest_area[0].areaName[0].value;
                    const maxRainChance = Math.max(...forecast.hourly.map(h => parseInt(h.chanceofrain, 10)));

                    container.innerHTML = `
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-bold text-gray-800">Turvo, SC</h4>
                            <p class="text-sm font-medium text-gray-500 capitalize">${current.weatherDesc[0].value}</p>
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
                        
                        <!-- Card Especial: Camila Cardoso -->
                        <div class="mt-6 relative bg-gradient-to-br from-blue-50 to-slate-50 border border-blue-100 rounded-xl p-4 shadow-sm overflow-hidden group">
                            <div class="pr-20 relative z-10">
                                <div class="flex items-center space-x-2 mb-1.5">
                                    <span class="relative flex h-2.5 w-2.5">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                                    </span>
                                    <span class="text-[10px] font-bold uppercase text-red-600 tracking-wider">Ao Vivo na Rádio</span>
                                </div>
                                <h5 class="text-[15px] font-black text-[#1E73BE] mb-1 leading-tight">Camila Cardoso</h5>
                                <p class="text-xs text-gray-700 leading-snug">
                                    Seg a Sex às <strong class="text-gray-900">07h07</strong>, <strong class="text-gray-900">11h30</strong> e <strong class="text-gray-900">17h45</strong>
                                </p>
                            </div>
                            
                            <!-- Imagem Meteorologista -->
                            <div class="absolute bottom-0 right-0 w-24 h-[110%] flex items-end justify-end pointer-events-none origin-bottom transform group-hover:scale-105 transition-transform duration-500">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/camila-cardoso.png" alt="Camila Cardoso" class="h-full w-auto object-contain object-bottom drop-shadow-md" onerror="this.style.display='none'">
                            </div>
                        </div>

                        <!-- Link Ver Previsão Completa -->
                        <a href="https://wttr.in/${encodeURIComponent(cityName)}" target="_blank" rel="noopener noreferrer" class="block text-center text-[11px] text-gray-400 hover:text-[#1E73BE] hover:underline mt-4">
                            Ver previsão em detalhes &rarr;
                        </a>
                    `;
                })
                .catch(error => {
                    container.innerHTML = `<p class="text-center text-red-500 text-sm">${error.message}</p>`;
                    console.error(error);
                });
        }

        // Inicializa na carga direta da página
        document.addEventListener('DOMContentLoaded', initSidebarWeather);

        // Observador que detecta mudanças na página feitas pelo SWUP (troca de página)
        new MutationObserver((mutations) => {
            for (let mutation of mutations) {
                if (mutation.addedNodes.length > 0 && document.getElementById('weather-widget-container')) {
                    initSidebarWeather();
                    break;
                }
            }
        }).observe(document.body, { childList: true, subtree: true });
    </script>

<?php wp_footer(); ?>
</body>
</html>
