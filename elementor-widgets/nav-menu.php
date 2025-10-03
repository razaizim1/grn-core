<?php

namespace Elementor;

class Nav_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'grownex_nav_menu';
    }

    public function get_title() {
        return esc_html__('Gronex Nav Menu', 'grownexcore');
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    public function get_categories() {
        return ['grownexcore'];
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();
        $options = [];
        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }

    protected function register_controls() {
        //==================================//
        //======= MENU SECTION ============//
        //================================//
        $this->start_controls_section(
            'menu',
            [
                'label' => esc_html__('Menu Options', 'grownexcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $menus = $this->get_available_menus();
        if (!empty($menus)) {
            $this->add_control(
                'menu_select',
                [
                    'label' => __('Menu', 'grownexcore'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',
                    'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'grownexcore'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu_select',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . __('There are no menus in your site.', 'grownexcore') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'grownexcore'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator' => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->add_control(
            'enable_sticky',
            [
                'label' => esc_html__('Enable Sticky header', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'grownexcore'),
                'label_off' => esc_html__('Hide', 'grownexcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'sticky_bg',
            [
                'label' => esc_html__('Sticky Background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sticky-bar' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_sticky' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'grownexcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'grownexcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'grownexcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .header-two .navbar-expand-lg .navbar-collapse' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mobile_logo_select',
            [
                'label' => esc_html__('Select logo Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default Logo', 'grownexcore'),
                    'custom' => esc_html__('Custom Logo', 'grownexcore'),
                ],
            ]
        );
        $this->add_control(
            'mobile_logo',
            [
                'label' => esc_html__('Upload Logo', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'mobile_logo_select' => 'custom',
                ],
            ]
        );
        $this->add_control(
            'note',
            [
                'label' => esc_html__('Button Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'enable_btn',
            [
                'label' => esc_html__('Enable Button', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'grownexcore'),
                'label_off' => esc_html__('Hide', 'grownexcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Get In Touch', 'grownexcore'),
                'label_block' => true,
                'condition' => [
                    'enable_btn' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_url',
            [
                'label' => esc_html__('Button Link', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'grownexcore'),
                'options' => ['url', 'is_external', 'nofollow', 'custom_attributes'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
                'condition' => [
                    'enable_btn' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        // Menu styles
        $this->start_controls_section(
            'menu_css_options',
            [
                'label' => esc_html__(' Menu Style ', 'grownexcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'menu_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu>ul>li>a' => 'color: {{VALUE}}'
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_hcolor',
            [
                'label' => esc_html__('Hover Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu>ul>li>a:hover' => 'color: {{VALUE}}'
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_active_color',
            [
                'label' => esc_html__('Active Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.current-menu-item a' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typo',
                'selector' => '{{WRAPPER}} .grownex-main-menu>ul>li>a',
            ]
        );
        $this->add_responsive_control(
            'menu_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu>ul>li>a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu>ul>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'menu_style_tabs'
        );
        $this->start_controls_tab(
            'sub_menu_tab',
            [
                'label' => esc_html__('Sub Menu', 'grownexcore'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_typo',
                'selector' => '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li a',
            ]
        );
        $this->add_responsive_control(
            'submenu_width',
            [
                'label' => esc_html__('Min Width', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_hcolor',
            [
                'label' => esc_html__('Hover Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_bg',
            [
                'label' => esc_html__('background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_hbg',
            [
                'label' => esc_html__('Hover Background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_border',
            [
                'label' => esc_html__('Border Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_align',
            [
                'label' => esc_html__('Alignment', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'grownexcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'grownexcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'grownexcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'submenu_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul li.no-mega ul.sub-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'mega_menu_tab',
            [
                'label' => esc_html__('Mega Menu', 'grownexcore'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mega_typo',
                'selector' => '{{WRAPPER}} .grownex-main-menu ul li.mega ul li a',
            ]
        );
        $this->add_responsive_control(
            'mega_width',
            [
                'label' => esc_html__('Box Width', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1600,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1320,
                ],
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega ul' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_align',
            [
                'label' => esc_html__('Alignment', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'grownexcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'grownexcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'grownexcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega ul li a' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_bg',
            [
                'label' => esc_html__('Box bg', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu>ul>li.mega>ul' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_hcolor',
            [
                'label' => esc_html__('Hover Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega ul li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mega_top',
            [
                'label' => esc_html__('Mega Hadding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mega_hadding_typo',
                'selector' => '{{WRAPPER}} .grownex-main-menu ul li.mega > ul > li > a',
            ]
        );
        $this->add_responsive_control(
            'mega_hadding_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega > ul > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mega_hadding_border_color',
            [
                'label' => esc_html__('border Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-main-menu ul li.mega > ul > li > a' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        //========================================//
        //======= MOBILE MENU STYLES ============//
        //======================================//
        $this->start_controls_section(
            'mobile_menu_settings',
            [
                'label' => esc_html__('Mobile Menu', 'grownexcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'mobile_meni_tabs'
        );
        $this->start_controls_tab(
            'mobile_menu_icon_tab',
            [
                'label' => esc_html__('Icon', 'grownexcore'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_icon_size',
                'selector' => '{{WRAPPER}} .grownex-toggle-menu',
            ]
        );
        $this->add_responsive_control(
            'mobile_icon_color',
            [
                'label' => esc_html__('Icon Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_icon_hcolor',
            [
                'label' => esc_html__('Icon Hover Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_icon_bg',
            [
                'label' => esc_html__('background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_icon_hbg',
            [
                'label' => esc_html__('Hover background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_icon_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_icon_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'close_btn',
            [
                'label' => esc_html__('Close Button', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'close_btn_size',
                'selector' => '{{WRAPPER}} .grownex-toggle-menu.close-icon',
            ]
        );
        $this->add_responsive_control(
            'close_btn_color',
            [
                'label' => esc_html__('Icon Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu.close-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'close_btn_hcolor',
            [
                'label' => esc_html__('Icon Hover Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu.close-icon:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'close_btn_bg',
            [
                'label' => esc_html__('background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu.close-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'close_btn_hbg',
            [
                'label' => esc_html__('Hover background', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu.close-icon:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'close_btn_border',
                'selector' => '{{WRAPPER}} .grownex-toggle-menu.close-icon',
            ]
        );
        $this->add_responsive_control(
            'close_btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-toggle-menu.close-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'mobile_menu_logo_tab',
            [
                'label' => esc_html__('Logo', 'grownexcore'),
            ]
        );
        $this->add_responsive_control(
            'mobile_logo_width',
            [
                'label' => esc_html__('Width', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .grownex-menu-wrapper .mobile-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mobile_logo_bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .grownex-menu-wrapper .mobile-logo',
            ]
        );
        $this->add_responsive_control(
            'mobile_menu_align',
            [
                'label' => esc_html__('Alignment', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'grownexcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'grownexcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'grownexcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .grownex-menu-wrapper .mobile-logo' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_logo_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-menu-wrapper .mobile-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_logo_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-menu-wrapper .mobile-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'mobile_menu_tab',
            [
                'label' => esc_html__('Menu', 'grownexcore'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_menu_typo',
                'selector' => '{{WRAPPER}} .grownex-mobile-menu ul li a',
            ]
        );
        $this->add_responsive_control(
            'mobile-menu_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_menu_active',
            [
                'label' => esc_html__('Active Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul li.grownex-active>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_color',
            [
                'label' => esc_html__('Border Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul li' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_menu_bg',
            [
                'label' => esc_html__('Background Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-menu-wrapper .grownex-menu-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_menu_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mobile_menu_arrow_note',
            [
                'label' => esc_html__('Icon Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_menu_arrow_typo',
                'selector' => '{{WRAPPER}} .grownex-mobile-menu ul .grownex-item-has-children>a .grownex-mean-expand',
            ]
        );
        $this->add_responsive_control(
            'mobile_arrow_color',
            [
                'label' => esc_html__(' Icon Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul .grownex-item-has-children>a .grownex-mean-expand' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'mobile_arrow_icon_bg',
            [
                'label' => esc_html__('Background Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-mobile-menu ul .grownex-item-has-children>a .grownex-mean-expand' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

?>

        <div class="grownex-menu-wrapper">
            <div class="grownex-menu-area text-center">
                <div class="mobile-logo">
                    <?php
                    if ($settings['mobile_logo_select'] === 'custom') {
                        $img_src = $settings['mobile_logo']['url'];
                        $img_alt = get_post_meta($settings['mobile_logo']['id'], '_wp_attachment_image_alt', true);
                        $img_title = get_the_title($settings['mobile_logo']['id']);
                    ?>
                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($img_alt); ?>" title="<?php echo esc_attr($img_title); ?>">
                    <?php
                    } elseif ($settings['mobile_logo_select'] === 'custom') {
                        $img_src = $settings['logo']['url'];
                        $img_alt = get_post_meta($settings['logo']['id'], '_wp_attachment_image_alt', true);
                        $img_title = get_the_title($settings['logo']['id']);
                        if (!empty($settings['logo_link']['url'])) {
                            $this->add_link_attributes('logo_link', $settings['logo_link']);
                        }
                    ?>
                        <a <?php echo $this->get_render_attribute_string('logo_link'); ?>>
                            <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($img_alt); ?>" title="<?php echo esc_attr($img_title); ?>">
                        </a>
                    <?php
                    } elseif (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                    ?>
                        <h2>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php esc_html(bloginfo('name')); ?>
                            </a>
                        </h2>
                    <?php
                    }
                    ?>
                    <button class="grownex-toggle-menu close-icon"><i class="fas fa-times"></i></button>
                </div>
                <div class="grownex-mobile-menu">
                    <?php
                    if ($settings['menu_select']) {
                        $header_menu = $settings['menu_select'];
                    } else {
                        $header_menu = '';
                    }
                    wp_nav_menu(
                        array(
                            'container' => false,
                            'theme_location' => 'mainmenu',
                            'menu' => $header_menu,
                            'menu_id' => 'mainmenu',
                        )
                    );
                    ?>
                </div>
            </div>
        </div>

        <div class="grownex-main-menu-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light main-navigation" id="<?php echo esc_attr($settings['enable_sticky'] == 'yes' ? 'sticky-header' : 'no-sticky'); ?>">
                <div class="navbar-collapse nav-menu grownex-main-menu d-none d-lg-inline-block">
                    <?php
                    if ($settings['menu_select']) {
                        $header_menu = $settings['menu_select'];
                    } else {
                        $header_menu = '';
                    }
                    wp_nav_menu(
                        array(
                            'container' => false,
                            'theme_location' => 'mainmenu',
                            'menu' => $header_menu,
                            'menu_id' => 'mainmenu',
                        )
                    );
                    ?>
                </div>
            </nav>
        </div>

        <button type="button" class="grownex-toggle-menu d-inline-block d-lg-none"><i class="fas fa-bars"></i></button>
<?php
    }
}
Plugin::instance()->widgets_manager->register(new Nav_Menu_Widget());
