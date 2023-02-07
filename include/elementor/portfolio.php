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
class SS_Portfolio extends Widget_Base {

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
        return 'portfolio-list';
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
        return __('Portfolio', 'ss-addons');
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
                    'layout-2' => esc_html__('Layout 2', 'ss-addons'),
                    'layout-3' => esc_html__('Layout 3', 'ss-addons'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'ss_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'ss-addons'),
                'description' => esc_html__('Control all the style settings from Style tab', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'ss-addons'),
                    'style_2' => __('Style 2', 'ss-addons'),
                    'style_3' => __('Style 3', 'ss-addons'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'ss_portfolio_image',
            [
                'label' => esc_html__('Upload Icon Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'ss_portfolio_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'ss-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ss_portfolio_description',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ss_portfolio_link_switcher',
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
            'ss_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'ss-addons'),
                'title' => esc_html__('Enter button text', 'ss-addons'),
                'label_block' => true,
                'condition' => [
                    'ss_portfolio_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'ss_portfolio_link_type',
            [
                'label' => esc_html__('Service Link Type', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'ss_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'ss_portfolio_link',
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
                    'ss_portfolio_link_type' => '1',
                    'ss_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'ss_portfolio_page_link',
            [
                'label' => esc_html__('Select Service Link Page', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ss_get_all_pages(),
                'condition' => [
                    'ss_portfolio_link_type' => '2',
                    'ss_portfolio_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ss_portfolio_list',
            [
                'label' => esc_html__('Services - List', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ss_portfolio_title' => esc_html__('Business Stratagy', 'ss-addons'),
                    ],
                    [
                        'ss_portfolio_title' => esc_html__('Website Development', 'ss-addons')
                    ],
                    [
                        'ss_portfolio_title' => esc_html__('Marketing & Reporting', 'ss-addons')
                    ],
                    [
                        'ss_portfolio_title' => esc_html__('Mobile Development', 'ss-addons')
                    ],
                    [
                        'ss_portfolio_title' => esc_html__('Marketing & Reporting', 'ss-addons')
                    ],
                    [
                        'ss_portfolio_title' => esc_html__('Mobile Development', 'ss-addons')
                    ],
                ],
                'title_field' => '{{{ ss_portfolio_title }}}',
            ]
        );
        $this->add_responsive_control(
            'ss_portfolio_align',
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

        // ss_portfolio_columns_section
        $this->start_controls_section(
            'ss_portfolio_columns_section',
            [
                'label' => esc_html__('Portfolio - Columns', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_portfolio__for_desktop',
            [
                'label' => esc_html__('Columns for Desktop', 'ss-addons'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'ss-addons'),
                    6 => esc_html__('2 Columns', 'ss-addons'),
                    4 => esc_html__('3 Columns', 'ss-addons'),
                    3 => esc_html__('4 Columns', 'ss-addons'),
                    2 => esc_html__('6 Columns', 'ss-addons'),
                    1 => esc_html__('12 Columns', 'ss-addons'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'ss_portfolio__for_laptop',
            [
                'label' => esc_html__('Columns for Laptop', 'ss-addons'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'ss-addons'),
                    6 => esc_html__('2 Columns', 'ss-addons'),
                    4 => esc_html__('3 Columns', 'ss-addons'),
                    3 => esc_html__('4 Columns', 'ss-addons'),
                    2 => esc_html__('6 Columns', 'ss-addons'),
                    1 => esc_html__('12 Columns', 'ss-addons'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'ss_portfolio__for_tablet',
            [
                'label' => esc_html__('Columns for Tablet', 'ss-addons'),
                'description' => esc_html__('Screen width equal to or greater than 576px', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'ss-addons'),
                    6 => esc_html__('2 Columns', 'ss-addons'),
                    4 => esc_html__('3 Columns', 'ss-addons'),
                    3 => esc_html__('4 Columns', 'ss-addons'),
                    2 => esc_html__('6 Columns', 'ss-addons'),
                    1 => esc_html__('12 Columns', 'ss-addons'),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            '
            ',
            [
                'label' => esc_html__('Columns for Mobile', 'ss-addons'),
                'description' => esc_html__('Screen width less than 576px', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'ss-addons'),
                    6 => esc_html__('2 Columns', 'ss-addons'),
                    4 => esc_html__('3 Columns', 'ss-addons'),
                    3 => esc_html__('4 Columns', 'ss-addons'),
                    5 => esc_html__('5 Columns (For Carousel Item)', 'ss-addons'),
                    2 => esc_html__('6 Columns', 'ss-addons'),
                    1 => esc_html__('12 Columns', 'ss-addons'),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
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

        <?php if ($settings['ss_design_style']  == 'layout-2') : ?>
            <section class="portfolio-area">
                <div class="container-fluid p-0 overflow-hidden">
                    <div class="row g-0">
                        <?php foreach ($settings['ss_portfolio_list'] as $key => $item) :
                            if (!empty($item['ss_portfolio_image']['url'])) {
                                $ss_portfolio_image_url = !empty($item['ss_portfolio_image']['id']) ? wp_get_attachment_image_url($item['ss_portfolio_image']['id'], $settings['thumbnail_size']) : $item['ss_portfolio_image']['url'];
                                $ss_portfolio_image_alt = get_post_meta($item["ss_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // Link
                            if ('2' == $item['ss_portfolio_link_type']) {
                                $link = get_permalink($item['ss_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ss_portfolio_link']['url']) ? $item['ss_portfolio_link']['url'] : '';
                                $target = !empty($item['ss_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ss_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }

                            $active = $key == 1 ? 'portfolioBlock--active' : '';
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ss_portfolio__for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ss_portfolio__for_laptop']); ?> col-md-<?php echo esc_attr($settings['ss_portfolio__for_tablet']); ?> col-<?php echo esc_attr($settings['ss_portfolio__for_mobile']); ?>">
                                <div class="portfolioBlock portfolioBlock--style2 position-relative <?php echo esc_attr($active); ?>">
                                    <figure class="portfolioBlock__figure">

                                        <img class="portfolioBlock__figure__thumb" src="<?php echo esc_url($ss_portfolio_image_url); ?>" alt="<?php echo esc_url($ss_portfolio_image_alt); ?>">

                                        <div class="portfolioBlock__figure__shape">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shapes/portfolio-shape-2.svg" alt="shape">
                                            <?php if ($item['ss_portfolio_link_switcher'] == 'yes') : ?>
                                                <a class="portfolioBlock__more" href="<?php echo esc_url($link); ?>">
                                                    <svg width="20" height="13" viewBox="0 0 20 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.6758 0.734375L11.8164 1.59375C11.6445 1.80859 11.6445 2.10938 11.8594 2.32422L15.2969 5.63281H0.515625C0.214844 5.63281 0 5.89062 0 6.14844V7.35156C0 7.65234 0.214844 7.86719 0.515625 7.86719H15.2969L11.8594 11.2188C11.6445 11.4336 11.6445 11.7344 11.8164 11.9492L12.6758 12.8086C12.8906 12.9805 13.1914 12.9805 13.4062 12.8086L19.0781 7.13672C19.25 6.92188 19.25 6.62109 19.0781 6.40625L13.4062 0.734375C13.1914 0.5625 12.8906 0.5625 12.6758 0.734375Z" fill="white" />
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </figure>
                                    <div class="portfolioBlock__content">
                                        <?php if (!empty($link)) : ?>
                                            <div class="sv-btn">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="portfolioBlock__hashLink mb-10"><span><?php echo ss_kses($item['ss_portfolio_btn_text']); ?></span></a>
                                            </div>
                                        <?php endif; ?>
                                        <h2 class="portfolioBlock__heading text-uppercase">
                                            <?php if ($item['ss_portfolio_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo ss_kses($item['ss_portfolio_title']); ?></a>
                                            <?php else : ?>
                                                <?php echo ss_kses($item['ss_portfolio_title']); ?>
                                            <?php endif; ?>
                                        </h2>
                                        <?php if (!empty($item['ss_portfolio_description'])) : ?>
                                            <p><?php echo ss_kses($item['ss_portfolio_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <section class="portfolio">
                <div class="container-fluid p-0 overflow-hidden">
                    <div class="row g-0">
                        <?php foreach ($settings['ss_portfolio_list'] as $item) :
                            if (!empty($item['ss_portfolio_image']['url'])) {
                                $ss_portfolio_image_url = !empty($item['ss_portfolio_image']['id']) ? wp_get_attachment_image_url($item['ss_portfolio_image']['id'], $settings['thumbnail_size']) : $item['ss_portfolio_image']['url'];
                                $ss_portfolio_image_alt = get_post_meta($item["ss_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // Link
                            if ('2' == $item['ss_portfolio_link_type']) {
                                $link = get_permalink($item['ss_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['ss_portfolio_link']['url']) ? $item['ss_portfolio_link']['url'] : '';
                                $target = !empty($item['ss_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['ss_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['ss_portfolio__for_desktop']); ?> col-lg-<?php echo esc_attr($settings['ss_portfolio__for_laptop']); ?> col-md-<?php echo esc_attr($settings['ss_portfolio__for_tablet']); ?> col-<?php echo esc_attr($settings['ss_portfolio__for_mobile']); ?>">
                                <div class="portfolioBlock position-relative">
                                    <figure class="portfolioBlock__figure">
                                        <img class="portfolioBlock__figure__thumb" src="<?php echo esc_url($ss_portfolio_image_url); ?>" alt="<?php echo esc_url($ss_portfolio_image_alt); ?>">
                                        <div class="portfolioBlock__figure__shape">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shapes/portfolio-shape.png" alt="Gainioz">
                                        </div>
                                    </figure>
                                    <div class="portfolioBlock__content">
                                        <h2 class="portfolioBlock__heading text-uppercase">
                                            <?php if ($item['ss_portfolio_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo ss_kses($item['ss_portfolio_title']); ?></a>
                                            <?php else : ?>
                                                <?php echo ss_kses($item['ss_portfolio_title']); ?>
                                            <?php endif; ?>
                                        </h2>

                                        <?php if (!empty($item['ss_portfolio_description'])) : ?>
                                            <p><?php echo ss_kses($item['ss_portfolio_description']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <div class="sv-btn">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="portfolioBlock__hashLink"><span><?php echo ss_kses($item['ss_portfolio_btn_text']); ?></span></a>
                                            </div>
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

$widgets_manager->register(new SS_Portfolio());
