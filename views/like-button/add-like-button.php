<?php
/**
 * This File is used to add like button.
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
        $fbl_like_add_button = wp_create_nonce("facebook_add_like_button");
        $facebook_likebutton_preview_nonce = wp_create_nonce("facebook_likebutton_preview_nonce");
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
                        <?php echo isset($_REQUEST["meta_id"]) ? $fbl_edit_like_button : $fbl_add_like_button; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-plus"></i>
                            <?php echo isset($_REQUEST["meta_id"]) ? $fbl_edit_like_button : $fbl_add_like_button; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_add_like_button">
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
                                        <input type="button" class="btn vivid-green" data-popup-open-preview="data-popup-likebox-preview" id="ux_preview_btn_add_likebutton" name="ux_preview_btn_add_likebutton" value="<?php echo $fbl_preview ?>" onclick='facebook_likebox_preview_likebox("facebook_likebutton_preview", "<?php echo $facebook_likebutton_preview_nonce ?>", "ux_frm_add_like_button", "0")'>
                                        <input type="submit" class="btn vivid-green" name="ux_btn_facebook_likebutton_save_change" id="ux_btn_facebook_likebutton_save_change" value="<?php echo $fbl_save_changes; ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_likebox_source; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_like_button_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_fb_likebox_source" name="ux_ddl_fb_likebox_source" class="form-control" onchange="page_id_and_url_show_for_facebook_likebox();">
                                                <option value="page_url"><?php echo $fbl_page_url; ?></option>
                                                <option value="page_id"><?php echo $fbl_page_id; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="ux_div_facebook_likebox_page_url">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_page_url; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_page_url_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_like_button_page_url" id="ux_txt_like_button_page_url" value="<?php echo isset($like_button_data["page_url"]) ? esc_attr($like_button_data["page_url"]) : "http://www.facebook.com/techbanker"; ?>" placeholder="<?php echo $fbl_page_url_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="ux_div_facebook_likebox_page_id">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_page_id; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_page_id_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_like_button_page_id" id="ux_txt_like_button_page_id" value="<?php echo isset($like_button_data["page_id"]) ? esc_attr($like_button_data["page_id"]) : "techbanker"; ?>" placeholder="<?php echo $fbl_page_id_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_title_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_like_button_title" id="ux_txt_like_button_title" value="<?php echo isset($like_button_data["title"]) ? esc_html($like_button_data["title"]) : "Tech-Banker"; ?>" placeholder="<?php echo $fbl_title_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_language; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_language_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_like_button_language" name="ux_ddl_like_button_language" class="form-control" >
                                                <?php
                                                foreach ($fbl_langs as $key => $val) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_width; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_width_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_like_button_width" id="ux_txt_like_button_width"  value="<?php echo isset($like_button_data["width"]) ? intval($like_button_data["width"]) : "350"; ?>" maxlength="3" onfocus="paste_only_digits_facebook_likebox(this.id);" onblur="default_width_facebook_likebox(this);" placeholder="<?php echo $fbl_width_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_button_type; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_button_type_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_fb_button_type" name="ux_ddl_fb_button_type" class="form-control" onchange="facebook_like_button_type_show_hide();">
                                                <option value="like"><?php echo $fbl_like; ?></option>
                                                <option value="follow"><?php echo $fbl_button_type_follow; ?></option>
                                                <option value="share"><?php echo $fbl_button_type_share; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_like_button_size; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_like_button_size_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_like_button_size" id="ux_ddl_like_button_size" class="form-control">
                                                <option value="small"><?php echo $fbl_small; ?></option>
                                                <option value="large"><?php echo $fbl_large; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_like_button_style_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_like_button_style_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_like_button_style" id="ux_ddl_like_button_style" class="form-control">
                                                <option value="standard"><?php echo $fbl_like_button_style_standard; ?></option>
                                                <option value="button_count"><?php echo $fbl_like_button_style_count; ?></option>
                                                <option value="box_count"><?php echo $fbl_like_button_style_box_count; ?></option>
                                                <option value="button"><?php echo $fbl_button; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="like_button_action">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_facebook_action; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_action_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_like_button_action" id="ux_ddl_like_button_action" class="form-control">
                                                <option value="like"><?php echo $fbl_like; ?></option>
                                                <option value="recommend"><?php echo $fbl_recommended; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_share_button_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_share_button_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_like_button_share_button" id="ux_ddl_like_button_share_button" class="form-control">
                                                <option value="true"><?php echo $fbl_show; ?></option>
                                                <option value="false"><?php echo $fbl_hide; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="button" class="btn vivid-green" data-popup-open-preview="data-popup-likebox-preview" id="ux_preview_btn_add_likebutton" name="ux_preview_btn_add_likebutton" value="<?php echo $fbl_preview ?>" onclick='facebook_likebox_preview_likebox("facebook_likebutton_preview", "<?php echo $facebook_likebutton_preview_nonce ?>", "ux_frm_add_like_button", "0")'>
                                        <input type="submit" class="btn vivid-green" name="ux_btn_facebook_likebutton_save_change" id="ux_btn_facebook_likebutton_save_change" value="<?php echo $fbl_save_changes; ?>">
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
                    <a href="admin.php?page=facebook_manage_like_button">
                        <?php echo $fbl_like_button; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_add_like_button; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-plus"></i>
                            <?php echo $fbl_add_like_button; ?>
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