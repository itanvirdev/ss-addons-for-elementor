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
class SS_CTA extends Widget_Base {

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
        return 'ss-cta';
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
        return __('CTA', 'ss-addons');
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

        // ss_section_title
        $this->start_controls_section(
            'ss_section_title',
            [
                'label' => esc_html__('Title & Content', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_sub_title',
            [
                'label' => esc_html__('Sub Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('SS Sub Title', 'ss-addons'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'ss-addons'),
                'label_block' => true,
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
            'ss_desctiption',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('SS section description here', 'ss-addons'),
                'placeholder' => esc_html__('Type section description here', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_short_desctiption',
            [
                'label' => esc_html__('Short Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('SS section description here', 'ss-addons'),
                'placeholder' => esc_html__('Type section description here', 'ss-addons'),
                'condition' => [
                    'ss_design_style' => 'layout-2'
                ],
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
                'default' => esc_html__('Button Text', 'ss-addons'),
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


        // _section_exp_info
        $this->start_controls_section(
            '_section_exp_info',
            [
                'label' => __('Experience Info', 'ss-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'ss_design_style' => ['layout-2', 'layout-5'],
                ],
            ]
        );

        $this->add_control(
            'exp_num',
            [
                'label' => __('Number', 'ss-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('1998', 'ss-addons'),
                'placeholder' => __('Type number Here', 'ss-addons'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'exp_title',
            [
                'label' => __('Title', 'ss-addons'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('..Since..', 'ss-addons'),
                'placeholder' => __('Type your text', 'ss-addons'),
                'dynamic' => [
                    'active' => true,
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
            $this->add_render_attribute('title_args', 'class', 'section__title section__title-44');

            // Link
            if ('2' == $settings['ss_btn_link_type']) {
                $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
                $this->add_render_attribute('ss-button-arg', 'target', '_self');
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button-arg', 'class', 'play-video');
            } else {
                if (!empty($settings['ss_btn_link']['url'])) {
                    $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                    $this->add_render_attribute('ss-button-arg', 'class', 'play-video popup-video');
                }
            }

        ?>

            <section class="certificate__area pb-120 pt-120">
                <div class="container">
                    <div class="certificate__inner grey-bg-9 p-relative">
                        <?php if (!empty($ss_image)) : ?>
                            <div class="certificate__thumb">
                                <img src="<?php echo esc_url($ss_image); ?>" alt="<?php echo esc_attr($ss_image_alt); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-xxl-7">
                                <div class="certificate__content">
                                    <div class="section__title-wrapper mb-10">
                                        <?php if (!empty($settings['ss_sub_title'])) : ?>
                                            <span class="section__title-pre-3"><?php echo ss_kses($settings['ss_sub_title']); ?></span>
                                        <?php endif; ?>

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
                                    <?php if (!empty($settings['ss_desctiption'])) : ?>
                                        <p><?php echo ss_kses($settings['ss_desctiption']); ?></p>
                                    <?php endif; ?>

                                    <div class="certificate__links d-sm-flex align-items-center">
                                        <?php if (!empty($settings['ss_btn_button_show'])) : ?>
                                            <a <?php echo $this->get_render_attribute_string('ss-button-arg'); ?>>
                                                <i class="fa-solid fa-play"></i> <?php echo $settings['ss_btn_text']; ?>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($settings['ss_short_desctiption'])) : ?>
                                            <?php echo ss_kses($settings['ss_short_desctiption']); ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['ss_design_style']  == 'layout-3') :
            if (!empty($settings['ss_image']['url'])) {
                $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
                $ss_image_alt = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'ss-price-cta-heading');

            // Link
            if ('2' == $settings['ss_btn_link_type']) {
                $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
                $this->add_render_attribute('ss-button-arg', 'target', '_self');
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button-arg', 'class', 'ss-price-btn');
            } else {
                if (!empty($settings['ss_btn_link']['url'])) {
                    $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                    $this->add_render_attribute('ss-button-arg', 'class', 'ss-price-btn');
                }
            }

        ?>

            <div class="price__banner theme-bg-3 mb-30 fix p-relative">
                <div class="price__shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/price/price-shape.png" alt="img">
                </div>
                <div class="price__banner-content p-relative z-index-1">
                    <?php if (!empty($settings['ss_sub_title'])) : ?>
                        <span class="section__title-pre-3"><?php echo ss_kses($settings['ss_sub_title']); ?></span>
                    <?php endif; ?>
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
                    <?php if (!empty($settings['ss_desctiption'])) : ?>
                        <p><?php echo ss_kses($settings['ss_desctiption']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['ss_btn_button_show'])) : ?>
                        <a <?php echo $this->get_render_attribute_string('ss-button-arg'); ?>>
                            <?php echo $settings['ss_btn_text']; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (!empty($ss_image)) : ?>
                    <div class="price__thumb">
                        <img src="<?php echo esc_url($ss_image); ?>" alt="<?php echo esc_attr($ss_image_alt); ?>">
                    </div>
                <?php endif; ?>
            </div>

        <?php else :
            if (!empty($settings['ss_image']['url'])) {
                $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
                $ss_image_alt = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'ss-cta-title');

            // Link
            if ('2' == $settings['ss_btn_link_type']) {
                $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
                $this->add_render_attribute('ss-button-arg', 'target', '_self');
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button-arg', 'class', 'ss-btn-5 ss-btn-11');
            } else {
                if (!empty($settings['ss_btn_link']['url'])) {
                    $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                    $this->add_render_attribute('ss-button-arg', 'class', 'ss-btn-5 ss-btn-11');
                }
            }
        ?>


            <div class="course__enroll-wrapper p-relative d-sm-flex align-items-center justify-content-between include-bg" data-background="<?php echo esc_url($ss_image); ?>">
                <div class="course__enroll-icon">
                    <span>
                        <svg width="28" height="34" viewBox="0 0 28 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_d_268_615)">
                                <path d="M7.59649 15.161H11.2015V23.561C11.2015 25.521 12.2632 25.9177 13.5582 24.4477L22.3898 14.4144C23.4748 13.1894 23.0198 12.1744 21.3748 12.1744H17.7698V3.77435C17.7698 1.81435 16.7082 1.41769 15.4132 2.88769L6.58149 12.921C5.50816 14.1577 5.96316 15.161 7.59649 15.161Z" fill="white" />
                            </g>
                            <defs>
                                <filter id="filter0_d_268_615" x="2" y="2" width="24.9795" height="31.3354" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                    <feOffset dy="4" />
                                    <feGaussianBlur stdDeviation="2" />
                                    <feComposite in2="hardAlpha" operator="out" />
                                    <feColorMatrix type="matrix" values="0 0 0 0 0.825 0 0 0 0 0.38207 0 0 0 0 0 0 0 0 0.5 0" />
                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_268_615" />
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_268_615" result="shape" />
                                </filter>
                            </defs>
                        </svg>
                    </span>
                </div>
                <div class="course__enroll-content">
                    <?php if (!empty($settings['ss_sub_title'])) : ?>
                        <p><?php echo ss_kses($settings['ss_sub_title']); ?></p>
                    <?php endif; ?>
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
                    <?php if (!empty($settings['ss_desctiption'])) : ?>
                        <span><?php echo ss_kses($settings['ss_desctiption']); ?></span>
                    <?php endif; ?>
                </div>

                <?php if (!empty($settings['ss_btn_button_show'])) : ?>
                    <div class="course__enroll-btn pt-5">
                        <a <?php echo $this->get_render_attribute_string('ss-button-arg'); ?>>
                            <?php echo $settings['ss_btn_text']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new SS_CTA());
