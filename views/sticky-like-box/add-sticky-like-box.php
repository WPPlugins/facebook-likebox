<?php
/**
 * This File is used to add sticky like box.
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
        $sticky_likebox_border_style = isset($sticky_likebox_data["sticky_likebox_border_style"]) ? explode(",", esc_attr($sticky_likebox_data["sticky_likebox_border_style"])) : "";
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
                        <?php echo isset($_REQUEST["meta_id"]) ? $fbl_edit_sticky_likebox : $fbl_add_sticky_like_box; ?>
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
                            <?php echo isset($_REQUEST["meta_id"]) ? $fbl_edit_sticky_likebox : $fbl_add_sticky_like_box; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_add_sticky_likebox">
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
                                        <input type="button" class="btn vivid-green" data-popup-open-preview="data-popup-likebox-preview" id="ux_preview_btn_add_sticky_likebox" name="ux_preview_btn_add_sticky_likebox" value="<?php echo $fbl_preview ?>" onclick='premium_edition_notification_facebook_likebox();'>
                                        <input type="submit" class="btn vivid-green" id="ux_btn_add_sticky_likebox" name="ux_btn_add_sticky_likebox" value="<?php echo $fbl_save_changes ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_likebox_source; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_sticky_likebox_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_fb_likebox_source" name="ux_ddl_fb_likebox_source"class="form-control" onchange="page_id_and_url_show_for_facebook_likebox();">
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
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_sticky_likebox_page_url" id="ux_txt_sticky_likebox_page_url" value="<?php echo isset($sticky_likebox_data["page_url"]) ? esc_attr($sticky_likebox_data["page_url"]) : "http://www.facebook.com/techbanker"; ?>" placeholder="<?php echo $fbl_page_url_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="ux_div_facebook_likebox_page_id">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_page_id; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_page_id_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_sticky_likebox_page_id" id="ux_txt_sticky_likebox_page_id" value="<?php echo isset($sticky_likebox_data["page_id"]) ? esc_attr($sticky_likebox_data["page_id"]) : "techbanker"; ?>" placeholder="<?php echo $fbl_page_id_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_title_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_sticky_likebox_page_title" id="ux_txt_sticky_likebox_page_title" value="<?php echo isset($sticky_likebox_data["title"]) ? esc_html($sticky_likebox_data["title"]) : "Tech-Banker"; ?>" placeholder="<?php echo $fbl_title_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_language; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_language_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select name="ux_ddl_sticky_likebox_language" id="ux_ddl_sticky_likebox_language" class="form-control">
                                                <?php
                                                foreach ($fbl_langs as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_width; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_width_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_sticky_likebox_width"
                                                   id="ux_txt_sticky_likebox_width"  maxlength="3" value="<?php echo isset($sticky_likebox_data["sticky_likebox_width"]) ? intval($sticky_likebox_data["sticky_likebox_width"]) : "350" ?>"
                                                   placeholder="<?php echo $fbl_width_placeholder; ?>" onblur="default_width_facebook_likebox(this);" onfocus="paste_only_digits_facebook_likebox(this.id);">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_height; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_height_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" name="ux_txt_sticky_likebox_height"
                                                   id="ux_txt_sticky_likebox_height"  maxlength="3" class="form-control" value="<?php echo isset($sticky_likebox_data["sticky_likebox_height"]) ? intval($sticky_likebox_data["sticky_likebox_height"]) : "250" ?>" placeholder="<?php echo $fbl_height_placeholder; ?>" onblur="default_height_facebook_likebox(this);" onfocus="paste_only_digits_facebook_likebox(this.id);" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_sticky_likebox_position; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_sticky_likebox_position_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_position" name="ux_ddl_sticky_likebox_position" class="form-control">
                                                <option value="top"><?php echo $fbl_position_top; ?></option>
                                                <option value="bottom"><?php echo $fbl_position_bottom; ?></option>
                                                <option value="left"><?php echo $fbl_position_left; ?></option>
                                                <option value="right"><?php echo $fbl_position_right; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_header; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_header_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_header" name="ux_ddl_sticky_likebox_header" class="form-control">
                                                <option value="true"><?php echo $fbl_small; ?></option>
                                                <option value="false"><?php echo $fbl_large; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_post_stream; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_post_stream_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_post_stream" name="ux_ddl_sticky_likebox_post_stream" class="form-control">
                                                <option value="timeline"><?php echo $fbl_enable; ?></option>
                                                <option value=""><?php echo $fbl_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_events; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_events_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_events" name="ux_ddl_sticky_likebox_events" class="form-control">
                                                <option value="events"><?php echo $fbl_enable; ?></option>
                                                <option value=""><?php echo $fbl_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_messages; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_messages_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_messages" name="ux_ddl_sticky_likebox_messages" class="form-control">
                                                <option value="messages"><?php echo $fbl_enable; ?></option>
                                                <option value=""><?php echo $fbl_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_cover_photo; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_cover_photo_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_cover_photo" name="ux_ddl_sticky_likebox_cover_photo" class="form-control">
                                                <option value="false"><?php echo $fbl_show; ?></option>
                                                <option value="true"><?php echo $fbl_hide; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="ux_txt_sticky_faces" >
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_show_faces; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_show_user_faces_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_sticky_likebox_show_faces" name="ux_ddl_sticky_likebox_show_faces" class="form-control">
                                                <option value="true"><?php echo $fbl_show; ?></option>
                                                <option value="false"><?php echo $fbl_hide; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_border_style_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_border_style_tooltip; ?>" data-placement="right"></i>
                                            </label>
                                            <span style="color:red;"><?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            <div class="input-icon right">
                                                <input type="text" class="form-control input-width-25 input-inline" name="ux_txt_border_style[]" id="ux_txt_border_style_width" placeholder="<?php echo $fbl_border_width_placeholder; ?>" maxlength="3" onblur="default_value_facebook_likebox('#ux_txt_border_style_width', 5);" onfocus="paste_only_digits_facebook_likebox(this.id)" value="<?php echo isset($sticky_likebox_border_style[0]) ? intval($sticky_likebox_border_style[0]) : "5" ?>">
                                                <select name="ux_txt_border_style[]" id="ux_ddl_border_style_thickness" class="form-control input-width-27 input-inline">
                                                    <option value="none"><?php echo $fbl_border_none; ?></option>
                                                    <option value="solid"><?php echo $fbl_border_solid; ?></option>
                                                    <option value="dashed"><?php echo $fbl_border_dashed; ?></option>
                                                    <option value="dotted"><?php echo $fbl_border_dotted ?></option>
                                                </select>
                                                <input type="text" class="form-control input-normal input-inline" name="ux_txt_border_style[]" id="ux_txt_border_style_color" onblur="check_color_facebook_likebox('#ux_txt_border_style_color');" onfocus="facebook_likebox_colorpicker(this.id, this.value);" placeholder="<?php echo $fbl_color_placeholder; ?>" value="<?php echo isset($sticky_likebox_border_style[2]) ? esc_attr($sticky_likebox_border_style[2]) : "#3b5998" ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_border_radius_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_border_radius_tooltip; ?>" data-placement="right"></i>
                                            </label>
                                            <span style="color:red;"><?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            <div class="input-icon right">
                                                <input type="text" class="form-control" name="ux_txt_border_radius" id="ux_txt_border_radius" placeholder="<?php echo $fbl_border_radius_placeholder; ?>" maxlength="3" onblur="default_value_facebook_likebox('#ux_txt_border_radius', 0);" value="<?php echo isset($sticky_likebox_data["sticky_likebox_border_radius"]) ? intval($sticky_likebox_data["sticky_likebox_border_radius"]) : "0" ?>" onfocus="paste_only_digits_facebook_likebox(this.id);" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="button" class="btn vivid-green" data-popup-open-preview="data-popup-likebox-preview" id="ux_preview_btn_add_sticky_likebox" name="ux_preview_btn_add_sticky_likebox" value="<?php echo $fbl_preview ?>" onclick='premium_edition_notification_facebook_likebox();'>
                                        <input type="submit" class="btn vivid-green" id="ux_btn_add_sticky_likebox" name="ux_btn_add_sticky_likebox" value="<?php echo $fbl_save_changes ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" data-popup="data-sticky-likebox-preview">
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
                        <?php echo $fbl_add_sticky_like_box; ?>
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
                            <?php echo $fbl_add_sticky_like_box; ?>
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