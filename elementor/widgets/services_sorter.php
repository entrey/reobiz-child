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

class Entrey_Services_Sorter extends Widget_Base
{
    public function get_name()
    {
        return 'entrey-services-sorter';
    }

    public function get_title()
    {
        return esc_html__( 'Tiger Print Services Sorter', 'reobiz' );
    }

    public function get_categories()
    {
        return [ 'rsaddon_category' ];
    }

    public function get_icon()
    {
		return 'eicon-gallery-grid';
	}

    protected function register_controls()
    {
        /** CONTENT -> GENERAL */

        $this->start_controls_section(
            'content_general',
            [ 'label' => esc_html__( 'General', 'reobiz' ) ]
        );

        $this->add_responsive_control(
            'tags_alignment',
            [
                'label' => esc_html__( 'Tags Alignment', 'reobiz' ),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'after',
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
                ],
                'selectors_dictionary' => [
                    'left' => 'flex-start',
                    'right' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .sorter__tags_container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_grid',
            [
                'label' => esc_html__( 'Content Grid Columns', 'reobiz' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1 (one)', 'reobiz' ),
                    2 => esc_html__( '2 (two)', 'reobiz' ),
                    3 => esc_html__( '3 (three)', 'reobiz' ),
                    4 => esc_html__( '4 (four)', 'reobiz' ),
                    5 => esc_html__( '5 (five)', 'reobiz' ),
                ],
                'default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'selectors_dictionary' => [
                    1 => '100%',
                    2 => '50%',
                    3 => '33.3333%',
                    4 => '25%',
                    5 => '20%',
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--entrey-sorter-content-width: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'titles_align',
            [
                'label' => esc_html__( 'Titles Alignment', 'reobiz' ),
                'type' => Controls_Manager::CHOOSE,
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
                ],
                'selectors_dictionary' => [
                    'left' => 'flex-start',
                    'right' => 'flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .content__title' => 'text-align: {{VALUE}};',
                ],
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .sorter__content' => 'text-align: {{VALUE}};',
                ],
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
            'item_title',
            [
                'label' => esc_html__( 'Title', 'reobiz' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Title', 'reobiz' ),
            ]
        );

        $repeater->add_control(
            'item_media',
            [
                'label' => esc_html__( 'Media', 'reobiz' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src() ],
            ]
        );

        $repeater->add_control(
            'item_wysiwyg',
            [
                'label' => esc_html__( 'Content', 'reobiz' ),
                'type' => Controls_Manager::WYSIWYG,
                'dynamic' => [ 'active' => true ],
                'default' => esc_html__( 'Lorem ipsum dolor sit amet.', 'reobiz' ),
            ]
        );

        $repeater->add_control(
            'item_tags',
            [
                'label' => esc_html__( 'Tags List', 'reobiz' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'required' => true,
                'dynamic' => [ 'active' => true ],
                'description' => esc_html__( 'Список тэгов для сортировки, перечисленных через запятую.', 'reobiz' ),
                'default' => esc_html__( 'Все', 'reobiz' ),
            ]
        );

        $this->add_control(
            'repeater_data',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'fields' => $repeater->get_controls(),
                'title_field' => '{{item_title}}',
                'default' => [
                    [
                        'item_title' => esc_html__( 'Title 1', 'reobiz' ),
                        'item_tags' => esc_html__( 'Все, Популярная продукция, Полиграфия', 'reobiz' ),
                    ],
                    [
                        'item_title' => esc_html__( 'Title 2', 'reobiz' ),
                        'item_tags' => esc_html__( 'Все, Полиграфия, Копицентр', 'reobiz' ),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        /** STYLE -> TAGS SECTION */

        $this->start_controls_section(
            'style_tags_section',
            [
                'label' => esc_html__( 'Tags Section', 'reobiz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tags_section_margin',
            [
                'label' => esc_html__( 'Margin', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sorter__tags_container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tags_section_padding',
            [
                'label' => esc_html__( 'Padding', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sorter__tags_container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tags_section_border',
                'fields_options' => [
                    'width' => [ 'label' => esc_html__( 'Border Width', 'reobiz' ) ],
                    'color' => [ 'label' => esc_html__( 'Border Color', 'reobiz' ) ],
                ],
                'selector' => '{{WRAPPER}} .sorter__tags_container',
            ]
        );

        $this->add_control(
            'tags_section_border_bg_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'terms' => [
                                [
                                    'name' => 'tags_section_border_border',
                                    'operator' => '!=',
                                    'value' => '',
                                ]
                            ]
                        ],
                        [
                            'terms' => [
                                [
                                    'name' => 'tags_section_bg_background',
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
                'name' => 'tags_section_bg',
                'selector' => '{{WRAPPER}} .sorter__tags_container',
            ]
        );

        $this->end_controls_section();

        /** STYLE -> TAG CONTAINER */

        $this->start_controls_section(
            'style_tag_container',
            [
                'label' => esc_html__( 'Tag Container', 'reobiz' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tag_container_min_width',
            [
                'label' => esc_html__( 'Min Width', 'reobiz' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [ 'min' => 50, 'max' => 450 ],
                ],
                'default' => [ 'size' => 110 ],
                'mobile_default' => [ 'size' => 100, 'unit' => '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tag__title' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tag_container_margin',
            [
                'label' => esc_html__( 'Margin', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 0,
                    'right' => 8,
                    'bottom' => 5,
                    'left' => 0,
                ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 5,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .tag__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tag_container_padding',
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
                    '{{WRAPPER}} .tag__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tag_container_border',
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
                'selector' => '{{WRAPPER}} .tag__title',
            ]
        );

        $this->add_control(
            'tag_container_radius',
            [
                'label' => esc_html__( 'Border Radius', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tag__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sorter__tags_container' => 'border-radius: calc({{TOP}}{{UNIT}} + {{tags_section_padding.top}}px )'
                                                                    . ' calc({{RIGHT}}{{UNIT}} + {{tags_section_padding.right}}px )'
                                                                    . ' calc({{BOTTOM}}{{UNIT}} + {{tags_section_padding.bottom}}px )'
                                                                    . ' calc({{LEFT}}{{UNIT}} + {{tags_section_padding.left}}px );',
                ],
            ]
        );

        $this->start_controls_tabs(
            'tag_container',
            [ 'separator' => 'before' ]
        );

        $this->start_controls_tab(
            'tag_container_idle',
            [ 'label' => esc_html__( 'Idle', 'reobiz' ) ]
        );

        $this->add_control(
            'tag_container_border_color_idle',
            [
                'label' => esc_html__( 'Border Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'tag_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'default' => '#eff1f5',
                'selectors' => [
                    '{{WRAPPER}} .tag__title' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tag_container_bg_idle',
                'fields_options' => [
                    'background' => ['default' => 'classic' ],
                    'color' => ['default' => '#f8f9fb' ],
                ],
                'selector' => '{{WRAPPER}} .tag__title',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tag_container_shadow_idle',
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
                'selector' => '{{WRAPPER}} .tag__title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tag_container_hover',
            [ 'label' => esc_html__( 'Hover', 'reobiz' ) ]
        );

        $this->add_control(
            'tag_container_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'tag_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'default' => 'rgba(255, 255, 255, 0)',
                'selectors' => [
                    '{{WRAPPER}} .tag__title:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tag_container_bg_hover',
                'fields_options' => [
                    'background' => ['default' => 'classic' ],
                    'color' => ['default' => '#ffffff' ],
                ],
                'selector' => '{{WRAPPER}} .tag__title:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tag_container_shadow_hover',
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
                'selector' => '{{WRAPPER}} .tag__title:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tag_container_active',
            [ 'label' => esc_html__( 'Active', 'reobiz' ) ]
        );

        $this->add_control(
            'tag_container_border_color_active',
            [
                'label' => esc_html__( 'Border Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'tag_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'selectors' => [
                    '{{WRAPPER}} .tag__title.active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tag_container_border_top_color_active',
            [
                'label' => esc_html__( 'Border Top Color', 'reobiz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [ 'tag_container_border_border!' => '' ],
                'dynamic' => [ 'active' => true ],
                'default' => '#EF7F1A',
                'selectors' => [
                    '{{WRAPPER}} .tag__title.active' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tag_container_bg_active',
                'selector' => '{{WRAPPER}} .tag__title.active',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tag_container_shadow_active',
                'selector' => '{{WRAPPER}} .tag__title.active',
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
                'selector' => '{{WRAPPER}} .content__title',
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
                    '{{WRAPPER}} .sorter__content .content__title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sorter__content:hover .content__title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sorter__content.active .content__title' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .sorter__content',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default' => [
                    'top' => 15,
                    'right' => 7,
                    'bottom' => 15,
                    'left' => 7,
                ],
                'mobile_default' => [
                    'top' => 15,
                    'right' => 0,
                    'bottom' => 15,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sorter__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                                                    . 'width: calc( var(--entrey-sorter-content-width) - {{LEFT}}{{UNIT}} - {{RIGHT}}{{UNIT}} );',

                    '{{WRAPPER}} .sorter__contents-container' => 'margin-left: calc( {{LEFT}}{{UNIT}} * -1 );'
                                                               . 'margin-right: calc( {{RIGHT}}{{UNIT}} * -1 );',
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
                    '{{WRAPPER}} .sorter__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .sorter__content',
            ]
        );

        $this->add_control(
            'content_radius_idle',
            [
                'label' => esc_html__( 'Border Radius', 'reobiz' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sorter__content,
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
                    '{{WRAPPER}} .sorter__content' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sorter__content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $this->widget_id = substr( $this->get_id_int(), 0, 3 );

        echo '<div class="entrey-sorter">';

            echo '<div class="sorter__tags_container">';
                $this->render_sorter_tags();
            echo '</div>';

            echo '<div class="sorter__contents-container">';
                $this->render_sorter_contents();
            echo '</div>';

        echo '</div>';
    }

    protected function render_sorter_tags()
    {
        foreach ( $this->get_tags_array() as $v ) {
            echo '<div class="tag__title">',
                esc_html($v),
            '</div>';
        }
    }

    protected function get_tags_array()
    {
        $tags_arr = [];

        foreach ( $this->get_settings_for_display( 'repeater_data' ) as $index => $sorter_item ) {
            $item_tags = explode( ',', $sorter_item['item_tags' ] );

            foreach ($item_tags as $k => $v) {
                $v = trim( esc_html( $v ) );

                if ( in_array( $v, $tags_arr ) ) {
                    continue;
                }

                $tags_arr[] = $v;
            }
        }

        return $tags_arr;
    }

    protected function render_sorter_contents()
    {
        foreach ( $this->get_settings_for_display( 'repeater_data' ) as $index => $sorter_item ) {
            $tab_count = $index + 1;
            $tab_content_key = $this->get_repeater_setting_key( 'tab_content_key', 'repeater_data', $index );
            $tab_id = 'tab-id-' . $this->widget_id . $tab_count;

            $item_tags_array = explode( ',', $sorter_item['item_tags' ] );
            $tags_array_modified = [];
            foreach ( $item_tags_array as $tag ) {
                $tag = trim( $tag );
                $tag = str_replace( ' ', '-', $tag );
                $tags_array_modified[] = $tag;
            }
            $item_tags_string = implode( ' ', $tags_array_modified);

            $this->add_render_attribute( $tab_content_key, [
                'data-tab-id' => $tab_id,
                'data-tags' => esc_attr( $item_tags_string ),
                'class' => [
                    'sorter__content',
                    'elementor-repeater-item-' . $sorter_item[ '_id' ]
                ],
            ] );

            echo '<div ', $this->get_render_attribute_string( $tab_content_key ), '>';
                $this->render_item_content( $sorter_item );
            echo '</div>';
        }
    }

    protected function render_item_content( $sorter_item )
    {
        if ( ! empty( $sorter_item[ 'item_media' ][ 'url' ] ) ) {
            $this->add_render_attribute( 'content_image', 'src', $sorter_item[ 'item_media' ][ 'url' ] );
            $this->add_render_attribute( 'content_image', 'alt', Control_Media::get_image_alt( $sorter_item[ 'item_media' ] ) );
            $this->add_render_attribute( 'content_image', 'title', Control_Media::get_image_title( $sorter_item[ 'item_media' ] ) );

            echo '<div class="content__media">',
                Group_Control_Image_Size::get_attachment_image_html( $sorter_item, 'content_image', 'item_media' ),
            '</div>';
        }

        if ( $item_title = $sorter_item[ 'item_title' ] ?? '' ) {
            $title_tag = $this->get_settings_for_display( 'title_tag' );

            echo '<', $title_tag, ' class="content__title">',
                '<span class="title__text">',
                    $item_title,
                '</span>',
            '</', $title_tag, '>';
        }

        echo '<div class="content__description">',
            do_shortcode( $sorter_item[ 'item_wysiwyg' ] ),
        '</div>';
    }
}
