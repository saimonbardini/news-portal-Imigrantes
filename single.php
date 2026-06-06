<?php
/**
 * The template for displaying all single posts
 *
 * @package Radio_News_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 py-8 max-w-[1440px]">
	<div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
		
		<!-- Conteúdo Principal -->
		<main class="lg:w-[70%]">
			<?php
			while ( have_posts() ) :
				the_post();

				// Incrementa a contagem de visualizações do post
				if ( function_exists('radio_news_set_post_views') ) {
					radio_news_set_post_views( get_the_ID() );
				}

				// Carrega o template part original para o conteúdo do post.
				get_template_part( 'template-parts/content', get_post_type() );

				// Se os comentários estiverem abertos, carrega o template de comentários.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // Fim do loop.
			?>
		</main>

		<!-- Sidebar -->
		<aside class="lg:w-[30%]">
			<?php get_sidebar(); ?>
		</aside>

	</div>
</div>

<?php
get_footer();
