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
    } elseif (error_logs_facebook_likebox == "1") {
        $error_logs_nonce = wp_create_nonce("error_logs_nonce");
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
                        <?php echo $fbl_error_logs; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-shield"></i>
                            <?php echo $fbl_error_logs; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_other_settings">
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
                                    <div class="pull-right">
                                        <a href="" type="button" class="btn vivid-green" id="ux_btn_download" name="ux_btn_download"><?php echo $fbl_error_logs_download; ?></a>
                                        <input type="button" class="btn vivid-green btn_clear_log" id="ux_btn_clear_log" name="ux_btn_clear_log" value="<?php echo $fbl_error_logs_clear; ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-group">
                                    <label class="control-label">
                                        <?php echo $fbl_error_logs_output; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_error_logs_output_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                    <textarea rows="20"  readonly="true" class="form-control"></textarea>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <a href="" type="button" class="btn vivid-green" id="ux_btn_download" name="ux_btn_download"><?php echo $fbl_error_logs_download; ?></a>
                                        <input type="button" class="btn vivid-green btn_clear_log" id="ux_btn_clear_log" name="ux_btn_clear_log" value="<?php echo $fbl_error_logs_clear; ?>">
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
                        <?php echo $fbl_error_logs; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-shield"></i>
                            <?php echo $fbl_error_logs; ?>
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
