<?php
/**
 * The template for displaying the front page.
 * SOLID Refactoring - Template Fragments
 */

get_header();
?>

<main id="primary" class="site-main dm-modern-structure">

    <?php 
    // Hero Section
    get_template_part('template-parts/content', 'hero'); 

    // Profile Section
    get_template_part('template-parts/content', 'profile'); 

    // Services Section
    get_template_part('template-parts/content', 'services'); 

    // Process Section
    get_template_part('template-parts/content', 'proceso'); 

    // FAQ Section
    get_template_part('template-parts/content', 'faq'); 

    // Contact Section
    get_template_part('template-parts/content', 'contact'); 
    ?>

</main>

<?php
get_footer();
