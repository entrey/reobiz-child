<?php

defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use Elementor\{
    Widget_Base,
    Control_Media,
    Frontend,
    Utils,
    Repeater,
    Controls_Manager,
    Icons_Manager,
    Group_Control_Background,
    Group_Control_Border,
    Group_Control_Typography,
    Group_Control_Image_Size,
    Group_Control_Box_Shadow
};

class Entrey_Tabs extends Widget_Base
{
    public function get_name()
    {
        return 'entrey-tabs';
    }

    public function get_title()
    {
        return esc_html__( 'Tiger Print Tabs', 'reobiz' );
    }

    public function get_categories()
    {
        return [ 'rsaddon_category' ];
    }

    public function get_icon() {
		return 'eicon-tabs';
	}

    protected function register_controls()
    {
        /** CONTENT -> GENERAL */

        $this->start_controls_section(
            'content_general',
            [ 'label' => esc_html__( 'General', 'reobiz' ) ]
        );

        $this->add_control(
            'titles_layout',
            [
                'label' => esc_html__( 'Titles Layout', 'pawscare-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'pawscare-core' ),
                    'vertical' => esc_html__( 'Vertical', 'pawscare-core' ),
                ],
                'prefix_class' => 'layout-',
                'default' => 'horizontal',
            ]
        );

        $this->add_responsive_control(
            'titles_align',
            [
                'label' => esc_html__('Titles Alignment', 'reobiz'),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'after',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'reobiz'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'reobiz'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'reobiz'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'reobiz' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => 'left',
                'mobile_default' => 'justify',
                'prefix_class' => 'titles-align%s-',
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__( 'Content Alignment', 'reobiz' ),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'reobiz' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'reobiz' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'reobiz' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'reobiz' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'contents-align%s-',
                'default' => 'left',
                'mobile_default' => 'justify',
            ]
        );

        $this->end_controls_section();

        /** CONTENT -> CONTENT */

        $this->start_controls_section(
            'content_content',
            [ 'label' => esc_html__( 'Content', 'reobiz' ) ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__( 'Tab Title', 'reobiz' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Tab Title', 'reobiz' ),
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label' => esc_html__( 'Content Type', 'reobiz' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => esc_html__( 'Content', 'reobiz' ),
                    'media' => esc_html__( 'Media', 'reobiz' ),
                ],
                'default' => 'content',
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => esc_html__( 'Tab Content', 'reobiz' ),
                'type' => Controls_Manager::WYSIWYG,
                'condition' => [ 'content_type' => 'content' ],
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'reobiz' ),
            ]
        );

        $repeater->add_control(
            'tab_media',
            [
                'label' => esc_html__( 'Tab Media', 'reobiz' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [ 'content_type' => 'media' ],
                'label_block' => true,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'tab_customization',
            [
                'label' => esc_html__( 'Customize Colors', 'reobiz' ),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tab_individual_heading_bg',
            [
                'label' => esc_html__( 'Individual Title BG Color Idle', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'tab_customization' => 'yes' ],
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tab__heading' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'tab_individual_content_bg',
            [
                'label' => esc_html__( 'Individual Content BG Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'tab_customization' => 'yes' ],
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.tab__content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'repeater_data',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{tab_title}}',
                'default' => [
                    [ 'tab_title' => esc_html__( 'Tab Title 1', 'reobiz' ) ],
                    [ 'tab_title' => esc_html__( 'Tab Title 2', 'reobiz' ) ],
                    [ 'tab_title' => esc_html__( 'Tab Title 3', 'reobiz' ) ],
                ],
            ]
        );

        $this->end_controls_section();

        /** STYLE -> HEADINGS SECTION */

        $this->start_controls_section(
            'style_headings_section',
            [
                'label' => esc_html__( 'Headings Section', 'reobiz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'headings_max_width',
            [
                'label' => esc_html__( 'Max Width', 'reobiz' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => [ 'titles_layout' => 'vertical' ],
                'range' => [
                    'px' => [ 'min' => 100, 'max' => 750 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tabs__headings-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'headings_section_margin',
            [
                'label' => esc_html__( 'Margin', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tabs__headings-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'headings_section_padding',
            [
                'label' => esc_html__( 'Padding', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tabs__headings-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'headings_section_border',
                'fields_options' => [
                    'width' => [ 'label' => esc_html__( 'Border Width', 'reobiz' ) ],
                    'color' => [ 'label' => esc_html__( 'Border Color', 'reobiz' ) ],
                ],
                'selector' => '{{WRAPPER}} .tabs__headings-container',
            ]
        );

        $this->add_control(
            'headings_section_border_bg_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'terms' => [
                                [
                                    'name' => 'headings_section_border_border',
                                    'operator' => '!=',
                                    'value' => '',
                                ]
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'headings_section_bg_background',
                                    'operator' => '!=',
                                    'value' => '',
                                ]
                            ]
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'headings_section_bg',
                'selector' => '{{WRAPPER}} .tabs__headings-container',
            ]
        );

        $this->end_controls_section();

        /** STYLE -> TITLE CONTAINER */

        $this->start_controls_section(
            'style_title_container',
            [
                'label' => esc_html__( 'Title Container', 'reobiz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_container_min_width',
            [
                'label' => esc_html__( 'Min Width', 'reobiz' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ 'min' => 50, 'max' => 450 ],
                ],
                'default' => [ 'size' => 130 ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_container_margin',
            [
                'label' => esc_html__( 'Margin', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_container_padding',
            [
                'label' => esc_html__( 'Padding', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 11,
                    'right' => 18,
                    'bottom' => 11,
                    'left' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_container_border',
                'fields_options' => [
                    'border' => [ 'default' => 'solid' ],
                    'width' => [
                        'label' => esc_html__( 'Border Width', 'reobiz' ),
                        'default' => [
                            'top' => 1,
                            'right' => 1,
                            'bottom' => 1,
                            'left' => 1,
                        ],
                    ],
                    'color' => [ 'type' => Controls_Manager::HIDDEN ],
                ],
                'selector' => '{{WRAPPER}} .tab__heading',
            ]
        );

        $this->add_control(
            'title_container_radius',
            [
                'label' => esc_html__( 'Border Radius', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tabs__headings-container' => 'border-radius: calc({{TOP}}{{UNIT}} + {{headings_section_padding.top}}px )'
                                                                    . ' calc({{RIGHT}}{{UNIT}} + {{headings_section_padding.right}}px )'
                                                                    . ' calc({{BOTTOM}}{{UNIT}} + {{headings_section_padding.bottom}}px )'
                                                                    . ' calc({{LEFT}}{{UNIT}} + {{headings_section_padding.left}}px );',
                ],
            ]
        );

        $this->start_controls_tabs(
            'title_container',
            [ 'separator' => 'before' ]
        );

        $this->start_controls_tab(
            'title_container_idle',
            [ 'label' => esc_html__( 'Idle', 'reobiz' ) ]
        );

        $this->add_control(
            'title_container_border_color_idle',
            [
                'label' => esc_html__( 'Border Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'title_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'default' => '#eff1f5',
                'selectors' => [
                    '{{WRAPPER}} .tab__heading' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_container_bg_idle',
                'fields_options' => [
                    'background' => ['default' => 'classic'],
                    'color' => ['default' => '#f8f9fb'],
                ],
                'selector' => '{{WRAPPER}} .tab__heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_container_shadow_idle',
                'fields_options' => [
                    'box_shadow_type' => [ 'default' => 'yes' ],
                    'box_shadow' => [ 'default' => [
                        'horizontal' => 0,
                        'vertical' => 5,
                        'blur' => 25,
                        'spread' => 0,
                        'color' => 'rgba(0, 0, 0, 0)',
                    ] ],
                ],
                'selector' => '{{WRAPPER}} .tab__heading',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_container_hover',
            [ 'label' => esc_html__( 'Hover', 'reobiz' ) ]
        );

        $this->add_control(
            'title_container_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'title_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'default' => 'rgba(255, 255, 255, 0)',
                'selectors' => [
                    '{{WRAPPER}} .tab__heading:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_container_bg_hover',
                'fields_options' => [
                    'background' => ['default' => 'classic'],
                    'color' => ['default' => '#ffffff'],
                ],
                'selector' => '{{WRAPPER}} .tab__heading:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_container_shadow_hover',
                'fields_options' => [
                    'box_shadow_type' => [ 'default' => 'yes' ],
                    'box_shadow' => [ 'default' => [
                        'horizontal' => 0,
                        'vertical' => 5,
                        'blur' => 25,
                        'spread' => 0,
                        'color' => 'rgba(0, 0, 0, 0.1)',
                    ] ],
                ],
                'selector' => '{{WRAPPER}} .tab__heading:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_container_active',
            [ 'label' => esc_html__( 'Active', 'reobiz' ) ]
        );

        $this->add_control(
            'title_container_border_color_active',
            [
                'label' => esc_html__( 'Border Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'title_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading.active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_container_border_top_color_active',
            [
                'label' => esc_html__( 'Border Top Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'title_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'default' => '#EF7F1A',
                'selectors' => [
                    '{{WRAPPER}} .tab__heading.active' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_container_bg_active',
                'selector' => '{{WRAPPER}} .tab__heading.active',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_container_shadow_active',
                'selector' => '{{WRAPPER}} .tab__heading.active',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /** STYLE -> TITLE */

        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__( 'Title', 'reobiz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .heading__title',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'reobiz' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => esc_html( '‹h1›' ),
                    'h2' => esc_html( '‹h2›' ),
                    'h3' => esc_html( '‹h3›' ),
                    'h4' => esc_html( '‹h4›' ),
                    'h5' => esc_html( '‹h5›' ),
                    'h6' => esc_html( '‹h6›' ),
                    'div' => esc_html( '‹div›' ),
                    'span' => esc_html( '‹span›' ),
                ],
                'default' => 'h4',
            ]
        );

        $this->start_controls_tabs(
            'title_styles',
            [ 'separator' => 'before' ]
        );

        $this->start_controls_tab(
            'title_idle',
            [ 'label' => esc_html__( 'Idle', 'reobiz' ) ]
        );

        $this->add_control(
            'title_color_idle',
            [
                'label' => esc_html__( 'Text Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading .heading__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover',
            [ 'label' => esc_html__( 'Hover', 'reobiz' ) ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Text Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading:hover .heading__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_active',
            [ 'label' => esc_html__( 'Active', 'reobiz' ) ]
        );

        $this->add_control(
            'title_color_active',
            [
                'label' => esc_html__( 'Text Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tab__heading.active .heading__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /** STYLE -> CONTENT */

        $this->start_controls_section(
            'style_content',
            [
                'label' => esc_html__( 'Content', 'reobiz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .tab__content',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tab__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tab__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_idle',
                'fields_options' => [
                    'width' => [ 'label' => esc_html__( 'Border Width', 'reobiz' ) ],
                    'color' => [ 'label' => esc_html__( 'Border Color', 'reobiz' ) ],
                ],
                'selector' => '{{WRAPPER}} .tab__content',
            ]
        );

        $this->add_control(
            'content_radius_idle',
            [
                'label' => esc_html__( 'Border Radius', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tab__content,
                     {{WRAPPER}} .content__media img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_color_idle',
            [
                'label' => esc_html__( 'Text Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tab__content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_bg_idle',
            [
                'label' => esc_html__( 'Background Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tab__content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $this->widget_id = substr( $this->get_id_int(), 0, 3 );

        echo '<div class="entrey-tabs">';

            echo '<div class="tabs__headings-container">';
                $this->render_tabs_headings();
            echo '</div>';

            echo '<div class="tabs__contents-container">';
                $this->render_tabs_contents();
            echo '</div>';

        echo '</div>';
    }

    protected function render_tabs_headings()
    {
        $title_tag = $this->get_settings_for_display( 'title_tag' );

        foreach ( $this->get_settings_for_display( 'repeater_data' ) as $index => $item ) {
            $tab_count = $index + 1;
            $tab_title_key = $this->get_repeater_setting_key( 'tab_title', 'repeater_data', $index );
            $tab_id = 'tab-id-' . $this->widget_id . $tab_count;
            $this->add_render_attribute( $tab_title_key, [
                'data-tab-id' => $tab_id,
                'class' => [
                    'tab__heading',
                    'elementor-repeater-item-' . $item[ '_id' ],
                ],
            ] );

            echo '<div ', $this->get_render_attribute_string( $tab_title_key ), '>';

                echo '<', $title_tag, ' class="heading__title">',
                    '<span class="title__text">',
                        $item[ 'tab_title' ],
                    '</span>',
                '</', $title_tag, '>';

            echo '</div>';
        }
    }

    protected function render_tabs_contents()
    {
        foreach ( $this->get_settings_for_display( 'repeater_data' ) as $index => $tab_item ) {
            $tab_count = $index + 1;
            $tab_content_key = $this->get_repeater_setting_key( 'tab_content_key', 'repeater_data', $index );
            $tab_id = 'tab-id-' . $this->widget_id . $tab_count;

            $this->add_render_attribute( $tab_content_key, [
                'data-tab-id' => $tab_id,
                'class' => [
                    'tab__content',
                    'elementor-repeater-item-' . $tab_item[ '_id' ]
                ],
            ] );

            echo '<div ', $this->get_render_attribute_string( $tab_content_key ), '>',
                $this->get_tab_content( $tab_item ),
            '</div>';
        }
    }

    protected function get_tab_content( $tab )
    {
        if (
            'media' === $tab[ 'content_type' ]
            && ! empty( $tab[ 'tab_media' ][ 'url' ] )
        ) {
            $this->add_render_attribute( 'content_image', 'src', $tab[ 'tab_media' ][ 'url' ] );
            $this->add_render_attribute( 'content_image', 'alt', Control_Media::get_image_alt( $tab[ 'tab_media' ] ) );
            $this->add_render_attribute( 'content_image', 'title', Control_Media::get_image_title( $tab[ 'tab_media' ] ) );

            return '<div class="content__media">'
                    . Group_Control_Image_Size::get_attachment_image_html( $tab, 'content_image', 'tab_media' )
                . '</div>';
        }

        return do_shortcode( $tab[ 'tab_content' ] );
    }
}
