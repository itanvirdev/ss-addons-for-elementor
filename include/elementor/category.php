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
class SS_Categories extends Widget_Base {

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
        return 'ss-categories';
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
        return __('Categories', 'ss-addons');
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

        // ss_section_title
        $this->start_controls_section(
            'ss_section_title',
            [
                'label' => esc_html__('Title & Content', 'ss-addons'),
            ]
        );

        $this->add_control(
            'ss_section_title_show',
            [
                'label' => esc_html__('Section Title & Content', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ss-addons'),
                'label_off' => esc_html__('Hide', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
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

        // Service group
        $this->start_controls_section(
            'ss_categories',
            [
                'label' => esc_html__('Category List', 'ss-addons'),
                'description' => esc_html__('Control all the style settings from Style tab', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_cat_normal',
            [
                'label' => __('Icon Color', 'ss-addons'),
            ]
        );

        $repeater->add_control(
            'ss_cat_icon_bg_color',
            [
                'label' => __('Icon BG Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ECF0FF',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .category__icon a' => 'background-color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'ss_cat_icon_color',
            [
                'label' => __('Icon Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4270FF',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .category__icon a' => 'color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );
        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_cat_hover',
            [
                'label' => __('Icon Hover Color', 'ss-addons'),
            ]
        );
        $repeater->add_control(
            'ss_cat_icon_bg_hover_color',
            [
                'label' => __('Icon BG Hover Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4270FF',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.category__item:hover .category__icon a' => 'background-color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'ss_cat_icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.category__item:hover .category__icon a' => 'color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();
        // icon tab end

        $repeater->add_control(
            'ss_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'ss-addons'),
                    'icon' => esc_html__('Icon', 'ss-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'ss_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ss_features_icon_type' => 'image'
                ]

            ]
        );

        if (ss_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'ss_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'eicon-star-o',
                    'condition' => [
                        'ss_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'ss_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'ss_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

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

        $this->add_control(
            'ss_course_link',
            [
                'label' => esc_html__('More Button Link', 'ss-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'ss-addons'),
                'placeholder' => esc_html__('Course Link', 'ss-addons'),
                'label_block' => true,
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
            $this->add_render_attribute('title_args', 'class', 'section__title-2 section__title-2-30');
            // Link
            if ('2' == $settings['ss_btn_link_type']) {
                $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
                $this->add_render_attribute('ss-button-arg', 'target', '_self');
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('ss-button-arg', 'class', 'ss-btn-5');
            } else {
                if (!empty($settings['ss_btn_link']['url'])) {
                    $this->add_link_attributes('ss-button-arg', $settings['ss_btn_link']);
                    $this->add_render_attribute('ss-button-arg', 'class', 'ss-btn-5');
                }
            }
        ?>

            <section class="category__area">
                <div class="container">
                    <div class="row">
                        <?php if (!empty($settings['ss_section_title_show'])) : ?>
                            <div class="col-xxl-4 col-xl-4 col-lg-4">
                                <div class="category__wrapper">
                                    <div class="section__title-wrapper-2">
                                        <?php if (!empty($settings['ss_sub_title'])) : ?>
                                            <span class="section__title-pre-2">
                                                <?php echo ss_kses($settings['ss_sub_title']); ?>
                                            </span>
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

                                    <?php if (!empty($settings['ss_btn_text'])) : ?>
                                        <div class="category__btn">
                                            <a <?php echo $this->get_render_attribute_string('ss-button-arg'); ?>>
                                                <?php echo $settings['ss_btn_text']; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-xxl-8 col-xl-8 col-lg-8">
                            <div class="category__item-wrapper">
                                <div class="row">
                                    <?php foreach ($settings['ss_service_list'] as $item) :
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
                                        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                            <div class="category__item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> text-center mb-45">
                                                <div class="category__icon">
                                                    <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>">
                                                        <?php if ($item['ss_features_icon_type'] !== 'image') : ?>
                                                            <?php if (!empty($item['ss_features_icon']) || !empty($item['ss_features_selected_icon']['value'])) : ?>
                                                                <span class="cat__icon"><?php ss_render_icon($item, 'ss_features_icon', 'ss_features_selected_icon'); ?></span>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <span class="cat__icon">
                                                                <?php if (!empty($item['ss_features_image']['url'])) : ?>
                                                                    <img class="light" src="<?php echo $item['ss_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="category__content">
                                                    <?php if (!empty($item['ss_service_title'])) : ?>
                                                        <h4 class="category__title">
                                                            <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>"><?php echo ss_kses($item['ss_service_title']); ?></a>
                                                        </h4>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <?php if (!empty($settings['ss_course_link'])) : ?>
                                        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                                            <div class="category__item text-center mb-45">
                                                <div class="category__icon add">
                                                    <a href="<?php echo esc_url($settings['ss_course_link']); ?>">+</a>
                                                </div>
                                                <div class="category__content">
                                                    <h4 class="category__title add">
                                                        <a href="<?php echo esc_url($settings['ss_course_link']); ?>"><?php echo esc_html__('All Course', 'ss-addons'); ?></a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new SS_Categories());
