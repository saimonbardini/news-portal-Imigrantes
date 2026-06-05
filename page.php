<?php
/**
 * The template for displaying all pages
 *
 * @package Radio_News_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 py-8 max-w-7xl mb-24">
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

        <!-- Conteúdo Principal -->
        <main class="lg:w-2/3">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header mb-8 border-b pb-4">
                        <?php the_title( '<h1 class="entry-title text-4xl font-bold text-gray-900 mb-2 tracking-tight leading-tight">', '</h1>' ); ?>
                    </header><!-- .entry-header -->

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-8">
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover rounded-lg shadow-md']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content prose lg:prose-lg max-w-none">
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
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            endwhile; // Fim do loop.
            ?>
        </main>

        <!-- Sidebar -->
        <aside class="lg:w-1/3">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php
get_footer();
