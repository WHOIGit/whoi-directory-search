<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.whoi.edu
 * @since      1.0.0
 *
 * @package    Whoi_Directory_Search
 * @subpackage Whoi_Directory_Search/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Whoi_Directory_Search
 * @subpackage Whoi_Directory_Search/public
 * @author     Ethan Andrews <eandrews@whoi.edu>
 */
class Whoi_Directory_Search_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
	 * Add Rewrite rules to set up user profile pages and username query var
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
    public function rewrite_rules()
    {
        add_rewrite_rule( 'profile/(.+?)/?$', 'index.php?username=$matches[1]', 'top');
        add_rewrite_tag( '%username%', '([^&]+)' );
    }

    /**
	 * Flush rewrite rules
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
    public function flush_rules()
    {
        $this->rewrite_rules();

        flush_rewrite_rules();
    }

    /**
	 * Load the PHP template for user profile page
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
    public function include_template( $template )
    {
        //try and get the query var we registered in our query_vars() function
        $profile_page = get_query_var( 'username' );

        //if the query var has data, we must be on the right page, load our custom template
        if ( $profile_page ) {
            return plugin_dir_path( __FILE__ ) . 'templates/whoi-directory-profile-display.php';
        }

        return $template;
    }

    /**
	 * Return display template for search form
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function search_form_display() {

        // Start output buffering for shortcode display
        ob_start();
		include( plugin_dir_path( __FILE__ ) . 'partials/whoi-directory-search-form-display.php' );
        return ob_get_clean();

	}

    /**
	 * Handles the directory form submit and response if no JWT token is available
	 * @since    1.0.0
	 */
	public function search_form_response() {

		if( isset( $_POST['whoi_directory_search_nonce'] ) && wp_verify_nonce( $_POST['whoi_directory_search_nonce'], 'whoi_directory_search_nonce') ) {

			// form processing logic
            $get_token = $this->getToken();
            echo json_encode(array('token' => $get_token));
            wp_die();
		}
		else {
			wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
						'response' 	=> 403,
						'back_link' => 'admin.php?page=' . $this->plugin_name,

				) );
		}
	}

    /**
	 * Return display template for people by deparment shortcode
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function people_by_department_display( $atts ) {

        $atts = shortcode_atts( array(
    		'department_code'  => '04',
    	), $atts, 'whoi_directory_people_by_department' );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://directory.whoi.edu/wp-json/whoi_directory/v1/users/department/" . $atts['department_code']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        /* Authorization with JWT tokens
        $headers = array();
        $headers[] = "Accept: application/json";
        $headers[] = "Authorization: Bearer APIKEY";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        */

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }

        curl_close ($ch);

        $users = json_decode($result);

        // Start output buffering for shortcode display
        ob_start();
		include( plugin_dir_path( __FILE__ ) . 'partials/whoi-directory-department-users-display.php' );
        return ob_get_clean();

	}

    /**
	 * Handles getting the JWT token via AJAX
	 * @since    1.0.0
	 */
	public function jwt_token_response() {

        $token = $this->get_token();
        echo json_encode(array('token' => $token));
        wp_die();

	}

    /**
    *   Generate a JWT token for future API calls to WordPress
    */
    private function get_token() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,'https://directory.whoi.edu/wp-json/jwt-auth/v1/token');
        curl_setopt($ch, CURLOPT_POST, 1);

        # Admin credentials here
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=webapp-support&password=1nc3Up0n@T!me");

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);
        if ($server_output === false) {
            die('Error getting JWT token on WordPress for API integration.');
        }
        $server_output = json_decode($server_output);

        if ($server_output === null && json_last_error() !== JSON_ERROR_NONE) {
            die('Invalid response getting JWT token on WordPress for API integration.');
        }

        if (!empty($server_output->token)) {
            $this->token = $server_output->token; # Token is here
            curl_close ($ch);
            return $this->token;
        } else {
            die('Invalid response getting JWT token on WordPress for API integration.');
        }
        return 'invalid';
    }


    /**
    * Registers all shortcodes at once
    *
    * @return [type] [description]
    */

    public function register_shortcodes() {

    	add_shortcode( 'whoi_directory_search_form', array( $this, 'search_form_display' ) );
        add_shortcode( 'whoi_directory_people_by_department', array( $this, 'people_by_department_display' ) );

    } // register_shortcodes()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whoi_Directory_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whoi_Directory_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whoi-directory-search-public.css', array(), time(), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whoi_Directory_Search_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whoi_Directory_Search_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        $params = array ( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whoi-directory-search-public.js', array( 'jquery' ), time(), false );
        wp_localize_script( $this->plugin_name, 'params', $params );

	}

}
