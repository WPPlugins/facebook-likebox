<?php

/**
 * This File is used to create Sidebar Menu.
 *
 * @author  Tech Banker
 * @package facebook-likebox/lib
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
if (!is_user_logged_in()) {
    return;
} else {
    $access_granted = false;
    if (isset($user_role_permission) && count($user_role_permission) > 0) {
        foreach ($user_role_permission as $permission) {
            if (current_user_can($permission)) {
                $access_granted = true;
                break;
            }
        }
    }
    if (!$access_granted) {
        return;
    } else {
        $flag = 0;
        global $wpdb;
        $roles_and_capabilities = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . facebook_meta_table() . " where meta_key = %s", "roles_and_capabilities"
                )
        );
        $roles_and_capabilities_unserialized_data = unserialize($roles_and_capabilities);
        $roles_and_capabilities_data = isset($roles_and_capabilities_unserialized_data["roles"]) ? esc_attr($roles_and_capabilities_unserialized_data["roles"]) : "";
        $capabilities = explode(",", $roles_and_capabilities_data);
        if (is_super_admin()) {
            $cpo_role = "administrator";
        } else {
            $cpo_role = check_user_roles_for_facebook_likebox();
        }
        switch ($cpo_role) {
            case "administrator":
                $privileges = "administrator_privileges";
                $flag = $capabilities[0];
                break;

            case "author":
                $privileges = "author_privileges";
                $flag = $capabilities[1];
                break;

            case "editor":
                $privileges = "editor_privileges";
                $flag = $capabilities[2];
                break;

            case "contributor":
                $privileges = "contributor_privileges";
                $flag = $capabilities[3];
                break;

            case "subscriber":
                $privileges = "subscriber_privileges";
                $flag = $capabilities[4];
                break;

            default:
                $privileges = "other_roles_privileges";
                $flag = $capabilities[5];
                break;
        }

        foreach ($roles_and_capabilities_unserialized_data as $key => $value) {
            if ($privileges == $key) {
                $privileges_value = $value;
                break;
            }
        }

        $full_control = explode(",", $privileges_value);
        if (!defined("full_control")) {
            define("full_control", "$full_control[0]");
        }
        if (!defined("like_box_facebook_likebox")) {
            define("like_box_facebook_likebox", $full_control[1]);
        }
        if (!defined("like_box_button_facebook_likebox")) {
            define("like_box_button_facebook_likebox", $full_control[2]);
        }
        if (!defined("like_box_popup_facebook_likebox")) {
            define("like_box_popup_facebook_likebox", $full_control[3]);
        }
        if (!defined("like_button_facebook_likebox")) {
            define("like_button_facebook_likebox", $full_control[4]);
        }
        if (!defined("sticky_like_box_facebook_likebox")) {
            define("sticky_like_box_facebook_likebox", $full_control[5]);
        }
        if (!defined("general_settings_facebook_likebox")) {
            define("general_settings_facebook_likebox", $full_control[6]);
        }
        if (!defined("roles_and_capability_facebook_likebox")) {
            define("roles_and_capability_facebook_likebox", $full_control[7]);
        }
        if (!defined("system_information_facebook_likebox")) {
            define("system_information_facebook_likebox", $full_control[8]);
        }
        if (!defined("error_logs_facebook_likebox")) {
            define("error_logs_facebook_likebox", $full_control[9]);
        }
        $check_facebook_likebox_wizard = get_option("facebook-likebox-wizard-set-up");
        if ($flag == "1") {
            if ($check_facebook_likebox_wizard) {
                add_menu_page($facebook_likebox, $facebook_likebox, "read", "facebook_likebox", "", plugins_url("assets/global/img/icon.png", dirname(__FILE__)));
            } else {
                add_menu_page($facebook_likebox, $facebook_likebox, "read", "facebook_likebox_wizard", "", plugins_url("assets/global/img/icon.png", dirname(__FILE__)));
                add_submenu_page($facebook_likebox, $facebook_likebox, "", "read", "facebook_likebox_wizard", "facebook_likebox_wizard");
            }
            add_submenu_Page($fbl_add_like_box, $fbl_like_box, "", "read", "facebook_manage_like_box", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_manage_like_box");
            add_submenu_page("facebook_likebox", $fbl_add_like_box, $fbl_like_box, "read", "facebook_likebox", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox");
            add_submenu_page("facebook_likebox", $fbl_manage_like_box_and_button, $fbl_like_box_and_button, "read", "facebook_manage_like_box_and_button", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_manage_like_box_and_button");
            add_submenu_page($fbl_add_like_box_and_button, $fbl_add_like_box_and_button, "", "read", "facebook_add_like_box_and_button", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_add_like_box_and_button");
            add_submenu_page("facebook_likebox", $fbl_manage_like_box_popup, $fbl_like_box_popup, "read", "facebook_manage_like_box_popup", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_manage_like_box_popup");
            add_submenu_page($fbl_add_like_box_popup, $fbl_add_like_box_popup, "", "read", "facebook_add_like_box_popup", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_add_like_box_popup");
            add_submenu_page("facebook_likebox", $fbl_manage_like_button, $fbl_like_button, "read", "facebook_manage_like_button", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_manage_like_button");
            add_submenu_page($fbl_add_like_button, $fbl_add_like_button, "", "read", "facebook_add_like_button", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_add_like_button");
            add_submenu_page("facebook_likebox", $fbl_manage_sticky_like_box, $fbl_sticky_like_box, "read", "facebook_manage_sticky_like_box", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_manage_sticky_like_box");
            add_submenu_page($fbl_add_sticky_like_box, $fbl_add_sticky_like_box, "", "read", "facebook_add_sticky_like_box", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_add_sticky_like_box");
            add_submenu_page("facebook_likebox", $fbl_general_settings, $fbl_general_settings, "read", "facebook_likebox_general_settings", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox_general_settings");
            add_submenu_page("facebook_likebox", $fbl_roles_and_capabilities, $fbl_roles_and_capabilities, "read", "facebook_likebox_roles_and_capabilities", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox_roles_and_capabilities");
            add_submenu_page("facebook_likebox", $fbl_feature_request, $fbl_feature_request, "read", "facebook_likebox_feature_request", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox_feature_request");
            add_submenu_page("facebook_likebox", $fbl_system_information, $fbl_system_information, "read", "facebook_likebox_system_information", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox_system_information");
            add_submenu_page("facebook_likebox", $fbl_error_logs, $fbl_error_logs, "read", "facebook_likebox_error_logs", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox_error_logs");
            add_submenu_page("facebook_likebox", $fbl_upgrade, $fbl_upgrade, "read", "facebook_likebox_upgrade", $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : "facebook_likebox_upgrade");
        }

        /*
          Function Name: facebook_likebox_wizard
          Parameters: No
          Description: This function is used for creating facebook_likebox_wizard menu.
          Created On: 19-04-2017 04:28
          Created By: Tech Banker Team
         */

        function facebook_likebox_wizard() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/wizard/wizard.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/wizard/wizard.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox
          Parameters: No
          Description: This function is used to create facebook_likebox menu.
          Created On: 04-11-2016 17:16
          Created By: Tech Banker Team
         */

        function facebook_likebox() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box/add-like-box.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box/add-like-box.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_manage_like_box
          Parameters: No
          Description: This function is used to create facebook_manage_like_box menu.
          Created On: 4-11-2016 17:17
          Created By: Tech Banker Team
         */

        function facebook_manage_like_box() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box/manage-like-box.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box/manage-like-box.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_add_like_button
          Parameters: No
          Description: This function is used to create facebook_manage_like_box menu.
          Created On: 04-11-2016 17:17
          Created By: Tech Banker Team
         */

        function facebook_add_like_button() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-button/add-like-button.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-button/add-like-button.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_manage_like_button
          Parameters: No
          Description: This function is used to create facebook_manage_like_button menu.
          Created On: 04-11-2016 17:17
          Created By: Tech Banker Team
         */

        function facebook_manage_like_button() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-button/manage-like-button.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-button/manage-like-button.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_add_sticky_like_box
          Parameters: No
          Description: This function is used to create facebook_add_sticky_like_box menu.
          Created On: 04-11-2016 17:18
          Created By: Tech Banker Team
         */

        function facebook_add_sticky_like_box() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/sticky-like-box/add-sticky-like-box.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/sticky-like-box/add-sticky-like-box.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_manage_sticky_like_box
          Parameters: No
          Description: This function is used to create facebook_manage_sticky_like_box menu.
          Created On: 04-11-2016 17:18
          Created By: Tech Banker Team
         */

        function facebook_manage_sticky_like_box() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/sticky-like-box/manage-sticky-like-box.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/sticky-like-box/manage-sticky-like-box.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_add_like_box_popup
          Parameters: No
          Description: This function is used to create facebook_add_like_box_popup menu.
          Created On: 04-11-2016 17:21
          Created By: Tech Banker Team
         */

        function facebook_add_like_box_popup() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-popup/add-like-box-popup.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-popup/add-like-box-popup.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_manage_like_box_popup
          Parameters: No
          Description: This function is used to create facebook_manage_like_box_popup menu.
          Created On: 04-11-2016 17:22
          Created By: Tech Banker Team
         */

        function facebook_manage_like_box_popup() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-popup/manage-like-box-popup.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-popup/manage-like-box-popup.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_add_like_box_and_button
          Parameters: No
          Description: This function is used to create facebook_add_like_box_and_button menu.
          Created On: 04-11-2016 16:10
          Created By: Tech Banker Team
         */

        function facebook_add_like_box_and_button() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "lib/languages.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-and-button/add-like-box-and-button.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-and-button/add-like-box-and-button.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_manage_like_box_and_button
          Parameters: No
          Description: This function is used to create facebook_manage_like_box_and_button menu.
          Created On: 04-11-2016 17:23
          Created By: Tech Banker Team
         */

        function facebook_manage_like_box_and_button() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-and-button/manage-like-box-and-button.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/like-box-and-button/manage-like-box-and-button.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox_general_settings
          Parameters: No
          Description: This function is used to create facebook_likebox_general_settings menu.
          Created On: 05-11-2016 13:15
          Created By: Tech Banker Team
         */

        function facebook_likebox_general_settings() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/general-settings/general-settings.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/general-settings/general-settings.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox_roles_and_capabilities
          Parameters: No
          Description: This function is used to create facebook_likebox_roles_and_capabilities menu.
          Created On: 05-11-2016 13:22
          Created By: Tech Banker Team
         */

        function facebook_likebox_roles_and_capabilities() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/roles-and-capabilities/roles-and-capabilities.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/roles-and-capabilities/roles-and-capabilities.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox_feature_request
          Parameters: No
          Description: This function is used to create facebook_likebox_feature_request menu.
          Created On: 05-11-2016 13:24
          Created By: Tech Banker Team
         */

        function facebook_likebox_feature_request() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/feature-request/feature-request.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/feature-request/feature-request.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox_system_information
          Parameters: No
          Description: This function is used to create facebook_likebox_system_information menu.
          Created On: 05-11-2016 13:22
          Created By: Tech Banker Team
         */

        function facebook_likebox_system_information() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/system-information/system-information.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/system-information/system-information.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox_error_logs
          Parameters: No
          Description: This function is used for creating Error Logs menu.
          Created On: 17-01-2017 11:22
          Created By: Tech Banker Team
         */

        function facebook_likebox_error_logs() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/error-logs/error-logs.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/error-logs/error-logs.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

        /*
          Function Name: facebook_likebox_upgrade
          Parameters: No
          Description: This function is used to create facebook_likebox_upgrade menu.
          Created On: 05-11-2016 13:23
          Created By: Tech Banker Team
         */

        function facebook_likebox_upgrade() {
            global $wpdb;
            $user_role_permission = get_users_capabilities_for_facebook_likebox();
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php")) {
                include FACEBOOK_LIKEBOX_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/header.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/sidebar.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/queries.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "views/premium-editions/premium-editions.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "views/premium-editions/premium-editions.php";
            }
            if (file_exists(FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php")) {
                include_once FACEBOOK_LIKEBOX_DIR_PATH . "includes/footer.php";
            }
        }

    }
}