<?php

/**
 * This File is used to create tables on activation hook.
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
    if (!current_user_can("manage_options")) {
        return;
    } else {
        /*
          Class Name: dbHelper_facebook_likebox
          Description: This class is used to perform operations.
          Created On: 03-11-2016 16:00
          Created By: Tech Banker Team
         */

        class dbHelper_facebook_likebox {
            /*
              Function Name: insertCommand
              Parameters: yes($table_name,$data)
              Description: This function is used for insert data in the database.
              Created On: 03-11-2016 16:01
              Created By: Tech Banker Team
             */

            function insertCommand($table_name, $data) {
                global $wpdb;
                $wpdb->insert($table_name, $data);
                return $wpdb->insert_id;
            }

            /*
              Function Name: updateCommand
              Parameters: Yes($table_name,$data,$where)
              Description: This function is used for Update data.
              Created On: 03-11-2016 16:01
              Created By: Tech Banker Team
             */

            function updateCommand($table_name, $data, $where) {
                global $wpdb;
                $wpdb->update($table_name, $data, $where);
            }

        }

        require_once ABSPATH . "wp-admin/includes/upgrade.php";
        $facebook_likebox_version_number = get_option("facebook-likebox-version-number");
        $obj_dbHelper_facebook_likebox = new dbHelper_facebook_likebox();

        /*
          Function Name: facebook_likebox_parent_table
          Parameters: No
          Description: This function is used for creating a parent table in database.
          Created On: 03-11-2016 16:04
          Created By: Tech Banker Team
         */

        function facebook_likebox_parent_table() {
            global $wpdb;
            $sql = "CREATE TABLE IF NOT EXISTS " . facebook_main_table() . "
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`type` longtext NOT NULL,
					`parent_id` int(10) NOT NULL,
					PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
            dbDelta($sql);

            $data = "INSERT INTO " . facebook_main_table() . " (`type`,`parent_id`) VALUES
				('add_like_box',0),
				('add_like_button',0),
				('sticky_likebox',0),
				('popup_likebox',0),
				('like_box_and_button',0),
				('general_settings',0),
				('roles_and_capabilities',0)";
            dbDelta($data);
        }

        /*
          Function Name: facebook_likebox_meta_table
          Parameter: No
          Description: This function is used for creating a meta table in database.
          Created On: 03-11-2016 16:08
          Created By: Tech Banker Team
         */

        function facebook_likebox_meta_table() {
            $obj_dbHelper_facebook_likebox = new dbHelper_facebook_likebox();
            global $wpdb;
            $sql = "CREATE TABLE IF NOT EXISTS " . facebook_meta_table() . "
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`meta_id` int(10) NOT NULL,
					`meta_key` varchar(200) NOT NULL,
					`meta_value` longtext NOT NULL,
					PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
            dbDelta($sql);

            $fbl_parent_table_data = $wpdb->get_results
                    (
                    "SELECT * FROM " . facebook_main_table()
            );
            foreach ($fbl_parent_table_data as $data) {
                switch (esc_attr($data->type)) {
                    case "general_settings":
                        $general_settings_data["remove_tables_uninstall"] = "enable";

                        $general_settings_data_serialize = array();
                        $general_settings_data_serialize["meta_id"] = isset($data->id) ? intval($data->id) : 0;
                        $general_settings_data_serialize["meta_key"] = "general_settings";
                        $general_settings_data_serialize["meta_value"] = serialize($general_settings_data);
                        $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $general_settings_data_serialize);
                        break;

                    case "roles_and_capabilities":
                        $roles_and_capabilities_data = array();
                        $roles_and_capabilities_data["roles"] = "1,1,1,0,0,0";
                        $roles_and_capabilities_data["show_top_bar_menu"] = "enable";
                        $roles_and_capabilities_data["others_full_control_capability"] = 0;
                        $roles_and_capabilities_data["administrator_privileges"] = "1,1,1,1,1,1,1,1,1,1,1";
                        $roles_and_capabilities_data["author_privileges"] = "0,1,1,1,0,0,0,0,1,1,0";
                        $roles_and_capabilities_data["editor_privileges"] = "0,1,0,0,0,0,1,0,1,1,0,0";
                        $roles_and_capabilities_data["contributor_privileges"] = "0,0,0,0,0,0,1,0,1,0,0";
                        $roles_and_capabilities_data["subscriber_privileges"] = "0,0,0,0,0,0,0,0,0,0,0";
                        $roles_and_capabilities_data["other_roles_privileges"] = "0,0,0,0,0,0,0,0,0,0,0";
                        $user_capabilities = get_others_capabilities_facebook_likebox();
                        $other_roles_array = array();
                        $other_roles_access_array = array(
                            "manage_options",
                            "edit_plugins",
                            "edit_posts",
                            "publish_posts",
                            "publish_pages",
                            "edit_pages",
                            "read"
                        );
                        foreach ($other_roles_access_array as $role) {
                            if (in_array($role, $user_capabilities)) {
                                array_push($other_roles_array, $role);
                            }
                        }
                        $roles_and_capabilities_data["capabilities"] = $other_roles_array;
                        $roles_and_capabilities_data_array = array();
                        $roles_and_capabilities_data_array["meta_id"] = isset($data->id) ? intval($data->id) : 0;
                        $roles_and_capabilities_data_array["meta_key"] = "roles_and_capabilities";
                        $roles_and_capabilities_data_array["meta_value"] = serialize($roles_and_capabilities_data);
                        $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $roles_and_capabilities_data_array);
                        break;
                }
            }
        }

        $obj_dbHelper_facebook_likebox = new dbHelper_facebook_likebox();
        switch ($facebook_likebox_version_number) {
            case "":
                facebook_likebox_parent_table();
                facebook_likebox_meta_table();
                break;

            default:
                if (wp_next_scheduled("facebook_likebox_auto_update")) {
                    wp_clear_scheduled_hook("facebook_likebox_auto_update");
                }
                if (count($wpdb->get_var("SHOW TABLES LIKE '" . facebook_main_table() . "'")) == 0) {
                    facebook_likebox_parent_table();
                }
                if (count($wpdb->get_var("SHOW TABLES LIKE '" . facebook_meta_table() . "'")) == 0) {
                    facebook_likebox_meta_table();
                } else {
                    $general_settings_meta_value = $wpdb->get_var
                            (
                            $wpdb->prepare
                                    (
                                    "SELECT meta_value FROM " . facebook_meta_table() .
                                    " WHERE meta_key = %s", "general_settings"
                            )
                    );
                    $general_settings_unserialized_data = unserialize($general_settings_meta_value);
                    $where = array();
                    $general_settings_unserialized_data_array = array();
                    $where["meta_key"] = "general_settings";
                    $general_settings_unserialized_data_array["meta_value"] = serialize($general_settings_unserialized_data);
                    $obj_dbHelper_facebook_likebox->updateCommand(facebook_meta_table(), $general_settings_unserialized_data_array, $where);

                    $get_roles_and_capabilities_data = $wpdb->get_var
                            (
                            $wpdb->prepare
                                    (
                                    "SELECT meta_value FROM " . facebook_meta_table() .
                                    " WHERE meta_key = %s", "roles_and_capabilities"
                            )
                    );
                    $roles_and_capabilities_data_array = unserialize($get_roles_and_capabilities_data);
                    if (array_key_exists("roles", $roles_and_capabilities_data_array)) {
                        $administrator_privileges_data = isset($roles_and_capabilities_data_array["administrator_privileges"]) ? explode(',', $roles_and_capabilities_data_array["administrator_privileges"]) : array();
                        $author_privileges_data = isset($roles_and_capabilities_data_array["author_privileges"]) ? explode(",", $roles_and_capabilities_data_array["author_privileges"]) : array();
                        $editor_privileges_data = isset($roles_and_capabilities_data_array["editor_privileges"]) ? explode(',', $roles_and_capabilities_data_array["editor_privileges"]) : array();
                        $contributor_privileges_data = isset($roles_and_capabilities_data_array["contributor_privileges"]) ? explode(',', $roles_and_capabilities_data_array["contributor_privileges"]) : array();
                        $subscribers_privileges_data = isset($roles_and_capabilities_data_array["subscriber_privileges"]) ? explode(',', $roles_and_capabilities_data_array["subscriber_privileges"]) : array();
                        $others_privileges_data = isset($roles_and_capabilities_data_array["other_roles_privileges"]) ? explode(',', $roles_and_capabilities_data_array["other_roles_privileges"]) : array();

                        if (count($administrator_privileges_data) == 10) {
                            $administrator_privileges_data[10] = $administrator_privileges_data[9];
                            $administrator_privileges_data[9] = 1;
                            $roles_and_capabilities_data_array["administrator_privileges"] = implode(",", $administrator_privileges_data);
                        }

                        if (count($author_privileges_data) == 10) {
                            $author_privileges_data[10] = $author_privileges_data[9];
                            $author_privileges_data[9] = 0;
                            $roles_and_capabilities_data_array["author_privileges"] = implode(",", $author_privileges_data);
                        }

                        if (count($editor_privileges_data) == 10) {
                            $editor_privileges_data[10] = $editor_privileges_data[9];
                            $editor_privileges_data[9] = 0;
                            $roles_and_capabilities_data_array["editor_privileges"] = implode(",", $editor_privileges_data);
                        }

                        if (count($contributor_privileges_data) == 10) {
                            $contributor_privileges_data[10] = $contributor_privileges_data[9];
                            $contributor_privileges_data[9] = 0;
                            $roles_and_capabilities_data_array["contributor_privileges"] = implode(",", $contributor_privileges_data);
                        }

                        if (count($subscribers_privileges_data) == 10) {
                            $subscribers_privileges_data[10] = $subscribers_privileges_data[9];
                            $subscribers_privileges_data[9] = 0;
                            $roles_and_capabilities_data_array["subscriber_privileges"] = implode(",", $subscribers_privileges_data);
                        }

                        if (count($others_privileges_data) == 10) {
                            $others_privileges_data[10] = $others_privileges_data[9];
                            $others_privileges_data[9] = 0;
                            $roles_and_capabilities_data_array["other_roles_privileges"] = implode(",", $others_privileges_data);
                        }

                        $where = array();
                        $roles_capabilities_array = array();
                        $where["meta_key"] = "roles_and_capabilities";
                        $roles_capabilities_array["meta_value"] = serialize($roles_and_capabilities_data_array);
                        $obj_dbHelper_facebook_likebox->updateCommand(facebook_meta_table(), $roles_capabilities_array, $where);
                    }
                }
                if (count($wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->prefix . "facebook_settings'")) != 0 && count($wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->prefix . "facebook_settings_meta'")) != 0) {
                    $check_likebox_data = $wpdb->get_results
                            (
                            $wpdb->prepare
                                    (
                                    "SELECT * FROM " . $wpdb->prefix . "facebook_settings WHERE type=%s", "facebook_likebox"
                            )
                    );
                    $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "facebook_settings");

                    if (isset($check_likebox_data) && count($check_likebox_data) > 0) {
                        foreach ($check_likebox_data as $key) {
                            if ($key->type == "facebook_likebox") {
                                $get_likebox_data = $wpdb->get_results
                                        (
                                        $wpdb->prepare
                                                (
                                                "SELECT * FROM " . $wpdb->prefix . "facebook_settings_meta WHERE setting_id = %d", $key->setting_id
                                        )
                                );
                                $facebook_data_array = array();
                                foreach ($get_likebox_data as $data => $values) {
                                    $facebook_data_array[$values->meta_key] = $values->meta_value;
                                }
                                if ($facebook_data_array["display_type"] == "like box") {
                                    $likebox_data = array();
                                    $likebox_data["likebox_source_type"] = "page_url";
                                    $likebox_data["page_url"] = isset($facebook_data_array["facebook_page_url"]) ? esc_attr($facebook_data_array["facebook_page_url"]) : "http://www.facebook.com/techbanker";
                                    $likebox_data["page_id"] = isset($facebook_data_array["facebook_page_id"]) ? esc_attr($facebook_data_array["facebook_page_id"]) : "techbanker";
                                    $likebox_data["title"] = isset($facebook_data_array["title"]) ? esc_attr($facebook_data_array["title"]) : "Tech-Banker";
                                    $likebox_data["language"] = isset($facebook_data_array["language"]) ? esc_attr($facebook_data_array["language"]) : "en_GB";
                                    $likebox_data["width"] = isset($facebook_data_array["width"]) ? intval($facebook_data_array["width"]) : "350";
                                    $likebox_data["height"] = isset($facebook_data_array["height"]) ? intval($facebook_data_array["height"]) : "400";
                                    $likebox_data["header"] = $facebook_data_array["header"] == "yes" ? "true" : "false";
                                    $likebox_data["post_stream"] = $facebook_data_array["streams"] == "yes" ? "timeline" : "";
                                    $likebox_data["events"] = "events";
                                    $likebox_data["messages"] = "messages";
                                    $likebox_data["cover_photo"] = "false";
                                    $likebox_data["animation_effect"] = "none";
                                    $likebox_data["border_style"] = "1,none,#000000";
                                    $likebox_data["border_radius"] = "0";
                                    $likebox_data["show_user_faces"] = $facebook_data_array["show_faces_like_box"] == "yes" ? "true" : "false";

                                    $id = $wpdb->get_var
                                            (
                                            $wpdb->prepare
                                                    (
                                                    "SELECT id FROM " . facebook_main_table() . " WHERE type = %s", "add_like_box"
                                            )
                                    );
                                    $insert_likebox_parent_data = array();
                                    $insert_likebox_parent_data["type"] = "add_like_box_settings";
                                    $insert_likebox_parent_data["parent_id"] = $id;
                                    $last_id = $obj_dbHelper_facebook_likebox->insertCommand(facebook_main_table(), $insert_likebox_parent_data);

                                    $likebox_data_serialize = array();
                                    $likebox_data_serialize["meta_id"] = $last_id;
                                    $likebox_data_serialize["meta_key"] = "add_like_box_settings";
                                    $likebox_data_serialize["meta_value"] = serialize($likebox_data);
                                    $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $likebox_data_serialize);
                                } elseif ($facebook_data_array["display_type"] == "like button") {
                                    $like_button_data = array();
                                    $like_button_data["button_type"] = "like";
                                    $like_button_data["likebox_source_type"] = "page_url";
                                    $like_button_data["page_url"] = isset($facebook_data_array["facebook_page_url"]) ? esc_attr($facebook_data_array["facebook_page_url"]) : "http://www.facebook.com/techbanker";
                                    $like_button_data["page_id"] = isset($facebook_data_array["facebook_page_id"]) ? esc_attr($facebook_data_array["facebook_page_id"]) : "techbanker";
                                    $like_button_data["title"] = isset($facebook_data_array["title"]) ? esc_attr($facebook_data_array["title"]) : "Tech-Banker";
                                    $like_button_data["language"] = isset($facebook_data_array["language"]) ? esc_attr($facebook_data_array["language"]) : "en_GB";
                                    $like_button_data["action"] = "like";
                                    $like_button_data["width"] = "350";
                                    $like_button_data["button_size"] = "small";
                                    $like_button_data["button_style"] = isset($facebook_data_array["button_style"]) ? esc_attr($facebook_data_array["button_style"]) : "standard";
                                    $like_button_data["share_button"] = isset($facebook_data_array["share_button"]) ? esc_attr($facebook_data_array["share_button"]) : "true";
                                    $id = $wpdb->get_var
                                            (
                                            $wpdb->prepare
                                                    (
                                                    "SELECT id FROM " . facebook_main_table() . " WHERE type = %s", "add_like_button"
                                            )
                                    );
                                    $insert_likebutton_parent_data = array();
                                    $insert_likebutton_parent_data["type"] = "add_like_button_settings";
                                    $insert_likebutton_parent_data["parent_id"] = isset($id) ? intval($id) : 0;
                                    $last_id = $obj_dbHelper_facebook_likebox->insertCommand(facebook_main_table(), $insert_likebutton_parent_data);

                                    $likebutton_data_serialize = array();
                                    $likebutton_data_serialize["meta_id"] = $last_id;
                                    $likebutton_data_serialize["meta_key"] = "add_like_button_settings";
                                    $likebutton_data_serialize["meta_value"] = serialize($like_button_data);
                                    $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $likebutton_data_serialize);
                                } elseif ($facebook_data_array["display_type"] == "like box button") {
                                    $likebox_button_data["likebox_source_type"] = "page_url";
                                    $likebox_button_data["page_url"] = isset($facebook_data_array["facebook_page_url"]) ? esc_attr($facebook_data_array["facebook_page_url"]) : "http://www.facebook.com/techbanker";
                                    $likebox_button_data["page_id"] = isset($facebook_data_array["facebook_page_id"]) ? esc_attr($facebook_data_array["facebook_page_id"]) : "techbanker";
                                    $likebox_button_data["title"] = isset($facebook_data_array["title"]) ? esc_attr($facebook_data_array["title"]) : "Tech-Banker";
                                    $likebox_button_data["language"] = isset($facebook_data_array["language"]) ? esc_attr($facebook_data_array["language"]) : "en_GB";
                                    $likebox_button_data["width"] = isset($facebook_data_array["width"]) ? intval($facebook_data_array["width"]) : "300";
                                    $likebox_button_data["height"] = isset($facebook_data_array["height"]) ? intval($facebook_data_array["height"]) : "500";
                                    $likebox_button_data["header"] = $facebook_data_array["header"] == "yes" ? "true" : "false";
                                    $likebox_button_data["post_stream"] = $facebook_data_array["streams"] == "yes" ? "timeline" : "";
                                    $likebox_button_data["cover_photo"] = "false";
                                    $likebox_button_data["border_style"] = "1,none,#000000";
                                    $likebox_button_data["border_radius"] = "0";
                                    $likebox_button_data["events"] = "events";
                                    $likebox_button_data["messages"] = "messages";
                                    $likebox_button_data["button_type"] = "like";
                                    $likebox_button_data["button_style"] = isset($facebook_data_array["button_style"]) ? esc_html($facebook_data_array["button_style"]) : "standard";
                                    $likebox_button_data["show_user_faces"] = $facebook_data_array["show_faces_like_box"] == "yes" ? "true" : "false";
                                    $likebox_button_data["action"] = "like";
                                    $likebox_button_data["share_button"] = isset($facebook_data_array["share_button"]) ? esc_attr($facebook_data_array["share_button"]) : "true";
                                    $likebox_button_data["button_size"] = "small";
                                    $likebox_button_data["animation_effect"] = "none";
                                    $id = $wpdb->get_var
                                            (
                                            $wpdb->prepare
                                                    (
                                                    "SELECT id FROM " . facebook_main_table() . " WHERE type = %s", "like_box_and_button"
                                            )
                                    );
                                    $insert_likebox_button_parent_data = array();
                                    $insert_likebox_button_parent_data["type"] = "like_box_and_button_settings";
                                    $insert_likebox_button_parent_data["parent_id"] = isset($id) ? intval($id) : 0;
                                    $last_id = $obj_dbHelper_facebook_likebox->insertCommand(facebook_main_table(), $insert_likebox_button_parent_data);

                                    $likebox_button_data_serialize = array();
                                    $likebox_button_data_serialize["meta_id"] = $last_id;
                                    $likebox_button_data_serialize["meta_key"] = "like_box_and_button_settings";
                                    $likebox_button_data_serialize["meta_value"] = serialize($likebox_button_data);
                                    $obj_dbHelper_facebook_likebox->insertCommand(facebook_meta_table(), $likebox_button_data_serialize);
                                }
                            }
                        }
                    }
                    $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix . "facebook_settings_meta");
                }
                break;
        }
        update_option("facebook-likebox-version-number", "3.0.0");
    }
}