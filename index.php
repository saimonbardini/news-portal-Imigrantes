<?php
/**
 * O arquivo principal de template.
 *
 * @package Radio_News_Theme
 */

get_header();
?>

<div class="container mx-auto px-4 py-8 max-w-6xl mb-24">
    <?php
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) :
            ?>
            <header class="mb-8 border-b-2 border-[#c4170c] pb-2">
                <h1 class="page-title text-3xl font-bold uppercase text-[#c4170c]"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">';

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', get_post_type() );

        endwhile;

        echo '</div>';

        the_posts_navigation(array(
            'prev_text' => '<span class="font-bold text-[#c4170c] uppercase">← Anteriores</span>',
            'next_text' => '<span class="font-bold text-[#c4170c] uppercase">Mais recentes →</span>',
            'class'     => 'mt-8 flex justify-between'
        ));

    else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>
</div>

<?php
get_footer();
