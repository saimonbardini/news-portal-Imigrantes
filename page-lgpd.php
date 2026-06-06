<?php
/**
 * Template Name: Página LGPD
 *
 * @package Radio_News_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 py-8 max-w-[1440px] mb-24">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

        <!-- Conteúdo Principal -->
        <main class="lg:w-[70%]">
            <article class="bg-white rounded-xl shadow-sm p-6 lg:p-10 border border-gray-100">
                <header class="entry-header mb-8 border-b pb-4">
                    <h1 class="entry-title text-4xl font-bold text-gray-900 mb-2 tracking-tight leading-tight">Lei Geral de Proteção de Dados (LGPD)</h1>
                </header>

                <div class="entry-content prose lg:prose-lg max-w-none text-gray-700">
                    
                    <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Requisição de Dados Pessoais</h2>
                    
                    <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Direitos do titular</h3>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li>Confirmação da existência de tratamento.</li>
                        <li>Acesso aos dados.</li>
                        <li>Correção de dados incompletos, inexatos ou desatualizados.</li>
                        <li>Anonimização, bloqueio ou eliminação de dados desnecessários, excessivos ou tratados em desconformidade com a lei.</li>
                        <li>Eliminação de dados pessoais tratados com o consentimento, exceto nas hipóteses da LEI Nº 13.709, DE 14 DE AGOSTO DE 2018.</li>
                        <li>Informações das entidades públicas e privadas com as quais os dados foram compartilhados.</li>
                        <li>Informações sobre a possibilidade de não fornecer consentimento e sobre as consequências da negativa.</li>
                        <li>Revogação do consentimento.</li>
                        <li>Outros.</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Regulamentação de Sorteios</h2>
                    <p class="mb-4 text-justify">
                        A Rádio Imigrantes de Turvo LTDA comunica que de forma esporádica realiza sorteios durante sua programação, os ouvintes são estimulados, por meio de brindes, a ligarem para a emissora por telefone ou mandar uma mensagem de whatsapp, informando seu nome, sobrenome e número de telefone, para que sejam identificados na hora da determinação do ganhador.
                    </p>
                    <p class="mb-4 text-justify">
                        Os dados dos participantes são listados de forma física, para a realização do sorteio. Após a realização dos sorteios, as mensagens de texto recebidas pelo WhatsApp, são todas apagadas e as listagens são guardadas com acesso restrito a pessoa responsável pelos sorteios, com o objetivo principal de comprovar os ganhadores dos prêmios e posterior de determinar um segundo ganhador, caso o sorteado recusar o prêmio por motivo imprevisto.
                    </p>
                    <p class="mb-4 text-justify">
                        Após todos os prêmios entregues ou findo o prazo de 07 dias do acontecimento do sorteio, as listas físicas onde se encontram os dados são picotadas e incineradas.
                    </p>

                </div>
            </article>
        </main>

        <!-- Sidebar -->
        <aside class="lg:w-[30%]">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php
get_footer();
