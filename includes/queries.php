<?php

/**
 * This File is used for fetching data.
 *
 * @author  Tech Banker
 * @package facebook-likebox/includes
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

        function facebook_likebox_meta_value($meta_key) {
            global $wpdb;
            $facebook_likebox_data = array();
            $data = $wpdb->get_results
                    (
                    $wpdb->prepare
                            (
                            "SELECT * FROM " . facebook_meta_table() . " WHERE meta_key = %s ORDER BY id DESC", $meta_key
                    )
            );
            foreach ($data as $row) {
                $record = unserialize($row->meta_value);
                $record["meta_id"] = $row->meta_id;
                array_push($facebook_likebox_data, $record);
            }
            return $facebook_likebox_data;
        }

        function get_facebook_likebox_meta_value($meta_key) {
            global $wpdb;
            $meta_value = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . facebook_meta_table() .
                            " WHERE meta_key = %s", $meta_key
                    )
            );
            return unserialize($meta_value);
        }

        function fbl_likebox_metaid_data($meta_id) {
            global $wpdb;
            $meta_value = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . facebook_meta_table() .
                            " WHERE meta_id = %d", $meta_id
                    )
            );
            return $meta_data = unserialize($meta_value);
        }

        if (isset($_GET["page"])) {
            switch (esc_attr($_GET["page"])) {
                case "facebook_likebox":
                    if (isset($_REQUEST["meta_id"])) {
                        $meta_id = intval($_REQUEST["meta_id"]);
                        $likebox_data = fbl_likebox_metaid_data($meta_id);
                    }
                    break;

                case "facebook_manage_like_box":
                    $likebox_data_value = facebook_likebox_meta_value("add_like_box_settings");
                    break;

                case "facebook_add_like_button":
                    if (isset($_REQUEST["meta_id"])) {
                        $meta_id = intval($_REQUEST["meta_id"]);
                        $like_button_data = fbl_likebox_metaid_data($meta_id);
                    }
                    break;

                case "facebook_manage_like_button":
                    $like_button_data_value = facebook_likebox_meta_value("add_like_button_settings");
                    break;

                case "facebook_add_sticky_like_box":
                    if (isset($_REQUEST["meta_id"])) {
                        $meta_id = intval($_REQUEST["meta_id"]);
                        $sticky_likebox_data = fbl_likebox_metaid_data($meta_id);
                    }
                    break;

                case "facebook_add_like_box_popup":
                    if (isset($_REQUEST["meta_id"])) {
                        $meta_id = intval($_REQUEST["meta_id"]);
                        $popup_likebox_data = fbl_likebox_metaid_data($meta_id);
                    }
                    break;

                case "facebook_add_like_box_and_button":
                    if (isset($_REQUEST["meta_id"])) {
                        $meta_id = intval($_REQUEST["meta_id"]);
                        $likebox_and_button_data_serialize = fbl_likebox_metaid_data($meta_id);
                    }
                    break;

                case "facebook_manage_like_box_and_button":
                    $manage_likebox_data = facebook_likebox_meta_value("like_box_and_button_settings");
                    break;

                case "facebook_likebox_general_settings":
                    $general_settings_data = get_facebook_likebox_meta_value("general_settings");
                    break;

                case "facebook_likebox_roles_and_capabilities":
                    $roles_and_capabilities_data = get_facebook_likebox_meta_value("roles_and_capabilities");
                    $core_roles = array(
                        "manage_options",
                        "edit_plugins",
                        "edit_posts",
                        "publish_posts",
                        "publish_pages",
                        "edit_pages",
                        "read"
                    );
                    $other_roles_array = isset($roles_and_capabilities_data["capabilities"]) ? $roles_and_capabilities_data["capabilities"] : $core_roles;
                    break;
            }
        }
    }
}