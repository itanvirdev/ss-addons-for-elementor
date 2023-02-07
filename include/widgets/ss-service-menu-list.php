<?php

/**
 * SS Latest Services Menu List Widget
 *
 *
 * @author 		SecureSofts
 * @category 	Widgets
 * @package 	SSAddons/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */


add_action('widgets_init', 'SS_Latest_Services_Menu_List_Widget');
function SS_Latest_Services_Menu_List_Widget() {
	register_widget('SS_Latest_Services_Menu_List_Widget');
}
class SS_Latest_Services_Menu_List_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct('ss-services-menu-list', 'SS Services Menu', array(
			'description'	=> 'SS Services Menu'
		));
	}


	public function widget($args, $instance) {

		extract($args);
		echo $before_widget;
		if ($instance['title']) :
			echo $before_title; ?>
			<?php echo apply_filters('widget_title', $instance['title']); ?>
			<?php echo $after_title; ?>
		<?php endif; ?>

		<div class="services__widget-content">
			<div class="services__link">
				<?php
				wp_nav_menu(array(
					'theme_location'    => 'service-menu',
					'menu_class'        => '',
					'container'         => '',
				));
				?>
			</div>
		</div>

		<?php echo $after_widget; ?>

	<?php
	}



	public function form($instance) {
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$count = !empty($instance['count']) ? $instance['count'] : esc_html__('3', 'ss-addons');
		$posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : esc_html__('DESC', 'ss-addons');
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>

<?php }
}
