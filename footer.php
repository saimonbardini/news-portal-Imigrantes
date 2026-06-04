<?php
/**
 * O template para exibir o rodapé
 *
 * @package Radio_News_Theme
 */

?>
	</main><!-- #swup -->

    <!-- Persistent Radio Player (Outside SWUP to keep playing) -->
    <div id="radio-player-container" class="fixed bottom-0 left-0 w-full bg-gray-900 text-white z-50 border-t border-gray-800 flex items-center justify-between px-4 py-3 shadow-lg">
        
        <div class="flex items-center space-x-4 w-1/3">
            <div class="w-14 h-14 bg-red-600 flex items-center justify-center rounded overflow-hidden shadow">
                <!-- Radio Logo / Thumbnail -->
                <i class="fa-solid fa-radio text-2xl"></i>
            </div>
            <div class="hidden sm:block">
                <h4 class="font-bold text-sm leading-tight text-white">Rádio Notícias FM</h4>
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
                    <div class="absolute top-0 left-0 h-full w-full bg-red-600 opacity-50 animate-pulse"></div>
                </div>
                <span class="text-[10px] text-red-500 font-bold"><i class="fa-solid fa-circle text-[8px] mr-1 blink"></i>ON AIR</span>
            </div>
        </div>

        <div class="w-1/3 flex justify-end items-center pr-2 space-x-3">
            <i class="fa-solid fa-headphones text-gray-400 text-sm"></i>
            <span class="text-xs font-semibold text-gray-300">Streaming</span>
        </div>

        <!-- Hidden Audio Element for Streaming -->
        <audio id="radio-audio" preload="none">
            <!-- Example free stream URL, replace with actual radio stream URL -->
            <source src="https://stream.pacificaservice.org:9000/kkfi_128" type="audio/mpeg">
            Seu navegador não suporta o elemento de áudio.
        </audio>
    </div>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
