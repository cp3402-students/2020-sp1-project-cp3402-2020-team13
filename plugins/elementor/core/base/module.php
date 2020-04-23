<?php

namespace Elementor\Core\Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor module.
 *
 * An abstract class that provides the needed properties and methods to
 * manage and handle modules in inheriting classes.
 *
 * @since 1.7.0
 * @abstract
 */
abstract class Module extends Base_Object
{

    /**
     * Module instance.
     *
     * Holds the module instance.
     *
     * @since 1.7.0
     * @access protected
     *
     * @var Module
     */
    protected static $_instances = [];
    /**
     * Module class reflection.
     *
     * Holds the information about a class.
     *
     * @since 1.7.0
     * @access private
     *
     * @var \ReflectionClass
     */
    private $reflection;
    /**
     * Module components.
     *
     * Holds the module components.
     *
     * @since 1.7.0
     * @access private
     *
     * @var array
     */
    private $components = [];

    /**
     * Instance.
     *
     * Ensures only one instance of the module class is loaded or can be loaded.
     *
     * @return Module An instance of the class.
     * @since 1.7.0
     * @access public
     * @static
     *
     */
    public static function instance()
    {
        $class_name = static::class_name();

        if (empty(static::$_instances[$class_name])) {
            static::$_instances[$class_name] = new static();
        }

        return static::$_instances[$class_name];
    }

    /**
     * Class name.
     *
     * Retrieve the name of the class.
     *
     * @since 1.7.0
     * @access public
     * @static
     */
    public static function class_name()
    {
        return get_called_class();
    }

    /**
     * @since 2.0.0
     * @access public
     * @static
     */
    public static function is_active()
    {
        return true;
    }

    /**
     * Get module name.
     *
     * Retrieve the module name.
     *
     * @return string Module name.
     * @since 1.7.0
     * @access public
     * @abstract
     *
     */
    abstract public function get_name();

    /**
     * Clone.
     *
     * Disable class cloning and throw an error on object clone.
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object. Therefore, we don't want the object to be cloned.
     *
     * @since 1.7.0
     * @access public
     */
    public function __clone()
    {
        // Cloning instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, esc_html__('Something went wrong.', 'elementor'), '1.0.0');
    }

    /**
     * Wakeup.
     *
     * Disable unserializing of the class.
     *
     * @since 1.7.0
     * @access public
     */
    public function __wakeup()
    {
        // Unserializing instances of the class is forbidden
        _doing_it_wrong(__FUNCTION__, esc_html__('Something went wrong.', 'elementor'), '1.0.0');
    }

    /**
     * @since 2.0.0
     * @access public
     */
    public function get_reflection()
    {
        if (null === $this->reflection) {
            $this->reflection = new \ReflectionClass($this);
        }

        return $this->reflection;
    }

    /**
     * Add module component.
     *
     * Add new component to the current module.
     *
     * @param string $id Component ID.
     * @param mixed $instance An instance of the component.
     * @since 1.7.0
     * @access public
     *
     */
    public function add_component($id, $instance)
    {
        $this->components[$id] = $instance;
    }

    /**
     * @return Module[]
     * @since 2.3.0
     * @access public
     */
    public function get_components()
    {
        return $this->components;
    }

    /**
     * Get module component.
     *
     * Retrieve the module component.
     *
     * @param string $id Component ID.
     *
     * @return mixed An instance of the component, or `false` if the component
     *               doesn't exist.
     * @since 1.7.0
     * @access public
     *
     */
    public function get_component($id)
    {
        if (isset($this->components[$id])) {
            return $this->components[$id];
        }

        return false;
    }

    /**
     * Get js assets url
     *
     * @param string $file_name
     * @param string $relative_url Optional. Default is null.
     * @param string $add_min_suffix Optional. Default is 'default'.
     *
     * @return string
     * @since 2.3.0
     * @access protected
     *
     */
    final protected function get_js_assets_url($file_name, $relative_url = null, $add_min_suffix = 'default')
    {
        return $this->get_assets_url($file_name, 'js', $relative_url, $add_min_suffix);
    }

    /**
     * Get assets url.
     *
     * @param string $file_name
     * @param string $file_extension
     * @param string $relative_url Optional. Default is null.
     * @param string $add_min_suffix Optional. Default is 'default'.
     *
     * @return string
     * @since 2.3.0
     * @access protected
     *
     */
    final protected function get_assets_url($file_name, $file_extension, $relative_url = null, $add_min_suffix = 'default')
    {
        static $is_test_mode = null;

        if (null === $is_test_mode) {
            $is_test_mode = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG || defined('ELEMENTOR_TESTS') && ELEMENTOR_TESTS;
        }

        if (!$relative_url) {
            $relative_url = $this->get_assets_relative_url() . $file_extension . '/';
        }

        $url = $this->get_assets_base_url() . $relative_url . $file_name;

        if ('default' === $add_min_suffix) {
            $add_min_suffix = !$is_test_mode;
        }

        if ($add_min_suffix) {
            $url .= '.min';
        }

        return $url . '.' . $file_extension;
    }

    /**
     * Get assets relative url
     *
     * @return string
     * @since 2.3.0
     * @access protected
     *
     */
    protected function get_assets_relative_url()
    {
        return 'assets/';
    }

    /**
     * Get assets base url
     *
     * @return string
     * @since 2.6.0
     * @access protected
     *
     */
    protected function get_assets_base_url()
    {
        return ELEMENTOR_URL;
    }

    /**
     * Get css assets url
     *
     * @param string $file_name
     * @param string $relative_url Optional. Default is null.
     * @param string $add_min_suffix Optional. Default is 'default'.
     * @param bool $add_direction_suffix Optional. Default is `false`
     *
     * @return string
     * @since 2.3.0
     * @access protected
     *
     */
    final protected function get_css_assets_url($file_name, $relative_url = null, $add_min_suffix = 'default', $add_direction_suffix = false)
    {
        static $direction_suffix = null;

        if (!$direction_suffix) {
            $direction_suffix = is_rtl() ? '-rtl' : '';
        }

        if ($add_direction_suffix) {
            $file_name .= $direction_suffix;
        }

        return $this->get_assets_url($file_name, 'css', $relative_url, $add_min_suffix);
    }
}
