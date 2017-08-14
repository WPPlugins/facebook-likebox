<?php
/**
 * This File contain Frontend likebox shortcode.
 *
 * @author Tech Banker
 * @package facebook-likebox/user-views/
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} //exit if accessed directly
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
        $facebook_likebox_shortcode_nonce = wp_create_nonce("facebook_likebox_shortcode_nonce");
        ?>
        <div id="toastTypeGroup_error" style="display:none;">
            <div class="radio">
                <input type="radio" value="error" checked=""/>
            </div>
        </div>
        <div class="media_button_popup" data-popup="ux_open_popup_media_button">
            <div class="media_button_popup-inner">
                <div class="portlet box vivid-green" style="margin-bottom: 0px !important;">
                    <div class="portlet-title">
                        <div class="caption" id="ux_div_action">
                            <?php echo $fbl_likebox_add_to_page; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div id="ux_div_popup_header">
                            <form id="ux_frm_media_likebox">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group" style="margin-left:5%;margin-right:5%;width:90%">
                                            <label class="control-label">
                                                <?php echo $fbl_layout_likebox; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_layout_likebox_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_layout_likebox" name="ux_ddl_layout_likebox" class="form-control" onchange="like_box_type()">
                                                <option value=""><?php echo $fbl_select_type; ?></option>
                                                <option value="add_like_box_settings"><?php echo $fbl_likebox; ?></option>
                                                <option value="add_like_button_settings"><?php echo $fbl_like_button; ?></option>
                                                <option value="like_box_and_button_settings"><?php echo $fbl_likebox_and_button; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group" style="margin-left:5%;margin-right:5%;width:90%">
                                            <label class="control-label">
                                                <?php echo $fbl_layout_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_layout_title_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_layout_title" name="ux_ddl_layout_title" class="form-control">
                                                <option value=""><?php echo $fbl_select_title; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button"  class="btn vivid-green" name="ux_btn_send_request" id="ux_btn_send_request" onclick="fbl_validate_fields()" value="<?php echo $fbl_insert_likebox; ?>">
                                    <input type="button" data-media-popup-close="ux_open_popup_media_button" class="btn vivid-green" name="ux_btn_close" id="ux_btn_close" value="<?php echo $fbl_close_popup; ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}