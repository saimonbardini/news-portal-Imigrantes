<?php
/**
 * Template Name: Memórias da Imigrantes
 *
 * @package Radio_News_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 py-12 max-w-[1440px] mb-24">
    <!-- Cabeçalho da Página -->
    <header class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-black text-[#1E73BE] mb-4 uppercase tracking-tight">Memórias da Imigrantes</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">Uma viagem no tempo pelos eventos e acontecimentos que marcaram a história da Rádio Imigrantes e de toda a nossa região.</p>
    </header>

    <!-- Galeria de Fotos Históricas (Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-16">
        <?php
        $image_urls = array();
        $page_content = get_post_field( 'post_content', get_queried_object_id() );

        // 1. Tenta extrair os IDs das imagens inseridas no editor (Bloco de Imagem ou Galeria do WP)
        // Isso garante que pegamos a versão em alta qualidade ('large') adaptada para o layout
        if ( preg_match_all( '/wp-image-([0-9]+)/', $page_content, $matches ) ) {
            foreach ( $matches[1] as $attachment_id ) {
                $url = wp_get_attachment_image_url( $attachment_id, 'large' );
                if ( $url ) {
                    $image_urls[] = $url;
                }
            }
        }
        // 2. Se não encontrar o padrão nativo do WordPress, faz busca genérica (Fallback)
        elseif ( preg_match_all( '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $page_content, $matches ) ) {
            $image_urls = $matches[1];
        }

        // Limpa possíveis duplicatas
        $image_urls = array_unique( $image_urls );

        // Se houver imagens extraídas da página, renderiza na nossa grid estilizada
        if ( ! empty( $image_urls ) ) :
            foreach ( $image_urls as $index => $img_url ) :
        ?>
        <div class="relative group overflow-hidden rounded-lg shadow-md aspect-[4/3] bg-gray-200">
            <img src="<?php echo esc_url($img_url); ?>" alt="Memória <?php echo $index + 1; ?>" class="w-full h-full object-cover grayscale opacity-80 transition-all duration-700 group-hover:scale-110 group-hover:rotate-1 group-hover:grayscale-0 group-hover:opacity-100">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                <p class="text-white p-4 font-semibold text-sm drop-shadow-md">Momento Histórico <?php echo $index + 1; ?></p>
            </div>
        </div>
        <?php 
            endforeach; 
        else : 
        ?>
            <div class="col-span-full bg-blue-50 border border-blue-200 rounded-xl p-8 text-center text-blue-800 shadow-inner">
                <i class="fa-solid fa-images text-4xl mb-3 text-[#1E73BE]/50"></i>
                <p class="text-lg font-bold text-[#1E73BE] mb-1">Nenhuma foto adicionada ainda.</p>
                <p class="text-sm opacity-80">Edite esta página no painel do WordPress, adicione <strong>Blocos de Imagem</strong> ou uma <strong>Galeria</strong> no conteúdo e elas aparecerão automaticamente aqui!</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Seção de Participação (Call to Action + Formulário) -->
    <div class="bg-gradient-to-br from-[#1E73BE] to-[#336666] rounded-2xl shadow-2xl overflow-hidden text-white flex flex-col lg:flex-row border border-[#4392C9]/30">
        
        <!-- Texto e CTA -->
        <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center relative">
            <!-- Elemento decorativo -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl transform translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
            
            <h2 class="text-3xl lg:text-4xl font-black mb-6 leading-tight drop-shadow-md">
                Quero participar enviando minhas fotos antigas
            </h2>
            <p class="text-blue-50 text-lg leading-relaxed mb-8 opacity-95">
                “Você tem uma história especial com a nossa rádio? Queremos ouvir você! Preencha nosso formulário e anexe suas imagens. Queremos reviver os momentos marcantes com você!”
            </p>
            <div class="flex items-center space-x-6 text-blue-100 opacity-80 mt-auto">
                <i class="fa-solid fa-camera-retro text-5xl hover:scale-110 transition-transform cursor-default"></i>
                <i class="fa-solid fa-microphone-lines text-3xl hover:scale-110 transition-transform cursor-default"></i>
                <i class="fa-solid fa-heart text-4xl hover:scale-110 transition-transform cursor-default"></i>
            </div>
        </div>

        <!-- Formulário Físico -->
        <div class="lg:w-1/2 bg-white text-gray-800 p-8 lg:p-12">
            <h3 class="text-2xl font-bold text-[#1E73BE] mb-6 border-b pb-3">Envie suas recordações</h3>
            
            <!-- O atributo enctype="multipart/form-data" é obrigatório para envio de arquivos -->
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-5">
                <div>
                    <label for="nome" class="block text-sm font-bold text-gray-700 mb-1">Nome completo *</label>
                    <input type="text" id="nome" name="nome" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E73BE] focus:border-[#1E73BE] outline-none transition-shadow bg-gray-50 focus:bg-white" placeholder="Seu nome">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">E-mail *</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E73BE] focus:border-[#1E73BE] outline-none transition-shadow bg-gray-50 focus:bg-white" placeholder="seu@email.com">
                    </div>
                    <div>
                        <label for="telefone" class="block text-sm font-bold text-gray-700 mb-1">WhatsApp</label>
                        <input type="tel" id="telefone" name="telefone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E73BE] focus:border-[#1E73BE] outline-none transition-shadow bg-gray-50 focus:bg-white" placeholder="(00) 00000-0000">
                    </div>
                </div>

                <div>
                    <label for="historia" class="block text-sm font-bold text-gray-700 mb-1">Conte-nos a história por trás das fotos *</label>
                    <textarea id="historia" name="historia" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E73BE] focus:border-[#1E73BE] outline-none transition-shadow bg-gray-50 focus:bg-white" placeholder="Escreva sobre o momento da foto, ano aproximado..."></textarea>
                </div>

                <!-- Área de Anexo de Fotos -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Anexar Fotos</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:bg-blue-50 hover:border-[#1E73BE] transition-colors cursor-pointer group" onclick="document.getElementById('fotos').click()">
                        <div class="space-y-1 text-center">
                            <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-400 group-hover:text-[#1E73BE] transition-colors"></i>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="fotos" class="relative cursor-pointer bg-transparent rounded-md font-medium text-[#1E73BE] hover:text-[#336666] focus-within:outline-none">
                                    <span>Fazer upload de arquivos</span>
                                    <!-- O atributo "multiple" permite enviar várias fotos de uma vez -->
                                    <input id="fotos" name="fotos[]" type="file" multiple accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">ou arraste e solte</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG ou JPEG até 10MB</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1E73BE] hover:bg-[#336666] text-white font-bold py-3.5 px-4 rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 mt-6">
                    <i class="fa-solid fa-paper-plane"></i> Enviar minhas memórias
                </button>
            </form>
        </div>
    </div>
</div>

<?php
get_footer();