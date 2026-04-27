<?php
/**
 * The template for displaying the front page.
 * SOLID Refactoring - Template Fragments
 */

get_header();
?>

<main id="contenido-principal" class="c-home-main with-floating-cta">

    <?php 
    // Hero Section
    get_template_part('template-parts/content', 'hero'); 

    // Profile Section
    get_template_part('template-parts/content', 'profile'); 

    // Services Section
    get_template_part('template-parts/content', 'services'); 

    // Process Section


    // FAQ Section
    get_template_part('template-parts/content', 'faq'); 

    // Contact Section
    get_template_part('template-parts/content', 'contact'); 
    ?>

</main>

<?php
get_footer();
