<br class="clearfix" />
<div id="footer">
    <div class="wrap">
	<p><?php _e('Copyright', 'shaken'); ?> &copy; <?php echo date('Y'); ?> <?php echo of_get_option('copyright'); ?> 
	
		<?php if(current_theme_supports('shaken_footer_credit')): ?>
        <span class="alignright">
            <?php _e('Powered by', 'shaken'); ?> <a href="http://shakenandstirredweb.com/theme/shaken-grid" target="_blank">Shaken Grid Premium</a><br />
        </span>
        <?php endif; ?>
        
    </p>
    <div class="clearfix"></div>
    </div><!-- #wrap -->
</div><!-- #footer -->

<script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js?v=20120423234912"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js?v=20120423234909"></script>

<?php if( is_home() || is_archive() || is_search() ): ?>
	<script src="http://platform.tumblr.com/v1/share.js"></script>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>