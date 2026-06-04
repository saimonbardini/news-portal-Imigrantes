<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'radio-news-theme' ); ?></a>

    <!-- Overlay for Off-Canvas -->
    <div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden transition-opacity duration-300 opacity-0" aria-hidden="true"></div>

    <!-- Off-Canvas Menu -->
    <aside id="offcanvas-menu" class="fixed top-0 left-0 h-full w-[80%] md:w-[350px] bg-white text-gray-800 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col overflow-hidden" aria-label="Menu Principal" aria-hidden="true">
        
        <!-- Menu Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50">
            <span class="font-bold text-lg text-[#c4170c]">Menu</span>
            <button id="close-menu-btn" class="text-gray-500 hover:text-red-600 focus:outline-none p-2" aria-label="Fechar menu">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Menu Content (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-0 pb-20">
            <ul class="flex flex-col w-full">
                
                <!-- Editorias (Expandable) -->
                <li class="border-b border-gray-100">
                    <button class="accordion-btn flex items-center justify-between w-full px-5 py-4 text-left font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                        <span class="flex items-center"><i class="fa-solid fa-newspaper w-6 text-center mr-2 text-gray-400"></i> Editorias</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"></i>
                    </button>
                    <ul class="accordion-content hidden bg-gray-50 px-5 py-2">
                        <?php 
                        $editorias = ['Política', 'Economia', 'Agronegócio', 'Educação', 'Saúde', 'Segurança', 'Cultura', 'Esportes', 'Tecnologia', 'Região', 'Municípios'];
                        foreach($editorias as $cat) {
                            echo '<li class="py-2"><a href="#" class="text-gray-600 hover:text-[#c4170c] block pl-8">' . esc_html($cat) . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>

                <!-- Jogos (Expandable) -->
                <li class="border-b border-gray-100">
                    <button class="accordion-btn flex items-center justify-between w-full px-5 py-4 text-left font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                        <span class="flex items-center"><i class="fa-solid fa-gamepad w-6 text-center mr-2 text-gray-400"></i> Jogos</span>
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-200"></i>
                    </button>
                    <ul class="accordion-content hidden bg-gray-50 px-5 py-2">
                        <li class="py-2"><a href="#" class="text-gray-600 hover:text-[#c4170c] block pl-8">Palavras Cruzadas</a></li>
                        <li class="py-2"><a href="#" class="text-gray-600 hover:text-[#c4170c] block pl-8">Sudoku</a></li>
                    </ul>
                </li>

                <!-- Outros Links -->
                <li class="border-b border-gray-100">
                    <a href="#" class="flex items-center w-full px-5 py-4 text-left font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-podcast w-6 text-center mr-2 text-gray-400"></i> Podcasts
                    </a>
                </li>
                <li class="border-b border-gray-100">
                    <a href="#" class="flex items-center w-full px-5 py-4 text-left font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-circle-info w-6 text-center mr-2 text-gray-400"></i> Sobre
                    </a>
                </li>
                <li class="border-b border-gray-100">
                    <a href="#" class="flex items-center w-full px-5 py-4 text-left font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-envelope w-6 text-center mr-2 text-gray-400"></i> Entre em Contato
                    </a>
                </li>
                <li class="border-b border-gray-100">
                    <a href="#" class="flex items-center w-full px-5 py-4 text-left font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-shield-halved w-6 text-center mr-2 text-gray-400"></i> Termos de Uso
                    </a>
                </li>
            </ul>
        </div>

        <!-- Menu Footer (Fixed Bottom) -->
        <div class="absolute bottom-0 left-0 w-full p-4 bg-gray-100 border-t border-gray-200">
            <a href="#" class="flex items-center justify-center w-full bg-[#c4170c] text-white py-3 px-4 rounded font-bold hover:bg-red-700 transition-colors shadow-sm">
                <i class="fa-solid fa-user mr-2"></i> Acesso Restrito
            </a>
        </div>
    </aside>

	<header id="masthead" class="bg-[#c4170c] text-white relative z-30 shadow-md">
		<div class="container mx-auto px-4 h-16 md:h-20 flex items-center justify-between">
            
            <!-- Left: Menu Toggle + Logo -->
            <div class="flex items-center h-full">
                <button id="open-menu-btn" class="text-white hover:bg-red-700 p-2 rounded mr-1 md:mr-3 focus:outline-none transition-colors flex flex-col justify-center items-center h-10 w-10 md:h-12 md:w-12" aria-label="Abrir menu" aria-expanded="false" aria-controls="offcanvas-menu">
                    <i class="fa-solid fa-bars text-xl md:text-2xl"></i>
                    <span class="text-[9px] md:text-[10px] uppercase font-bold tracking-wider mt-0.5 md:mt-1">Menu</span>
                </button>
                
                <div class="site-branding flex items-center h-full">
                    <?php
                    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="text-white hover:text-gray-200 flex items-center">
                            <span class="text-xl md:text-3xl font-black tracking-tighter uppercase"><?php bloginfo( 'name' ); ?></span>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <!-- Center: Search (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                <form role="search" method="get" class="w-full relative group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="w-full bg-white text-gray-900 rounded-full py-2.5 pl-5 pr-12 focus:outline-none focus:ring-2 focus:ring-red-400 placeholder-gray-500 text-sm md:text-base shadow-inner transition-shadow" placeholder="Buscar notícias, categorias, conteúdos..." value="<?php echo get_search_query(); ?>" name="s" title="Pesquisar" />
                    <button type="submit" class="absolute right-0 top-0 mt-2.5 mr-4 text-gray-500 hover:text-[#c4170c] transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </button>
                </form>
            </div>

            <!-- Right: Acesso Restrito & Mobile Search Toggle -->
            <div class="flex items-center h-full space-x-2 md:space-x-4">
                <!-- Mobile Search Icon -->
                <button id="mobile-search-btn" class="md:hidden text-white p-2 hover:bg-red-700 rounded transition-colors focus:outline-none">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>
                
                <!-- Acesso Restrito Desktop -->
                <a href="#" class="hidden md:flex items-center space-x-2 border border-white hover:bg-white hover:text-[#c4170c] px-5 py-2 rounded-full transition-colors font-semibold text-sm shadow-sm">
                    <i class="fa-solid fa-user"></i>
                    <span>Acesso Restrito</span>
                </a>
                
                <!-- Acesso Restrito Mobile Icon -->
                <a href="#" class="md:hidden text-white p-2 hover:bg-red-700 rounded transition-colors">
                    <i class="fa-solid fa-user text-lg"></i>
                </a>
            </div>
            
        </div>
        
        <!-- Mobile Search Dropdown -->
        <div id="mobile-search-container" class="hidden md:hidden px-4 pb-4 w-full bg-[#c4170c]">
            <form role="search" method="get" class="w-full relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" class="w-full bg-white text-gray-900 rounded-full py-2 pl-4 pr-10 focus:outline-none placeholder-gray-500 text-sm shadow-inner" placeholder="Buscar..." value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
	</header><!-- #masthead -->

    <!-- SWUP CONTAINER -->
	<main id="swup" class="site-main transition-fade">
