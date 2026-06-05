<?php
/**
 * Template part for displaying single posts professionally
 *
 * @package Radio_News_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm overflow-hidden mb-8 border border-gray-100'); ?>>
    
    <div class="px-5 py-5 md:px-8 lg:py-6 lg:px-10 border-b border-gray-100">
        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="mb-3 flex flex-wrap gap-2">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    foreach ( $categories as $category ) {
                        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="inline-block bg-[#1E73BE]/10 text-[#1E73BE] hover:bg-[#1E73BE] hover:text-white transition-colors duration-200 text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded-sm">' . esc_html( $category->name ) . '</a>';
                    }
                }
                ?>
            </div>
        <?php endif; ?>

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title text-xl md:text-2xl lg:text-3xl font-bold text-gray-900 mb-3 tracking-tight leading-snug">', '</h1>' ); ?>

            <?php if ( has_excerpt() ) : ?>
                <div class="text-sm md:text-base text-gray-600 mb-4 font-normal leading-relaxed">
                    <?php echo get_the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <?php if ( 'post' === get_post_type() ) : ?>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-t border-b border-gray-100 py-3 mt-4 gap-3">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 32, '', '', array( 'class' => 'h-8 w-8 rounded-full border border-gray-100 shadow-sm' ) ); ?>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-900">
                                Por <?php echo esc_html( get_the_author() ); ?>
                            </div>
                            <div class="text-[10px] md:text-[11px] text-gray-500 font-medium flex items-center mt-0.5 flex-wrap gap-1.5">
                                <span class="flex items-center">
                                    <i class="fa-regular fa-calendar mr-1"></i> <?php echo get_the_date(); ?>
                                </span>
                                <span class="hidden sm:inline-block">•</span>
                                <span class="flex items-center">
                                    <i class="fa-regular fa-clock mr-1"></i> <?php echo get_the_time(); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Share Buttons -->
                    <div class="flex space-x-1.5">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 flex items-center justify-center rounded-full bg-blue-600 text-white hover:bg-blue-700 transition shadow-sm hover:shadow text-xs" title="Compartilhar no Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 flex items-center justify-center rounded-full bg-sky-500 text-white hover:bg-sky-600 transition shadow-sm hover:shadow text-xs" title="Compartilhar no X (Twitter)">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="w-7 h-7 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition shadow-sm hover:shadow text-xs" title="Compartilhar no WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </header>
    </div>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="w-full relative group bg-gray-50 flex flex-col items-center">
            <?php the_post_thumbnail('large', ['class' => 'w-full max-w-3xl h-auto max-h-[400px] object-contain']); ?>
            <?php
            $thumbnail_id  = get_post_thumbnail_id();
            $thumbnail_cap = wp_get_attachment_caption( $thumbnail_id );
            if ( $thumbnail_cap ) :
                ?>
                <figcaption class="w-full text-[10px] md:text-[11px] text-gray-500 px-5 py-2 bg-white border-b border-gray-100 text-center flex items-center justify-center space-x-1.5">
                    <i class="fa-solid fa-camera text-gray-400"></i>
                    <span><?php echo esc_html( $thumbnail_cap ); ?></span>
                </figcaption>
            <?php endif; ?>
        </div>
    <?php endif; ?>

	<div class="px-5 py-5 md:px-8 lg:px-10 entry-content prose prose-sm sm:prose-base max-w-none text-gray-800 font-serif leading-relaxed prose-a:text-[#1E73BE] hover:prose-a:text-red-700 prose-a:transition-colors prose-headings:font-sans prose-headings:font-bold prose-headings:text-gray-900 prose-img:rounded-md prose-img:shadow-sm prose-iframe:w-full prose-iframe:max-w-3xl prose-iframe:block prose-iframe:mx-auto prose-iframe:aspect-video prose-iframe:rounded-xl prose-iframe:shadow-lg prose-iframe:border-0 prose-iframe:my-8 prose-figure:mx-auto prose-figure:block">
		<?php
        the_content();
        
        wp_link_pages( array(
            'before' => '<div class="page-links mt-6 font-sans text-xs font-bold tracking-wider border-t border-gray-100 pt-4">' . esc_html__( 'Páginas:', 'radio-news-theme' ),
            'after'  => '</div>',
            'link_before' => '<span class="inline-flex items-center justify-center w-6 h-6 bg-gray-100 hover:bg-[#1E73BE] hover:text-white text-gray-700 rounded ml-1.5 transition-colors">',
            'link_after'  => '</span>',
        ) );
		?>
	</div><!-- .entry-content -->
    
    <div class="px-5 py-3 md:px-8 lg:px-10 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <div class="tags-links flex flex-wrap gap-1.5 items-center">
            <?php
            $tags = get_the_tags();
            if ( $tags ) {
                echo '<span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mr-1.5 flex items-center"><i class="fa-solid fa-tags mr-1"></i> Tags:</span>';
                foreach ( $tags as $tag ) {
                    echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="inline-block bg-white border border-gray-200 text-gray-600 hover:border-[#1E73BE] hover:text-[#1E73BE] transition-colors duration-200 text-[10px] font-semibold px-2 py-0.5 rounded-sm">' . esc_html( $tag->name ) . '</a>';
                }
            } else {
                echo '<span class="text-[10px] text-gray-400">Nenhuma tag associada.</span>';
            }
            ?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->