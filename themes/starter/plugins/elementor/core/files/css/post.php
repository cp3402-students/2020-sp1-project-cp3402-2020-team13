<?php

namespace Elementor\Core\Files\CSS;

use Elementor\Controls_Stack;
use Elementor\Element_Base;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor post CSS file.
 *
 * Elementor CSS file handler class is responsible for generating the single
 * post CSS file.
 *
 * @since 1.2.0
 */
class Post extends Base
{

    /**
     * Elementor post CSS file prefix.
     */
    const FILE_PREFIX = 'post-';

    const META_KEY = '_elementor_css';

    /**
     * Post ID.
     *
     * Holds the current post ID.
     *
     * @var int
     */
    private $post_id;

    /**
     * Post CSS file constructor.
     *
     * Initializing the CSS file of the post. Set the post ID and initiate the stylesheet.
     *
     * @param int $post_id Post ID.
     * @since 1.2.0
     * @access public
     *
     */
    public function __construct($post_id)
    {
        $this->post_id = $post_id;

        parent::__construct(self::FILE_PREFIX . $post_id . '.css');
    }

    /**
     * Get CSS file name.
     *
     * Retrieve the CSS file name.
     *
     * @return string CSS file name.
     * @since 1.6.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'post';
    }

    /**
     * Get post ID.
     *
     * Retrieve the ID of current post.
     *
     * @return int Post ID.
     * @since 1.2.0
     * @access public
     *
     */
    public function get_post_id()
    {
        return $this->post_id;
    }

    /**
     * Enqueue CSS.
     *
     * Enqueue the post CSS file in Elementor.
     *
     * This method ensures that the post was actually built with elementor before
     * enqueueing the post CSS file.
     *
     * @since 1.2.2
     * @access public
     */
    public function enqueue()
    {
        if (!Plugin::$instance->db->is_built_with_elementor($this->post_id)) {
            return;
        }

        parent::enqueue();
    }

    /**
     * Load meta data.
     *
     * Retrieve the post CSS file meta data.
     *
     * @return array Post CSS file meta data.
     * @since 1.2.0
     * @access protected
     *
     */
    protected function load_meta()
    {
        return get_post_meta($this->post_id, static::META_KEY, true);
    }

    /**
     * Update meta data.
     *
     * Update the global CSS file meta data.
     *
     * @param array $meta New meta data.
     * @since 1.2.0
     * @access protected
     *
     */
    protected function update_meta($meta)
    {
        update_post_meta($this->post_id, static::META_KEY, $meta);
    }

    /**
     * Delete meta.
     *
     * Delete the file meta data.
     *
     * @since  2.1.0
     * @access protected
     */
    protected function delete_meta()
    {
        delete_post_meta($this->post_id, static::META_KEY);
    }

    /**
     * Render CSS.
     *
     * Parse the CSS for all the elements.
     *
     * @since 1.2.0
     * @access protected
     */
    protected function render_css()
    {
        $data = $this->get_data();

        if (!empty($data)) {
            foreach ($data as $element_data) {
                $element = Plugin::$instance->elements_manager->create_element_instance($element_data);

                if (!$element) {
                    continue;
                }

                $this->render_styles($element);
            }
        }
    }

    /**
     * Get post data.
     *
     * Retrieve raw post data from the database.
     *
     * @return array Post data.
     * @since 1.9.0
     * @access protected
     *
     */
    protected function get_data()
    {
        $document = Plugin::$instance->documents->get($this->post_id);
        return $document ? $document->get_elements_data() : [];
    }

    /**
     * Render styles.
     *
     * Parse the CSS for any given element.
     *
     * @param Element_Base $element The element.
     * @since 1.2.0
     * @access protected
     *
     */
    protected function render_styles(Element_Base $element)
    {
        /**
         * Before element parse CSS.
         *
         * Fires before the CSS of the element is parsed.
         *
         * @param Post $this The post CSS file.
         * @param Element_Base $element The element.
         * @since 1.2.0
         *
         */
        do_action('elementor/element/before_parse_css', $this, $element);

        $element_settings = $element->get_settings();

        $this->add_controls_stack_style_rules($element, $element->get_style_controls(null, $element->get_parsed_dynamic_settings()), $element_settings, ['{{ID}}', '{{WRAPPER}}'], [$element->get_id(), $this->get_element_unique_selector($element)]);

        /**
         * After element parse CSS.
         *
         * Fires after the CSS of the element is parsed.
         *
         * @param Post $this The post CSS file.
         * @param Element_Base $element The element.
         * @since 1.2.0
         *
         */
        do_action('elementor/element/parse_css', $this, $element);
    }

    /**
     * Add controls-stack style rules.
     *
     * Parse the CSS for all the elements inside any given controls stack.
     *
     * This method recursively renders the CSS for all the child elements in the stack.
     *
     * @param Controls_Stack $controls_stack The controls stack.
     * @param array $controls Controls array.
     * @param array $values Values array.
     * @param array $placeholders Placeholders.
     * @param array $replacements Replacements.
     * @param array $all_controls All controls.
     * @since 1.6.0
     * @access public
     *
     */
    public function add_controls_stack_style_rules(Controls_Stack $controls_stack, array $controls, array $values, array $placeholders, array $replacements, array $all_controls = null)
    {
        parent::add_controls_stack_style_rules($controls_stack, $controls, $values, $placeholders, $replacements, $all_controls);

        if ($controls_stack instanceof Element_Base) {
            foreach ($controls_stack->get_children() as $child_element) {
                $this->render_styles($child_element);
            }
        }
    }

    /**
     * Get unique element selector.
     *
     * Retrieve the unique selector for any given element.
     *
     * @param Element_Base $element The element.
     *
     * @return string Unique element selector.
     * @since 1.2.0
     * @access public
     *
     */
    public function get_element_unique_selector(Element_Base $element)
    {
        return '.elementor-' . $this->post_id . ' .elementor-element' . $element->get_unique_selector();
    }

    /**
     * Get enqueue dependencies.
     *
     * Retrieve the name of the stylesheet used by `wp_enqueue_style()`.
     *
     * @return array Name of the stylesheet.
     * @since 1.2.0
     * @access protected
     *
     */
    protected function get_enqueue_dependencies()
    {
        return ['elementor-frontend'];
    }

    /**
     * Get inline dependency.
     *
     * Retrieve the name of the stylesheet used by `wp_add_inline_style()`.
     *
     * @return string Name of the stylesheet.
     * @since 1.2.0
     * @access protected
     *
     */
    protected function get_inline_dependency()
    {
        return 'elementor-frontend';
    }

    /**
     * Get file handle ID.
     *
     * Retrieve the handle ID for the post CSS file.
     *
     * @return string CSS file handle ID.
     * @since 1.2.0
     * @access protected
     *
     */
    protected function get_file_handle_id()
    {
        return 'elementor-post-' . $this->post_id;
    }
}
