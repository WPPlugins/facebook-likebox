<?php

/**
 * This File is used for managing database.
 *
 * @author Tech Banker
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
        if (isset($_REQUEST["param"])) {
            $obj_dbHelper_facebook_likebox = new dbHelper_facebook_likebox();
            switch (esc_attr($_REQUEST["param"])) {
                case "wizard_facebook_likebox":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_likebox_check_status")) {
                        $type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "";
                        update_option("facebook-likebox-wizard-set-up", $type);
                        if ($type == "opt_in") {
                            $plugin_info_facebook_likebox = new plugin_info_facebook_likebox();
                            global $wp_version;
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
                            $plugin_stat_data["event"] = "activate";
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

                    break;


                case "facebook_likebox_module" :
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_add_likebox")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $like_box);
                        $meta_id = isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0;

                        $likebox_data = array();
                        $likebox_data["likebox_source_type"] = esc_attr($like_box["ux_ddl_fb_likebox_source"]);
                        $likebox_data["page_url"] = esc_attr($like_box["ux_txt_likebox_page_url"]);
                        $likebox_data["page_id"] = esc_attr($like_box["ux_txt_likebox_page_id"]);
                        $likebox_data["title"] = esc_attr($like_box["ux_txt_likebox_title"]);
                        $likebox_data["language"] = esc_attr($like_box["ux_ddl_likebox_language"]);
                        $likebox_data["width"] = intval($like_box["ux_txt_likebox_width"]);
                        $likebox_data["height"] = intval($like_box["ux_txt_likebox_height"]);
                        $likebox_data["header"] = esc_attr($like_box["ux_ddl_likebox_header"]);
                        $likebox_data["post_stream"] = esc_attr($like_box["ux_ddl_likebox_stream"]);
                        $likebox_data["events"] = esc_attr($like_box["ux_ddl_likebox_events"]);
                        $likebox_data["messages"] = esc_attr($like_box["ux_ddl_likebox_messages"]);
                        $likebox_data["cover_photo"] = esc_attr($like_box["ux_ddl_likebox_cover_photo"]);
                        $likebox_data["animation_effect"] = "none";
                        $likebox_data["border_style"] = "1,none,#000000";
                        $likebox_data["border_radius"] = "0";
                        $likebox_data["show_user_faces"] = esc_attr($like_box["ux_ddl_likebox_user_faces"]);
                        if ($meta_id == 0) {
                            $parent_id = $wpdb->get_var
                                    (
                                    $wpdb->prepare
                                            (
                                            "SELECT id FROM " . facebook_main_table() . " WHERE type = %s", "add_like_box"
                                    )
                            );
                            $likebox_parent_data = array();
                            $likebox_parent_data["type"] = "add_like_box_settings";
                            $likebox_parent_data["parent_id"] = isset($parent_id) ? intval($parent_id) : 0;
                            $id = $obj_dbHelper_facebook_likebox->insertCommand(facebook_main_table(), $likebox_parent_data);

                            $likebox_data_serialize = array();
                            $likebox_data_serialize["meta_id"] = $id;
                            $likebox_data_serialize["meta_key"] = "add_like_box_settings";
                            $likebox_data_serialize["meta_value"] = serialize($likebox_data);
                            $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $likebox_data_serialize);
                        } else {
                            $likebox_update_data = array();
                            $where = array();
                            $where["meta_id"] = $meta_id;
                            $likebox_update_data["meta_value"] = serialize($likebox_data);
                            $obj_dbHelper_facebook_likebox->updateCommand(facebook_meta_table(), $likebox_update_data, $where);
                        }
                    }
                    break;

                case "facebook_like_button_module" :
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "facebook_add_like_button")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $like_button);
                        $meta_id = isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0;

                        $like_button_data = array();
                        $like_button_data["button_type"] = esc_attr($like_button["ux_ddl_fb_button_type"]);
                        $like_button_data["likebox_source_type"] = esc_attr($like_button["ux_ddl_fb_likebox_source"]);
                        $like_button_data["page_url"] = esc_attr($like_button["ux_txt_like_button_page_url"]);
                        $like_button_data["page_id"] = esc_attr($like_button["ux_txt_like_button_page_id"]);
                        $like_button_data["title"] = esc_attr($like_button["ux_txt_like_button_title"]);
                        $like_button_data["language"] = esc_attr($like_button["ux_ddl_like_button_language"]);
                        $like_button_data["action"] = esc_attr($like_button["ux_ddl_like_button_action"]);
                        $like_button_data["width"] = intval($like_button["ux_txt_like_button_width"]);
                        $like_button_data["button_style"] = esc_attr($like_button["ux_ddl_like_button_style"]);
                        $like_button_data["button_size"] = esc_attr($like_button["ux_ddl_like_button_size"]);
                        $like_button_data["share_button"] = esc_attr($like_button["ux_ddl_like_button_share_button"]);
                        if ($meta_id == 0) {
                            $parent_id = $wpdb->get_var
                                    (
                                    $wpdb->prepare
                                            (
                                            "SELECT id FROM " . facebook_main_table() . " WHERE type = %s", "add_like_button"
                                    )
                            );

                            $like_button_parent_data = array();
                            $like_button_parent_data["type"] = "add_like_button_settings";
                            $like_button_parent_data["parent_id"] = isset($parent_id) ? intval($parent_id) : 0;
                            $last_id = $obj_dbHelper_facebook_likebox->insertCommand(facebook_main_table(), $like_button_parent_data);

                            $like_button_data_serialize = array();
                            $like_button_data_serialize["meta_id"] = $last_id;
                            $like_button_data_serialize["meta_key"] = "add_like_button_settings";
                            $like_button_data_serialize["meta_value"] = serialize($like_button_data);
                            $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $like_button_data_serialize);
                        } else {
                            $like_button_update_data = array();
                            $where = array();
                            $where["meta_id"] = $meta_id;
                            $like_button_update_data["meta_value"] = serialize($like_button_data);
                            $obj_dbHelper_facebook_likebox->updateCommand(facebook_meta_table(), $like_button_update_data, $where);
                        }
                    }
                    break;

                case "facebook_likebox_and_button_module" :
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "fbl_add_likebox_and_button_nonce")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $form_data);
                        $meta_id = isset($_REQUEST["id"]) ? intval($_REQUEST["id"]) : 0;
                        $likebox_and_button_data = array();
                        $likebox_and_button_data["likebox_source_type"] = esc_attr($form_data["ux_ddl_fb_likebox_source"]);
                        $likebox_and_button_data["page_url"] = esc_attr($form_data["ux_txt_likebox_and_button_page_url"]);
                        $likebox_and_button_data["page_id"] = esc_attr($form_data["ux_txt_likebox_and_button_page_id"]);
                        $likebox_and_button_data["title"] = esc_attr($form_data["ux_txt_likebox_and_button_title"]);
                        $likebox_and_button_data["language"] = esc_attr($form_data["ux_ddl_likebox_and_likebutton_language"]);
                        $likebox_and_button_data["width"] = intval($form_data["ux_txt_likebox_and_button_width"]);
                        $likebox_and_button_data["height"] = intval($form_data["ux_txt_likebox_and_button_height"]);
                        $likebox_and_button_data["header"] = esc_attr($form_data["ux_ddl_likebox_and_button_header"]);
                        $likebox_and_button_data["post_stream"] = esc_attr($form_data["ux_ddl_likebox_and_button_post"]);
                        $likebox_and_button_data["cover_photo"] = esc_attr($form_data["ux_ddl_likebox_and_button_cover_photo"]);
                        $likebox_and_button_data["border_style"] = "1,none,#000000";
                        $likebox_and_button_data["border_radius"] = "0";
                        $likebox_and_button_data["show_user_faces"] = esc_attr($form_data["ux_ddl_likebox_and_button_show_faces"]);
                        $likebox_and_button_data["events"] = esc_attr($form_data["ux_ddl_likebox_and_button_events"]);
                        $likebox_and_button_data["messages"] = esc_attr($form_data["ux_ddl_likebox_and_button_messages"]);
                        $likebox_and_button_data["button_type"] = esc_attr($form_data["ux_ddl_fb_button_type"]);
                        $likebox_and_button_data["button_style"] = esc_attr($form_data["ux_ddl_like_button_style"]);
                        $likebox_and_button_data["button_size"] = esc_attr($form_data["ux_ddl_likebox_and_button_size"]);
                        $likebox_and_button_data["action"] = esc_attr($form_data["ux_ddl_like_box_button_action"]);
                        $likebox_and_button_data["share_button"] = esc_attr($form_data["ux_ddl_like_button_box_share_button"]);
                        $likebox_and_button_data["animation_effect"] = "none";

                        if ($meta_id == 0) {
                            $id = $wpdb->get_var
                                    (
                                    $wpdb->prepare
                                            (
                                            "SELECT id FROM " . facebook_main_table() . " WHERE type = %s", "like_box_and_button"
                                    )
                            );
                            $likebox_and_button_parent = array();
                            $likebox_and_button_parent["type"] = "like_box_and_button_settings";
                            $likebox_and_button_parent["parent_id"] = isset($id) ? intval($id) : 0;
                            $last_id = $obj_dbHelper_facebook_likebox->insertCommand(facebook_main_table(), $likebox_and_button_parent);

                            $likebox_and_button_metadata["meta_id"] = $last_id;
                            $likebox_and_button_metadata["meta_key"] = "like_box_and_button_settings";
                            $likebox_and_button_metadata["meta_value"] = serialize($likebox_and_button_data);
                            $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $likebox_and_button_metadata);
                        } else {
                            $where = array();
                            $update_likebox_and_button_data = array();
                            $where["meta_id"] = $meta_id;
                            $update_likebox_and_button_data["meta_value"] = serialize($likebox_and_button_data);
                            $obj_dbHelper_facebook_likebox->updateCommand(facebook_meta_table(), $update_likebox_and_button_data, $where);
                        }
                    }
                    break;

                case "delete_facbook_likebox_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "likebox_single_delete_nonce")) {
                        $id = isset($_REQUEST["id"]) ? intval($_REQUEST["id"]) : 0;
                        $where_parent = array();
                        $where_meta = array();
                        $where_parent["id"] = $id;
                        $where_meta["meta_id"] = $id;
                        $obj_dbHelper_facebook_likebox->deleteCommand(facebook_main_table(), $where_parent);
                        $obj_dbHelper_facebook_likebox->deleteCommand(facebook_meta_table(), $where_meta);
                    }
                    break;

                case "general_settings_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "likebox_general_settings_nonce")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $form_data);
                        $general_settings_data = array();
                        $general_settings_data["remove_tables_uninstall"] = esc_attr($form_data["ux_ddl_general_settings_table_remove_table"]);

                        $update_data = array();
                        $where["meta_key"] = "general_settings";
                        $update_data["meta_value"] = serialize($general_settings_data);
                        $obj_dbHelper_facebook_likebox->updateCommand(facebook_meta_table(), $update_data, $where);
                    }
                    break;
            }
            die();
        }
    }
}