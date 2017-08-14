<?php
/**
 * This File is used for feature request.
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
                        <?php echo $fbl_feature_request; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-call-out"></i>
        <?php echo $fbl_feature_request; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_feature_request">
                            <div class="form-body">
                                <div class="note note-warning">
                                    <h4 class="block">
        <?php echo $fbl_feature_request_thank_you; ?>
                                    </h4>
                                    <p>
        <?php echo $fbl_feature_requests_suggest_some_features; ?>
                                    </p>
                                    <p>
                                        <?php echo $fbl_feature_requests_suggestion_complaint; ?>
                                    </p>
                                    <p>
                                        <?php echo $fbl_feature_requests_write_us_on; ?>
                                        <a href="mailto:support@tech-banker.com" target="_blank">support@tech-banker.com</a>
                                    </p>
                                        <?php
                                        if ($fbl_message_translate_help != "") {
                                            ?>
                                        <strong><?php echo $fbl_message_translate_help; ?><br/><?php echo $fbl_kindly_click; ?><a href="javascript:void(0);" data-popup-open="ux_open_popup_translator" class="custom_links_feature" onclick="show_pop_up_facebook();"><?php echo $fbl_message_translate_here; ?></a></strong>
                                            <?php
                                        }
                                        ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                    <?php echo $fbl_feature_requests_your_name; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_feature_requests_your_name_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_your_name" id="ux_txt_your_name" value="" placeholder="<?php echo $fbl_feature_requests_your_name_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $fbl_feature_requests_your_email; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_feature_requests_your_email_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_email_address" id="ux_txt_email_address" value=""  placeholder="<?php echo $fbl_feature_requests_your_email_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
        <?php echo $fbl_feature_requests; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_feature_requests_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <textarea class="form-control" name="ux_txtarea_feature_request" id="ux_txtarea_feature_request" rows="8"  placeholder="<?php echo $fbl_feature_requests_placeholder; ?>"></textarea>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="submit" class="btn vivid-green" name="ux_btn_send_request" id="ux_btn_send_request" value="<?php echo $fbl_feature_requests_send_request; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}