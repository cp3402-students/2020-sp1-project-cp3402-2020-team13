<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;

/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Widget_Icon extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve icon widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'icon';
    }

    /**
     * Get widget title.
     *
     * Retrieve icon widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Icon', 'elementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve icon widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-favorite';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the icon widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @return array Widget categories.
     * @since 2.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['basic'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since 2.1.0
     * @access public
     *
     */
    public function get_keywords()
    {
        return ['icon'];
    }

    /**
     * Register icon widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Icon', 'elementor'),
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => __('Icon', 'elementor'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => __('View', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __('Default', 'elementor'),
                    'stacked' => __('Stacked', 'elementor'),
                    'framed' => __('Framed', 'elementor'),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => __('Shape', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __('Circle', 'elementor'),
                    'square' => __('Square', 'elementor'),
                ],
                'default' => 'circle',
                'condition' => [
                    'view!' => 'default',
                ],
                'prefix_class' => 'elementor-shape-',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'elementor'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'elementor'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('Icon', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('icon_colors');

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => __('Normal', 'elementor'),
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __('Primary Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label' => __('Secondary Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => __('Hover', 'elementor'),
            ]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label' => __('Primary Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_secondary_color',
            [
                'label' => __('Secondary Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __('Hover Animation', 'elementor'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'size',
            [
                'label' => __('Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
                ],
                'range' => [
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'rotate',
            [
                'label' => __('Rotate', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'tablet_default' => [
                    'unit' => 'deg',
                ],
                'mobile_default' => [
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i, {{WRAPPER}} .elementor-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __('Border Width', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render icon widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'elementor-icon-wrapper');

        $this->add_render_attribute('icon-wrapper', 'class', 'elementor-icon');

        if (!empty($settings['hover_animation'])) {
            $this->add_render_attribute('icon-wrapper', 'class', 'elementor-animation-' . $settings['hover_animation']);
        }

        $icon_tag = 'div';

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('icon-wrapper', $settings['link']);

            $icon_tag = 'a';
        }

        if (empty($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            // add old default
            $settings['icon'] = 'fa fa-star';
        }

        if (!empty($settings['icon'])) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }

        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        $is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        ?>
    <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
        <<?php echo $icon_tag . ' ' . $this->get_render_attribute_string('icon-wrapper'); ?>>
        <?php if ($is_new || $migrated) :
        Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
    else : ?>
        <i <?php echo $this->get_render_attribute_string('icon'); ?>></i>
    <?php endif; ?>
        </<?php echo $icon_tag; ?>>
        </div>
        <?php
    }

    /**
     * Render icon widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template()
    {
        ?>
        <# var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
        iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
        migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' ),
        iconTag = link ? 'a' : 'div';
        #>
        <div class="elementor-icon-wrapper">
            <{{{ iconTag }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}" {{{ link }}}>
            <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
            {{{ iconHTML.value }}}
            <# } else { #>
            <i class="{{ settings.icon }}" aria-hidden="true"></i>
            <# } #>
        </{{{ iconTag }}}>
        </div>
        <?php
    }
}