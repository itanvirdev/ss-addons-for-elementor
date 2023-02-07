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
class SS_Stories extends Widget_Base {

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
        return 'stories';
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
        return __('Stories', 'ss-addons');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'ss_services',
            [
                'label' => esc_html__('Stories List', 'ss-addons'),
                'description' => esc_html__('Control all the style settings from Style tab', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ss_story_image',
            [
                'label' => esc_html__('Upload Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'ss_service_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'ss-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ss_service_description',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ss_service_meta',
            [
                'label' => esc_html__('Meta', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Meta Text.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ss_services_link_switcher',
            [
                'label' => esc_html__('Add Services link', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ss-addons'),
                'label_off' => esc_html__('No', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'ss_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'ss-addons'),
                'title' => esc_html__('Enter button text', 'ss-addons'),
                'label_block' => true,
                'condition' => [
                    'ss_services_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'ss_services_link_type',
            [
                'label' => esc_html__('Service Link Type', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ss_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ss_services_link',
            [
                'label' => esc_html__('Service Link link', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ss-addons'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'ss_services_link_type' => '1',
                    'ss_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ss_services_page_link',
            [
                'label' => esc_html__('Select Service Link Page', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ss_get_all_pages(),
                'condition' => [
                    'ss_services_link_type' => '2',
                    'ss_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ss_service_list',
            [
                'label' => esc_html__('Services - List', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ss_service_title' => esc_html__('Business Stratagy', 'ss-addons'),
                    ],
                    [
                        'ss_service_title' => esc_html__('Website Development', 'ss-addons')
                    ],
                    [
                        'ss_service_title' => esc_html__('Marketing & Reporting', 'ss-addons')
                    ]
                ],
                'title_field' => '{{{ ss_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'ss_service_align',
            [
                'label' => esc_html__('Alignment', 'ss-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'ss-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'ss-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'ss-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'ss-post-thumb',
            ]
        );
        $this->end_controls_section();

        // TAB_STYLE
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

        <?php if ($settings['ss_design_style']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
        ?>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>


            <section class="stories">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['ss_service_list'] as $item) :

                            if (!empty($item['ss_story_image']['url'])) {
                                $ss_story_image_url = !empty($item['ss_story_image']['id']) ? wp_get_attachment_image_url($item['ss_story_image']['id'], $settings['thumbnail_size']) : $item['ss_story_image']['url'];
                                $ss_story_image_alt = get_post_meta($item["ss_story_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // Link
                            if ('2' == $item['ss_services_link_type']) {
                                $link = get_permalink($item['ss_services_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ss_services_link']['url']) ? $item['ss_services_link']['url'] : '';
                                $target = !empty($item['ss_services_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ss_services_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-12 mb-50">
                                <div class="storiesBlock">
                                    <div class="storiesBlock__thumb">
                                        <a class="storiesBlock__thumb__link" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                            <img class="portfolioBlock__figure__thumb" src="<?php echo esc_url($ss_story_image_url); ?>" alt="<?php echo esc_url($ss_story_image_alt); ?>">
                                        </a>
                                    </div>
                                    <div class="storiesBlock__content">
                                        <?php if (!empty($item['ss_service_title'])) : ?>
                                            <h3 class="storiesBlock__heading text-uppercase">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo ss_kses($item['ss_service_title']); ?></a>
                                            </h3>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ss_service_meta'])) : ?>
                                            <div class="storiesBlock__meta">
                                                <?php echo ss_kses($item['ss_service_meta']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ss_service_description'])) : ?>
                                            <p class="storiesBlock__text"><?php echo ss_kses($item['ss_service_description']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="storiesBlock__detailsLink">
                                                <?php echo ss_kses($item['ss_services_btn_text']); ?>
                                                <svg width="61" height="12" viewBox="0 0 61 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M60.5303 6.53033C60.8232 6.23744 60.8232 5.76256 60.5303 5.46967L55.7574 0.696699C55.4645 0.403806 54.9896 0.403806 54.6967 0.696699C54.4038 0.989593 54.4038 1.46447 54.6967 1.75736L58.9393 6L54.6967 10.2426C54.4038 10.5355 54.4038 11.0104 54.6967 11.3033C54.9896 11.5962 55.4645 11.5962 55.7574 11.3033L60.5303 6.53033ZM0 6.75H60V5.25H0V6.75Z" fill="#0D0D0D" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new SS_Stories());
