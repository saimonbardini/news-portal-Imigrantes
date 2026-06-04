<?php
/**
 * The template for displaying all pages
 *
 * @package Radio_News_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 py-8 max-w-4xl mb-24">
	<?php
	while ( have_posts() ) :
		the_post();

        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header mb-8">
                <?php the_title( '<h1 class="entry-title text-4xl font-bold text-gray-900 mb-4 tracking-tight leading-tight">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="mb-8">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover rounded shadow-sm']); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content text-gray-700 text-lg leading-relaxed">
                <?php
                the_content();

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'radio-news-theme' ),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
        <?php

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
</div>

<?php
get_footer();
