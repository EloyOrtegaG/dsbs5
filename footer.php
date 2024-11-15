</main><!-- /#main -->
<footer id="footer" class="pb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				
				<?php dynamic_sidebar('footer_widget_01'); ?>
			</div>
			<div class="col-md-4">
					<?php
				dynamic_sidebar('footer_widget_02');

				if (current_user_can('manage_options')):
					?>
					<span class="edit-link"><a href="<?php echo esc_url(admin_url('widgets.php')); ?>"
							class="badge bg-secondary"><?php esc_html_e('Edit', 'dsbs502'); ?></a></span><!-- Show Edit Widget link -->
					<?php
				endif;
				?>
				
				
			</div>
			<div class="col-md-4">

				<?php
				if (has_nav_menu('footer-menu')): // See function register_nav_menus() in functions.php
					/*
											 Loading WordPress Custom Menu (theme_location) ... remove <div> <ul> containers and show only <li> items!!!
											 Menu name taken from functions.php!!! ... register_nav_menu( 'footer-menu', 'Footer Menu' );
											 !!! IMPORTANT: After adding all pages to the menu, don't forget to assign this menu to the Footer menu of "Theme locations" /wp-admin/nav-menus.php (on left side) ... Otherwise the themes will not know, which menu to use!!!
										 */
					wp_nav_menu(
						array(
							'container' => 'nav',
							//'container_class' => 'col-md-6',
							//'fallback_cb'     => 'WP_Bootstrap4_Navwalker_Footer::fallback',
							'walker' => new WP_Bootstrap4_Navwalker_Footer(),
							'theme_location' => 'footer-menu',
							'items_wrap' => '<ul class="menu nav flex-column text-md-end">%3$s</ul>',
						)
					);
				endif;


				?>
			</div>
	

		</div><!-- /.row -->
		<div class="row mt-5 align-items-end">
			<div class="col-lg-6"><div class="d-lg-flex">
					<p>LOGO</p>
		
				</div></div>
			<div class="col-lg-6">
				<p class="text-md-end">
					<?php printf(esc_html__('&copy; %1$s %2$s.', 'dsbs502'), wp_date('Y'), get_bloginfo('name', 'display')); ?>
				</p>
			</div>
		</div>
	</div><!-- /.container -->
</footer><!-- /#footer -->
</div><!-- /#wrapper -->
<!-- <img src="./wp-content/uploads/2024/05/bg-footer.jpg" alt="" style="position: absolute; z-index:-1; object-fit:cover;"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
wp_footer();
?>

</body>

</html>