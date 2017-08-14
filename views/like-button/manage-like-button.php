<?php
/**
 * This File is used to manage like button.
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
    } elseif (like_button_facebook_likebox == "1") {
        $facebook_likebutton_preview_nonce = wp_create_nonce("facebook_likebutton_preview_nonce");
        $likebox_single_delete_nonce = wp_create_nonce("likebox_single_delete_nonce");
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
                    <a href="admin.php?page=facebook_manage_like_button">
                        <?php echo $fbl_like_button; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_manage_like_button; ?>
                    </span>
                <li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
                            <?php echo $fbl_manage_like_button; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_manage_like_button">
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
                                <div class="form-actions">
                                    <div class="table-top-margin">
                                        <select name="ux_ddl_facebook_likebox" id="ux_ddl_facebook_likebox" class="custom-bulk-width">
                                            <option value=""><?php echo $fbl_bulk_action; ?></option>
                                            <option value="delete" style="color:red !Important;"><?php echo $fbl_delete; ?> <?php echo " ( " . $fbl_premium_editions_label . " ) "; ?></option>
                                        </select>
                                        <input type="button" class="btn vivid-green" name="ux_btn_facebook_apply" id="ux_btn_facebook_apply" <?php echo $fbl_bulk_delete_facebook_likebox; ?> value="<?php echo $fbl_apply; ?>" onclick="premium_edition_notification_facebook_likebox();">
                                        <a href="admin.php?page=facebook_add_like_button" class="btn vivid-green"><?php echo $fbl_add_like_button; ?></a>
                                    </div>
                                    <div class="line-separator"></div>
                                    <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_facebook_button">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;width: 5%;" class="chk-action">
                                                    <input type="checkbox" class="custom-chkbox-operation" name="ux_chk_facebook_all_user" id="ux_chk_facebook_all_user">
                                                </th>
                                                <th style="width:71%;">
                                                    <label class="control-label">
                                                        <?php echo $fbl_likebox_details; ?>
                                                    </label>
                                                </th>
                                                <th style="width:16%;text-align:center;">
                                                    <label class="control-label">
                                                        <?php echo $fbl_facebook_action; ?>
                                                    </label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($like_button_data_value as $value) {
                                                ?>
                                                <tr>
                                                    <td class="chk-action" style="text-align:center;width: 5%;">
                                                        <input type="checkbox" name="ux_chk_likebox" onclick="check_all_facebook_likebox('ux_chk_facebook_all_user');" id="ux_chk_likebox" value="<?php echo isset($value["meta_id"]) ? intval($value["meta_id"]) : ""; ?>">
                                                    </td>
                                                    <td>
                                                        <label class="control-label">
                                                            <strong>
                                                                <?php echo $fbl_title; ?> :
                                                            </strong>
                                                            <?php echo isset($value["title"]) ? esc_html($value["title"]) : ""; ?>
                                                        </label></br>
                                                        <label class="control-label">
                                                            <strong>
                                                                <?php echo $fbl_page_id_url; ?> :
                                                            </strong>
                                                            <?php echo isset($value["likebox_source_type"]) && $value["likebox_source_type"] == "page_url" ? esc_attr($value["page_url"]) : esc_attr($value["page_id"]); ?>
                                                        </label></br>
                                                        <label class="control-label">
                                                            <strong>
                                                                <?php echo $fbl_shortcode; ?> :
                                                            </strong>
                                                            <span id="ux_shortcode_<?php echo intval($value['meta_id']); ?>">[facebook_likebox case_type="like_button" fbl_id="<?php echo intval($value['meta_id']); ?>"][/facebook_likebox]</span>
                                                        </label></br>
                                                    </td>
                                                    <td class="custom-alternative">
                                                        <a href="javascript:void(0);" class="icon-custom-frame tooltips" data-original-title="<?php echo $fbl_preview; ?>" data-placement="top"  onclick='facebook_likebox_preview_likebox("facebook_likebutton_preview", "<?php echo $facebook_likebutton_preview_nonce ?>", "likebox_dummy_form", "<?php echo intval($value["meta_id"]); ?>")'></a> |
                                                        <a href="javascript:void(0);" class="icon-custom-docs tooltips" data-original-title="<?php echo $fbl_copy_to_clipboard; ?>" data-placement="top" data-clipboard-action="copy" data-clipboard-target="#ux_shortcode_<?php echo intval($value['meta_id']); ?>"></a> |
                                                        <a href="admin.php?page=facebook_add_like_button&meta_id=<?php echo intval($value["meta_id"]); ?>" class="icon-custom-note tooltips" data-original-title="<?php echo $fbl_edit_tooltip; ?>" data-placement="top"></a> |
                                                        <a href="javascript:void(0);" class="icon-custom-trash tooltips custom-delete-icon-custom-live" data-original-title="<?php echo $fbl_delete; ?>" onclick="delete_record_facebook_likebox(<?php echo isset($value["meta_id"]) ? intval($value["meta_id"]) : ""; ?>, 'facebook_manage_like_button', '<?php echo $fbl_delete_like_button_success; ?>')" data-placement="top"></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
                    <a href="admin.php?page=facebook_manage_like_button">
                        <?php echo $fbl_like_button; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_manage_like_button; ?>
                    </span>
                <li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
                            <?php echo $fbl_manage_like_button; ?>
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