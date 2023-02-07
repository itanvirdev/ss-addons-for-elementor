<?php

namespace SSAddons\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use SSAddons\Elementor\Controls\Group_Control_SSBGGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * SS Addons
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class SS_Team_Details extends Widget_Base {

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
        return 'team-details';
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
        return __('Team Details', 'ss-addons');
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

    protected static function get_profile_names() {
        return [
            '500px' => esc_html__('500px', 'ss-addons'),
            'apple' => esc_html__('Apple', 'ss-addons'),
            'behance' => esc_html__('Behance', 'ss-addons'),
            'bitbucket' => esc_html__('BitBucket', 'ss-addons'),
            'codepen' => esc_html__('CodePen', 'ss-addons'),
            'delicious' => esc_html__('Delicious', 'ss-addons'),
            'deviantart' => esc_html__('DeviantArt', 'ss-addons'),
            'digg' => esc_html__('Digg', 'ss-addons'),
            'dribbble' => esc_html__('Dribbble', 'ss-addons'),
            'email' => esc_html__('Email', 'ss-addons'),
            'facebook' => esc_html__('Facebook', 'ss-addons'),
            'flickr' => esc_html__('Flicker', 'ss-addons'),
            'foursquare' => esc_html__('FourSquare', 'ss-addons'),
            'github' => esc_html__('Github', 'ss-addons'),
            'houzz' => esc_html__('Houzz', 'ss-addons'),
            'instagram' => esc_html__('Instagram', 'ss-addons'),
            'jsfiddle' => esc_html__('JS Fiddle', 'ss-addons'),
            'linkedin' => esc_html__('LinkedIn', 'ss-addons'),
            'medium' => esc_html__('Medium', 'ss-addons'),
            'pinterest' => esc_html__('Pinterest', 'ss-addons'),
            'product-hunt' => esc_html__('Product Hunt', 'ss-addons'),
            'reddit' => esc_html__('Reddit', 'ss-addons'),
            'slideshare' => esc_html__('Slide Share', 'ss-addons'),
            'snapchat' => esc_html__('Snapchat', 'ss-addons'),
            'soundcloud' => esc_html__('SoundCloud', 'ss-addons'),
            'spotify' => esc_html__('Spotify', 'ss-addons'),
            'stack-overflow' => esc_html__('StackOverflow', 'ss-addons'),
            'tripadvisor' => esc_html__('TripAdvisor', 'ss-addons'),
            'tumblr' => esc_html__('Tumblr', 'ss-addons'),
            'twitch' => esc_html__('Twitch', 'ss-addons'),
            'twitter' => esc_html__('Twitter', 'ss-addons'),
            'vimeo' => esc_html__('Vimeo', 'ss-addons'),
            'vk' => esc_html__('VK', 'ss-addons'),
            'website' => esc_html__('Website', 'ss-addons'),
            'whatsapp' => esc_html__('WhatsApp', 'ss-addons'),
            'wordpress' => esc_html__('WordPress', 'ss-addons'),
            'xing' => esc_html__('Xing', 'ss-addons'),
            'yelp' => esc_html__('Yelp', 'ss-addons'),
            'youtube' => esc_html__('YouTube', 'ss-addons'),
        ];
    }


    protected function register_controls() {

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
        $this->add_control(
            'ss_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ss-addons'),
                'label_off' => esc_html__('No', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'ss_image_height',
            [
                'label' => esc_html__('Image Height', 'ss-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ss-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ss_image_overlap_x',
            [
                'label' => esc_html__('Image overlap position', 'ss-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ss-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'ss_image_overlap' => 'yes',
                ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'ss-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'ss-addons'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Profile Link', 'ss-addons'),
                'placeholder' => esc_html__('Add your profile link', 'ss-addons'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'ss-addons'),
                'label_off' => esc_html__('Hide', 'ss-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );


        $this->end_controls_section();


        // Skill
        $this->start_controls_section(
            'ss_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'ss-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Name', 'ss-addons'),
                'default' => esc_html__('Design', 'ss-addons'),
                'placeholder' => esc_html__('Type a skill name', 'ss-addons'),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__('Level (Out Of 100)', 'ss-addons'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__('Want To Customize?', 'ss-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ss-addons'),
                'label_off' => esc_html__('No', 'ss-addons'),
                'return_value' => 'yes',
                'description' => esc_html__('You can customize this skill bar color from here or customize from Style tab', 'ss-addons'),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'percentage_color',
            [
                'label' => esc_html__('Percentage label Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .percentage' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );


        $repeater->add_group_control(
            Group_Control_SSBGGradient::get_type(),
            [
                'name' => 'level_color',
                'label' => esc_html__('Level Color', 'ss-addons'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress-bar',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => esc_html__('Base Color', 'ss-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .progress' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Design',
                        'level' => ['size' => 95, 'unit' => '%']
                    ],
                    [
                        'name' => 'UX',
                        'level' => ['size' => 85, 'unit' => '%']
                    ]
                ]
            ]
        );
        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Layout', 'ss-addons'),
                'separator' => 'before',
                'default' => 'progress-bar--1',
                'options' => [
                    'progress-bar--2' => esc_html__('Thin', 'ss-addons'),
                    'progress-bar--1' => esc_html__('Normal', 'ss-addons'),
                    'progress-bar--3' => esc_html__('Bold', 'ss-addons'),
                ],
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

        if (!empty($settings['ss_image']['url'])) {
            $ss_image = !empty($settings['ss_image']['id']) ? wp_get_attachment_image_url($settings['ss_image']['id'], $settings['ss_image_size_size']) : $settings['ss_image']['url'];
            $ss_image_alt = get_post_meta($settings["ss_image"]["id"], "_wp_attachment_image_alt", true);
        }
        $this->add_render_attribute('title_args', 'class', 'team-details-title text-uppercase mb-10');

?>

        <section class="volunteersSection">
            <div class="container">
                <div class="row">
                    <?php if ($settings['ss_image']['url'] || $settings['ss_image']['id']) : ?>
                        <div class="col-lg-5 col-md-6">
                            <div class="team-details-img">
                                <img src="<?php echo esc_url($ss_image); ?>" alt="<?php echo esc_attr($ss_image_alt); ?>">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-7 col-md-6">
                        <div class="team-details-content pt-40">

                            <?php if (!empty($settings['ss_section_title_show'])) : ?>
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
                                <?php if (!empty($settings['ss_sub_title'])) : ?>
                                    <span class="team-designation">
                                        <?php echo ss_kses($settings['ss_sub_title']); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                    <div class="team-icon mt-15 mb-30">
                                        <?php
                                        foreach ($settings['profiles'] as $profile) :
                                            $icon = $profile['name'];
                                            $url = esc_url($profile['link']['url']);

                                            printf(
                                                '<a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                                $url,
                                                esc_attr($profile['_id']),
                                                esc_attr($icon)
                                            );
                                        endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['ss_desctiption'])) : ?>
                                    <p><?php echo ss_kses($settings['ss_desctiption']); ?></p>
                                <?php endif; ?>

                            <?php endif; ?>

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="featureBlock__donation__progress">
                                        <?php foreach ($settings['skills'] as $index => $skill) : ?>
                                            <div class="featureBlock__donation__bar mb-15 <?php echo esc_attr($settings['view']); ?> elementor-repeater-item-<?php echo $skill['_id']; ?>">
                                                <label><?php echo esc_html($skill['name']); ?></label>
                                                <span class="featureBlock__donation__text skill-bar" data-width="<?php echo esc_attr($skill['level']['size']); ?>%"><?php echo esc_attr($skill['level']['size']); ?>%</span>
                                                <div class="featureBlock__donation__line">
                                                    <span class="skill-bars">
                                                        <span class="skill-bars__line skill-bar" data-width="<?php echo esc_attr($skill['level']['size']); ?>%"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}

$widgets_manager->register(new SS_Team_Details());
