<?php

/**
 * This File is used to delete tables schedulers and options on Uninstall hook.
 *
 * @author  Tech Banker
 * @package facebook-likebox/lib
 * @version 2.0.0
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
} else {
    if (!current_user_can("manage_options")) {
        return;
    } else {
        $facebook_likebox_version_number = get_option("facebook-likebox-version-number");
        if ($facebook_likebox_version_number != "") {
            global $wp_version, $wpdb;
            $general_settings = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . $wpdb->prefix ."facebook_likebox_meta
                                WHERE meta_key=%s", "general_settings"
                    )
            );
            $general_settings_data = unserialize($general_settings);

            if (esc_attr($general_settings_data["remove_tables_uninstall"]) == "enable") {
                // Drop Tables
                $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix ."facebook_likebox_parent");
                $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix ."facebook_likebox_meta");
                // Delete options
                delete_option("facebook-likebox-version-number");
                delete_option("facebook-likebox-wizard-set-up");
                delete_option("fbl_tech_banker_site_id");
            }
        }
    }
}
