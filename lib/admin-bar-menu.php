<?php

/**
 * This File is used to create Admin Bar Menu.
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
        $roles = unserialize($roles_and_capabilities);
        $roles_data = isset($roles["roles"]) ? esc_attr($roles["roles"]) : "";
        $capabilities = explode(",", $roles_data);
        if (is_super_admin()) {
            $cpo_role = "administrator";
        } else {
            $cpo_role = check_user_roles_for_facebook_likebox();
        }
        switch ($cpo_role) {
            case "administrator":
                $flag = $capabilities[0];
                break;

            case "author":
                $flag = $capabilities[1];
                break;

            case "editor":
                $flag = $capabilities[2];
                break;

            case "contributor":
                $flag = $capabilities[3];
                break;

            case "subscriber":
                $flag = $capabilities[4];
                break;

            default:
                $flag = $capabilities[5];
                break;
        }
        if ($flag == "1") {
            $wp_admin_bar->add_menu(array
                (
                "id" => "facebook_likebox",
                "title" => "<img src = \"" . plugins_url("assets/global/img/icon.png", dirname(__FILE__)) . "\" style=\"vertical-align:text-top;  margin-right:5px;\"./>$facebook_likebox",
                "href" => admin_url("admin.php?page=facebook_likebox")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_manage_like_box",
                "title" => $fbl_like_box,
                "href" => admin_url("admin.php?page=facebook_likebox")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_add_like_box_and_button",
                "title" => $fbl_like_box_and_button,
                "href" => admin_url("admin.php?page=facebook_manage_like_box_and_button")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_manage_like_box_popup",
                "title" => $fbl_like_box_popup,
                "href" => admin_url("admin.php?page=facebook_manage_like_box_popup")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_manage_like_button",
                "title" => $fbl_like_button,
                "href" => admin_url("admin.php?page=facebook_manage_like_button")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_manage_sticky_like_box",
                "title" => $fbl_sticky_like_box,
                "href" => admin_url("admin.php?page=facebook_manage_sticky_like_box")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_manage_like_box_and_button",
                "title" => $fbl_general_settings,
                "href" => admin_url("admin.php?page=facebook_likebox_general_settings")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_roles_and_capabilities",
                "title" => $fbl_roles_and_capabilities,
                "href" => admin_url("admin.php?page=facebook_likebox_roles_and_capabilities")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_feature_request",
                "title" => $fbl_feature_request,
                "href" => admin_url("admin.php?page=facebook_likebox_feature_request")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_system_information",
                "title" => $fbl_system_information,
                "href" => admin_url("admin.php?page=facebook_likebox_system_information")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_error_logs",
                "title" => $fbl_error_logs,
                "href" => admin_url("admin.php?page=facebook_likebox_error_logs")
            ));
            $wp_admin_bar->add_menu(array
                (
                "parent" => "facebook_likebox",
                "id" => "fbl_upgrade",
                "title" => $fbl_upgrade,
                "href" => admin_url("admin.php?page=facebook_likebox_upgrade")
            ));
        }
    }
}