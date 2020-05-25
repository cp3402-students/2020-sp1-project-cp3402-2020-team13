<?php

namespace Elementor\Core\Schemes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor scheme base.
 *
 * An abstract class implementing the scheme interface, responsible for
 * creating new schemes.
 *
 * @since 1.0.0
 * @abstract
 */
abstract class Base
{

    /**
     * DB option name for the time when the scheme was last updated.
     */
    const LAST_UPDATED_META = '_elementor_scheme_last_updated';

    /**
     * Get description.
     *
     * Retrieve the scheme description.
     *
     * @return string Scheme description.
     * @since 1.0.0
     * @access public
     * @static
     *
     */
    public static function get_description()
    {
        return '';
    }

    /**
     * Save scheme.
     *
     * Update Elementor scheme in the database, and update the last updated
     * scheme time.
     *
     * @param array $posted
     * @since 1.0.0
     * @access public
     *
     */
    public function save_scheme(array $posted)
    {
        update_option('elementor_scheme_' . static::get_type(), $posted);

        update_option(self::LAST_UPDATED_META, time());
    }

    /**
     * Get scheme type.
     *
     * Retrieve the scheme type.
     *
     * @since 2.8.0
     * @access public
     * @static
     */
    public static function get_type()
    {
        return '';
    }

    /**
     * Get scheme.
     *
     * Retrieve the scheme.
     *
     * @return array The scheme.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_scheme()
    {
        $scheme = [];

        foreach ($this->get_scheme_value() as $scheme_key => $scheme_value) {
            $scheme[$scheme_key] = [
                'value' => $scheme_value,
            ];
        }

        return $scheme;
    }

    /**
     * Get scheme value.
     *
     * Retrieve the scheme value.
     *
     * @return array Scheme value.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_scheme_value()
    {
        $scheme_value = get_option('elementor_scheme_' . static::get_type());

        if (!$scheme_value) {
            $scheme_value = $this->get_default_scheme();

            update_option('elementor_scheme_' . static::get_type(), $scheme_value);
        }

        return $scheme_value;
    }

    /**
     * Get default scheme.
     *
     * Retrieve the default scheme.
     *
     * @since 2.8.0
     * @access public
     */
    abstract public function get_default_scheme();
}
