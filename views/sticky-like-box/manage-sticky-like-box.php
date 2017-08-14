<?php
/**
 * This File is used to manage sticky like box.
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
    } elseif (sticky_like_box_facebook_likebox == "1") {
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
                    <a href="admin.php?page=facebook_manage_sticky_like_box">
                        <?php echo $fbl_sticky_like_box; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_manage_sticky_like_box; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
                            <?php echo $fbl_manage_sticky_like_box; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_manage_sticky_like_box">
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
                                            <option value="delete" style="color:red;"><?php echo $fbl_delete . " ( " . $fbl_premium_editions_label . " )"; ?></option>
                                        </select>
                                        <input type="button" class="btn vivid-green" name="ux_btn_facebook_apply" id="ux_btn_facebook_apply" <?php echo $fbl_bulk_delete_facebook_likebox; ?> value="<?php echo $fbl_apply; ?>" onclick="premium_edition_notification_facebook_likebox();">
                                        <a href="admin.php?page=facebook_add_sticky_like_box" class="btn vivid-green"><?php echo $fbl_add_sticky_like_box; ?></a>
                                    </div>
                                    <div class="line-separator"></div>
                                    <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_facebook_sticky_likebox">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;width:5%;" class="chk-action">
                                                    <input type="checkbox" class="custom-chkbox-operation" name="ux_chk_facebook_all_user" id="ux_chk_facebook_all_user">
                                                </th>
                                                <th style="width:70%;">
                                                    <label class="control-label">
                                                        <?php echo $fbl_likebox_details; ?>
                                                    </label>
                                                </th>
                                                <th style="width:17%;text-align:center;">
                                                    <label class="control-label">
                                                        <?php echo $fbl_facebook_action; ?>
                                                    </label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="popup" data-popup="data-sticky-likebox-preview"></div>
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
                    <a href="admin.php?page=facebook_manage_sticky_like_box">
                        <?php echo $fbl_sticky_like_box; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_manage_sticky_like_box; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
                            <?php echo $fbl_manage_sticky_like_box; ?>
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