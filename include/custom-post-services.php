<?php
class ssServicesPost {
	function __construct() {
		add_action('init', array($this, 'register_custom_post_type'));
		add_action('init', array($this, 'create_cat'));
		add_filter('template_include', array($this, 'services_template_include'));
	}

	public function services_template_include($template) {
		if (is_singular('services')) {
			return $this->get_template('single-services.php');
		}
		return $template;
	}

	public function get_template($template) {
		if ($theme_file = locate_template(array($template))) {
			$file = $theme_file;
		} else {
			$file = SS_ADDONS_DIR . '/include/template/' . $template;
		}
		return apply_filters(__FUNCTION__, $file, $template);
	}


	public function register_custom_post_type() {
		// $medidove_mem_slug = get_theme_mod('medidove_mem_slug','member'); 
		$labels = array(
			'name'                  => esc_html_x('Services', 'Post Type General Name', 'ss-addons'),
			'singular_name'         => esc_html_x('Service', 'Post Type Singular Name', 'ss-addons'),
			'menu_name'             => esc_html__('Service', 'ss-addons'),
			'name_admin_bar'        => esc_html__('Service', 'ss-addons'),
			'archives'              => esc_html__('Item Archives', 'ss-addons'),
			'parent_item_colon'     => esc_html__('Parent Item:', 'ss-addons'),
			'all_items'             => esc_html__('All Items', 'ss-addons'),
			'add_new_item'          => esc_html__('Add New Service', 'ss-addons'),
			'add_new'               => esc_html__('Add New', 'ss-addons'),
			'new_item'              => esc_html__('New Item', 'ss-addons'),
			'edit_item'             => esc_html__('Edit Item', 'ss-addons'),
			'update_item'           => esc_html__('Update Item', 'ss-addons'),
			'view_item'             => esc_html__('View Item', 'ss-addons'),
			'search_items'          => esc_html__('Search Item', 'ss-addons'),
			'not_found'             => esc_html__('Not found', 'ss-addons'),
			'not_found_in_trash'    => esc_html__('Not found in Trash', 'ss-addons'),
			'featured_image'        => esc_html__('Featured Image', 'ss-addons'),
			'set_featured_image'    => esc_html__('Set featured image', 'ss-addons'),
			'remove_featured_image' => esc_html__('Remove featured image', 'ss-addons'),
			'use_featured_image'    => esc_html__('Use as featured image', 'ss-addons'),
			'inserbt_into_item'     => esc_html__('Insert into item', 'ss-addons'),
			'uploaded_to_this_item' => esc_html__('Uploaded to this item', 'ss-addons'),
			'items_list'            => esc_html__('Items list', 'ss-addons'),
			'items_list_navigation' => esc_html__('Items list navigation', 'ss-addons'),
			'filter_items_list'     => esc_html__('Filter items list', 'ss-addons'),
		);

		$args   = array(
			'label'                 => esc_html__('Service', 'ss-addons'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'   			=> 'dashicons-shield',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);

		register_post_type('services', $args);
	}

	public function create_cat() {
		$labels = array(
			'name'                       => esc_html_x('Service Categories', 'Taxonomy General Name', 'ss-addons'),
			'singular_name'              => esc_html_x('Service Categories', 'Taxonomy Singular Name', 'ss-addons'),
			'menu_name'                  => esc_html__('Service Categories', 'ss-addons'),
			'all_items'                  => esc_html__('All Service Category', 'ss-addons'),
			'parent_item'                => esc_html__('Parent Item', 'ss-addons'),
			'parent_item_colon'          => esc_html__('Parent Item:', 'ss-addons'),
			'new_item_name'              => esc_html__('New Service Category Name', 'ss-addons'),
			'add_new_item'               => esc_html__('Add New Service Category', 'ss-addons'),
			'edit_item'                  => esc_html__('Edit Service Category', 'ss-addons'),
			'update_item'                => esc_html__('Update Service Category', 'ss-addons'),
			'view_item'                  => esc_html__('View Service Category', 'ss-addons'),
			'separate_items_with_commas' => esc_html__('Separate items with commas', 'ss-addons'),
			'add_or_remove_items'        => esc_html__('Add or remove items', 'ss-addons'),
			'choose_from_most_used'      => esc_html__('Choose from the most used', 'ss-addons'),
			'popular_items'              => esc_html__('Popular Service Category', 'ss-addons'),
			'search_items'               => esc_html__('Search Service Category', 'ss-addons'),
			'not_found'                  => esc_html__('Not Found', 'ss-addons'),
			'no_terms'                   => esc_html__('No Service Category', 'ss-addons'),
			'items_list'                 => esc_html__('Service Category list', 'ss-addons'),
			'items_list_navigation'      => esc_html__('Service Category list navigation', 'ss-addons'),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy('services-cat', 'services', $args);
	}
}

new ssServicesPost();
