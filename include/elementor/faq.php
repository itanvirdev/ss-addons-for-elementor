<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_FAQ extends Widget_Base {

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
		return 'ss-faq';
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
		return __('FAQ', 'ss-addons');
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

		$this->start_controls_section(
			'_accordion',
			[
				'label' => esc_html__('Accordion', 'ss-addons'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'accordion_title',
			[
				'label' => esc_html__('Accordion Item', 'ss-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('This is accordion item title', 'ss-addons'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'accordion_description',
			[
				'label' => esc_html__('Description', 'ss-addons'),
				'description' => ss_get_allowed_html_desc('intermediate'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
				'label_block' => true,
			]
		);
		$this->add_control(
			'accordions',
			[
				'label' => esc_html__('Repeater Accordion', 'ss-addons'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'accordion_title' => esc_html__('This is accordion item title #1', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('This is accordion item title #2', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('This is accordion item title #3', 'ss-addons'),
					],
					[
						'accordion_title' => esc_html__('This is accordion item title #4', 'ss-addons'),
					],
				],
				'title_field' => '{{{ accordion_title }}}',
			]
		);

		$this->add_control(
			'space_accordion_item',
			[
				'label' => esc_html__('Accordion space gap', 'ss-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rn-card + .rn-card' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
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


		<div class="faq__item-wrapper">
			<div class="faq__accordion">
				<div class="accordion" id="faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
					<?php foreach ($settings['accordions'] as $index => $item) :
						$collapsed = ($index == '0') ? '' : 'collapsed';
						$aria_expanded = ($index == '0') ? "true" : "false";
						$show = ($index == '0') ? "show" : "";
					?>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faqOne-<?php echo esc_attr($index); ?>">
								<button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
									<?php echo esc_html($item['accordion_title']); ?>
								</button>
							</h2>
							<div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="faqOne-<?php echo esc_attr($index); ?>" data-bs-parent="#faqaccordion-<?php echo esc_attr($this->get_id()); ?>">
								<div class="accordion-body">
									<p><?php echo ss_kses($item['accordion_description']); ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

<?php
	}
}

$widgets_manager->register(new SS_FAQ());
