<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor base data control.
 *
 * An abstract class for creating new data controls in the panel.
 *
 * @since 1.5.0
 * @abstract
 */
abstract class Base_Data_Control extends Base_Control
{

    /**
     * Get data control value.
     *
     * Retrieve the value of the data control from a specific Controls_Stack settings.
     *
     * @param array $control Control
     * @param array $settings Element settings
     *
     * @return mixed Control values.
     * @since 1.5.0
     * @access public
     *
     */
    public function get_value($control, $settings)
    {
        if (!isset($control['default'])) {
            $control['default'] = $this->get_default_value();
        }

        if (isset($settings[$control['name']])) {
            $value = $settings[$control['name']];
        } else {
            $value = $control['default'];
        }

        return $value;
    }

    /**
     * Get data control default value.
     *
     * Retrieve the default value of the data control. Used to return the default
     * values while initializing the data control.
     *
     * @return string Control default value.
     * @since 1.5.0
     * @access public
     *
     */
    public function get_default_value()
    {
        return '';
    }

    /**
     * Parse dynamic tags.
     *
     * Iterates through all the controls and renders all the dynamic tags.
     *
     * @param string $dynamic_value The dynamic tag text.
     * @param array $dynamic_settings The dynamic tag settings.
     *
     * @return string|string[]|mixed A string or an array of strings with the
     *                               return value from each tag callback function.
     * @since 2.0.0
     * @access public
     *
     */
    public function parse_tags($dynamic_value, $dynamic_settings)
    {
        $current_dynamic_settings = $this->get_settings('dynamic');

        if (is_array($current_dynamic_settings)) {
            $dynamic_settings = array_merge($current_dynamic_settings, $dynamic_settings);
        }

        return Plugin::$instance->dynamic_tags->parse_tags_text($dynamic_value, $dynamic_settings, [Plugin::$instance->dynamic_tags, 'get_tag_data_content']);
    }

    /**
     * Get data control style value.
     *
     * Retrieve the style of the control. Used when adding CSS rules to the control
     * while extracting CSS from the `selectors` data argument.
     *
     * @param string $css_property CSS property.
     * @param string $control_value Control value.
     * @param array $control_data Control Data.
     *
     * @return string Control style value.
     * @since 1.5.0
     * @since 2.3.3 New `$control_data` parameter added.
     * @access public
     *
     */
    public function get_style_value($css_property, $control_value, array $control_data)
    {
        if ('DEFAULT' === $css_property) {
            return $control_data['default'];
        }

        return $control_value;
    }

    /**
     * Get data control unique ID.
     *
     * Retrieve the unique ID of the control. Used to set a uniq CSS ID for the
     * element.
     *
     * @param string $input_type Input type. Default is 'default'.
     *
     * @return string Unique ID.
     * @since 1.5.0
     * @access protected
     *
     */
    protected function get_control_uid($input_type = 'default')
    {
        return 'elementor-control-' . $input_type . '-{{{ data._cid }}}';
    }
}