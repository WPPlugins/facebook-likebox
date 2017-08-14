<?php
/*
  Plugin Name: Facebook Likebox
  Plugin URI: http://beta.tech-banker.com
  Description:Facebook Like Box is a social plugin that enables Facebook Page owners to attract and gain Likes from their own website.
  Author: Tech Banker
  Author URI: http://beta.tech-banker.com
  Version: 3.0.3
  License: GPLv3
  Text Domain:  facebook-likebox
  Domain Path: /languages
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
/* Constant Declaration */
if (!defined("FACEBOOK_LIKEBOX_FILE")) {
    define("FACEBOOK_LIKEBOX_FILE", plugin_basename(__FILE__));
}
if (!defined("FACEBOOK_LIKEBOX_DIR_PATH")) {
    define("FACEBOOK_LIKEBOX_DIR_PATH", plugin_dir_path(__FILE__));
}
if (!defined("FACEBOOK_LIKEBOX_DIR_URL")) {
    define("FACEBOOK_LIKEBOX_DIR_URL", plugin_dir_url(__FILE__));
}
if (!defined("FACEBOOK_LIKEBOX_DIRNAME")) {
    define("FACEBOOK_LIKEBOX_DIRNAME", plugin_basename(dirname(__FILE__)));
}
if (is_ssl()) {
    if (!defined("tech_banker_url")) {
        define("tech_banker_url", "https://tech-banker.com");
    }
    if (!defined("tech_banker_beta_url")) {
        define("tech_banker_beta_url", "https://beta.tech-banker.com");
    }
} else {
    if (!defined("tech_banker_url")) {
        define("tech_banker_url", "http://tech-banker.com");
    }
    if (!defined("tech_banker_beta_url")) {
        define("tech_banker_beta_url", "http://beta.tech-banker.com");
    }
}
if (!defined("tech_banker_stats_url")) {
    define("tech_banker_stats_url", "http://stats.tech-banker-services.org");
}
if (!defined("facebook_likebox_version_number")) {
    define("facebook_likebox_version_number", "3.0.3");
}
/* Check Plugin update */

$memory_limit_facebook_lightbox = intval(ini_get("memory_limit"));
if (!extension_loaded('suhosin') && $memory_limit_facebook_lightbox < 512) {
    @ini_set("memory_limit", "512M");
}

@ini_set("max_execution_time", 6000);
@ini_set("max_input_vars", 10000);

/*
  Function Name: install_script_for_facebook_likebox
  Parameter: No
  Description: This function is used to create Tables in Database.
  Created On: 03-11-2016 12:47
  Created By: Tech Banker Team
 */

function install_script_for_facebook_likebox() {
    global $wpdb;
    if (is_multisite()) {
        $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        foreach ($blog_ids as $blog_id) {
            switch_to_blog($blog_id);
            $version = get_option("facebook-likebox-version-number");
            if ($version < "3.0.0") {
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/install-script.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "lib/install-script.php";
                }
            }
            restore_current_blog();
        }
    } else {
        $version = get_option("facebook-likebox-version-number");
        if ($version < "3.0.0") {
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/install-script.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/install-script.php";
            }
        }
    }
}

/*
  Function Name: facebook_main_table
  Parameter: No
  Description: This function is used to return Parent Table name with prefix.
  Created On: 03-11-2016 12:52
  Created By: Tech Banker Team
 */

function facebook_main_table() {
    global $wpdb;
    return $wpdb->prefix . "facebook_likebox_parent";
}

/*
  Function Name: facebook_meta_table
  Parameter: No
  Description: This function is used to return Meta Table name with prefix.
  Created On: 03-11-2016 12:53
  Created By: Tech Banker Team
 */

function facebook_meta_table() {
    global $wpdb;
    return $wpdb->prefix . "facebook_likebox_meta";
}

/*
  Function Name: check_user_roles_for_facebook_likebox
  Parameters: No
  Description: This function is used for checking roles of different users.
  Created On: 03-11-2016 13:00
  Created By: Tech Banker Team
 */

function check_user_roles_for_facebook_likebox() {
    global $current_user;
    $user = $current_user ? new WP_User($current_user) : wp_get_current_user();
    return $user->roles ? $user->roles[0] : false;
}

/*
  Function Name: get_others_capabilities_facebook_likebox
  Parameters: No
  Description: This function is used to get all the roles available in WordPress
  Created On: 03-11-2016 13:04
  Created By: Tech Banker Team
 */

function get_others_capabilities_facebook_likebox() {
    $user_capabilities = array();
    if (function_exists("get_editable_roles")) {
        foreach (get_editable_roles() as $role_name => $role_info) {
            foreach ($role_info["capabilities"] as $capability => $values) {
                if (!in_array($capability, $user_capabilities)) {
                    array_push($user_capabilities, $capability);
                }
            }
        }
    } else {
        $user_capabilities = array(
            "manage_options",
            "edit_plugins",
            "edit_posts",
            "publish_posts",
            "publish_pages",
            "edit_pages",
            "read"
        );
    }
    return $user_capabilities;
}

/*
  Function Name: facebook_likebox_action_links
  Parameters: Yes
  Description: This function is used to create link for Pro Editions.
  Created On: 20-04-2017 12:14
  Created By: Tech Banker Team
 */

function facebook_likebox_action_links($plugin_link) {
    $plugin_link[] = "<a href=\"http://beta.tech-banker.com/products/facebook-like-box/\" style=\"color: red; font-weight: bold;\" target=\"_blank\">Go Pro!</a>";
    return $plugin_link;
}

/*
  Function Name: facebook_likebox_settings_action_links
  Parameters: Yes($action)
  Description: This function is used to create link for Plugin Settings.
  Created On: 05-05-2017 17:35
  Created By: Tech Banker Team
 */

function facebook_likebox_settings_action_links($action) {
    global $wpdb;
    $user_role_permission = get_users_capabilities_for_facebook_likebox();
    $settings_link = '<a href = "' . admin_url('admin.php?page=facebook_likebox') . '">' . "Settings" . '</a>';
    array_unshift($action, $settings_link);
    return $action;
}

$version = get_option("facebook-likebox-version-number");
if ($version >= "3.0.0") {
    /*
      Function Name: get_users_capabilities_for_facebook_likebox
      Parameters: No
      Description: This function is used to get users capabilities.
      Created On: 03-11-2016 12:58
      Created By: Tech Banker Team
     */

    function get_users_capabilities_for_facebook_likebox() {
        global $wpdb;
        $capabilities = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . facebook_meta_table() . "
					WHERE meta_key = %s", "roles_and_capabilities"
                )
        );
        $core_roles = array(
            "manage_options",
            "edit_plugins",
            "edit_posts",
            "publish_posts",
            "publish_pages",
            "edit_pages",
            "read"
        );
        $unserialized_capabilities = unserialize($capabilities);
        return isset($unserialized_capabilities["capabilities"]) ? $unserialized_capabilities["capabilities"] : $core_roles;
    }

    /*
      Function Name: backend_js_css_for_facebook_likebox
      Parameters: Yes
      Description: This function is used for including backend js and css
      Created On : 4-11-2016 13:23
      Created By : Tech Banker Team
     */

    if (is_admin()) {

        function backend_js_css_for_facebook_likebox() {
            $pages_facebook_likebox = array
                (
                "facebook_likebox",
                "facebook_manage_like_box",
                "facebook_add_like_button",
                "facebook_manage_like_button",
                "facebook_add_sticky_like_box",
                "facebook_manage_sticky_like_box",
                "facebook_add_like_box_popup",
                "facebook_manage_like_box_popup",
                "facebook_add_like_box_and_button",
                "facebook_manage_like_box_and_button",
                "facebook_likebox_general_settings",
                "facebook_likebox_roles_and_capabilities",
                "facebook_likebox_feature_request",
                "facebook_likebox_system_information",
                "facebook_likebox_error_logs",
                "facebook_likebox_upgrade"
            );
            if (in_array(isset($_REQUEST["page"]) ? esc_attr($_REQUEST["page"]) : "", $pages_facebook_likebox)) {
                wp_enqueue_script("jquery");

                wp_enqueue_script("facebook-likebox-bootstrap.js", plugins_url("assets/global/plugins/custom/js/custom.js", __FILE__));
                wp_enqueue_script("facebook-likebox-jquery.validate.js", plugins_url("assets/global/plugins/validation/jquery.validate.js", __FILE__));
                wp_enqueue_script("facebook-likebox-jquery-datatables.js", plugins_url("assets/global/plugins/datatables/media/js/jquery-datatables.js", __FILE__));
                wp_enqueue_script("facebook-likebox-colpick.js", plugins_url("assets/global/plugins/colorpicker/colpick.js", __FILE__));
                wp_enqueue_script("facebook-likebox-jquery-fngetfilterednodes.js", plugins_url("assets/global/plugins/datatables/media/js/fngetfilterednodes.js", __FILE__));
                wp_enqueue_script("facebook-likebox-toastr.js", plugins_url("assets/global/plugins/toastr/toastr.js", __FILE__));
                wp_enqueue_script("facebook-clipboard.js", plugins_url("assets/global/plugins/clipboard/clipboard.js", __FILE__));
                wp_enqueue_script("facebook-likebox-tab-slideout.js", plugins_url("assets/global/plugins/tab-slideout/js/tab-slideout.js", __FILE__));
                wp_enqueue_style("facebook-like-box-custom", plugins_url("assets/admin/layout/css/facebook-like-box-custom.css", __FILE__));
                wp_enqueue_style("facebook-likebox-simple-line-icons.css", plugins_url("assets/global/plugins/icons/icons.css", __FILE__));
                wp_enqueue_style("facebook-likebox-components.css", plugins_url("assets/global/css/components.css", __FILE__));
                wp_enqueue_style("facebook-likebox-premium-edition.css", plugins_url("assets/admin/layout/css/premium-edition.css", __FILE__));
                if (is_rtl()) {
                    wp_enqueue_style("facebook-likebox-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom-rtl.css", __FILE__));
                    wp_enqueue_style("facebook-likebox-layout.css", plugins_url("assets/admin/layout/css/layout-rtl.css", __FILE__));
                    wp_enqueue_style("facebook-likebox-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom-rtl.css", __FILE__));
                } else {
                    wp_enqueue_style("facebook-likebox-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom.css", __FILE__));
                    wp_enqueue_style("facebook-likebox-layout.css", plugins_url("assets/admin/layout/css/layout.css", __FILE__));
                    wp_enqueue_style("facebook-likebox-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom.css", __FILE__));
                }
                wp_enqueue_style("facebook-likebox-default.css", plugins_url("assets/admin/layout/css/themes/default.css", __FILE__));
                wp_enqueue_style("facebook-likebox-toastr.min.css", plugins_url("assets/global/plugins/toastr/toastr.css", __FILE__));
                wp_enqueue_style("facebook-likebox-datatables.foundation.`css", plugins_url("assets/global/plugins/datatables/media/css/datatables.foundation.css", __FILE__));
                wp_enqueue_style("facebook-likebox-colpick.css", plugins_url("assets/global/plugins/colorpicker/colpick.css", __FILE__));
            }
        }

        add_action("admin_enqueue_scripts", "backend_js_css_for_facebook_likebox");
    }

    /*
      Function Name: frontend_js_css_for_facebook_likebox
      Parameters: Yes
      Description: This function is used for including frontend js and css
      Created On : 22-11-2016 12:19
      Created By : Tech Banker Team
     */

    function frontend_js_css_for_facebook_likebox() {
        wp_enqueue_style("facebook-like-box-custom", plugins_url("assets/admin/layout/css/facebook-like-box-custom.css", __FILE__));
        wp_enqueue_style("facebook-likebox-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom.css", __FILE__));
        wp_enqueue_style("facebook-likebox-simple-line-icons.css", plugins_url("assets/global/plugins/icons/icons.css", __FILE__));

        wp_enqueue_style("facebook-likebox-components.css", plugins_url("assets/global/css/components.css", __FILE__));
        wp_enqueue_style("facebook-likebox-toastr.min.css", plugins_url("assets/global/plugins/toastr/toastr.css", __FILE__));
        wp_enqueue_style("facebook-likebox-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom.css", __FILE__));
        wp_enqueue_style("facebook-likebox-animation-effects.css", plugins_url("assets/admin/layout/css/fbl-animation-effects.css", __FILE__));

        wp_enqueue_script("jquery");
        wp_enqueue_script("facebook-likebox-tab-slideout.js", plugins_url("assets/global/plugins/tab-slideout/js/tab-slideout.js", __FILE__));
        wp_enqueue_script("facebook-likebox-bootstrap.js", plugins_url("assets/global/plugins/custom/js/custom.js", __FILE__));
        wp_enqueue_script("facebook-likebox-jquery.validate.js", plugins_url("assets/global/plugins/validation/jquery.validate.js", __FILE__));
        wp_enqueue_script("facebook-likebox-toastr.js", plugins_url("assets/global/plugins/toastr/toastr.js", __FILE__));
    }

    /*
      Function Name: sidebar_menu_for_facebook_likebox
      Parameter: No
      Description: This function is used to create Admin sidebar menus.
      Created On: 03-11-2016 13:00
      Created By: Tech Banker Team
     */

    function sidebar_menu_for_facebook_likebox() {
        global $wpdb, $current_user;
        $user_role_permission = get_users_capabilities_for_facebook_likebox();
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
            include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
        }
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/sidebar-menu.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/sidebar-menu.php";
        }
    }

    /*
      Function Name: adminbar_menu_for_facebook_likebox
      Parameters: NO
      Description: This function is used for creating admin bar menu
      Created On: 03-11-2016 13:14
      Created by: Tech Banker Team
     */

    function adminbar_menu_for_facebook_likebox() {
        global $wpdb, $current_user, $wp_admin_bar;
        $role_capabilities = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . facebook_meta_table() . "
					WHERE meta_key = %s", "roles_and_capabilities"
                )
        );

        $role_capabilities_top_bar_menu_unserialize = unserialize($role_capabilities);

        if (esc_attr($role_capabilities_top_bar_menu_unserialize["show_top_bar_menu"]) == "enable") {
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/admin-bar-menu.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/admin-bar-menu.php";
            }
        }
    }

    /*
      Function Name: user_functions_for_facebook_lightbox
      Parameters: No
      Description: This function is used to call on init hook.
      Created On: 03-11-2016 11:08
      Created By: Tech Banker Team
     */

    function user_functions_for_facebook_lightbox() {
        frontend_js_css_for_facebook_likebox();
        plugin_load_textdomain_facebook_likebox();
    }

    /*
      Function Name: helper_file_for_facebook_likebox
      Parameter: No
      Description: This function is used to create class and function to perform operations.
      Created On: 03-11-2016 15:03
      Created By: Tech Banker Team
     */

    function helper_file_for_facebook_likebox() {
        global $wpdb, $current_user;
        $user_role_permission = get_users_capabilities_for_facebook_likebox();
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/helper.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/helper.php";
        }
    }

    /*
      Function Name: action_library_for_facebook_likebox_backend
      Parameter: No
      Description: This function is used to Register Ajax for backend.
      Created On: 03-11-2016 14:12
      Created By: Tech Banker Team
     */

    function action_library_for_facebook_likebox_backend() {
        global $wpdb, $current_user;
        $user_role_permission = get_users_capabilities_for_facebook_likebox();
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
            include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
        }
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/action-library.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/action-library.php";
        }
    }

    /*
      Function Name: preview_for_facebook_likebox
      Parameter: No
      Description: This function is used to Register Ajax for preview.
      Created On: 28-11-2016 10:12
      Created By: Tech Banker Team
     */

    function preview_for_facebook_likebox() {
        global $wpdb, $current_user;
        $user_role_permission = get_users_capabilities_for_facebook_likebox();
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
            include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
        }
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/preview.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/preview.php";
        }
    }

    /*
      Function Name: admin_function_facebook_likebox
      Parameters: No
      Description: This function is used for calling admin_init functions.
      Created On: 03-11-2016 13:30
      Created By: Tech Banker Team
     */

    function admin_function_facebook_likebox() {
        install_script_for_facebook_likebox();
        helper_file_for_facebook_likebox();
    }

    /*
      Function Name: plugin_load_textdomain_facebook_likebox
      Parameters: No
      Description: This function is used to load the plugin's translated strings.
      Created On: 03-11-2016 14:54
      Created By: Tech Banker Team
     */

    function plugin_load_textdomain_facebook_likebox() {
        load_plugin_textdomain("facebook-likebox", false, FACEBOOK_LIKEBOX_DIRNAME . "/languages");
    }

    /*
      Function Name: extracted_shortcode_attributes_likebox
      Parameters: yes(all shortcode attributes)
      Description: This function is used to add frontend file for likebox.
      Created On: 16-11-2016 14:49
      Created by: Tech Banker Team
     */

    function extracted_shortcode_attributes_likebox($display_type, $case_type, $fbl_id, $facebook_page_url, $language, $width, $height, $header, $streams, $border_width, $border_style, $border_color, $border_radius, $show_faces_like_box, $share_button, $button_style) {
        ob_start();
        $unique_id = rand(100, 10000);
        ?>
        <div id="<?php echo $unique_id ?>">
            <?php
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/queries.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/styles/css-generator.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/styles/css-generator.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/views/facebook-likebox.php")) {
                require FACEBOOK_LIKEBOX_DIR_PATH . "user-views/views/facebook-likebox.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php";
            }
            ?>
        </div>
        <?php
        $facebook_likebox_output = ob_get_clean();
        wp_reset_query();
        return $facebook_likebox_output;
    }

    /*
      Function Name: facebook_likebox_shortcode_handler
      Parameters: yes($atts)
      Description: This function is used to set shortcode attributes.
      Created On: 16-11-2016 14:49
      Created by: Tech Banker Team
     */

    function facebook_likebox_shortcode_handler($atts) {
        extract(shortcode_atts(array(
            "display_type" => "",
            "case_type" => "",
            "fbl_id" => "",
            "facebook_page_url" => "",
            "language" => "",
            "width" => "",
            "height" => "",
            "header" => "",
            "streams" => "",
            "border_width" => "",
            "border_style" => "",
            "border_color" => "",
            "border_radius" => "",
            "show_faces_like_box" => "",
            "share_button" => "",
            "button_style" => ""
                        ), $atts));
        return extracted_shortcode_attributes_likebox($display_type, $case_type, $fbl_id, $facebook_page_url, $language, $width, $height, $header, $streams, $border_width, $border_style, $border_color, $border_radius, $show_faces_like_box, $share_button, $button_style);
    }

    /*
      Function Name: add_likebox_button
      Parameters: No
      Description: This function is used to add likebox shortcode popup.
      Created On: 03-11-2016 13:30
      Created by: Tech Banker Team
     */

    function add_likebox_button($context) {
        $user_role_permission = get_users_capabilities_for_facebook_likebox();
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php")) {
            include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php";
        }
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/likebox-media-popup.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/likebox-media-popup.php";
        }
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php";
        }
        $context .= '<a href="javascript:void(0);" data-media-popup-open="ux_open_popup_media_button" class="button" onclick="show_pop_up_facebook_likebox();">' . $fbl_likebox_add_to_page . '</a>';
        return $context;
    }

    /*
      Function Name: action_library_for_facebook_likebox_frontend
      Parameter: No
      Description: This function is used for including the frontend ajax file.
      Created On: 01-06-2016 10:32
      Created By: Tech Banker Team
     */

    function action_library_for_facebook_likebox_frontend() {
        global $wpdb;
        $user_role_permission = get_users_capabilities_for_facebook_likebox();
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php")) {
            include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php";
        }
        if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/action-library.php")) {
            include_once FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/action-library.php";
        }
    }

    /*
      Class Name: Facebook_Likebox_Widget
      Parameter: No
      Description: This class is used to add widget.
      Created On: 21-11-2016 13:11
      Created by: Tech Banker Team
     */
    if (!class_exists("Facebook_Likebox_Widget")) {

        class Facebook_Likebox_Widget extends WP_Widget {

            function __construct() {
                parent::__construct(
                        "Facebook_Likebox_Widget", __("Facebook Like Box", "facebook_likebox"), array("description" => __("Uses Facebook Like Box", "facebook_likebox"))
                );
            }

            /*
              Function Name: form
              Parameters: Yes($instance)
              Description: This function is used to add widget form.
              Created On: 21-11-2016 13:16
              Created by: Tech Banker Team
             */

            function form($instance) {
                $user_role_permission = get_users_capabilities_for_facebook_likebox();
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php";
                }
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/facebook-likebox-widget.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/facebook-likebox-widget.php";
                }
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php";
                }
            }

            /*
              Function Name: update
              Parameters: Yes($new_instance, $old_instance)
              Description: This function is used to update widget.
              Created On: 21-11-2016 13:18
              Created by: Tech Banker Team
             */

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance["likebox_id"] = $new_instance["ux_ddl_likebox_title"];
                return $instance;
            }

            /*
              Function Name: widget
              Parameters: Yes($args, $instance)
              Description: This function is used to display widget.
              Created On: 21-11-2016 13:20
              Created by: Tech Banker Team
             */

            function widget($args, $instance) {
                extract($args, EXTR_SKIP);
                echo $before_widget;
                if (isset($instance["display_type"]) && !empty($instance["display_type"])) {
                    $fbl_language = empty($instance["fbl_language"]) ? "" : $instance["fbl_language"];
                    $facebook_page_url = empty($instance["facebook_page_url"]) ? "" : $instance["facebook_page_url"];
                    $width = empty($instance["width"]) ? "" : $instance["width"];
                    $height = empty($instance["height"]) ? "" : $instance["height"];
                    $streams = empty($instance["streams"]) ? "" : $instance["streams"];
                    $show_faces_like_box = empty($instance["show_faces_like_box"]) ? "yes" : $instance["show_faces_like_box"];
                    $header = empty($instance["header"]) ? "" : $instance["header"];
                    $post_stream = $streams == "yes" ? "timeline" : "";
                    $likebox_header = $header == "yes" ? "true" : "false";
                    $likebox_user_faces = $show_faces_like_box == "yes" ? "true" : "false";
                    $url = urlencode($facebook_page_url);

                    $iframe_src = "https://www.facebook.com/plugins/page.php?href=";
                    $iframe_src .= $url;
                    $iframe_src .= "&tabs=$post_stream,events,messages";
                    $iframe_src .= "&width=" . $width;
                    $iframe_src .= "&height=" . $height;
                    $iframe_src .= "&small_header=" . $likebox_header;
                    $iframe_src .= "&adapt_container_width=true";
                    $iframe_src .= "&hide_cover=true";
                    $iframe_src .= "&locale=" . $fbl_language;
                    $iframe_src .= "&show_facepile=" . $likebox_user_faces;
                    ?>
                    <div id="facebook_likebox_container">
                        <iframe class="iframe_class" src="<?php echo $iframe_src; ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" style="overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
                        </iframe>
                    </div>
                    <?php
                }
                if (isset($instance["case_type"]) && !empty($instance["case_type"])) {
                    $case_id = $instance["likebox_id"];
                    if ($instance["case_type"] == "like_button" || $instance["case_type"] == "like_box_button") {
                        $case_type = $instance["case_type"];

                        $shortcode_type = "[facebook_likebox case_type= \"$case_type\" fbl_id=\"$case_id\"][/facebook_likebox]";
                        echo do_shortcode($shortcode_type);
                    }
                }
                $likebox_id = empty($instance["likebox_id"]) ? " " : apply_filters("widget_likebox_shortcode", $instance["likebox_id"]);
                $shortcode = "";
                if (!empty($likebox_id)) {
                    if (isset($instance["case_type"]) && !empty($instance["case_type"]) && $instance["case_type"] == "like_box") {
                        $shortcode = "[facebook_likebox case_type= \"like_box\" fbl_id=\"$likebox_id\"][/facebook_likebox]";
                    } else {
                        $shortcode = "[facebook_likebox case_type= \"like_box\" fbl_id=\"$likebox_id\"][/facebook_likebox]";
                    }
                }
                if (!empty($shortcode)) {
                    echo do_shortcode($shortcode);
                }
                echo $after_widget;
            }

        }

    }

    /*
      Class Name: Facebook_Like_button_Widget
      Parameter: No
      Description: This class is used to add widget.
      Created On: 20-04-2017 11:26
      Created by: Tech Banker Team
     */
    if (!class_exists("Facebook_Like_button_Widget")) {

        class Facebook_Like_button_Widget extends WP_Widget {

            function __construct() {
                parent::__construct(
                        "Facebook_Like_button_Widget", __("Facebook Like Button", "facebook_like_button"), array("description" => __("Uses Facebook Like button", "facebook_like_button"))
                );
            }

            /*
              Function Name: form
              Parameters: Yes($instance)
              Description: This function is used to add widget form.
              Created On: 20-04-2017 11:26
              Created by: Tech Banker Team
             */

            function form($instance) {
                $user_role_permission = get_users_capabilities_for_facebook_likebox();
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php";
                }
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/facebook-like-button-widget.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/facebook-like-button-widget.php";
                }
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php";
                }
            }

            /*
              Function Name: update
              Parameters: Yes($new_instance, $old_instance)
              Description: This function is used to update widget.
              Created On: 20-04-2017 11:26
              Created by: Tech Banker Team
             */

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance["likebox_id"] = $new_instance["ux_ddl_like_button_title"];
                return $instance;
            }

            /*
              Function Name: widget
              Parameters: Yes($args, $instance)
              Description: This function is used to display widget.
              Created On: 20-04-2017 11:26
              Created by: Tech Banker Team
             */

            function widget($args, $instance) {
                extract($args, EXTR_SKIP);
                echo $before_widget;
                if (isset($instance["display_type"]) && !empty($instance["display_type"])) {
                    $fbl_language = empty($instance["fbl_language"]) ? "" : $instance["fbl_language"];
                    $facebook_page_url = empty($instance["facebook_page_url"]) ? "" : $instance["facebook_page_url"];
                    $button_style = empty($instance["button_style"]) ? "" : $instance["button_style"];
                    $url = urlencode($facebook_page_url);

                    $button_src = "https://www.facebook.com/plugins/like.php?href=";
                    $button_src .= $url;
                    $button_src .= "&width=300";
                    $button_src .= "&layout=" . $button_style;
                    $button_src .= "&action=like";
                    $button_src .= "&size=small";
                    $button_src .= "&share=true";
                    $button_src .= "&locale=" . $fbl_language;
                    ?>
                    <div class="facebook_like_button_container">
                        <iframe src="<?php echo $button_src ?>" width="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
                        </iframe>
                    </div>
                    <?php
                }
                $likebox_id = empty($instance["likebox_id"]) ? " " : apply_filters("widget_likebox_shortcode", $instance["likebox_id"]);
                if (!empty($likebox_id)) {
                    $shortcode = "[facebook_likebox case_type= \"like_button\" fbl_id=\"$likebox_id\"][/facebook_likebox]";
                }
                echo do_shortcode($shortcode);
                echo $after_widget;
            }

        }

    }

    /*
      Class Name: Facebook_Likebox_button_Widget
      Parameter: No
      Description: This class is used to add widget.
      Created On: 20-04-2017 11:26
      Created by: Tech Banker Team
     */
    if (!class_exists("Facebook_Likebox_button_Widget")) {

        class Facebook_Likebox_button_Widget extends WP_Widget {

            function __construct() {
                parent::__construct(
                        "Facebook_Likebox_button_Widget", __("Facebook Like Box and Button", "facebook_likebox_button"), array("description" => __("Uses Facebook Like Box and Button", "facebook_likebox_button"))
                );
            }

            /*
              Function Name: form
              Parameters: Yes($instance)
              Description: This function is used to add widget form.
              Created On: 20-04-2017 11:26
              Created by: Tech Banker Team
             */

            function form($instance) {
                $user_role_permission = get_users_capabilities_for_facebook_likebox();
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/translations.php";
                }
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/facebook-like-box-button-widget.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/lib/facebook-like-box-button-widget.php";
                }
                if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php")) {
                    include FACEBOOK_LIKEBOX_DIR_PATH . "user-views/includes/scripts.php";
                }
            }

            /*
              Function Name: update
              Parameters: Yes($new_instance, $old_instance)
              Description: This function is used to update widget.
              Created On: 20-04-2017 11:26
              Created by: Tech Banker Team
             */

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance["likebox_id"] = $new_instance["ux_ddl_like_box_button_title"];
                return $instance;
            }

            /*
              Function Name: widget
              Parameters: Yes($args, $instance)
              Description: This function is used to display widget.
              Created On: 20-04-2017 11:26
              Created by: Tech Banker Team
             */

            function widget($args, $instance) {
                extract($args, EXTR_SKIP);
                echo $before_widget;
                if (isset($instance["display_type"]) && !empty($instance["display_type"])) {
                    $fbl_language = empty($instance["fbl_language"]) ? "" : $instance["fbl_language"];
                    $facebook_page_url = empty($instance["facebook_page_url"]) ? "" : $instance["facebook_page_url"];
                    $width = empty($instance["width"]) ? "" : $instance["width"];
                    $height = empty($instance["height"]) ? "" : $instance["height"];
                    $streams = empty($instance["streams"]) ? "" : $instance["streams"];
                    $show_faces_like_box = empty($instance["show_faces_like_box"]) ? "yes" : $instance["show_faces_like_box"];
                    $header = empty($instance["header"]) ? "" : $instance["header"];
                    $post_stream = $streams == "yes" ? "timeline" : "";
                    $likebox_header = $header == "yes" ? "true" : "false";
                    $likebox_user_faces = $show_faces_like_box == "yes" ? "true" : "false";
                    $url = urlencode($facebook_page_url);

                    $iframe_src = "https://www.facebook.com/plugins/page.php?href=";
                    $iframe_src .= $url;
                    $iframe_src .= "&tabs=$post_stream,events,messages";
                    $iframe_src .= "&width=" . $width;
                    $iframe_src .= "&height=" . $height;
                    $iframe_src .= "&small_header=" . $likebox_header;
                    $iframe_src .= "&adapt_container_width=true";
                    $iframe_src .= "&hide_cover=true";
                    $iframe_src .= "&locale=" . $fbl_language;
                    $iframe_src .= "&show_facepile=" . $likebox_user_faces;
                    ?>
                    <div class="facebook_like_box_button_container">
                        <iframe class="iframe_class" src="<?php echo $iframe_src; ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" style="overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true">
                        </iframe>
                        <?php
                        $like_button_src = "https://www.facebook.com/plugins/like.php?href=";
                        $like_button_src .= $url;
                        $like_button_src .= "&width=" . $width;
                        $like_button_src .= "&layout=" . $button_style;
                        $like_button_src .= "&action=like";
                        $like_button_src .= "&size=small";
                        $like_button_src .= "&share=true";
                        $like_button_src .= "&locale=" . $fbl_language;
                        ?>
                        <div style="height:31px;margin:5px;">
                            <iframe src="<?php echo $like_button_src ?>" width="<?php echo $width; ?>"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
                            </iframe>
                        </div>
                    </div>
                    <?php
                }
                $likebox_id = empty($instance["likebox_id"]) ? " " : apply_filters("widget_likebox_shortcode", $instance["likebox_id"]);
                if (!empty($likebox_id)) {
                    $shortcode = "[facebook_likebox case_type= \"like_box_button\" fbl_id=\"$likebox_id\"][/facebook_likebox]";
                }
                echo do_shortcode($shortcode);
                echo $after_widget;
            }

        }

    }

    /*
      Function Name: deactivation_function_for_facebook_likebox
      Parameters: No
      Description: This function is used for executing the code on deactivation.
      Created On: 19-04-2017 04:08
      Created by: Tech Banker Team
     */

    function deactivation_function_for_facebook_likebox() {
        $type = get_option("facebook-likebox-wizard-set-up");
        if ($type == "opt_in") {
            $plugin_info_facebook_likebox = new plugin_info_facebook_likebox();
            global $wp_version, $wpdb;
            $theme_details = array();

            if ($wp_version >= 3.4) {
                $active_theme = wp_get_theme();
                $theme_details["theme_name"] = strip_tags($active_theme->Name);
                $theme_details["theme_version"] = strip_tags($active_theme->Version);
                $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
            }

            $plugin_stat_data = array();
            $plugin_stat_data["plugin_slug"] = "facebook-likebox";
            $plugin_stat_data["type"] = "standard_edition";
            $plugin_stat_data["version_number"] = facebook_likebox_version_number;
            $plugin_stat_data["status"] = $type;
            $plugin_stat_data["event"] = "de-activate";
            $plugin_stat_data["domain_url"] = site_url();
            $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();

            $plugin_stat_data["email"] = get_option("admin_email");
            $plugin_stat_data["wp_version"] = $wp_version;
            $plugin_stat_data["php_version"] = esc_html(phpversion());
            $plugin_stat_data["mysql_version"] = $wpdb->db_version();
            $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
            $plugin_stat_data["operating_system"] = PHP_OS . "  (" . PHP_INT_SIZE * 8 . ") BIT";
            $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit") ? ini_get("memory_limit") : "N/A";
            $plugin_stat_data["extensions"] = get_loaded_extensions();
            $plugin_stat_data["plugins"] = $plugin_info_facebook_likebox->get_plugin_info_facebook_likebox();
            $plugin_stat_data["themes"] = $theme_details;
            $url = tech_banker_stats_url . "/wp-admin/admin-ajax.php";
            $response = wp_safe_remote_post($url, array
                (
                "method" => "POST",
                "timeout" => 45,
                "redirection" => 5,
                "httpversion" => "1.0",
                "blocking" => true,
                "headers" => array(),
                "body" => array("data" => serialize($plugin_stat_data), "site_id" => get_option("fbl_tech_banker_site_id") != "" ? get_option("fbl_tech_banker_site_id") : "", "action" => "plugin_analysis_data")
            ));

            if (!is_wp_error($response)) {
                $response["body"] != "" ? update_option("fbl_tech_banker_site_id", $response["body"]) : "";
            }
        }
    }

    /* Hooks */

    /*
      add_action for admin_function_facebook_likebox
      Description:This hook contains all admin_init functions.
      Created On: 03-11-2016 13:32
      Created By: Tech Banker Team
     */

    add_action("admin_init", "admin_function_facebook_likebox");

    /*
      add_action for action_library_for_facebook_likebox_backend
      Description:This hook is used to calling the function of ajax register for backend.
      Created On: 03-11-2016 14:18
      Created By: Tech Banker Team
     */
    add_action("wp_ajax_facebook_likebox_backend", "action_library_for_facebook_likebox_backend");

    /*
      add_action for preview_for_facebook_likebox
      Description:This hook is used to calling the function of ajax register for preview.
      Created On: 28-11-2016 10:09
      Created By: Tech Banker Team
     */
    add_action("wp_ajax_facebook_likebox_preview", "preview_for_facebook_likebox");

    /*
      add_action for sidebar_menu_for_facebook_likebox
      Description:This hook is used for calling the function of sidebar menus.
      Created On: 03-11-2016 13:11
      Created By: Tech Banker Team
     */

    add_action("admin_menu", "sidebar_menu_for_facebook_likebox");

    /*
      add_action for sidebar_menu_for_facebook_likebox
      Description: This hook is used for calling the function of sidebar menuin multisite case.
      Created On: 03-11-2016 13:11
      Created By: Tech Banker Team
     */
    add_action("network_admin_menu", "sidebar_menu_for_facebook_likebox");

    /*
      add_action for adminbar_menu_for_facebook_likebox
      Description: This hook is used for calling the function of top bar menu.
      Created On: 03-11-2016 13:15
      Created by: Tech Banker Team
     */

    add_action("admin_bar_menu", "adminbar_menu_for_facebook_likebox", 100);

    /*
      add_shortcode for facebook_likebox_shortcode_handler
      Description: This hook is used for calling the function of shortcode handler.
      Created On: 16-11-2016 14:51
      Created By: Tech Banker Team
     */

    add_shortcode("facebook_likebox", "facebook_likebox_shortcode_handler");

    /*
      add_action for add_likebox_button
      Description: This hook is used for add likebox button for shortcode popup.
      Created On: 03-11-2016 15:09
      Created By: Tech Banker Team
     */
    add_action("media_buttons_context", "add_likebox_button");

    /*
      add_action for action_library_for_facebook_likebox_frontend
      Description:This hook is used to calling the function of ajax register for backend.
      Created On: 03-11-2016 14:18
      Created By: Tech Banker Team
     */
    add_action("wp_ajax_facebook_likebox_frontend_ajax_call", "action_library_for_facebook_likebox_frontend");

    /*
      add_action for Facebook_Likebox_Widget class
      Description: This hook is used for initiate Widget
      Created On: 03-11-2016 15:09
      Created By: Tech Banker Team
     */
    add_action("widgets_init", create_function("", "return register_widget(\"Facebook_Likebox_Widget\");"));

    /*
      add_action for Facebook_Like_button_Widget class
      Description: This hook is used for initiate Widget
      Created On: 20-04-2017 11:48
      Created By: Tech Banker Team
     */
    add_action("widgets_init", create_function("", "return register_widget(\"Facebook_Like_button_Widget\");"));

    /*
      add_action for Facebook_Likebox_button_Widget class
      Description: This hook is used for initiate Widget
      Created On: 20-04-2017 11:48
      Created By: Tech Banker Team
     */
    add_action("widgets_init", create_function("", "return register_widget(\"Facebook_Likebox_button_Widget\");"));
    /*
      add_action for Widget.
      Description: This hook is used for apply the shortcode for Widget.
      Created On: 30-11-2016 12:24
      Created By: Tech Banker Team
     */
    add_filter("widget_text", "do_shortcode");
}

/*
  add_action for user_functions_for_facebook_lightbox
  Description: This hook is used for calling the function of frontend.
  Created On: 03-11-2016 15:03
  Created by: Tech Banker Team
 */

add_action("init", "user_functions_for_facebook_lightbox");
/*
  register_activation_hook
  Description: This hook is used for calling the function of install script.
  Created On: 03-11-2016 12:49
  Created By: Tech Banker Team
 */

register_activation_hook(__FILE__, "install_script_for_facebook_likebox");

/*
  add_action for install_script_for_facebook_likebox
  Description: This hook is used for calling the function of install script.
  Created On: 03-11-2016 12:49
  Created By: Tech Banker Team
 */

add_action("admin_init", "install_script_for_facebook_likebox");


/* deactivation_function_for_facebook_likebox
  Description: This hook is used to sets the deactivation hook for a plugin.
  Created On: 19-04-2017 04:08
  Created by: Tech Banker Team
 */

register_deactivation_hook(__FILE__, "deactivation_function_for_facebook_likebox");

/* add_filter create Go Pro link for Facebook Likebox
  Description: This hook is used for create link for premium Editions.
  Created On: 20-04-2017 12:17
  Created by: Tech Banker Team
 */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), "facebook_likebox_action_links");

/* add_filter create Settings link for Facebook Likebox
  Description: This hook is used for create link for Plugin Settings.
  Created On: 05-05-2017 17:37
  Created by: Tech Banker Team
 */
add_filter("plugin_action_links_" . plugin_basename(__FILE__), "facebook_likebox_settings_action_links", 10, 2);

/*
  Function Name: plugin_activate_facebook_likebox
  Description: This function is used to add option.
  Parameters: No
  Created On: 28-04-2017 17:41
  Created By: Tech Banker Team
 */

function plugin_activate_facebook_likebox() {
    add_option("facebook_likebox_do_activation_redirect", true);
}

/*
  Function Name: facebook_likebox_redirect
  Description: This function is used to redirect page.
  Parameters: No
  Created On: 278-04-2017 17:42
  Created By: Tech Banker Team
 */

function facebook_likebox_redirect() {
    if (get_option("facebook_likebox_do_activation_redirect", false)) {
        delete_option("facebook_likebox_do_activation_redirect");
        wp_redirect(admin_url("admin.php?page=facebook_manage_like_box"));
        exit;
    }
}

/*
  register_activation_hook
  Description: This hook is used for calling the function plugin_activate_facebook_likebox
  Created On: 28-04-2017 17:44
  Created By: Tech Banker Team
 */

register_activation_hook(__FILE__, "plugin_activate_facebook_likebox");

/*
  add_action for facebook_likebox_redirect
  Description: This hook is used for calling the function facebook_likebox_redirect
  Created On: 28-04-2017 17:47
  Created By: Tech Banker Team
 */

add_action("admin_init", "facebook_likebox_redirect");
