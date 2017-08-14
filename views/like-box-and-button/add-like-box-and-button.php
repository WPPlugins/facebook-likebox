<?php
/**
 * This File is used to add like box and like button.
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
    } elseif (like_box_button_facebook_likebox == "1") {
        $fbl_add_likebox_and_button_nonce = wp_create_nonce("fbl_add_likebox_and_button_nonce");
        $facebook_likebox_button_preview_nonce = wp_create_nonce("fbl_likebox_button_nonce");
        $likebox_and_button_border_style = isset($likebox_and_button_data_serialize["border_style"]) ? explode(",", esc_attr($likebox_and_button_data_serialize["border_style"])) : "";
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
                    <a href="admin.php?page=facebook_manage_like_box_and_button">
                        <?php echo $fbl_like_box_and_button; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo!isset($_REQUEST["meta_id"]) ? $fbl_add_like_box_and_button : $fbl_edit_like_box_and_button; ?>
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
                            <?php echo!isset($_REQUEST["meta_id"]) ? $fbl_add_like_box_and_button : $fbl_edit_like_box_and_button; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_add_likebox_and_button">
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
                                        <input type="button" class="btn vivid-green" data-popup-open-preview="data-popup-likebox-preview" id="ux_preview_btn_add_likebox_and_button" name="ux_preview_btn_add_likebox_and_button" value="<?php echo $fbl_preview ?>" onclick='facebook_likebox_preview_likebox("facebook_likebox_button_preview", "<?php echo $facebook_likebox_button_preview_nonce ?>", "ux_frm_add_likebox_and_button", "0")'>
                                        <input type="submit" class="btn vivid-green" id="ux_btn_add_likebox_and_button" name="ux_btn_add_likebox_and_button" value="<?php echo $fbl_save_changes ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_likebox_source; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_likebox_and_button_tooltip; ?>" data-placement="right"></i>
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
                                            <input type="text" class="form-control" name="ux_txt_likebox_and_button_page_url" id="ux_txt_likebox_and_button_page_url" value="<?php echo isset($likebox_and_button_data_serialize["page_url"]) ? esc_attr($likebox_and_button_data_serialize["page_url"]) : "http://www.facebook.com/techbanker"; ?>" placeholder="<?php echo $fbl_page_url_placeholder; ?>">
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
                                            <input type="text" class="form-control" name="ux_txt_likebox_and_button_page_id" id="ux_txt_likebox_and_button_page_id" value="<?php echo isset($likebox_and_button_data_serialize["page_id"]) ? esc_attr($likebox_and_button_data_serialize["page_id"]) : "techbanker"; ?>" placeholder="<?php echo $fbl_page_id_placeholder; ?>">
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
                                            <input type="text" class="form-control" name="ux_txt_likebox_and_button_title" id="ux_txt_likebox_and_button_title" value="<?php echo isset($likebox_and_button_data_serialize["title"]) ? esc_html($likebox_and_button_data_serialize["title"]) : "Tech-Banker"; ?>" placeholder="<?php echo $fbl_title_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_language; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_language_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_likebox_and_likebutton_language" id="ux_ddl_likebox_and_likebutton_language" class="form-control">
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
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_likebox_and_button_width" id="ux_txt_likebox_and_button_width"  onblur="default_width_facebook_likebox(this);" maxlength="3" value="<?php echo isset($likebox_and_button_data_serialize["width"]) ? intval($likebox_and_button_data_serialize["width"]) : 300; ?>"  onfocus="paste_only_digits_facebook_likebox(this.id);" placeholder="<?php echo $fbl_width_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_height; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_height_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_likebox_and_button_height" id="ux_txt_likebox_and_button_height" maxlength="3" value="<?php echo isset($likebox_and_button_data_serialize["height"]) ? intval($likebox_and_button_data_serialize["height"]) : 350; ?>" onblur="default_height_facebook_likebox(this)" onfocus="paste_only_digits_facebook_likebox(this.id);" placeholder="<?php echo $fbl_height_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_header; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_header_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_and_button_header" name="ux_ddl_likebox_and_button_header" class="form-control">
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
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_and_button_post" name="ux_ddl_likebox_and_button_post" class="form-control">
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
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_and_button_events" name="ux_ddl_likebox_and_button_events" class="form-control">
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
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_and_button_messages" name="ux_ddl_likebox_and_button_messages" class="form-control">
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
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_and_button_cover_photo" name="ux_ddl_likebox_and_button_cover_photo" class="form-control">
                                                <option value="false"><?php echo $fbl_show; ?></option>
                                                <option value="true"><?php echo $fbl_hide; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_likebox_animation; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_likebox_and_button_animation_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true"><?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_likebox_button_animations_effects" name="ux_ddl_likebox_button_animations_effects" class="form-control" >
                                                <option value="none"><?php _e("None", "facebook-likebox"); ?></option>
                                                <optgroup label="<?php _e("Magic Effects", "facebook-likebox"); ?>">
                                                    <option value="twisterInDown" disabled="disabled"><?php _e("Twister In Down", "facebook-likebox"); ?></option>
                                                    <option value="twisterInUp" disabled="disabled"><?php _e("Twister In Up", "facebook-likebox"); ?></option>
                                                    <option value="swap" disabled="disabled"><?php _e("Swap", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Bling", "facebook-likebox"); ?>">
                                                    <option value="puffIn" disabled="disabled"><?php _e("Puff In", "facebook-likebox"); ?></option>
                                                    <option value="vanishIn" disabled="disabled"><?php _e("Vanish In", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Static Effects", "facebook-likebox"); ?>">
                                                    <option value="openDownLeftRetourn" disabled="disabled"><?php _e("Open Down Left Return", "facebook-likebox"); ?></option>
                                                    <option value="openDownRightRetourn" disabled="disabled"><?php _e("Open Down Right Return", "facebook-likebox"); ?></option>
                                                    <option value="openUpLeftRetourn" disabled="disabled"><?php _e("Open Up Left Return", "facebook-likebox"); ?></option>
                                                    <option value="openUpRightRetourn" disabled="disabled"><?php _e("Open Up Right Return", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Perspective", "facebook-likebox"); ?>">
                                                    <option value="perspectiveDownRetourn" disabled="disabled"><?php _e("Perspective Down Return", "facebook-likebox"); ?></option>
                                                    <option value="perspectiveUpRetourn" disabled="disabled"><?php _e("Perspective Up Return", "facebook-likebox"); ?></option>
                                                    <option value="perspectiveLeftRetourn" disabled="disabled"><?php _e("Perspective Left Return", "facebook-likebox"); ?></option>
                                                    <option value="perspectiveRightRetourn" disabled="disabled"><?php _e("Perspective Right Return", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Slide", "facebook-likebox"); ?>">
                                                    <option value="slideDownRetourn" disabled="disabled"><?php _e("Slide Down Return", "facebook-likebox"); ?></option>
                                                    <option value="slideUpRetourn" disabled="disabled"><?php _e("Slide Up Return", "facebook-likebox"); ?></option>
                                                    <option value="slideLeftRetourn" disabled="disabled"><?php _e("Slide Left Return", "facebook-likebox"); ?></option>
                                                    <option value="slideRightRetourn" disabled="disabled"><?php _e("Slide Right Return", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Math", "facebook-likebox"); ?>">
                                                    <option value="swashIn" disabled="disabled"><?php _e("Swash In", "facebook-likebox"); ?></option>
                                                    <option value="foolishIn" disabled="disabled"><?php _e("Foolish In", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Tin", "facebook-likebox"); ?>">
                                                    <option value="tinRightIn" disabled="disabled"><?php _e("Tin Right In", "facebook-likebox"); ?></option>
                                                    <option value="tinLeftIn" disabled="disabled"><?php _e("Tin Left In", "facebook-likebox"); ?></option>
                                                    <option value="tinUpIn" disabled="disabled"><?php _e("Tin Up In", "facebook-likebox"); ?></option>
                                                    <option value="tinDownIn" disabled="disabled"><?php _e("Tin Down In", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Boing", "facebook-likebox"); ?>">
                                                    <option value="boingInUp" disabled="disabled"><?php _e("Boing In Up", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("On the Space", "facebook-likebox"); ?>">
                                                    <option value="spaceInUp" disabled="disabled"><?php _e("Space In Up", "facebook-likebox"); ?></option>
                                                    <option value="spaceInRight" disabled="disabled"><?php _e("Space In Right", "facebook-likebox"); ?></option>
                                                    <option value="spaceInDown" disabled="disabled"><?php _e("Space In Down", "facebook-likebox"); ?></option>
                                                    <option value="spaceInLeft" disabled="disabled"><?php _e("Space In Left", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Attention Seekers", "facebook-likebox"); ?>">
                                                    <option value="bounce" disabled="disabled"><?php _e("Bounce", "facebook-likebox"); ?></option>
                                                    <option value="flash" disabled="disabled"><?php _e("Flash", "facebook-likebox"); ?></option>
                                                    <option value="pulse" disabled="disabled"><?php _e("Pulse", "facebook-likebox"); ?></option>
                                                    <option value="rubberBand" disabled="disabled"><?php _e("Rubber Band", "facebook-likebox"); ?></option>
                                                    <option value="shake" disabled="disabled"><?php _e("Shake", "facebook-likebox"); ?></option>
                                                    <option value="swing" disabled="disabled"><?php _e("Swing", "facebook-likebox"); ?></option>
                                                    <option value="tada" disabled="disabled"><?php _e("Tada", "facebook-likebox"); ?></option>
                                                    <option value="wobble" disabled="disabled"><?php _e("Wobble", "facebook-likebox"); ?></option>
                                                    <option value="jello" disabled="disabled"><?php _e("Jello", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Bouncing Entrances", "facebook-likebox"); ?>">
                                                    <option value="bounceIn" disabled="disabled"><?php _e("Bounce In", "facebook-likebox"); ?></option>
                                                    <option value="bounceInDown" disabled="disabled"><?php _e("Bounce In Down", "facebook-likebox"); ?></option>
                                                    <option value="bounceInLeft" disabled="disabled"><?php _e("Bounce In Left", "facebook-likebox"); ?></option>
                                                    <option value="bounceInRight" disabled="disabled"><?php _e("Bounce In Right", "facebook-likebox"); ?></option>
                                                    <option value="bounceInUp" disabled="disabled"><?php _e("Bounce In Up", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Fading Entrances", "facebook-likebox"); ?>">
                                                    <option value="fadeIn" disabled="disabled"><?php _e("Fade In", "facebook-likebox"); ?></option>
                                                    <option value="fadeInDown" disabled="disabled"><?php _e("Fade In Down", "facebook-likebox"); ?></option>
                                                    <option value="fadeInDownBig" disabled="disabled"><?php _e("Fade In Down Big", "facebook-likebox"); ?></option>
                                                    <option value="fadeInLeft" disabled="disabled"><?php _e("Fade In Left", "facebook-likebox"); ?></option>
                                                    <option value="fadeInLeftBig" disabled="disabled"><?php _e("Fade In Left Big", "facebook-likebox"); ?></option>
                                                    <option value="fadeInRight" disabled="disabled"><?php _e("Fade In Right", "facebook-likebox"); ?></option>
                                                    <option value="fadeInRightBig" disabled="disabled"><?php _e("Fade In Right Big", "facebook-likebox"); ?></option>
                                                    <option value="fadeInUp" disabled="disabled"><?php _e("Fade In Up", "facebook-likebox"); ?></option>
                                                    <option value="fadeInUpBig" disabled="disabled"><?php _e("Fade In Up Big", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Flippers", "facebook-likebox"); ?>">
                                                    <option value="flipInX" disabled="disabled"><?php _e("Flip In X", "facebook-likebox"); ?></option>
                                                    <option value="flipInY" disabled="disabled"><?php _e("Flip In Y", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Lightspeed", "facebook-likebox"); ?>">
                                                    <option value="lightSpeedIn" disabled="disabled"><?php _e("Light Speed In", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Rotating Entrances", "facebook-likebox"); ?>">
                                                    <option value="rotateIn" disabled="disabled"><?php _e("Rotate In", "facebook-likebox"); ?></option>
                                                    <option value="rotateInDownLeft" disabled="disabled"><?php _e("Rotate In Down Left", "facebook-likebox"); ?></option>
                                                    <option value="rotateInDownRight" disabled="disabled"><?php _e("Rotate In Down Right", "facebook-likebox"); ?></option>
                                                    <option value="rotateInUpLeft" disabled="disabled"><?php _e("Rotate In Up Left", "facebook-likebox"); ?></option>
                                                    <option value="rotateInUpRight" disabled="disabled"><?php _e("Rotate In Up Right", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Sliding Entrances", "facebook-likebox"); ?>">
                                                    <option value="slideInUp" disabled="disabled"><?php _e("Slide In Up", "facebook-likebox"); ?></option>
                                                    <option value="slideInDown" disabled="disabled"><?php _e("Slide In Down", "facebook-likebox"); ?></option>
                                                    <option value="slideInLeft" disabled="disabled"><?php _e("Slide In Left", "facebook-likebox"); ?></option>
                                                    <option value="slideInRight" disabled="disabled"><?php _e("Slide In Right", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Zoom Entrances", "facebook-likebox"); ?>">
                                                    <option value="zoomIn" disabled="disabled"><?php _e("Zoom In", "facebook-likebox"); ?></option>
                                                    <option value="zoomInDown" disabled="disabled"><?php _e("Zoom In Down", "facebook-likebox"); ?></option>
                                                    <option value="zoomInLeft" disabled="disabled"><?php _e("Zoom In Left", "facebook-likebox"); ?></option>
                                                    <option value="zoomInRight" disabled="disabled"><?php _e("Zoom In Right", "facebook-likebox"); ?></option>
                                                    <option value="zoomInUp" disabled="disabled"><?php _e("Zoom In Up", "facebook-likebox"); ?></option>
                                                </optgroup>
                                                <optgroup label="<?php _e("Specials", "facebook-likebox"); ?>">
                                                    <option value="rollIn" disabled="disabled"><?php _e("Roll In", "facebook-likebox"); ?></option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_show_faces; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_likebox_and_button_show_faces_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_and_button_show_faces" name="ux_ddl_likebox_and_button_show_faces" class="form-control">
                                                <option value="true"><?php echo $fbl_show; ?></option>
                                                <option value="false"><?php echo $fbl_hide; ?></option>
                                            </select>
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
                                            <select id="ux_ddl_likebox_and_button_size" name="ux_ddl_likebox_and_button_size" class="form-control">
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
                                            <select name="ux_ddl_like_box_button_action" id="ux_ddl_like_box_button_action" class="form-control">
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
                                            <select name="ux_ddl_like_button_box_share_button" id="ux_ddl_like_button_box_share_button" class="form-control">
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
                                                <input type="text" class="form-control input-width-25 input-inline" name="ux_txt_border_style[]" id="ux_txt_border_style_width" placeholder="<?php echo $fbl_border_width_placeholder; ?>" maxlength="3" onblur="default_value_facebook_likebox('#ux_txt_border_style_width', 1)"  onfocus="paste_only_digits_facebook_likebox(this.id);" value="<?php echo isset($likebox_and_button_border_style[0]) ? intval($likebox_and_button_border_style[0]) : 2; ?>" disabled="disabled">
                                                <select name="ux_txt_border_style[]" id="ux_ddl_border_style_thickness" class="form-control input-width-27 input-inline">
                                                    <option value="none"><?php echo $fbl_border_none; ?></option>
                                                    <option value="solid" disabled="disabled"><?php echo $fbl_border_solid; ?></option>
                                                    <option value="dashed" disabled="disabled"><?php echo $fbl_border_dashed; ?></option>
                                                    <option value="dotted" disabled="disabled"><?php echo $fbl_border_dotted ?></option>
                                                </select>
                                                <input type="text" class="form-control input-normal input-inline" name="ux_txt_border_style[]" id="ux_txt_border_style_color" onblur="check_color_facebook_likebox('#ux_txt_border_style_color');" onfocus="facebook_likebox_colorpicker(this.id, this.value);" placeholder="<?php echo $fbl_color_placeholder; ?>" value="<?php echo isset($likebox_and_button_border_style[2]) ? esc_attr($likebox_and_button_border_style[2]) : "#e3e3e3"; ?>" disabled="disabled">
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
                                                <input type="text" class="form-control" name="ux_txt_border_radius" id="ux_txt_border_radius" placeholder="<?php echo $fbl_border_radius_placeholder; ?>" maxlength="3" onblur="default_value_facebook_likebox('#ux_txt_border_radius', 0)" onfocus="paste_only_digits_facebook_likebox(this.id);" value="<?php echo isset($likebox_and_button_data_serialize["border_radius"]) ? intval($likebox_and_button_data_serialize["border_radius"]) : 0; ?>" disabled="disabled">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="button" class="btn vivid-green" data-popup-open-preview="data-popup-likebox-preview" id="ux_preview_btn_add_likebox_and_button" name="ux_preview_btn_add_likebox_and_button" value="<?php echo $fbl_preview ?>" onclick='facebook_likebox_preview_likebox("facebook_likebox_button_preview", "<?php echo $facebook_likebox_button_preview_nonce ?>", "ux_frm_add_likebox_and_button", "0")'>
                                        <input type="submit" class="btn vivid-green" id="ux_btn_add_likebox_and_button" name="ux_btn_add_likebox_and_button" value="<?php echo $fbl_save_changes ?>">
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
                    <a href="admin.php?page=facebook_manage_like_box_and_button">
                        <?php echo $fbl_like_box_and_button; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_add_like_box_and_button; ?>
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
                            <?php echo $fbl_add_like_box_and_button; ?>
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