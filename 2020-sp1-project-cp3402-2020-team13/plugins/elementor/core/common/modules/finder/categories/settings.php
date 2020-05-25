<?php

namespace Elementor\Core\Common\Modules\Finder\Categories;

use Elementor\Core\Common\Modules\Finder\Base_Category;
use Elementor\Settings as ElementorSettings;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Settings Category
 *
 * Provides items related to Elementor's settings.
 */
class Settings extends Base_Category
{

    /**
     * Get title.
     *
     * @return string
     * @since 2.3.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Settings', 'elementor');
    }

    /**
     * Get category items.
     *
     * @param array $options
     *
     * @return array
     * @since 2.3.0
     * @access public
     *
     */
    public function get_category_items(array $options = [])
    {
        $settings_url = ElementorSettings::get_url();

        return [
            'general-settings' => [
                'title' => __('General Settings', 'elementor'),
                'url' => $settings_url,
                'keywords' => ['general', 'settings', 'elementor'],
            ],
            'style' => [
                'title' => __('Style', 'elementor'),
                'url' => $settings_url . '#tab-style',
                'keywords' => ['style', 'settings', 'elementor'],
            ],
            'advanced' => [
                'title' => __('Advanced', 'elementor'),
                'url' => $settings_url . '#tab-advanced',
                'keywords' => ['advanced', 'settings', 'elementor'],
            ],
        ];
    }
}
