<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor sidebar widget.
 *
 * Elementor widget that insert any sidebar into the page.
 *
 * @since 1.0.0
 */
class Widget_Sidebar extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve sidebar widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'sidebar';
    }

    /**
     * Get widget title.
     *
     * Retrieve sidebar widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Sidebar', 'elementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve sidebar widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-sidebar';
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
        return ['sidebar', 'widget'];
    }

    /**
     * Render sidebar widget as plain content.
     *
     * Override the default render behavior, don't render sidebar content.
     *
     * @since 1.0.0
     * @access public
     */
    public function render_plain_content()
    {
    }

    /**
     * Register sidebar widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        global $wp_registered_sidebars;

        $options = [];

        if (!$wp_registered_sidebars) {
            $options[''] = __('No sidebars were found', 'elementor');
        } else {
            $options[''] = __('Choose Sidebar', 'elementor');

            foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) {
                $options[$sidebar_id] = $sidebar['name'];
            }
        }

        $default_key = array_keys($options);
        $default_key = array_shift($default_key);

        $this->start_controls_section(
            'section_sidebar',
            [
                'label' => __('Sidebar', 'elementor'),
            ]
        );

        $this->add_control('sidebar', [
            'label' => __('Choose Sidebar', 'elementor'),
            'type' => Controls_Manager::SELECT,
            'default' => $default_key,
            'options' => $options,
        ]);

        $this->end_controls_section();
    }

    /**
     * Render sidebar widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $sidebar = $this->get_settings_for_display('sidebar');

        if (empty($sidebar)) {
            return;
        }

        dynamic_sidebar($sidebar);
    }

    /**
     * Render sidebar widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template()
    {
    }
}
