<?php

namespace Elementor\Core\Common\Modules\Finder;

use Elementor\Core\Base\Base_Object;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Base Category
 *
 * Base class for Elementor Finder categories.
 */
abstract class Base_Category extends Base_Object
{

    /**
     * Get init settings.
     *
     * @return array
     * @since 2.3.0
     * @access protected
     *
     */
    protected function get_init_settings()
    {
        $settings = [
            'title' => $this->get_title(),
            'dynamic' => $this->is_dynamic(),
        ];

        if (!$settings['dynamic']) {
            $settings['items'] = $this->get_category_items();
        }

        return $settings;
    }

    /**
     * Get title.
     *
     * @return string
     * @since 2.3.0
     * @abstract
     * @access public
     *
     */
    abstract public function get_title();

    /**
     * Is dynamic.
     *
     * Determine if the category is dynamic.
     *
     * @return bool
     * @since 2.3.0
     * @access public
     *
     */
    public function is_dynamic()
    {
        return false;
    }

    /**
     * Get category items.
     *
     * @param array $options
     *
     * @return array
     * @since 2.3.0
     * @abstract
     * @access public
     *
     */
    abstract public function get_category_items(array $options = []);
}
