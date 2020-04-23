<?php

namespace Elementor\Core\Common\Modules\Ajax;

use Elementor\Core\Base\Module as BaseModule;
use Elementor\Core\Utils\Exceptions;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor ajax manager.
 *
 * Elementor ajax manager handler class is responsible for handling Elementor
 * ajax requests, ajax responses and registering actions applied on them.
 *
 * @since 2.0.0
 */
class Module extends BaseModule
{

    const NONCE_KEY = 'elementor_ajax';

    /**
     * Ajax actions.
     *
     * Holds all the register ajax action.
     *
     * @since 2.0.0
     * @access private
     *
     * @var array
     */
    private $ajax_actions = [];

    /**
     * Ajax requests.
     *
     * Holds all the register ajax requests.
     *
     * @since 2.0.0
     * @access private
     *
     * @var array
     */
    private $requests = [];

    /**
     * Ajax response data.
     *
     * Holds all the response data for all the ajax requests.
     *
     * @since 2.0.0
     * @access private
     *
     * @var array
     */
    private $response_data = [];

    /**
     * Current ajax action ID.
     *
     * Holds all the ID for the current ajax action.
     *
     * @since 2.0.0
     * @access private
     *
     * @var string|null
     */
    private $current_action_id = null;

    /**
     * Ajax manager constructor.
     *
     * Initializing Elementor ajax manager.
     *
     * @since 2.0.0
     * @access public
     */
    public function __construct()
    {
        add_action('wp_ajax_elementor_ajax', [$this, 'handle_ajax_request']);
    }

    /**
     * Get module name.
     *
     * Retrieve the module name.
     *
     * @return string Module name.
     * @since  1.7.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'ajax';
    }

    /**
     * Register ajax action.
     *
     * Add new actions for a specific ajax request and the callback function to
     * be handle the response.
     *
     * @param string $tag Ajax request name/tag.
     * @param callable $callback The callback function.
     * @since 2.0.0
     * @access public
     *
     */
    public function register_ajax_action($tag, $callback)
    {
        if (!did_action('elementor/ajax/register_actions')) {
            _doing_it_wrong(__METHOD__, esc_html(sprintf('Use `%s` hook to register ajax action.', 'elementor/ajax/register_actions')), '2.0.0');
        }

        $this->ajax_actions[$tag] = compact('tag', 'callback');
    }

    /**
     * Handle ajax request.
     *
     * Verify ajax nonce, and run all the registered actions for this request.
     *
     * Fired by `wp_ajax_elementor_ajax` action.
     *
     * @since 2.0.0
     * @access public
     */
    public function handle_ajax_request()
    {
        if (!$this->verify_request_nonce()) {
            $this->add_response_data(false, __('Token Expired.', 'elementor'))
                ->send_error(Exceptions::UNAUTHORIZED);
        }

        $editor_post_id = 0;

        if (!empty($_REQUEST['editor_post_id'])) {
            $editor_post_id = absint($_REQUEST['editor_post_id']);

            Plugin::$instance->db->switch_to_post($editor_post_id);
        }

        /**
         * Register ajax actions.
         *
         * Fires when an ajax request is received and verified.
         *
         * Used to register new ajax action handles.
         *
         * @param self $this An instance of ajax manager.
         * @since 2.0.0
         *
         */
        do_action('elementor/ajax/register_actions', $this);

        $this->requests = json_decode(stripslashes($_REQUEST['actions']), true);

        foreach ($this->requests as $id => $action_data) {
            $this->current_action_id = $id;

            if (!isset($this->ajax_actions[$action_data['action']])) {
                $this->add_response_data(false, __('Action not found.', 'elementor'), Exceptions::BAD_REQUEST);

                continue;
            }

            if ($editor_post_id) {
                $action_data['data']['editor_post_id'] = $editor_post_id;
            }

            try {
                $results = call_user_func($this->ajax_actions[$action_data['action']]['callback'], $action_data['data'], $this);

                if (false === $results) {
                    $this->add_response_data(false);
                } else {
                    $this->add_response_data(true, $results);
                }
            } catch (\Exception $e) {
                $this->add_response_data(false, $e->getMessage(), $e->getCode());
            }
        }

        $this->current_action_id = null;

        $this->send_success();
    }

    /**
     * Verify request nonce.
     *
     * Whether the request nonce verified or not.
     *
     * @return bool True if request nonce verified, False otherwise.
     * @since 2.3.0
     * @access public
     *
     */
    public function verify_request_nonce()
    {
        return !empty($_REQUEST['_nonce']) && wp_verify_nonce($_REQUEST['_nonce'], self::NONCE_KEY);
    }

    /**
     * Ajax failure response.
     *
     * Send a JSON response data back to the ajax request, indicating failure.
     *
     * @param null $code
     * @since 2.0.0
     * @access protected
     *
     */
    private function send_error($code = null)
    {
        wp_send_json_error([
            'responses' => $this->response_data,
        ], $code);
    }

    /**
     * Add response data.
     *
     * Add new response data to the array of all the ajax requests.
     *
     * @param bool $success True if the requests returned successfully, False
     *                       otherwise.
     * @param mixed $data Optional. Response data. Default is null.
     *
     * @param int $code Optional. Response code. Default is 200.
     *
     * @return Module An instance of ajax manager.
     * @since 2.0.0
     * @access protected
     *
     */
    private function add_response_data($success, $data = null, $code = 200)
    {
        $this->response_data[$this->current_action_id] = [
            'success' => $success,
            'code' => $code,
            'data' => $data,
        ];

        return $this;
    }

    /**
     * Ajax success response.
     *
     * Send a JSON response data back to the ajax request, indicating success.
     *
     * @since 2.0.0
     * @access protected
     */
    private function send_success()
    {
        $response = [
            'success' => true,
            'data' => [
                'responses' => $this->response_data,
            ],
        ];

        $json = wp_json_encode($response);

        while (ob_get_status()) {
            ob_end_clean();
        }

        if (function_exists('gzencode')) {
            $response = gzencode($json);

            header('Content-Type: application/json; charset=utf-8');
            header('Content-Encoding: gzip');
            header('Content-Length: ' . strlen($response));

            echo $response;
        } else {
            echo $json;
        }

        wp_die('', '', ['response' => null]);
    }

    /**
     * Get current action data.
     *
     * Retrieve the data for the current ajax request.
     *
     * @return bool|mixed Ajax request data if action exist, False otherwise.
     * @since 2.0.1
     * @access public
     *
     */
    public function get_current_action_data()
    {
        if (!$this->current_action_id) {
            return false;
        }

        return $this->requests[$this->current_action_id];
    }

    protected function get_init_settings()
    {
        return [
            'url' => admin_url('admin-ajax.php'),
            'nonce' => $this->create_nonce(),
        ];
    }

    /**
     * Create nonce.
     *
     * Creates a cryptographic token to
     * give the user an access to Elementor ajax actions.
     *
     * @return string The nonce token.
     * @since 2.3.0
     * @access public
     *
     */
    public function create_nonce()
    {
        return wp_create_nonce(self::NONCE_KEY);
    }
}
