<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor heading control.
 *
 * A base control for creating heading control. Displays a text heading between
 * controls in the panel.
 *
 * @since 1.0.0
 */
class Control_Heading extends Base_UI_Control
{

    /**
     * Get heading control type.
     *
     * Retrieve the control type, in this case `heading`.
     *
     * @return string Control type.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_type()
    {
        return 'heading';
    }

    /**
     * Render heading control output in the editor.
     *
     * Used to generate the control HTML in the editor using Underscore JS
     * template. The variables for the class are available using `data` JS
     * object.
     *
     * @since 1.0.0
     * @access public
     */
    public function content_template()
    {
        ?>
        <div class="elementor-control-field">
            <h3 class="elementor-control-title">{{ data.label }}</h3>
        </div>
        <?php
    }

    /**
     * Get heading control default settings.
     *
     * Retrieve the default settings of the heading control. Used to return the
     * default settings while initializing the heading control.
     *
     * @return array Control default settings.
     * @since 1.0.0
     * @access protected
     *
     */
    protected function get_default_settings()
    {
        return [
            'label_block' => true,
        ];
    }
}
