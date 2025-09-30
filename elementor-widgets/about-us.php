<?php

namespace Elementor;

class Grownex_About_Us_Widget extends Widget_Base
{

    public function get_name()
    {

        return 'grownex_about_us';
    }

    public function get_title()
    {
        return esc_html__('Grownex About Us', 'grownexcore');
    }

    public function get_icon()
    {

        return 'eicon-document-file';
    }

    public function get_categories()
    {
        return ['grownexcore'];
    }

    protected function register_controls()
    {

        //======================================//
        //========= CONTENT TAB START ========//
        //====================================//
        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__('About Us', 'grownexcore'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'enable_list',
            [
                'label' => esc_html__('Enable List', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'grownexcore'),
                'label_off' => esc_html__('Hide', 'grownexcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'list_info',
            [
                'label' => esc_html__('List Content', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Quisque nisi rutrum laoreet sollicitudin imperdiet', 'grownexcore'),
            ]
        );
        $repeater->add_control(
            'list_icon',
            [
                'label' => esc_html__('Icon', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'lists',
            [
                'label'     => esc_html__('Info List', 'grownexcore'),
                'type'      => \Elementor\Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'list_info' => esc_html__('Fast Growing Sells', 'grownexcore'),
                    ],
                ],
                'title_field' => '{{{ list_info }}}',
                'condition' => [
                    'enable_list' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_note',
            [
                'label' => esc_html__('Button Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'enable_button',
            [
                'label' => esc_html__('Enable Button', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'grownexcore'),
                'label_off' => esc_html__('Hide', 'grownexcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('More About Us', 'grownexcore'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'enable_button' => 'yes',
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
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-arrow-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'button_icon_position',
            [
                'label' => esc_html__('Icon Position', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row-reverse' => [
                        'title' => esc_html__('Left', 'grownexcore'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row' => [
                        'title' => esc_html__('Right', 'grownexcore'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .theme-btns' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'author_note',
            [
                'label' => esc_html__('Author Info Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'enable_author',
            [
                'label' => esc_html__('Enable Author Info', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'grownexcore'),
                'label_off' => esc_html__('Hide', 'grownexcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'author_image',
            [
                'label' => esc_html__('Author Image', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'enable_author' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'author_name',
            [
                'label' => esc_html__('Name', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Daniel H. Smith', 'grownexcore'),
                'condition' => [
                    'enable_author' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'author_designation',
            [
                'label' => esc_html__('Designation', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO & Founder', 'grownexcore'),
                'condition' => [
                    'enable_author' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        //================================//
        //========= START STYLES ========//
        //==============================//
        $this->start_controls_section(
            'section_box',
            [
                'label' => esc_html__('Box Style', 'grownexcore'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_aligment',
            [
                'label'     => __('Alignment', 'grownexcore'),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'grownexcore'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'grownexcore'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'grownexcore'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .grownex-about-wrapper',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .grownex-about-wrapper',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => esc_html__('Border Radius', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .grownex-about-wrapper',
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__('Margin', 'grownexcore'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .grownex-about-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__('Padding', 'grownexcore'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .grownex-about-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //===============================//
        //========= ITEM STYLES ========//
        //=============================//
        $this->start_controls_section(
            'list_css_style',
            [
                'label' => esc_html__('List Item', 'grownexcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_list' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'list_typo',
                'selector' => '{{WRAPPER}} .grownex-about-dec-list ul li .content',
            ]
        );
        $this->add_responsive_control(
            'list_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_bg',
            [
                'label' => esc_html__('Background Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_width',
            [
                'label' => esc_html__('Width', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'selector' => '{{WRAPPER}} .grownex-about-dec-list ul li .content',
            ]
        );
        $this->add_responsive_control(
            'list_radius',
            [
                'label' => esc_html__('Border Radius', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_shadow',
                'selector' => '{{WRAPPER}} .grownex-about-dec-list ul li .content',
            ]
        );
        $this->add_responsive_control(
            'list_align',
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
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'list_icon_notes',
            [
                'label' => esc_html__('Icon Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'list_icon_position',
            [
                'label' => esc_html__('Icon Position', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Left', 'grownexcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__('Right', 'grownexcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_icon_border',
                'selector' => '{{WRAPPER}} .grownex-about-dec-list ul li .icon',
            ]
        );
        $this->add_responsive_control(
            'list_icon_radius',
            [
                'label' => esc_html__('Border Radius', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_icon_color',
            [
                'label' => esc_html__('Icon Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_icon_bgcolor',
            [
                'label' => esc_html__('BG Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'list_icon_typo',
                'selector' => '{{WRAPPER}} .grownex-about-dec-list ul li .icon',
            ]
        );
        $this->add_responsive_control(
            'list_icon_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_icon_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list ul li .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'list_box_note',
            [
                'label' => esc_html__('List Box Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'list_box_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'list_box_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-dec-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //=================================//
        //========= BUTTONS STYLE ========//
        //===============================//
        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__('Button Style', 'grownexcore'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_button' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_box_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-button-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_box_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-button-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button_tab_normal',
            [
                'label' => esc_html__('Normal', 'grownexcore'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typo',
                'selector' => '{{WRAPPER}} .grownex-about-botton .primary-button',
            ]
        );
        $this->add_responsive_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_background',
            [
                'label' => esc_html__('BG Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .grownex-about-botton .primary-button',
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label' => esc_html__('Border Radius', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'about_btn_icon_note',
            [
                'label' => esc_html__('Icon Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button .button-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_bgcolor',
            [
                'label' => esc_html__('BG Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button .button-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button .button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button .button-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_tab_hover',
            [
                'label' => esc_html__('Hover', 'grownexcore'),
            ]
        );
        $this->add_responsive_control(
            'button_hcolor',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_hbgcolor',
            [
                'label' => esc_html__('BG Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_hborder',
                'selector' => '{{WRAPPER}} .grownex-about-botton .primary-button:hover',
            ]
        );
        $this->add_responsive_control(
            'button_hradius',
            [
                'label' => esc_html__('Border Radius', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'about_hbtn_icon',
            [
                'label' => esc_html__('Icon Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'icon_hcolor',
            [
                'label' => esc_html__('Icon Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button:hover .button-icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_hbgcolor',
            [
                'label' => esc_html__('BG Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .grownex-about-botton .primary-button:hover .button-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        //======================================//
        //========= AUTHOR META STYLES ========//
        //====================================//
        $this->start_controls_section(
            'author_info_style',
            [
                'label' => esc_html__('Author Meta', 'grownexcore'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_author' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_box_margin',
            [
                'label' => esc_html__('Box Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_box_padding',
            [
                'label' => esc_html__('Box Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'authorinfo_box_note',
            [
                'label' => esc_html__('Author Info Box Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'info_box_border',
                'selector' => '{{WRAPPER}} .about-author-info',
            ]
        );
        $this->add_responsive_control(
            'info_box_margin',
            [
                'label' => esc_html__('Info Box Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'info_box_padding',
            [
                'label' => esc_html__('Info Box Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'author_image_note_style',
            [
                'label' => esc_html__('Image Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'author_image_width',
            [
                'label' => esc_html__('Width', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .about-author-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_image_height',
            [
                'label' => esc_html__('Height', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .about-author-img img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'author_image_border',
                'selector' => '{{WRAPPER}} .about-author-img img',
            ]
        );
        $this->add_responsive_control(
            'author_image_radius',
            [
                'label' => esc_html__('Border Radius', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
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
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .about-author-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'author_image_shadow',
                'selector' => '{{WRAPPER}} .about-author-img img',
            ]
        );
        $this->add_responsive_control(
            'author_image_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_image_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'author_info_title_node',
            [
                'label' => esc_html__('Title Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_title_typo',
                'selector' => '{{WRAPPER}} .about-author-content .author-name',
            ]
        );
        $this->add_responsive_control(
            'author_title_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-author-content .author-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_title_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-content .author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_title_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-content .author-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'author_info_stitle_node',
            [
                'label' => esc_html__('Designation Options', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_stitle_typo',
                'selector' => '{{WRAPPER}} .about-author-content .author-sname',
            ]
        );
        $this->add_responsive_control(
            'author_stitle_color',
            [
                'label' => esc_html__('Color', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-author-content .author-sname' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_stitle_margin',
            [
                'label' => esc_html__('Margin', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-content .author-sname' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_stitle_padding',
            [
                'label' => esc_html__('Padding', 'grownexcore'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .about-author-content .author-sname' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    //Render
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_html = array(
            'h1'    => array(),
            'h2'    => array(),
            'h3'    => array(),
            'h4'    => array(),
            'h5'    => array(),
            'h6'    => array(),
            'span'  => array('style' => array(),),
            'a'     => array(
                'href'   => array(),
                'target' => array(),
                'title'  => array(),
                'rel'    => array(),
            ),
            'strong'  => array('style' => array(),),
            'del'  => array('datetime' => array(),),
            'small'  => array(),
            'span'   => array(
                'style' => array(),
            ),
            'br'    => array(),
            'em'    => array(),
            'ul'    => array(),
            'li' => array()
        );
        ob_start();
?>
        <div class="grownex-about-wrapper">
            <div class="container">
                <?php if (!empty($settings['lists']) && $settings['enable_list'] == 'yes') : ?>
                    <div class="grownex-about-dec-list">
                        <ul>
                            <?php foreach ($settings['lists'] as $list) : ?>
                                <li>
                                    <div class="icon"><?php \Elementor\Icons_Manager::render_icon($list['list_icon'], ['aria-hidden' => 'true']); ?></div>
                                    <div class="content">
                                        <?php echo wp_kses($list['list_info'], $allowed_html); ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="about-info">
                    <?php if ($settings['enable_author'] == 'yes') : ?>
                        <div class="about-author-wrapper">
                            <?php if (!empty($settings['author_name'])) : ?>
                                <div class="about-author-info">
                                    <?php if (!empty($settings['author_image'])) : ?>
                                        <div class="about-author-img">
                                            <?php echo wp_get_attachment_image($settings['author_image']['id'], 'thumbnail'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="about-author-content">
                                        <?php if (!empty($settings['author_name'])) : ?>
                                            <h4 class="author-name"><?php echo esc_html($settings['author_name']); ?></h4>
                                        <?php endif; ?>
                                        <span class="author-sname"><?php echo esc_html($settings['author_designation']); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($settings['enable_button'] == 'yes') :
                        if (!empty($settings['button_url']['url'])) {
                            $this->add_link_attributes('button_url', $settings['button_url']);
                        }
                    ?>
                        <div class="about-button-wrapper">
                            <div class="grownex-about-botton">
                                <a <?php echo $this->get_render_attribute_string('button_url'); ?> class="primary-button">
                                    <?php echo esc_html($settings['button_text']); ?>
                                    <div class="button-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php
        echo ob_get_clean();
    }
}
Plugin::instance()->widgets_manager->register(new Grownex_About_Us_Widget);
