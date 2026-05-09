<?php
/**
 * The template for displaying the front page.
 * PHASE 4: Sovereign Migration (Native-First)
 */

use DataMaq\UI\ViewModels\HomeViewModel;

// Initialize ViewModel
$repo = dm_content_repo();
$vm   = new HomeViewModel( $repo );

get_header( null, array( 'vm' => $vm ) ); 
?>

<!-- Native Home Styles -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/HomePage.css">

<div class="app-shell--home">
	<main id="contenido-principal" class="c-home-main with-floating-cta">

		<?php
		// 1. Hero Section
		include locate_template( 'parts/home/hero.php' );

		// 2. Profile Section
		include locate_template( 'parts/home/profile.php' );

		// 3. Services Section
		include locate_template( 'parts/home/services.php' );

		// 4. Process Section
		include locate_template( 'parts/home/process.php' );

		// 5. FAQ Section
		include locate_template( 'parts/home/faq.php' );

		// 6. Contact Section (Still legacy or placeholder)
		get_template_part( 'template-parts/content', 'contact' );
		?>

	</main>
</div>

<?php 
// WhatsApp FAB (Native)
get_template_part( 'parts/whatsapp-fab' );

get_footer(); 
?>
