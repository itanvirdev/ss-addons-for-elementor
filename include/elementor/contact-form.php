<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_Contact_Form extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'contactform';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __('Contact Form', 'ss-addons');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'ss-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['ss-addons'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return ['ss-addons'];
	}


	public function get_ss_contact_form() {
		if (!class_exists('WPCF7')) {
			return;
		}
		$ss_cfa         = array();
		$ss_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$ss_forms       = get_posts($ss_cf_args);
		$ss_cfa         = ['0' => esc_html__('Select Form', 'ss-addons')];
		if ($ss_forms) {
			foreach ($ss_forms as $ss_form) {
				$ss_cfa[$ss_form->ID] = $ss_form->post_title;
			}
		} else {
			$ss_cfa[esc_html__('No contact form found', 'ss-addons')] = 0;
		}
		return $ss_cfa;
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		// layout Panel
		$this->start_controls_section(
			'ss_layout',
			[
				'label' => esc_html__('Design Layout', 'ss-addons'),
			]
		);
		$this->add_control(
			'ss_design_style',
			[
				'label' => esc_html__('Select Layout', 'ss-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'ss-addons'),
					'layout-2' => esc_html__('Layout 2', 'ss-addons'),
				],
				'default' => 'layout-1',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sscore_contact',
			[
				'label' => esc_html__('Contact Form', 'ss-addons'),
			]
		);

		$this->add_control(
			'sscore_select_contact_form',
			[
				'label'   => esc_html__('Select Form', 'ss-addons'),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_ss_contact_form(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Style', 'ss-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __('Text Transform', 'ss-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'ss-addons'),
					'uppercase' => __('UPPERCASE', 'ss-addons'),
					'lowercase' => __('lowercase', 'ss-addons'),
					'capitalize' => __('Capitalize', 'ss-addons'),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

?>

		<?php if ($settings['ss_design_style']  == 'layout-2') : ?>

			<div class="innerWrapperSidebar">
				<div class="sidebarWidget">
					<?php if (!empty($settings['sscore_select_contact_form'])) : ?>
						<div class="contact__form m-0">
							<?php echo do_shortcode('[contact-form-7  id="' . $settings['sscore_select_contact_form'] . '"]'); ?>
						</div>
					<?php else : ?>
						<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'ss-addons') . '</p></div>'; ?>
					<?php endif; ?>
				</div>
			</div>

		<?php else : ?>

			<div class="contact__form">
				<!-- Start Contact Form -->
				<?php if (!empty($settings['sscore_select_contact_form'])) : ?>
					<div class="form-wrapper">
						<?php echo do_shortcode('[contact-form-7  id="' . $settings['sscore_select_contact_form'] . '"]'); ?>
					</div>
				<?php else : ?>
					<?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'ss-addons') . '</p></div>'; ?>
				<?php endif; ?>
			</div>


		<?php endif; ?>

<?php
	}
}

$widgets_manager->register(new SS_Contact_Form());
