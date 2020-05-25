<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor repeater element.
 *
 * Elementor repeater handler class is responsible for initializing the repeater.
 *
 * @since 1.0.0
 */
class Repeater extends Element_Base
{

    /**
     * Repeater counter.
     *
     * Holds the Repeater counter data. Default is `0`.
     *
     * @since 1.0.0
     * @access private
     * @static
     *
     * @var int Repeater counter.
     */
    private static $counter = 0;

    /**
     * Repeater constructor.
     *
     * Initializing Elementor repeater element.
     *
     * @param array $data Optional. Element data. Default is an empty array.
     * @param array|null $args Optional. Element default arguments. Default is null.
     *
     * @since 1.0.7
     * @access public
     *
     */
    public function __construct(array $data = [], array $args = null)
    {
        self::$counter++;

        parent::__construct($data, $args);
    }

    /**
     * Get repeater type.
     *
     * Retrieve the repeater type.
     *
     * @return string Repeater type.
     * @since 1.0.0
     * @access public
     * @static
     *
     */
    public static function get_type()
    {
        return 'repeater';
    }

    /**
     * Get repeater name.
     *
     * Retrieve the repeater name.
     *
     * @return string Repeater name.
     * @since 1.0.7
     * @access public
     *
     */
    public function get_name()
    {
        return 'repeater-' . self::$counter;
    }

    /**
     * Add new repeater control to stack.
     *
     * Register a repeater control to allow the user to set/update data.
     *
     * This method should be used inside `_register_controls()`.
     *
     * @param string $id Repeater control ID.
     * @param array $args Repeater control arguments.
     * @param array $options Optional. Repeater control options. Default is an
     *                        empty array.
     *
     * @return bool True if repeater control added, False otherwise.
     * @since 1.0.0
     * @access public
     *
     */
    public function add_control($id, array $args, $options = [])
    {
        $current_tab = $this->get_current_tab();

        if (null !== $current_tab) {
            $args = array_merge($args, $current_tab);
        }

        return Plugin::$instance->controls_manager->add_control_to_stack($this, $id, $args, $options);
    }

    /**
     * Get repeater fields.
     *
     * Retrieve the fields from the current repeater control.
     *
     * @return array Repeater fields.
     * @deprecated 2.1.0 Use `Repeater::get_controls()` instead.
     * @access public
     *
     * @since 1.5.0
     */
    public function get_fields()
    {
        _deprecated_function(__METHOD__, '2.1.0', __CLASS__ . '::get_controls()');

        return array_values($this->get_controls());
    }

    /**
     * Get default child type.
     *
     * Retrieve the repeater child type based on element data.
     *
     * Note that repeater does not support children, therefore it returns false.
     *
     * @param array $element_data Element ID.
     *
     * @return false Repeater default child type or False if type not found.
     * @since 1.0.0
     * @access protected
     *
     */
    protected function _get_default_child_type(array $element_data)
    {
        return false;
    }
}
