<?php
/* Frontpage (Blog)
 *
 * @since   1.0
 * @alter   1.6
*/

get_header(); ?>

<div id="grid" style="width:100%">

<?php
/* Run the loop to output the posts.
* If you want to overload this in a child theme then include a file
* called loop-index.php and that will be used instead.
*/
get_template_part( 'loop', 'index' );
?>
</div><!-- #grid -->
    
<?php get_footer(); ?>