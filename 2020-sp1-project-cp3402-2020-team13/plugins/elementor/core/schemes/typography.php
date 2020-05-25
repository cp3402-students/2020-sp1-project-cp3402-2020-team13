<?php

namespace Elementor\Core\Schemes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor typography scheme.
 *
 * Elementor typography scheme class is responsible for initializing a scheme
 * for typography.
 *
 * @since 1.0.0
 */
class Typography extends Base_UI
{

    /**
     * 1st typography scheme.
     */
    const TYPOGRAPHY_1 = '1';

    /**
     * 2nd typography scheme.
     */
    const TYPOGRAPHY_2 = '2';

    /**
     * 3rd typography scheme.
     */
    const TYPOGRAPHY_3 = '3';

    /**
     * 4th typography scheme.
     */
    const TYPOGRAPHY_4 = '4';

    /**
     * Get typography scheme type.
     *
     * Retrieve the typography scheme type.
     *
     * @return string Typography scheme type.
     * @since 1.0.0
     * @access public
     * @static
     *
     */
    public static function get_type()
    {
        return 'typography';
    }

    /**
     * Get typography scheme title.
     *
     * Retrieve the typography scheme title.
     *
     * @return string Typography scheme title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Typography', 'elementor');
    }

    /**
     * Get typography scheme disabled title.
     *
     * Retrieve the typography scheme disabled title.
     *
     * @return string Typography scheme disabled title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_disabled_title()
    {
        return __('Default Fonts', 'elementor');
    }

    /**
     * Get typography scheme titles.
     *
     * Retrieve the typography scheme titles.
     *
     * @return array Typography scheme titles.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_scheme_titles()
    {
        return [
            self::TYPOGRAPHY_1 => __('Primary Headline', 'elementor'),
            self::TYPOGRAPHY_2 => __('Secondary Headline', 'elementor'),
            self::TYPOGRAPHY_3 => __('Body Text', 'elementor'),
            self::TYPOGRAPHY_4 => __('Accent Text', 'elementor'),
        ];
    }

    /**
     * Get default typography scheme.
     *
     * Retrieve the default typography scheme.
     *
     * @return array Default typography scheme.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_default_scheme()
    {
        return [
            self::TYPOGRAPHY_1 => [
                'font_family' => 'Roboto',
                'font_weight' => '600',
            ],
            self::TYPOGRAPHY_2 => [
                'font_family' => 'Roboto Slab',
                'font_weight' => '400',
            ],
            self::TYPOGRAPHY_3 => [
                'font_family' => 'Roboto',
                'font_weight' => '400',
            ],
            self::TYPOGRAPHY_4 => [
                'font_family' => 'Roboto',
                'font_weight' => '500',
            ],
        ];
    }

    /**
     * Print typography scheme content template.
     *
     * Used to generate the HTML in the editor using Underscore JS template. The
     * variables for the class are available using `data` JS object.
     *
     * @since 1.0.0
     * @access public
     */
    public function print_template_content()
    {
        ?>
        <div class="elementor-panel-scheme-items"></div>
        <?php
    }

    /**
     * Init system typography schemes.
     *
     * Initialize the system typography schemes.
     *
     * @return array System typography schemes.
     * @since 1.0.0
     * @access protected
     *
     */
    protected function _init_system_schemes()
    {
        return [];
    }
}
