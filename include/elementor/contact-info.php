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
class SS_Contact_Info extends Widget_Base {

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
        return 'contact-info';
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
        return __('Contact Info', 'ss-addons');
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


    protected static function get_profile_names() {
        return [
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

        // Service group
        $this->start_controls_section(
            '_SS_contact_info',
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
                    'default' => 'fa fa-star',
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
            'ss_title',
            [
                'label' => esc_html__('Title', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'ss-addons'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'ss_description',
            [
                'label' => esc_html__('Description', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ss_contact_link',
            [
                'label' => esc_html__('Description CTA', 'ss-addons'),
                'description' => ss_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Phone and Email',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'ss_list',
            [
                'label' => esc_html__('Services - List', 'ss-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ss_title' => esc_html__('united states', 'ss-addons'),
                    ],
                    [
                        'ss_title' => esc_html__('south Africa', 'ss-addons')
                    ],
                    [
                        'ss_title' => esc_html__('United Kingdom', 'ss-addons')
                    ]
                ],
                'title_field' => '{{{ ss_title }}}',
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


        <div class="contact__info white-bg p-relative z-index-1">
            <div class="contact__info-inner white-bg">
                <ul>
                    <?php foreach ($settings['ss_list'] as $item) : ?>
                        <li>
                            <div class="contact__info-item d-flex align-items-start mb-35">
                                <div class="contact__info-icon mr-15">
                                    <?php if ($item['ss_features_icon_type'] !== 'image') : ?>
                                        <?php if (!empty($item['ss_features_icon']) || !empty($item['ss_features_selected_icon']['value'])) : ?>
                                            <span class="contact_info_icon"><?php ss_render_icon($item, 'ss_features_icon', 'ss_features_selected_icon'); ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <span class="contact_info_icon">
                                            <?php if (!empty($item['ss_features_image']['url'])) : ?>
                                                <img src="<?php echo $item['ss_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['ss_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="contact__info-text">
                                    <h4><?php echo ss_kses($item['ss_title']); ?></h4>
                                    <?php if (!empty($item['ss_description'])) : ?>
                                        <p><?php echo ss_kses($item['ss_description']); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>


                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                    <div class="contact__social pl-30">
                        <h4><?php echo esc_html__('Follow Us', 'ss-addons'); ?></h4>
                        <ul>
                            <?php
                            foreach ($settings['profiles'] as $profile) :
                                $icon = $profile['name'];
                                $url = esc_url($profile['link']['url']);

                                printf(
                                    '<li><a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a></li>',
                                    $url,
                                    esc_attr($profile['_id']),
                                    esc_attr($icon)
                                );
                            endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>

<?php
    }
}

$widgets_manager->register(new SS_Contact_Info());
