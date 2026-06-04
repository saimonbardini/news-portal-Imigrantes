<?php
/**
 * Template part for displaying posts
 *
 * @package Radio_News_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-8 border-b border-gray-200 pb-8'); ?>>
    
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="mb-4">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover rounded']); ?>
            </a>
        </div>
    <?php endif; ?>

	<header class="entry-header mb-2">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title text-4xl font-bold text-gray-900 mb-4 tracking-tight leading-tight">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title text-2xl md:text-3xl font-bold text-[#c4170c] hover:text-red-700 tracking-tight leading-tight"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta text-xs text-gray-500 font-semibold uppercase tracking-wider mt-2">
				<?php
                echo 'Por ' . get_the_author() . ' — ' . get_the_date();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content text-gray-700 text-lg leading-relaxed">
		<?php
        if ( is_singular() ) {
            the_content();
        } else {
            the_excerpt();
        }
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
