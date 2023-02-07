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
class SS_Process extends Widget_Base {

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
        return 'process';
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
        return __('Process', 'ss-addons');
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

        $this->add_control(
            'ss_section_shape_show',
            [
                'label' => esc_html__('Shape ?', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ss-addons'),
                'label_off' => esc_html__('Hide', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
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

        // Service group
        $this->start_controls_section(
            'ss_process',
            [
                'label' => esc_html__('Process List', 'ss-addons'),
                'description' => esc_html__('Control all the style settings from Style tab', 'ss-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ss_process_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'ss-addons'),
                    'icon' => esc_html__('Icon', 'ss-addons'),
                ],
            ]
        );

        $repeater->add_control(
            'ss_process_image',
            [
                'label' => esc_html__('Upload Icon Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ss_process_icon_type' => 'image'
                ]

            ]
        );

        $repeater->add_control(
            'ss_process_image_white',
            [
                'label' => esc_html__('Upload White Icon Image', 'ss-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ss_process_icon_type' => 'image'
                ]

            ]
        );

        if (ss_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'ss_process_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'ss_process_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'ss_process_selected_icon',
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
                        'ss_process_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'ss_process_step',
            [
                'label' => esc_html__('Sub Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'ss-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ss_process_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'ss-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ss_process_description',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ss_process_list',
            [
                'label' => esc_html__('Services - List', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ss_process_title' => esc_html__('Discover', 'ss-addons'),
                    ],
                    [
                        'ss_process_title' => esc_html__('Define', 'ss-addons')
                    ],
                    [
                        'ss_process_title' => esc_html__('Develop', 'ss-addons')
                    ],
                    [
                        'ss_process_title' => esc_html__('Deliver', 'ss-addons')
                    ]
                ],
                'title_field' => '{{{ ss_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'ss_process_align',
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
        // Link
        if ('2' == !empty($settings['ss_btn_link_type'])) {
            $this->add_render_attribute('ss-button-arg', 'href', get_permalink($settings['ss_btn_page_link']));
            $this->add_render_attribute('ss-button-arg', 'target', '_self');
            $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('ss-button-arg', 'class', ' btn');
        } else {
            $this->add_render_attribute('ss-button-arg', 'class', ' btn');
            $this->add_render_attribute('ss-button-arg', 'data-wow-delay', ' .6s ');
            if (!empty($settings['ss_btn_link']['url'])) {
                $this->add_render_attribute('ss-button-arg', 'href', esc_url($settings['ss_btn_link']['url']));
            }
            if (!empty($settings['ss_btn_link']['is_external'])) {
                $this->add_render_attribute('ss-button-arg', 'target', '_blank');
            }
            if (!empty($settings['ss_btn_link']['nofollow'])) {
                $this->add_render_attribute('ss-button-arg', 'rel', 'nofollow');
            }
        }

        // Button
        if (!empty($settings['ss_btn_link']['url']) || isset($settings['ss_btn_link_type'])) {
            // Link
            $button_html = '<a ' . $this->get_render_attribute_string('ss-button-arg') . '>' . $settings['ss_btn_text'] . '</a>';
        }

?>

        <?php if ($settings['ss_design_style']  == 'layout-2') : ?>
            <div class="style-2"></div>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
            $shape_swtich = ($settings['ss_section_shape_show'] == 'yes') ? '' : 'shape-off p-0';
        ?>

            <section class="work__process <?php echo esc_attr($shape_swtich); ?>">
                <div class="container">
                    <?php if (!empty($settings['ss_section_title_show'])) : ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-8">
                                <div class="section__title text-center">
                                    <?php if (!empty($settings['ss_sub_title'])) : ?>
                                        <span class="sub-title ss-el-subtitle"><?php echo ss_kses($settings['ss_sub_title']); ?></span>
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
                                        <p class="desc"><?php echo ss_kses($settings['ss_desctiption']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row work__process__wrap">
                        <?php foreach ($settings['ss_process_list'] as $item) : ?>
                            <div class="col">
                                <div class="work__process__item">
                                    <?php if (!empty($item['ss_process_title'])) : ?>
                                        <span class="work__process_step"><?php echo ss_kses($item['ss_process_step']); ?></span>
                                    <?php endif; ?>
                                    <div class="work__process__icon">
                                        <?php if ($item['ss_process_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['ss_process_icon']) || !empty($item['ss_process_selected_icon']['value'])) : ?>
                                                <div class="icon">
                                                    <?php ss_render_icon($item, 'ss_process_icon', 'ss_process_selected_icon'); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <div class="icon">
                                                <?php if (!empty($item['ss_process_image']['url'])) : ?>
                                                    <img class="light" src="<?php echo $item['ss_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>

                                                <?php if (!empty($item['ss_process_image_white']['url'])) : ?>
                                                    <img class="dark" src="<?php echo $item['ss_process_image_white']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_process_image_white']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="work__process__content">
                                        <?php if (!empty($item['ss_process_title'])) : ?>
                                            <h4 class="title">
                                                <?php echo ss_kses($item['ss_process_title']); ?>
                                            </h4>
                                        <?php endif; ?>

                                        <?php if (!empty($item['ss_process_description'])) : ?>
                                            <p><?php echo ss_kses($item['ss_process_description']); ?></p>
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

$widgets_manager->register(new SS_Process());
