<?php
/**
 * This File is used to add like box.
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
    } elseif (like_box_facebook_likebox == "1") {
        $fbl_add_likebox = wp_create_nonce("facebook_add_likebox");
        $facebook_likebox_preview_nonce = wp_create_nonce("facebook_likebox_preview_nonce");
        $likebox_border_style = isset($likebox_data["border_style"]) ? explode(",", esc_attr($likebox_data["border_style"])) : "";
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
                    <a href="admin.php?page=facebook_manage_like_box">
                        <?php echo $fbl_like_box; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo isset($_REQUEST["meta_id"]) ? $fbl_edit_like_box : $fbl_add_like_box; ?>
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
                            <?php echo isset($_REQUEST["meta_id"]) ? $fbl_edit_like_box : $fbl_add_like_box; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_add_likebox">
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
                                        <input type="button" class="btn vivid-green" id="ux_preview_btn_add_likebox" name="ux_preview_btn_add_likebox"  value="<?php echo $fbl_preview ?>" onclick='facebook_likebox_preview_likebox("facebook_likebox_preview", "<?php echo $facebook_likebox_preview_nonce ?>", "ux_frm_add_likebox", "0")'>
                                        <input type="submit" class="btn vivid-green" id="ux_btn_add_likebox" name="ux_btn_add_likebox" value="<?php echo $fbl_save_changes ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_likebox_source; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_likebox_tooltip; ?>" data-placement="right"></i>
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
                                            <input type="text" class="form-control" name="ux_txt_likebox_page_url" id="ux_txt_likebox_page_url"  value="<?php echo isset($likebox_data["page_url"]) ? esc_attr($likebox_data["page_url"]) : "http://www.facebook.com/techbanker" ?>" placeholder="<?php echo $fbl_page_url_placeholder; ?>" >
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
                                            <input type="text" class="form-control" name="ux_txt_likebox_page_id" id="ux_txt_likebox_page_id" value="<?php echo isset($likebox_data["page_id"]) ? esc_attr($likebox_data["page_id"]) : "techbanker" ?>" placeholder="<?php echo $fbl_page_id_placeholder; ?>" >
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
                                            <input type="text" class="form-control" name="ux_txt_likebox_title" id="ux_txt_likebox_title" value="<?php echo isset($likebox_data["title"]) ? esc_html($likebox_data["title"]) : "Tech-Banker" ?>" placeholder="<?php echo $fbl_title_placeholder; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_language; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_language_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_language" name="ux_ddl_likebox_language" class="form-control" >
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_width; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_width_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control"  maxlength="3" name="ux_txt_likebox_width" id="ux_txt_likebox_width" onblur="default_width_facebook_likebox(this);" onfocus="paste_only_digits_facebook_likebox(this.id);" value="<?php echo isset($likebox_data["width"]) ? intval($likebox_data["width"]) : "350" ?>" placeholder="<?php echo $fbl_width_placeholder; ?>" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_height; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_height_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_likebox_height" id="ux_txt_likebox_height"  maxlength="3" onblur="default_height_facebook_likebox(this);" onfocus="paste_only_digits_facebook_likebox(this.id);" value="<?php echo isset($likebox_data["height"]) ? intval($likebox_data["height"]) : "400" ?>" placeholder="<?php echo $fbl_height_placeholder; ?>" >
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
                                            <select id="ux_ddl_likebox_header" name="ux_ddl_likebox_header" class="form-control" >
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
                                            <select id="ux_ddl_likebox_stream" name="ux_ddl_likebox_stream" class="form-control" >
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
                                            <select id="ux_ddl_likebox_events" name="ux_ddl_likebox_events" class="form-control" >
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
                                            <select id="ux_ddl_likebox_messages" name="ux_ddl_likebox_messages" class="form-control" >
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
                                            <select id="ux_ddl_likebox_cover_photo" name="ux_ddl_likebox_cover_photo" class="form-control" >
                                                <option value="false"><?php echo $fbl_show; ?></option>
                                                <option value="true"><?php echo $fbl_hide; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_likebox_animation; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_likebox_animation_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <select id="ux_ddl_likebox_animations_effects" name="ux_ddl_likebox_animations_effects" class="form-control">
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
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_show_faces_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select id="ux_ddl_likebox_user_faces" name="ux_ddl_likebox_user_faces" class="form-control">
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
                                                <span class="required" aria-required="true"><?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <div class="input-icon right">
                                                <input type="text" class="form-control input-width-25 input-inline" name="ux_ddl_likebox_border_style[]" id="ux_txt_border_style_width" placeholder="<?php echo $fbl_border_width_placeholder; ?>" maxlength="3" value="<?php echo isset($likebox_border_style[0]) ? intval($likebox_border_style[0]) : 2 ?>" onblur="default_value_facebook_likebox('#ux_txt_border_style_width', 1);" onfocus="paste_only_digits_facebook_likebox(this.id);" disabled="disabled" >
                                                <select name="ux_ddl_likebox_border_style[]" id="ux_ddl_likebox_border" class="form-control input-width-27 input-inline" >
                                                    <option value="none"><?php echo $fbl_border_none; ?></option>
                                                    <option value="solid" disabled="disabled"><?php echo $fbl_border_solid; ?></option>
                                                    <option value="dashed" disabled="disabled"><?php echo $fbl_border_dashed; ?></option>
                                                    <option value="dotted" disabled="disabled"><?php echo $fbl_border_dotted ?></option>
                                                </select>
                                                <input type="text" class="form-control input-normal input-inline" name="ux_ddl_likebox_border_style[]" id="ux_txt_likebox_border_color" value="<?php echo isset($likebox_border_style[2]) ? esc_attr($likebox_border_style[2]) : "#e3e3e3" ?>" placeholder="<?php echo $fbl_border_color_placeholder; ?>" onblur="check_color_facebook_likebox('#ux_txt_likebox_border_color');" onfocus="facebook_likebox_colorpicker(this.id, this.value);" disabled="disabled">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $fbl_border_radius_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_border_radius_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true"><?php echo " ( " . $fbl_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <div class="input-icon right">
                                                <input type="text" class="form-control" name="ux_txt_border_radius" id="ux_txt_border_radius" placeholder="<?php echo $fbl_border_radius_placeholder; ?>" onblur="default_value_facebook_likebox('#ux_txt_border_radius', 0);" maxlength="3" value="<?php echo isset($likebox_data["border_radius"]) ? intval($likebox_data["border_radius"]) : "0" ?>" onfocus="paste_only_digits_facebook_likebox(this.id);" disabled="disabled">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="button" class="btn vivid-green" id="ux_preview_btn_add_likebox" name="ux_preview_btn_add_likebox"  value="<?php echo $fbl_preview ?>"  onclick='facebook_likebox_preview_likebox("facebook_likebox_preview", "<?php echo $facebook_likebox_preview_nonce ?>", "ux_frm_add_likebox", "0")'>
                                        <input type="submit" class="btn vivid-green" id="ux_btn_add_likebox" name="ux_btn_add_likebox" value="<?php echo $fbl_save_changes ?>">
                                    </div>
                                </div>
                        </form>
                    </div>
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
                    <a href="admin.php?page=facebook_manage_like_box">
                        <?php echo $fbl_like_box; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $fbl_add_like_box; ?>
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
                            <?php echo $fbl_add_like_box; ?>
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