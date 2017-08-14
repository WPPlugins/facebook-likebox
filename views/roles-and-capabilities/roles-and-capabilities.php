<?php
/**
 * This File is used for roles and capabilities.
 *
 * @author  Tech Banker
 * @package facebook-likebox/views
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
    } elseif (roles_and_capability_facebook_likebox == "1") {
        $fbl_roles_and_capabilities_nonce = wp_create_nonce("facebook_likebox_roles_and_capabilities");
        $roles_data = explode(",", isset($roles_and_capabilities_data["roles"]) ? esc_attr($roles_and_capabilities_data["roles"]) : "");
        $author = explode(",", isset($roles_and_capabilities_data["author_privileges"]) ? esc_attr($roles_and_capabilities_data["author_privileges"]) : "");
        $editor = explode(",", isset($roles_and_capabilities_data["editor_privileges"]) ? esc_attr($roles_and_capabilities_data["editor_privileges"]) : "");
        $contributor = explode(",", isset($roles_and_capabilities_data["contributor_privileges"]) ? esc_attr($roles_and_capabilities_data["contributor_privileges"]) : "");
        $subscriber = explode(",", isset($roles_and_capabilities_data["subscriber_privileges"]) ? esc_attr($roles_and_capabilities_data["subscriber_privileges"]) : "");
        $other_privileges = explode(",", isset($roles_and_capabilities_data["other_roles_privileges"]) ? esc_attr($roles_and_capabilities_data["other_roles_privileges"]) : "");
        ?>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-custom-home"></i>
                    <a href="admin.php?page=facebook_manage_like_box">
                        <?php echo $facebook_likebox; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_roles_and_capabilities; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-users"></i>
                            <?php echo $fbl_roles_and_capabilities; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_roles_and_capabilities">
                            <div class="form-body">
                                <?php
                                if ($fbl_message_translate_help != "") {
                                    ?>
                                    <div class="note note-danger">
                                        <h4 class="block">
                                            <?php echo $fbl_important_disclaimer; ?>
                                        </h4>
                                        <strong><?php echo $fbl_message_translate_help; ?><br/><?php echo $fbl_kindly_click; ?><a href="javascript:void(0);" data-popup-open="ux_open_popup_translator" class="custom_links" onclick="show_pop_up_facebook();"><?php echo $fbl_message_translate_here; ?></a></strong>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div id="ux_div_roles_and_capabilities">
                                    <label class="control-label">
                                        <?php echo $fbl_roles_and_capabilities_menu; ?>
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_menu_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                    </label>
                                    <table class="table table-striped table-bordered table-margin-top" id="ux_tbl_plugin_settings">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" name="ux_chk_administrator" id="ux_chk_administrator" checked="checked" disabled="disabled" value="1">
                                                    <?php echo $fbl_roles_and_capabilities_administrator; ?>
                                                </th>
                                                <th>
                                                    <input type="checkbox" name="ux_chk_author" id="ux_chk_author" value="1" onclick="show_roles_facebook_likebox(this, 'ux_div_author_roles');" <?php echo isset($roles_data) && $roles_data[1] == "1" ? "checked=checked" : ""; ?>>
                                                    <?php echo $fbl_roles_and_capabilities_author; ?>
                                                </th>
                                                <th>
                                                    <input type="checkbox" name="ux_chk_editor" id="ux_chk_editor" value="1" onclick="show_roles_facebook_likebox(this, 'ux_div_editor_roles');" <?php echo isset($roles_data) && $roles_data[2] == "1" ? "checked=checked" : ""; ?>>
                                                    <?php echo $fbl_roles_and_capabilities_editor; ?>
                                                </th>
                                                <th>
                                                    <input type="checkbox"  name="ux_chk_contributor" id="ux_chk_contributor" value="1" onclick="show_roles_facebook_likebox(this, 'ux_div_contributor_roles');" <?php echo isset($roles_data) && $roles_data[3] == "1" ? "checked=checked" : ""; ?>>
                                                    <?php echo $fbl_roles_and_capabilities_contributor; ?>
                                                </th>
                                                <th>
                                                    <input type="checkbox" name="ux_chk_subscriber" id="ux_chk_subscriber" value="1" onclick="show_roles_facebook_likebox(this, 'ux_div_subscriber_roles');" <?php echo isset($roles_data) && $roles_data[4] == "1" ? "checked=checked" : ""; ?>>
                                                    <?php echo $fbl_roles_and_capabilities_subscriber; ?>
                                                </th>
                                                <th>
                                                    <input type="checkbox" name="ux_chk_others_privileges" id="ux_chk_others_privileges" value="1" onclick="show_roles_facebook_likebox(this, 'ux_div_other_privileges_roles');" <?php echo isset($roles_data) && $roles_data[5] == "1" ? "checked=checked" : ""; ?>>
                                                    <?php echo $fbl_roles_and_capabilities_others_privileges; ?>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        <?php echo $fbl_roles_and_capabilities_topbar_menu; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_topbar_menu_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                    </label>
                                    <select name="ux_ddl_settings" id="ux_ddl_settings" class="form-control">
                                        <option value="enable"><?php echo $fbl_enable; ?></option>
                                        <option value="disable"><?php echo $fbl_disable; ?></option>
                                    </select>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-group">
                                    <div id="ux_div_administrator_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_and_capabilities_administrator_role; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_administrator_role_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_administrator">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_administrator" id="ux_chk_full_control_administrator" checked="checked" disabled="disabled" value="1">
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox" disabled="disabled" checked="checked" id="ux_chk_likebox" value="1">
                                                            <?php echo $fbl_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_and_likebutton" disabled="disabled" checked="checked" id="ux_chk_likebox_and_likebutton" value="1">
                                                            <?php echo $fbl_like_box_and_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_popup" disabled="disabled" checked="checked" id="ux_chk_likebox_popup" value="1">
                                                            <?php echo $fbl_like_box_popup; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebutton" disabled="disabled" checked="checked" id="ux_chk_likebutton" value="1">
                                                            <?php echo $fbl_like_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_sticky_likebox" disabled="disabled" checked="checked" id="ux_chk_sticky_likebox" value="1">
                                                            <?php echo $fbl_sticky_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_general_settings" disabled="disabled" checked="checked" id="ux_chk_general_settings" value="1">
                                                            <?php echo $fbl_general_settings; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_roles_and_capabilities_admin" disabled="disabled" checked="checked" id="ux_chk_roles_and_capabilities_admin" value="1">
                                                            <?php echo $fbl_roles_and_capabilities; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_system_information" disabled="disabled" checked="checked" id="ux_chk_system_information" value="1">
                                                            <?php echo $fbl_system_information; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_error_logs" disabled="disabled" checked="checked" id="ux_chk_error_logs" value="1">
                                                            <?php echo $fbl_error_logs; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="ux_div_author_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_and_capabilities_author_role; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_author_role_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_author">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_author" id="ux_chk_full_control_author" value="1"  onclick="full_control_facebook_likebox(this, 'ux_div_author_roles');" <?php echo isset($author) && $author[0] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_author" id="ux_chk_likebox_author" value="1" <?php echo isset($author) && $author[1] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_and_likebutton_author" id="ux_chk_likebox_and_likebutton_author" value="1" <?php echo isset($author) && $author[2] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_and_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_popup_author" id="ux_chk_likebox_popup_author" value="1" <?php echo isset($author) && $author[3] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_popup; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebutton_author" id="ux_chk_likebutton_author" value="1" <?php echo isset($author) && $author[4] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_sticky_likebox_author" id="ux_chk_sticky_likebox_author" value="1" <?php echo isset($author) && $author[5] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_sticky_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_general_settings_author" id="ux_chk_general_settings_author" value="1" <?php echo isset($author) && $author[6] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_general_settings; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_roles_and_capabilities_author" id="ux_chk_roles_and_capabilities_author" value="1" <?php echo isset($author) && $author[7] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_system_information_author" id="ux_chk_system_information_author" value="1" <?php echo isset($author) && $author[8] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_system_information; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_error_logs_author" id="ux_chk_error_logs_author" value="1" <?php echo isset($author) && $author[9] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_error_logs; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="ux_div_editor_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_and_capabilities_editor_role; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_editor_role_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_editor">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_editor" id="ux_chk_full_control_editor" value="1"  onclick="full_control_facebook_likebox(this, 'ux_div_editor_roles');" <?php echo isset($editor) && $editor[0] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_editor" id="ux_chk_likebox_editor" value="1" <?php echo isset($editor) && $editor[1] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_and_likebutton_editor" id="ux_chk_likebox_and_likebutton_editor" value="1" <?php echo isset($editor) && $editor[2] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_and_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_popup_editor" id="ux_chk_likebox_popup_editor" value="1" <?php echo isset($editor) && $editor[3] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_popup; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebutton_editor" id="ux_chk_likebutton_editor" value="1" <?php echo isset($editor) && $editor[4] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_sticky_likebox_editor" id="ux_chk_sticky_likebox_editor" value="1" <?php echo isset($editor) && $editor[5] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_sticky_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_general_settings_editor" id="ux_chk_general_settings_editor" value="1" <?php echo isset($editor) && $editor[6] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_general_settings; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_roles_and_capabilities_editor" id="ux_chk_roles_and_capabilities_editor" value="1" <?php echo isset($editor) && $editor[7] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_system_information_editor" id="ux_chk_system_information_editor" value="1" <?php echo isset($editor) && $editor[8] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_system_information; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_error_logs_editor" id="ux_chk_error_logs_editor" value="1" <?php echo isset($editor) && $editor[9] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_error_logs; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="ux_div_contributor_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_and_capabilities_contributor_role; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_contributor_role_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_contributor">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_contributor" id="ux_chk_full_control_contributor" value="1"  onclick="full_control_facebook_likebox(this, 'ux_div_contributor_roles');" <?php echo isset($contributor) && $contributor[0] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_contributor" id="ux_chk_likebox_contributor" value="1" <?php echo isset($contributor) && $contributor[1] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_and_likebutton_contributor" id="ux_chk_likebox_and_likebutton_contributor" value="1" <?php echo isset($contributor) && $contributor[2] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_and_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_popup_contributor" id="ux_chk_likebox_popup_contributor" value="1" <?php echo isset($contributor) && $contributor[3] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_popup; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebutton_contributor" id="ux_chk_likebutton_contributor" value="1" <?php echo isset($contributor) && $contributor[4] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_sticky_likebox_contributor" id="ux_chk_sticky_likebox_contributor" value="1" <?php echo isset($contributor) && $contributor[5] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_sticky_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_general_settings_contributor" id="ux_chk_general_settings_contributor" value="1" <?php echo isset($contributor) && $contributor[6] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_general_settings; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_roles_and_capabilities_contributor" id="ux_chk_roles_and_capabilities_contributor" value="1" <?php echo isset($contributor) && $contributor[7] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_system_information_contributor" id="ux_chk_system_information_contributor" value="1" <?php echo isset($contributor) && $contributor[8] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_system_information; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_error_logs_contributor" id="ux_chk_error_logs_contributor" value="1" <?php echo isset($contributor) && $contributor[9] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_error_logs; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="ux_div_subscriber_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_and_capabilities_subscriber_role; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_subscriber_role_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_subscriber">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_subscriber" id="ux_chk_full_control_subscriber" value="1"  onclick="full_control_facebook_likebox(this, 'ux_div_subscriber_roles');" <?php echo isset($subscriber) && $subscriber[0] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_subscriber" id="ux_chk_likebox_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[1] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_and_likebutton_subscriber" id="ux_chk_likebox_and_likebutton_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[2] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_and_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_popup_subscriber" id="ux_chk_likebox_popup_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[3] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_popup; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebutton_subscriber" id="ux_chk_likebutton_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[4] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_sticky_likebox_subscriber" id="ux_chk_sticky_likebox_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[5] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_sticky_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_general_settings_subscriber" id="ux_chk_general_settings_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[6] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_general_settings; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_roles_and_capabilities_subscriber" id="ux_chk_feature_request_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[7] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_system_information_subscriber" id="ux_chk_system_information_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[8] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_system_information; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_error_logs_subscriber" id="ux_chk_error_logs_subscriber" value="1" <?php echo isset($subscriber) && $subscriber[9] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_error_logs; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="ux_div_other_privileges_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_and_capabilities_other_roles; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_and_capabilities_other_roles_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_other_roles_privileges">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_other_privileges_roles" id="ux_chk_full_control_other_privileges_roles" value="1"  onclick="full_control_facebook_likebox(this, 'ux_div_other_privileges_roles');" <?php echo isset($other_privileges) && $other_privileges[0] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_other_roles" id="ux_chk_likebox_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[1] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_and_likebutton_other_roles" id="ux_chk_likebox_and_likebutton_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[2] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_and_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebox_popup_other_roles" id="ux_chk_likebox_popup_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[3] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_box_popup; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_likebutton_other_roles" id="ux_chk_likebutton_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[4] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_like_button; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_sticky_likebox_other_roles" id="ux_chk_sticky_likebox_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[5] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_sticky_like_box; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_general_settings_other_roles" id="ux_chk_general_settings_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[6] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_general_settings; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_roles_and_capabilities_other_roles" id="ux_chk_feature_request_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[7] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_roles_and_capabilities; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_system_information_other_roles" id="ux_chk_system_information_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[8] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_system_information; ?>
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="ux_chk_error_logs_other_roles" id="ux_chk_error_logs_other_roles" value="1" <?php echo isset($other_privileges) && $other_privileges[9] == "1" ? "checked=checked" : ""; ?>>
                                                            <?php echo $fbl_error_logs; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="ux_div_other_roles">
                                        <label class="control-label">
                                            <?php echo $fbl_roles_capabilities_other_roles_capabilities; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_roles_capabilities_other_roles_capabilities_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">* ( <?php echo $fbl_premium_editions_label; ?> )</span>
                                        </label>
                                        <div class="table-margin-top">
                                            <table class="table table-striped table-bordered table-hover" id="ux_tbl_other_roles">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 40% !important;">
                                                            <input type="checkbox" name="ux_chk_full_control_other_roles" id="ux_chk_full_control_other_roles" value="1" onclick="full_control_facebook_likebox(this, 'ux_div_other_roles');" <?php echo $roles_and_capabilities_data["others_full_control_capability"] == "1" ? "checked = checked" : "" ?>>
                                                            <?php echo $fbl_roles_and_capabilities_full_control; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $flag = 0;
                                                    $user_capabilities_data = get_others_capabilities_facebook_likebox();
                                                    foreach ($user_capabilities_data as $key => $value) {
                                                        $other_roles = in_array($value, $other_roles_array) ? "checked=checked" : "";
                                                        $flag++;
                                                        if ($key % 3 == 0) {
                                                            ?>
                                                            <tr>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td>
                                                                <input type="checkbox" name="ux_chk_other_capabilities_<?php echo $value; ?>" id="ux_chk_other_capabilities_<?php echo $value; ?>" value="<?php echo $value; ?>" <?php echo $other_roles; ?>>
                                                                <?php echo $value; ?>
                                                            </td>
                                                            <?php
                                                            if (count($user_capabilities_data) == $flag && $flag % 3 == 1) {
                                                                ?>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if (count($user_capabilities_data) == $flag && $flag % 3 == 2) {
                                                                ?>
                                                                <td>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($flag % 3 == 0) {
                                                                ?>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="line-separator"></div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="submit" class="btn vivid-green" name="ux_btn_roles_and_capabilities" id="ux_btn_roles_and_capabilities" value="<?php echo $fbl_save_changes; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-custom-home"></i>
                    <a href="admin.php?page=facebook_manage_like_box">
                        <?php echo $facebook_likebox; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_roles_and_capabilities; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-users"></i>
                            <?php echo $fbl_roles_and_capabilities; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <strong><?php echo $fbl_user_access_message; ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}