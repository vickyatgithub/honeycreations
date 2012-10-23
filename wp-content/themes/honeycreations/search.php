<?php
/* Search Results
 *
 * @since   1.0
 * @alter   2.1.3
*/

get_header('search'); ?>
<div id="grid">

<?php if ( have_posts() ) : ?>

<?php
/* Run the loop to output the posts.
* If you want to overload this in a child theme then include a file
* called loop-index.php and that will be used instead.
*/
get_template_part( 'loop', 'search' );
?>

<?php else : ?>
	
    <div class="box">
    	<div class="box-content not-found">
        	<h2><?php _e('Sorry, nothing was found for your search', 'shaken'); ?></h2>
            <p><?php _e('Maybe try searching for something different.', 'shaken'); ?></p>
            <?php get_search_form(); ?>
        </div>
    </div>
    
<?php endif; ?>
</div><!-- #grid -->
<?php get_footer('search'); ?>