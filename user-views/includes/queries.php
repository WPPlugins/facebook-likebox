<?php

/**
 * This File fetching data from database.
 *
 * @author Tech Banker
 * @package facebook-likebox/user-views/includes
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
if (isset($case_type)) {
    global $wpdb;
    $get_likebox_data = $wpdb->get_var
            (
            $wpdb->prepare
                    (
                    "SELECT meta_value FROM " . facebook_meta_table() . " WHERE meta_id = %d", $fbl_id
            )
    );
    $fbl_unserialized_data = unserialize($get_likebox_data);
}