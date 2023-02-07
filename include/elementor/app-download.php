<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_App_Donwload extends Widget_Base {

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
        return 'ss-app';
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
        return __('App Donwload', 'ss-addons');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'ss_bg_color',
            [
                'label' => __('BG Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#A794C8',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}} .ss-el-bg-color' => 'background-color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        // ss_section_title
        $this->start_controls_section(
            'ss_section_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('SS Title Here', 'ss-addons'),
                'placeholder' => esc_html__('Type Heading Text', 'ss-addons'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ss_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'ss-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'ss-addons'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'ss-addons'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'ss-addons'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'ss-addons'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'ss-addons'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'ss-addons'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'ss_align',
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
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();


        // ss_btn_button_group
        $this->start_controls_section(
            'ss_btn_button_group',
            [
                'label' => esc_html__('Button', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ss-addons'),
                'label_off' => esc_html__('Hide', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ss_btn_text',
            [
                'label' => esc_html__('Button Text', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Google play', 'ss-addons'),
                'title' => esc_html__('Enter button text', 'ss-addons'),
                'label_block' => true,
                'condition' => [
                    'ss_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'ss_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'ss_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'ss_btn_link',
            [
                'label' => esc_html__('Button link', 'ss-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ss-addons'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'ss_btn_link_type' => '1',
                    'ss_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'ss-addons'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ss_get_all_pages(),
                'condition' => [
                    'ss_btn_link_type' => '2',
                    'ss_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // ss_btn_button_group
        $this->start_controls_section(
            'ss_btn_2_button_group',
            [
                'label' => esc_html__('Button 2', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_btn_2_button_show',
            [
                'label' => esc_html__('Show Button', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ss-addons'),
                'label_off' => esc_html__('Hide', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ss_btn_2_text',
            [
                'label' => esc_html__('Button Text', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Apple store', 'ss-addons'),
                'title' => esc_html__('Enter button text', 'ss-addons'),
                'label_block' => true,
                'condition' => [
                    'ss_btn_2_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'ss_btn_2_link_type',
            [
                'label' => esc_html__('Button Link Type', 'ss-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'ss_btn_2_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'ss_btn_2_link',
            [
                'label' => esc_html__('Button link', 'ss-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ss-addons'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'ss_btn_2_link_type' => '1',
                    'ss_btn_2_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'ss_btn_2_page_link',
            [
                'label' => esc_html__('Select Button Page', 'ss-addons'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => ss_get_all_pages(),
                'condition' => [
                    'ss_btn_2_link_type' => '2',
                    'ss_btn_2_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();



        // _ss_image
        $this->start_controls_section(
            '_ss_image',
            [
                'label' => esc_html__('Thumbnail', 'ss-addons'),
            ]
        );
        $this->add_control(
            'ss_image',
            [
                'label' => esc_html__('Choose Image', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'ss_image_2',
            [
                'label' => esc_html__('Choose BG Image', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'ss_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
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

        <?php if ($settings['ss_design_style']  == 'layout-2') :
            if (!empty($settings['ss_image']['url'])) {
                $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
                $ss_image_alt = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['ss_image_2']['url'])) {
                $ss_image_2 = !empty($settings['ss_image_2']['id']) ? wp_get_attachment_image_url($settings['ss_image_2']['id'], 'full') : $settings['ss_image_2']['url'];
                $ss_image_2_alt = get_post_meta($settings["ss_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'app__title');

            // Link
            if ('2' == $settings['ss_btn_link_type']) {
                $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
                $this->add_render_attribute('ss-button-arg', 'target', '_self');
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button-arg', 'class', 'app-btn');
            } else {
                if (!empty($settings['ss_btn_link']['url'])) {
                    $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                    $this->add_render_attribute('ss-button-arg', 'class', 'app-btn');
                }
            }

            // Link 2
            if ('2' == $settings['ss_btn_2_link_type']) {
                $this->add_render_attribute('ss-button2-arg', 'href', get_permalink($settings['ss_btn_2_page_link']));
                $this->add_render_attribute('ss-button2-arg', 'target', '_self');
                $this->add_render_attribute('ss-button2-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button2-arg', 'class', 'app-btn');
            } else {
                if (!empty($settings['ss_btn_2_link']['url'])) {
                    $this->add_link_attributes('ss-button2-arg', $settings['ss_btn_2_link']);
                    $this->add_render_attribute('ss-button2-arg', 'class', 'app-btn');
                }
            }

        ?>

            <section class="app__area">
                <div class="container">
                    <div class="app__inner ss-el-bg-color p-relative fix">
                        <div class="app__shape">
                            <img class="app__shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/app/app-shape-1.png" alt="img">
                            <img class="app__shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/app/app-shape-2.png" alt="img">
                        </div>
                        <div class="row align-items-center">
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="app__wrapper p-relative z-index-1">
                                    <?php
                                    if (!empty($settings['ss_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['ss_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            ss_kses($settings['ss_title'])
                                        );
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="app__download p-relative z-index-1 d-sm-flex align-items-center justify-content-lg-end">
                                    <?php if (!empty($settings['ss_btn_text'])) : ?>
                                        <div class="app__item mr-15">
                                            <a href="#">
                                                <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/app/google-play.png" alt="img"></span>
                                                <?php echo $settings['ss_btn_text']; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['ss_btn_2_text'])) : ?>
                                        <div class="app__item">
                                            <a href="#" class="active">
                                                <span class="apple"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/app/apple.png" alt="img"></span>
                                                <?php echo $settings['ss_btn_2_text']; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php else :
            if (!empty($settings['ss_image']['url'])) {
                $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
                $ss_image_alt = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['ss_image_2']['url'])) {
                $ss_image_2 = !empty($settings['ss_image_2']['id']) ? wp_get_attachment_image_url($settings['ss_image_2']['id'], 'full') : $settings['ss_image_2']['url'];
                $ss_image_2_alt = get_post_meta($settings["ss_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'research__title-2');

            // Link
            if ('2' == $settings['ss_btn_link_type']) {
                $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
                $this->add_render_attribute('ss-button-arg', 'target', '_self');
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button-arg', 'class', 'app-btn');
            } else {
                if (!empty($settings['ss_btn_link']['url'])) {
                    $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                    $this->add_render_attribute('ss-button-arg', 'class', 'app-btn');
                }
            }

            // Link 2
            if ('2' == $settings['ss_btn_2_link_type']) {
                $this->add_render_attribute('ss-button2-arg', 'href', get_permalink($settings['ss_btn_2_page_link']));
                $this->add_render_attribute('ss-button2-arg', 'target', '_self');
                $this->add_render_attribute('ss-button2-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button2-arg', 'class', 'app-btn');
            } else {
                if (!empty($settings['ss_btn_2_link']['url'])) {
                    $this->add_link_attributes('ss-button2-arg', $settings['ss_btn_2_link']);
                    $this->add_render_attribute('ss-button2-arg', 'class', 'app-btn');
                }
            }
        ?>

            <div class="research__download ss-el-bg-color">
                <div class="research__download-bg include-bg" data-background="<?php echo esc_url($ss_image_2); ?>"></div>
                <div class="research__content-2 p-relative z-index-1">
                    <?php
                    if (!empty($settings['ss_title'])) :
                        printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['ss_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            ss_kses($settings['ss_title'])
                        );
                    endif;
                    ?>
                    <div class="research__store">
                        <ul>
                            <?php if (!empty($settings['ss_btn_text'])) : ?>
                                <li>
                                    <a <?php echo $this->get_render_attribute_string('ss-button-arg'); ?>>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/google-play-store.png" alt="google-play-store">
                                        <?php echo $settings['ss_btn_text']; ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($settings['ss_btn_2_text'])) : ?>
                                <li>
                                    <a <?php echo $this->get_render_attribute_string('ss-button2-arg'); ?>>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/apple-store.png" alt="apple-store">
                                        <?php echo $settings['ss_btn_2_text']; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <?php if (!empty($ss_image)) : ?>
                    <div class="research__thumb-2">
                        <img src="<?php echo esc_url($ss_image); ?>" alt="<?php echo esc_attr($ss_image_alt); ?>">
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new SS_App_Donwload());
