<?php
/**
 * This File contains javascript code.
 *
 * @author  Tech Banker
 * @package facebook-likebox/includes
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
        </div>
        </div>
        </div>
        <div class="popup" data-popup="ux_open_popup_translator">
            <div class="popup-inner">
                <div class="portlet box vivid-green" style="margin-bottom:0px;">
                    <div class="portlet-title">
                        <div class="caption" id="ux_div_action">
        <?php echo $fbl_translation_request; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div id="ux_div_popup_header">
                            <form id="ux_frm_language_translator">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 popup-control">
                                            <div class="form-group">
                                                <label class="control-label">
        <?php echo $fbl_feature_requests_your_name; ?> :
                                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_popup_your_name_tooltip; ?>" data-placement="right"></i>
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="ux_txt_your_name" id="ux_txt_your_name" value="" placeholder="<?php echo $fbl_feature_requests_your_name_placeholder; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6 popup-control">
                                            <div class="form-group">
                                                <label class="control-label">
        <?php echo $fbl_feature_requests_your_email; ?> :
                                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_popup_your_email_tooltip; ?>" data-placement="right"></i>
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="ux_txt_email_address" id="ux_txt_email_address" value=""  placeholder="<?php echo $fbl_feature_requests_your_email_placeholder; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
        <?php echo $fbl_language_interested_to_translate; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_language_interested_to_translate_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="ux_txt_language" id="ux_txt_language"  value="" placeholder="<?php echo $fbl_language_interested_to_translate_placeholder; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">
        <?php echo $fbl_popup_query; ?> :
                                            <i class="icon-custom-question tooltips" data-original-title="<?php echo $fbl_popup_query_tooltip; ?>" data-placement="right"></i>
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <textarea class="form-control" name="ux_txtarea_query" id="ux_txtarea_query" rows="7" placeholder="<?php echo $fbl_popup_query_placeholder; ?>"><?php echo "Hi,\r\r\nI am interested in translating your plugin Facebook Likebox in my native language.\r\r\nPlease get back to me!\r\r\nThanks"; ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" data-popup-close-translator="ux_open_popup_translator" class="btn vivid-green" name="ux_btn_close" id="ux_btn_close" value="<?php echo $fbl_manage_backups_close; ?>">
                                    <input type="submit"  class="btn vivid-green" name="ux_btn_send_request" id="ux_btn_send_request" value="<?php echo $fbl_feature_requests_send_request; ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" data-popup="data-popup-likebox-preview">
            <div class="popup-likebox-preview">
                <div class="portlet box vivid-green" style="margin-bottom:0px !important;">
                    <div class="portlet-title">
                        <div class="caption" id="ux_div_likebox_preview">
                            < ?php echo $fbl_like_box_preview_title; ?>
                        </div>
                    </div>
                    <div id="ux_txt_likebox_css">
                        <div class="modal-body" id="ux_txt_likebox" style="overflow:hidden;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button"  class="btn vivid-green" data-popup-close-preview="data-popup-likebox-preview" name="ux_btn_close" id="ux_btn_close" value="Close" >
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".tooltips").tooltip_tip({placement: "right"});
            jQuery(".page-sidebar-tech-banker").on("click", "li > a", function (e)
            {
                var hasSubMenu = jQuery(this).next().hasClass("sub-menu");
                var parent = jQuery(this).parent().parent();
                var sidebar_menu = jQuery(".page-sidebar-menu-tech-banker");
                var sub = jQuery(this).next();
                var slideSpeed = parseInt(sidebar_menu.data("slide-speed"));
                parent.children("li.open").children(".sub-menu:not(.always-open)").slideUp(slideSpeed);
                parent.children("li.open").removeClass("open");
                var sidebar_close = parent.children("li.open").removeClass("open");
                if (sub.is(":visible"))
                {
                    jQuery(this).parent().removeClass("open");
                    sub.slideUp(slideSpeed);
                } else if (hasSubMenu)
                {
                    jQuery(this).parent().addClass("open");
                    sub.slideDown(slideSpeed);
                }
            });
            function load_sidebar_content_facebook_likebox()
            {
                var menus_height = jQuery(".page-sidebar-menu-tech-banker").height();
                var content_height = jQuery(".page-content").height() + 30;
                if (parseInt(menus_height) > parseInt(content_height))
                {
                    jQuery(".page-content").attr("style", "min-height:" + menus_height + "px")
                } else
                {
                    jQuery(".page-sidebar-menu-tech-banker").attr("style", "min-height:" + content_height + "px")
                }
            }

            function overlay_loading_facebook_likebox(control_id)
            {
                var overlay_opacity = jQuery("<div class=\"opacity_overlay\"></div>");
                jQuery("body").append(overlay_opacity);
                var overlay = jQuery("<div class=\"loader_opacity\"><div class=\"processing_overlay\"></div></div>");
                jQuery("body").append(overlay);
                if (control_id != undefined)
                {
                    var message = control_id;
                    var success = <?php echo json_encode($fbl_success); ?>;
                    var issuccessmessage = jQuery("#toast-container").exists();
                    if (issuccessmessage != true)
                    {
                        var shortCutFunction = jQuery("#manage_messages input:checked").val();
                        var $toast = toastr[shortCutFunction](message, success);
                    }
                }
            }
            // Close popup
            jQuery("[data-popup-close-translator]").on("click", function (e)
            {
                var confirm_close = confirm(<?php echo json_encode($fbl_confirm_close); ?>);
                if (confirm_close == true)
                {
                    var targeted_popup_class = jQuery(this).attr("data-popup-close-translator");
                    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
                }

                e.preventDefault();
            });
            function open_popup_facebook()
            {
                jQuery("[data-popup-open]").on("click", function (e)
                {
                    var targeted_popup_class = jQuery(this).attr("data-popup-open");
                    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                    e.preventDefault();
                });
                // Close popup
                jQuery("[data-popup-close]").on("click", function (e)
                {
                    var targeted_popup_class = jQuery(this).attr("data-popup-close");
                    jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                    e.preventDefault();
                });
                jQuery(document).keydown(function (e)
                {
                    // ESCAPE key pressed
                    if (e.keyCode == 27)
                    {
                        var targeted_popup_class = jQuery("[data-popup-close]").attr("data-popup-close");
                        jQuery('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
                    }
                });
            }
            var translation_request_array = [];
            var url = "<?php echo tech_banker_url . "/feedbacks.php"; ?>";
            var domain_url = "<?php echo site_url(); ?>";
            jQuery("#ux_frm_language_translator").validate
                    ({
                        rules:
                                {
                                    ux_txt_your_name:
                                            {
                                                required: true
                                            },
                                    ux_txt_email_address:
                                            {
                                                required: true,
                                                email: true
                                            },
                                    ux_txt_language:
                                            {
                                                required: true
                                            },
                                    ux_txtarea_query:
                                            {
                                                required: true
                                            }
                                },
                        errorPlacement: function (error, element)
                        {
                            var icon = jQuery(element).parent(".input-icon").children("i");
                            icon.removeClass("fa-check").addClass("fa-warning");
                            icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
                        },
                        highlight: function (element)
                        {
                            jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                        },
                        success: function (label, element)
                        {
                            var icon = jQuery(element).parent(".input-icon").children("i");
                            jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                            icon.removeClass("fa-warning").addClass("fa-check");
                        },
                        submitHandler: function (form)
                        {
                            translation_request_array.push(jQuery("#ux_txt_your_name").val());
                            translation_request_array.push(jQuery("#ux_txt_email_address").val());
                            translation_request_array.push(domain_url);
                            translation_request_array.push(jQuery("#ux_txt_language").val());
                            translation_request_array.push(jQuery("#ux_txtarea_query").val());
                            jQuery.post(url,
                                    {
                                        data: JSON.stringify(translation_request_array),
                                        param: "facebook_likebox_translation_request"
                                    },
                                    function (data)
                                    {
                                        overlay_loading_facebook_likebox(<?php echo json_encode($fbl_feature_request_message) ?>);
                                        setTimeout(function ()
                                        {
                                            remove_overlay_facebook_likebox();
                                            window.location.href = "admin.php?page=facebook_manage_like_box";
                                        }, 3000);
                                    });
                        }
                    });
            function show_pop_up_facebook()
            {
                open_popup_facebook();
            }
            jQuery(document).ready(function ()
            {
                show_pop_up_facebook();
            });
            function copy_clipboard_facebook_likebox()
            {
                var clipboard = new Clipboard(".icon-custom-docs");
                clipboard.on("success", function (e)
                {
                    var shortCutFunction = jQuery("#manage_messages input:checked").val();
                    var $toast = toastr[shortCutFunction](<?php echo json_encode($fbl_copied_successfully) ?>);
                });
                clipboard.on("error", function (e)
                {
                    var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                    var $toast = toastr[shortCutFunction](<?php echo json_encode($fbl_copied_failed); ?>);
                });
            }
            function remove_overlay_facebook_likebox()
            {
                jQuery(".loader_opacity").remove();
                jQuery(".opacity_overlay").remove();
            }
            function paste_only_digits_facebook_likebox(control_id)
            {
                jQuery("#" + control_id).on("paste keypress", function (e)
                {
                    var control = jQuery("#" + control_id);
                    setTimeout(function ()
                    {
                        control.val(control.val().replace(/[^0-9]/g, ""));
                    }, 5);
                });
            }
            function default_width_facebook_likebox(input)
            {
                if (input.value < 260)
                    input.value = 260;
                if (input.value > 500)
                    input.value = 500;
            }
            function check_opacity_facebook_likebox(input, value)
            {
                if (input.value < 0)
                    input.value = 0;
                if (input.value > 100)
                    input.value = 100;
                jQuery(input).val() == "" ? jQuery(input).val(value) : jQuery(input).val();
            }
            function default_height_facebook_likebox(input)
            {
                if (input.value < 70)
                    input.value = 70;
            }
            function default_value_facebook_likebox(id, value)
            {
                jQuery(id).val() == "" ? jQuery(id).val(value) : jQuery(id).val();
            }
            
          
            function default_popup_opacity_facebook_likebox(id, value)
            {
                jQuery(id).val() == "" ? jQuery(id).val(value) : jQuery(id).val();
            }
            function default_popup_color_facebook_likebox(id, value)
            {
                jQuery(id).val() == "" ? jQuery(id).val(value) : jQuery(id).val();
            }            
            function default_popup_time_interval(id, value)
            {
                jQuery(id).val() == "" ? jQuery(id).val(value) : jQuery(id).val();
            }
            function base64_encode_facebook_likebox(data)
            {
                var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                        ac = 0,
                        enc = "",
                        tmp_arr = [];
                if (!data)
                {
                    return data;
                }
                do
                {
                    o1 = data.charCodeAt(i++);
                    o2 = data.charCodeAt(i++);
                    o3 = data.charCodeAt(i++);
                    bits = o1 << 16 | o2 << 8 | o3;
                    h1 = bits >> 18 & 0x3f;
                    h2 = bits >> 12 & 0x3f;
                    h3 = bits >> 6 & 0x3f;
                    h4 = bits & 0x3f;
                    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
                } while (i < data.length);
                enc = tmp_arr.join("");
                var r = data.length % 3;
                return (r ? enc.slice(0, r - 3) : enc) + "===".slice(r || 3);
            }
            function facebook_likebox_colorpicker(id, value)
            {
                jQuery("#" + id).colpick
                        ({
                            layout: "hex",
                            colorScheme: "dark",
                            color: value,
                            onChange: function (hsb, hex, rgb, el, bySetColor)
                            {
                                if (!bySetColor)
                                    jQuery(el).val("#" + hex);
                            }
                        }).keyup(function ()
                {
                    jQuery(this).colpickSetColor("#" + this.value);
                });
            }
            function check_color_facebook_likebox(id)
            {
                jQuery(id).val() == "" ? jQuery(id).val("#3b5998") : jQuery(id).val();
            }
            function page_id_and_url_show_for_facebook_likebox()
            {
                if (jQuery("#ux_ddl_fb_likebox_source").val() == "page_url")
                {
                    jQuery("#ux_div_facebook_likebox_page_url").show();
                    jQuery("#ux_div_facebook_likebox_page_id").hide();
                } else
                {
                    jQuery("#ux_div_facebook_likebox_page_url").hide();
                    jQuery("#ux_div_facebook_likebox_page_id").show();
                }
            }
            function display_periodicity_facebook_likebox()
            {
                if (jQuery("#ux_ddl_popup_display_periodicity").val() == "onetime")
                {
                    jQuery("#ux_div_time_interval").css("display", "none");
                } else
                {
                    jQuery("#ux_div_time_interval").css("display", "block");
                }
            }
            function facebook_like_button_type_show_hide()
            {
                var button_type = jQuery("#ux_ddl_fb_button_type").val();
                var like = "";
                switch (button_type)
                {
                    case "like":
                        jQuery("#like_button_action").show();
                        jQuery("#facebook_likebox_share_button").show();
                        like += "<option value='standard'><?php echo $fbl_like_button_style_standard; ?></option>";
                        like += "<option value='button_count'><?php echo $fbl_like_button_style_count; ?></option>";
                        like += "<option value='box_count'><?php echo $fbl_like_button_style_box_count; ?></option>";
                        like += "<option value='button'><?php echo $fbl_button; ?></option>";
                        jQuery("#ux_ddl_like_button_style").html(like);
                        break;
                    case "follow":
                        jQuery("#like_button_action").hide();
                        jQuery("#facebook_likebox_share_button").hide();
                        like += "<option value='standard'><?php echo $fbl_like_button_style_standard; ?></option>";
                        like += "<option value='button_count'><?php echo $fbl_like_button_style_count; ?></option>";
                        like += "<option value='box_count'><?php echo $fbl_like_button_style_box_count; ?></option>";
                        like += "<option value='button'><?php echo $fbl_button; ?></option>";
                        jQuery("#ux_ddl_like_button_style").html(like);
                        break;
                    case "share":
                        jQuery("#like_button_action").hide();
                        jQuery("#facebook_likebox_share_button").hide();
                        like += "<option value='button_count'><?php echo $fbl_like_button_style_count; ?></option>";
                        like += "<option value='box_count'><?php echo $fbl_like_button_style_box_count; ?></option>";
                        like += "<option value='button'><?php echo $fbl_button; ?></option>";
                        jQuery("#ux_ddl_like_button_style").html(like);
                        break;
                }
            }
            function dataTable_for_facebook_likebox(id)
            {
                var oTable = jQuery(id).dataTable
                        ({
                            "pagingType": "full_numbers",
                            "language":
                                    {
                                        "emptyTable": "No data available in table",
                                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                        "infoEmpty": "No entries found",
                                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                                        "lengthMenu": "Show _MENU_ entries",
                                        "search": "Search:",
                                        "zeroRecords": "No matching records found"
                                    },
                            "bSort": true,
                            "pageLength": 10
                        });
                return oTable;
            }
            jQuery(document).ready(function ()
            {
                load_sidebar_content_facebook_likebox();
            });
            function delete_record_facebook_likebox(id, page_url, message)
            {
                var confirm_action = confirm(<?php echo json_encode($fbl_confirm_delete); ?>);
                if (confirm_action == true)
                {
                    jQuery.post(ajaxurl,
                            {
                                id: id,
                                param: "delete_facbook_likebox_module",
                                action: "facebook_likebox_backend",
                                _wp_nonce: "<?php echo isset($likebox_single_delete_nonce) ? $likebox_single_delete_nonce : ""; ?>"
                            },
                            function (data)
                            {
                                overlay_loading_facebook_likebox(message);
                                setTimeout(function ()
                                {
                                    remove_overlay_facebook_likebox();
                                    window.location.href = "admin.php?page=" + page_url;
                                }, 3000);
                            });
                }
            }
            function check_all_facebook_likebox(id)
            {
                if (jQuery("input:checked", oTable.fnGetFilteredNodes()).length == jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).length)
                {
                    jQuery("#" + id).attr("checked", "checked");
                } else
                {
                    jQuery("#" + id).removeAttr("checked");
                }
            }
            function check_all_chk_facebook_likebox(id)
            {
                jQuery(id).click(function ()
                {
                    jQuery("input[type=checkbox]", oTable.fnGetFilteredNodes()).attr("checked", this.checked);
                });
            }
            function facebook_likebox_preview_likebox(param, nonce, form_id, meta_id)
            {
                jQuery("[data-popup-close-preview],.popup").on("click", function (e)
                {
                    jQuery('[data-popup=data-popup-likebox-preview]').fadeOut(350);
                    e.preventDefault();
                });
                jQuery.post(ajaxurl,
                {
                    meta_id: meta_id,
                    data: base64_encode_facebook_likebox(jQuery("#" + form_id).serialize()),
                    param: param,
                    action: "facebook_likebox_preview",
                    _wp_nonce: nonce
                },
                function (data)
                {
                    jQuery("[data-popup='data-popup-likebox-preview']").fadeIn(350);
                    if (param == "facebook_likebox_preview")
                    {
                        jQuery("#ux_div_likebox_preview").text(<?php echo json_encode($fbl_like_box_preview_title) ?>);
                    }
                    else if (param == "facebook_likebutton_preview")
                    {
                        jQuery("#ux_div_likebox_preview").text(<?php echo json_encode($fbl_like_button_preview_title) ?>);
                    }
                    else if (param == "facebook_likebox_button_preview")
                    {
                        jQuery("#ux_div_likebox_preview").text(<?php echo json_encode($fbl_like_box_button_preview_title) ?>);
                    }
                    jQuery("#ux_txt_likebox").html(data);
                });
            }
            function premium_edition_notification_facebook_likebox()
            {
                var premium_edition = <?php echo json_encode($fbl_message_premium_edition); ?>;
                var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
                var $toast = toastr[shortCutFunction](premium_edition);
            }
        <?php
        $check_facebook_likebox_wizard = get_option("facebook-likebox-wizard-set-up");
        $fbl_page_url = $check_facebook_likebox_wizard == "" ? "facebook_likebox_wizard" : esc_attr($_GET["page"]);
        if (isset($_GET["page"])) {
            switch (esc_attr($fbl_page_url)) {
                case "facebook_likebox_wizard":
                    ?>
                        function show_hide_details_facebook_likebox()
                        {
                            if (jQuery("#ux_div_wizard_set_up").hasClass("wizard-set-up"))
                            {
                                jQuery("#ux_div_wizard_set_up").css("display", "none");
                                jQuery("#ux_div_wizard_set_up").removeClass("wizard-set-up");
                            } else
                            {
                                jQuery("#ux_div_wizard_set_up").css("display", "block");
                                jQuery("#ux_div_wizard_set_up").addClass("wizard-set-up");
                            }
                        }
                        function plugin_stats_facebook_likebox(type)
                        {
                            overlay_loading_facebook_likebox();
                            jQuery.post(ajaxurl,
                                    {
                                        type: type,
                                        param: "wizard_facebook_likebox",
                                        action: "facebook_likebox_backend",
                                        _wp_nonce: "<?php echo $facebook_likebox_check_status; ?>"
                                    },
                                    function (data)
                                    {
                                        remove_overlay_facebook_likebox();
                                        window.location.href = "admin.php?page=facebook_likebox";
                                    });
                        }
                    <?php
                    break;
                case "facebook_likebox":
                    ?>
                        jQuery("#ux_li_like_box").addClass("active");
                        jQuery("#ux_li_add_like_box").addClass("active");
                    <?php
                    if (like_box_facebook_likebox == "1") {
                        ?>
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_fb_likebox_source").val("<?php echo isset($likebox_data["likebox_source_type"]) ? esc_attr($likebox_data["likebox_source_type"]) : "page_url" ?>");
                                jQuery("#ux_ddl_likebox_language").val("<?php echo isset($likebox_data["language"]) ? esc_attr($likebox_data["language"]) : "en_GB" ?>");
                                jQuery("#ux_ddl_likebox_stream").val("<?php echo isset($likebox_data["post_stream"]) ? esc_attr($likebox_data["post_stream"]) : "timeline" ?>");
                                jQuery("#ux_ddl_likebox_events").val("<?php echo isset($likebox_data["events"]) ? esc_attr($likebox_data["events"]) : "events" ?>");
                                jQuery("#ux_ddl_likebox_messages").val("<?php echo isset($likebox_data["messages"]) ? esc_attr($likebox_data["messages"]) : "messages" ?>");
                                jQuery("#ux_ddl_likebox_header").val("<?php echo isset($likebox_data["header"]) ? esc_attr($likebox_data["header"]) : "false" ?>");
                                jQuery("#ux_ddl_likebox_cover_photo").val("<?php echo isset($likebox_data["cover_photo"]) ? esc_attr($likebox_data["cover_photo"]) : "false" ?>");
                                jQuery("#ux_ddl_likebox_animations_effects").val("<?php echo isset($likebox_data["animation_effect"]) ? esc_attr($likebox_data["animation_effect"]) : "none" ?>");
                                jQuery("#ux_ddl_likebox_border").val("<?php echo isset($likebox_border_style[1]) ? esc_attr($likebox_border_style[1]) : "none" ?>");
                                jQuery("#ux_ddl_likebox_user_faces").val("<?php echo isset($likebox_data["show_user_faces"]) ? esc_attr($likebox_data["show_user_faces"]) : "true" ?>");
                                page_id_and_url_show_for_facebook_likebox();
                            });
                            jQuery("#ux_frm_add_likebox").validate
                                    ({
                                        rules:
                                                {
                                                    ux_txt_likebox_page_url:
                                                            {
                                                                required: true,
                                                                url: true
                                                            },
                                                    ux_txt_likebox_page_id:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_likebox_title:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_likebox_width:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_border_radius:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_likebox_height:
                                                            {
                                                                required: true
                                                            }
                                                },
                                        errorPlacement: function (error, element)
                                        {
                                            var icon = jQuery(element).parent(".input-icon").children("i");
                                            icon.removeClass("fa-check").addClass("fa-warning");
                                            icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
                                        },
                                        highlight: function (element)
                                        {
                                            jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                        },
                                        success: function (label, element)
                                        {
                                            var icon = jQuery(element).parent(".input-icon").children("i");
                                            jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                            icon.removeClass("fa-warning").addClass("fa-check");
                                        },
                                        submitHandler: function (form)
                                        {
                                            overlay_loading_facebook_likebox(<?php echo isset($_REQUEST["meta_id"]) ? json_encode($fbl_likebox_update_success) : json_encode($fbl_likebox_saved_success); ?>);
                                            jQuery.post(ajaxurl,
                                                    {
                                                        meta_id: "<?php echo isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0 ?>",
                                                        data: base64_encode_facebook_likebox(jQuery("#ux_frm_add_likebox").serialize()),
                                                        param: "facebook_likebox_module",
                                                        action: "facebook_likebox_backend",
                                                        _wp_nonce: "<?php echo $fbl_add_likebox; ?>"
                                                    },
                                                    function (data)
                                                    {
                                                        setTimeout(function ()
                                                        {
                                                            remove_overlay_facebook_likebox();
                                                            window.location.href = "admin.php?page=facebook_manage_like_box";
                                                        }, 3000);
                                                    });
                                        }
                                    });
                            var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                            setTimeout(function ()
                            {
                                clearInterval(sidebar_load_interval);
                            }, 5000);
                        <?php
                    }
                    break;
                case "facebook_manage_like_box":
                    ?>
                        jQuery("#ux_li_like_box").addClass("active");
                        jQuery("#ux_li_manage_like_box").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (like_box_facebook_likebox == "1") {
                        ?>
                            copy_clipboard_facebook_likebox();
                            var oTable = dataTable_for_facebook_likebox("#ux_tbl_facebook_likebox");
                            check_all_chk_facebook_likebox("#ux_chk_facebook_all_user");
                            load_sidebar_content_facebook_likebox();
                        <?php
                    }
                    break;
                case "facebook_add_like_button":
                    ?>
                        jQuery("#ux_li_like_button").addClass("active");
                        jQuery("#ux_li_add_like_button").addClass("active");
                    <?php
                    if (like_button_facebook_likebox == "1") {
                        ?>
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_fb_button_type").val("<?php echo isset($like_button_data["button_type"]) ? esc_attr($like_button_data["button_type"]) : "like" ?>");
                                jQuery("#ux_ddl_fb_likebox_source").val("<?php echo isset($like_button_data["likebox_source_type"]) ? esc_attr($like_button_data["likebox_source_type"]) : "page_url" ?>");
                                jQuery("#ux_ddl_like_button_language").val("<?php echo isset($like_button_data["language"]) ? esc_attr($like_button_data["language"]) : "en_GB" ?>");
                                jQuery("#ux_ddl_like_button_action").val("<?php echo isset($like_button_data["action"]) ? esc_attr($like_button_data["action"]) : "like" ?>");
                                facebook_like_button_type_show_hide();
                                jQuery("#ux_ddl_like_button_style").val("<?php echo isset($like_button_data["button_style"]) ? esc_attr($like_button_data["button_style"]) : "standard" ?>");
                                jQuery("#ux_ddl_like_button_size").val("<?php echo isset($like_button_data["button_size"]) ? esc_attr($like_button_data["button_size"]) : "small" ?>");
                                jQuery("#ux_ddl_like_button_share_button").val("<?php echo isset($like_button_data["share_button"]) ? esc_attr($like_button_data["share_button"]) : "true" ?>");
                                page_id_and_url_show_for_facebook_likebox();
                            });
                            jQuery("#ux_frm_add_like_button").validate
                                    ({
                                        rules:
                                                {
                                                    ux_txt_like_button_page_url:
                                                            {
                                                                required: true,
                                                                url: true
                                                            },
                                                    ux_txt_like_button_page_id:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_like_button_title:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_like_button_width:
                                                            {
                                                                required: true
                                                            },
                                                },
                                        errorPlacement: function (error, element)
                                        {
                                            var icon = jQuery(element).parent(".input-icon").children("i");
                                            icon.removeClass("fa-check").addClass("fa-warning");
                                            icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
                                        },
                                        highlight: function (element)
                                        {
                                            jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                        },
                                        success: function (label, element)
                                        {
                                            var icon = jQuery(element).parent(".input-icon").children("i");
                                            jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                            icon.removeClass("fa-warning").addClass("fa-check");
                                        },
                                        submitHandler: function (form)
                                        {
                                            overlay_loading_facebook_likebox(<?php echo isset($_REQUEST["meta_id"]) ? json_encode($fbl_like_button_update_success) : json_encode($fbl_like_button_saved_success); ?>);
                                            jQuery.post(ajaxurl,
                                                    {
                                                        meta_id: "<?php echo isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0 ?>",
                                                        data: base64_encode_facebook_likebox(jQuery("#ux_frm_add_like_button").serialize()),
                                                        param: "facebook_like_button_module",
                                                        action: "facebook_likebox_backend",
                                                        _wp_nonce: "<?php echo $fbl_like_add_button; ?>"
                                                    },
                                                    function (data)
                                                    {
                                                        setTimeout(function ()
                                                        {
                                                            remove_overlay_facebook_likebox();
                                                            window.location.href = "admin.php?page=facebook_manage_like_button";
                                                        }, 3000);
                                                    });
                                        }
                                    });
                            var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                            setTimeout(function ()
                            {
                                clearInterval(sidebar_load_interval);
                            }, 5000);
                        <?php
                    }
                    break;
                case "facebook_manage_like_button":
                    ?>
                        jQuery("#ux_li_like_button").addClass("active");
                        jQuery("#ux_li_manage_like_button").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (like_button_facebook_likebox == "1") {
                        ?>
                            copy_clipboard_facebook_likebox();
                            var oTable = dataTable_for_facebook_likebox("#ux_tbl_facebook_button");
                            check_all_chk_facebook_likebox("#ux_chk_facebook_all_user");
                        <?php
                    }
                    break;
                case "facebook_add_sticky_like_box":
                    ?>
                        jQuery("#ux_li_sticky_like_box").addClass("active");
                        jQuery("#ux_li_add_sticky_like_box").addClass("active");
                    <?php
                    if (sticky_like_box_facebook_likebox == "1") {
                        ?>
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_fb_likebox_source").val("<?php echo isset($sticky_likebox_data["likebox_source_type"]) ? esc_attr($sticky_likebox_data["likebox_source_type"]) : "page_url" ?>");
                                jQuery("#ux_ddl_sticky_likebox_language").val("<?php echo isset($sticky_likebox_data["sticky_likebox_language"]) ? esc_attr($sticky_likebox_data["sticky_likebox_language"]) : "en_GB" ?>");
                                jQuery("#ux_ddl_border_style_thickness").val("<?php echo isset($sticky_likebox_border_style[1]) ? esc_attr($sticky_likebox_border_style[1]) : "solid" ?>");
                                jQuery("#ux_ddl_sticky_likebox_position").val("<?php echo isset($sticky_likebox_data["sticky_likebox_position"]) ? esc_attr($sticky_likebox_data["sticky_likebox_position"]) : "left" ?>");
                                jQuery("#ux_ddl_sticky_likebox_cover_photo").val("<?php echo isset($sticky_likebox_data["sticky_likebox_cover_photo"]) ? esc_attr($sticky_likebox_data["sticky_likebox_cover_photo"]) : "false" ?>");
                                jQuery("#ux_ddl_sticky_likebox_post_stream").val("<?php echo isset($sticky_likebox_data["sticky_likebox_post_stream"]) ? esc_attr($sticky_likebox_data["sticky_likebox_post_stream"]) : "timeline" ?>");
                                jQuery("#ux_ddl_sticky_likebox_events").val("<?php echo isset($sticky_likebox_data["sticky_likebox_events"]) ? esc_attr($sticky_likebox_data["sticky_likebox_events"]) : "events" ?>");
                                jQuery("#ux_ddl_sticky_likebox_messages").val("<?php echo isset($sticky_likebox_data["sticky_likebox_messages"]) ? esc_attr($sticky_likebox_data["sticky_likebox_messages"]) : "messages" ?>");
                                jQuery("#ux_ddl_sticky_likebox_show_faces").val("<?php echo isset($sticky_likebox_data["sticky_likebox_show_faces"]) ? esc_attr($sticky_likebox_data["sticky_likebox_show_faces"]) : "true" ?>");
                                jQuery("#ux_ddl_sticky_likebox_header").val("<?php echo isset($sticky_likebox_data["sticky_likebox_header"]) ? esc_attr($sticky_likebox_data["sticky_likebox_header"]) : "false" ?>");
                            });
                            jQuery("#ux_frm_add_sticky_likebox").validate
                                    ({
                                        submitHandler: function (form)
                                        {
                                            premium_edition_notification_facebook_likebox();
                                        }
                                    });
                            var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                            setTimeout(function ()
                            {
                                clearInterval(sidebar_load_interval);
                            }, 5000);
                        <?php
                    }
                    break;
                case "facebook_manage_sticky_like_box":
                    ?>
                        jQuery("#ux_li_sticky_like_box").addClass("active");
                        jQuery("#ux_li_manage_sticky_like_box").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (sticky_like_box_facebook_likebox == "1") {
                        ?>
                            copy_clipboard_facebook_likebox();
                            var oTable = dataTable_for_facebook_likebox("#ux_tbl_facebook_sticky_likebox");
                            check_all_chk_facebook_likebox("#ux_chk_facebook_all_user");
                        <?php
                    }
                    break;
                case "facebook_add_like_box_popup":
                    ?>
                        jQuery("#ux_li_like_box_popup").addClass("active");
                        jQuery("#ux_li_add_like_box_popup").addClass("active");
                    <?php
                    if (like_box_popup_facebook_likebox == "1") {
                        ?>
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_popup_display_periodicity").val("<?php echo isset($popup_likebox_data["display_periodicity"]) ? esc_attr($popup_likebox_data["display_periodicity"]) : "onetime" ?>");
                                jQuery("#ux_ddl_fb_likebox_source").val("<?php echo isset($popup_likebox_data["likebox_source_type"]) ? esc_attr($popup_likebox_data["likebox_source_type"]) : "page_url" ?>");
                                jQuery("#ux_ddl_popup_likebox_post_stream").val("<?php echo isset($popup_likebox_data["post_stream"]) ? esc_attr($popup_likebox_data["post_stream"]) : "timeline" ?>");
                                jQuery("#ux_ddl_popup_likebox_events").val("<?php echo isset($popup_likebox_data["events"]) ? esc_attr($popup_likebox_data["events"]) : "events" ?>");
                                jQuery("#ux_ddl_popup_likebox_messages").val("<?php echo isset($popup_likebox_data["messages"]) ? esc_attr($popup_likebox_data["messages"]) : "messages" ?>");
                                jQuery("#ux_ddl_popup_likebox_header").val("<?php echo isset($popup_likebox_data["header"]) ? esc_attr($popup_likebox_data["header"]) : "false" ?>");
                                jQuery("#ux_ddl_popup_likebox_cover_photo").val("<?php echo isset($popup_likebox_data["cover_photo"]) ? esc_attr($popup_likebox_data["cover_photo"]) : "false" ?>");
                                jQuery("#ux_ddl_border_style_thickness").val("<?php echo isset($likebox_border_style[1]) ? esc_attr($likebox_border_style[1]) : "solid" ?>");
                                jQuery("#ux_ddl_popup_likebox_show_faces").val("<?php echo isset($popup_likebox_data["show_faces"]) ? esc_attr($popup_likebox_data["show_faces"]) : "true" ?>");
                                jQuery("#ux_ddl_popup_likebox_language").val("<?php echo isset($popup_likebox_data["language"]) ? esc_attr($popup_likebox_data["language"]) : "en_GB" ?>");
                                page_id_and_url_show_for_facebook_likebox();
                                display_periodicity_facebook_likebox();
                            });
                            jQuery("#ux_frm_add_popup_likebox").validate
                                    ({
                                        submitHandler: function (form)
                                        {
                                            premium_edition_notification_facebook_likebox();
                                        }
                                    });
                            var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                            setTimeout(function ()
                            {
                                clearInterval(sidebar_load_interval);
                            }, 5000);
                        <?php
                    }
                    break;
                case "facebook_manage_like_box_popup":
                    ?>
                        jQuery("#ux_li_like_box_popup").addClass("active");
                        jQuery("#ux_li_manage_like_box_popup").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (like_box_popup_facebook_likebox == "1") {
                        ?>
                            copy_clipboard_facebook_likebox();
                            var oTable = dataTable_for_facebook_likebox("#ux_tbl_facebook_likebox_box_popup");
                            check_all_chk_facebook_likebox("#ux_chk_facebook_all_user");
                            load_sidebar_content_facebook_likebox();
                        <?php
                    }
                    break;
                case "facebook_add_like_box_and_button":
                    ?>
                        jQuery("#ux_li_like_box_and_button").addClass("active");
                        jQuery("#ux_li_add_like_box_and_button").addClass("active");
                    <?php
                    if (like_box_button_facebook_likebox == "1") {
                        ?>
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_fb_likebox_source").val("<?php echo isset($likebox_and_button_data_serialize["likebox_source_type"]) ? esc_attr($likebox_and_button_data_serialize["likebox_source_type"]) : "page_url" ?>");
                                jQuery("#ux_ddl_likebox_and_likebutton_language").val("<?php echo isset($likebox_and_button_data_serialize["language"]) ? esc_attr($likebox_and_button_data_serialize["language"]) : "en_GB" ?>");
                                jQuery("#ux_ddl_border_style_thickness").val("<?php echo isset($likebox_and_button_border_style[1]) ? esc_attr($likebox_and_button_border_style[1]) : "none"; ?>");
                                jQuery("#ux_ddl_likebox_and_button_cover_photo").val("<?php echo isset($likebox_and_button_data_serialize["cover_photo"]) ? esc_attr($likebox_and_button_data_serialize["cover_photo"]) : "false" ?>");
                                jQuery("#ux_ddl_fb_button_type").val("<?php echo isset($likebox_and_button_data_serialize["button_type"]) ? esc_attr($likebox_and_button_data_serialize["button_type"]) : "like" ?>");
                                facebook_like_button_type_show_hide();
                                jQuery("#ux_ddl_like_button_style").val("<?php echo isset($likebox_and_button_data_serialize["button_style"]) ? esc_attr($likebox_and_button_data_serialize["button_style"]) : "standard" ?>");
                                jQuery("#ux_ddl_likebox_and_button_show_faces").val("<?php echo isset($likebox_and_button_data_serialize["show_user_faces"]) ? esc_attr($likebox_and_button_data_serialize["show_user_faces"]) : "true" ?>");
                                jQuery("#ux_ddl_likebox_and_button_post").val("<?php echo isset($likebox_and_button_data_serialize["post_stream"]) ? esc_attr($likebox_and_button_data_serialize["post_stream"]) : "timeline" ?>");
                                jQuery("#ux_ddl_likebox_and_button_events").val("<?php echo isset($likebox_and_button_data_serialize["events"]) ? esc_attr($likebox_and_button_data_serialize["events"]) : "events" ?>");
                                jQuery("#ux_ddl_likebox_and_button_messages").val("<?php echo isset($likebox_and_button_data_serialize["messages"]) ? esc_attr($likebox_and_button_data_serialize["messages"]) : "messages" ?>");
                                jQuery("#ux_ddl_likebox_and_button_header").val("<?php echo isset($likebox_and_button_data_serialize["header"]) ? esc_attr($likebox_and_button_data_serialize["header"]) : "false" ?>");
                                jQuery("#ux_ddl_likebox_and_button_size").val("<?php echo isset($likebox_and_button_data_serialize["button_size"]) ? esc_attr($likebox_and_button_data_serialize["button_size"]) : "small" ?>");
                                jQuery("#ux_ddl_like_box_button_action").val("<?php echo isset($likebox_and_button_data_serialize["action"]) ? esc_attr($likebox_and_button_data_serialize["action"]) : "like" ?>");
                                jQuery("#ux_ddl_like_button_box_share_button").val("<?php echo isset($likebox_and_button_data_serialize["share_button"]) ? esc_attr($likebox_and_button_data_serialize["share_button"]) : "true" ?>");
                                jQuery("#ux_ddl_likebox_button_animations_effects").val("<?php echo isset($likebox_and_button_data_serialize["animation_effect"]) ? esc_attr($likebox_and_button_data_serialize["animation_effect"]) : "none" ?>");
                                page_id_and_url_show_for_facebook_likebox();
                            });
                            jQuery("#ux_frm_add_likebox_and_button").validate
                                    ({
                                        rules:
                                                {
                                                    ux_txt_likebox_and_button_page_url:
                                                            {
                                                                required: true,
                                                                url: true
                                                            },
                                                    ux_txt_likebox_and_button_page_id:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_likebox_and_button_title:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_likebox_and_button_width:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_likebox_and_button_height:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_border_style_width:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_border_style_color:
                                                            {
                                                                required: true
                                                            },
                                                    ux_txt_border_radius:
                                                            {
                                                                required: true
                                                            }
                                                },
                                        errorPlacement: function (error, element)
                                        {
                                            var icon = jQuery(element).parent(".input-icon").children("i");
                                            icon.removeClass("fa-check").addClass("fa-warning");
                                            icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
                                        },
                                        highlight: function (element)
                                        {
                                            jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                        },
                                        success: function (label, element)
                                        {
                                            var icon = jQuery(element).parent(".input-icon").children("i");
                                            jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                            icon.removeClass("fa-warning").addClass("fa-check");
                                        },
                                        submitHandler: function (form)
                                        {
                                            overlay_loading_facebook_likebox(<?php echo!isset($_REQUEST["meta_id"]) ? json_encode($fbl_likebox_and_button_saved) : json_encode($fbl_likebox_and_button_update_success); ?>);
                                            jQuery.post(ajaxurl,
                                                    {
                                                        id: "<?php echo isset($_REQUEST["meta_id"]) ? intval($_REQUEST["meta_id"]) : 0; ?>",
                                                        data: base64_encode_facebook_likebox(jQuery("#ux_frm_add_likebox_and_button").serialize()),
                                                        param: "facebook_likebox_and_button_module",
                                                        action: "facebook_likebox_backend",
                                                        _wp_nonce: "<?php echo $fbl_add_likebox_and_button_nonce; ?>"
                                                    },
                                                    function (data)
                                                    {
                                                        setTimeout(function ()
                                                        {
                                                            remove_overlay_facebook_likebox();
                                                            window.location.href = "admin.php?page=facebook_manage_like_box_and_button";
                                                        }, 3000);
                                                    });
                                        }
                                    });
                            var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                            setTimeout(function ()
                            {
                                clearInterval(sidebar_load_interval);
                            }, 5000);
                        <?php
                    }
                    break;
                case "facebook_manage_like_box_and_button":
                    ?>
                        jQuery("#ux_li_like_box_and_button").addClass("active");
                        jQuery("#ux_li_manage_like_box_and_button").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (like_box_button_facebook_likebox == "1") {
                        ?>
                            copy_clipboard_facebook_likebox();
                            var oTable = dataTable_for_facebook_likebox("#ux_tbl_facebook_likebox_box_button");
                            check_all_chk_facebook_likebox("#ux_chk_all_likebox");
                        <?php
                    }
                    break;
                case "facebook_likebox_general_settings":
                    ?>
                        jQuery("#ux_li_general_settings").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                        jQuery(document).ready(function ()
                        {
                            open_popup_facebook();
                        });
                    <?php
                    if (general_settings_facebook_likebox == "1") {
                        ?>
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_general_settings_table_remove_table").val("<?php echo isset($general_settings_data["remove_tables_uninstall"]) ? esc_attr($general_settings_data["remove_tables_uninstall"]) : "disable"; ?>");
                            });
                            jQuery("#ux_frm_general_settings").validate
                                    ({
                                        submitHandler: function (form)
                                        {
                                            overlay_loading_facebook_likebox(<?php echo json_encode($fbl_update_general_settings); ?>);
                                            jQuery.post(ajaxurl,
                                                    {
                                                        data: base64_encode_facebook_likebox(jQuery("#ux_frm_general_settings").serialize()),
                                                        param: "general_settings_module",
                                                        action: "facebook_likebox_backend",
                                                        _wp_nonce: "<?php echo $likebox_general_settings_nonce; ?>"
                                                    },
                                                    function (data)
                                                    {
                                                        setTimeout(function ()
                                                        {
                                                            remove_overlay_facebook_likebox();
                                                            window.location.href = "admin.php?page=facebook_likebox_general_settings";
                                                        }, 3000);
                                                    });
                                        }
                                    });
                        <?php
                    }
                    break;
                case "facebook_likebox_roles_and_capabilities":
                    ?>
                        jQuery("#ux_li_roles_and_capabilities").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (roles_and_capability_facebook_likebox == "1") {
                        ?>
                            function show_roles_facebook_likebox(id, div_id)
                            {
                                if (jQuery(id).prop("checked"))
                                {
                                    jQuery("#" + div_id).css("display", "block");
                                } else
                                {
                                    jQuery("#" + div_id).css("display", "none");
                                }
                            }
                            function full_control_facebook_likebox(id, div_id)
                            {
                                var checkbox_id = jQuery(id).prop("checked");
                                jQuery("#" + div_id + " input[type=checkbox]").each(function ()
                                {
                                    if (checkbox_id)
                                    {
                                        jQuery(this).attr("checked", "checked");
                                        if (jQuery(id).attr("id") != jQuery(this).attr("id"))
                                        {
                                            jQuery(this).attr("disabled", "disabled");
                                        }
                                    } else
                                    {
                                        if (jQuery(id).attr("id") != jQuery(this).attr("id"))
                                        {
                                            jQuery(this).removeAttr("disabled");
                                            jQuery("#ux_chk_other_capabilities_manage_options").attr("disabled", "disabled");
                                            jQuery("#ux_chk_other_capabilities_read").attr("disabled", "disabled");
                                        }
                                    }
                                });
                            }
                            jQuery(document).ready(function ()
                            {
                                jQuery("#ux_ddl_settings").val("<?php echo isset($roles_and_capabilities_data["show_top_bar_menu"]) ? esc_attr($roles_and_capabilities_data["show_top_bar_menu"]) : ""; ?>");
                                show_roles_facebook_likebox("#ux_chk_author", "ux_div_author_roles");
                                full_control_facebook_likebox("#ux_chk_full_control_author", "ux_div_author_roles");
                                show_roles_facebook_likebox("#ux_chk_editor", "ux_div_editor_roles");
                                full_control_facebook_likebox("#ux_chk_full_control_editor", "ux_div_editor_roles");
                                show_roles_facebook_likebox("#ux_chk_contributor", "ux_div_contributor_roles");
                                full_control_facebook_likebox("#ux_chk_full_control_contributor", "ux_div_contributor_roles");
                                show_roles_facebook_likebox("#ux_chk_subscriber", "ux_div_subscriber_roles");
                                full_control_facebook_likebox("#ux_chk_full_control_subscriber", "ux_div_subscriber_roles");
                                show_roles_facebook_likebox("#ux_chk_others_privileges", "ux_div_other_privileges_roles");
                                full_control_facebook_likebox("#ux_chk_full_control_other_privileges_roles", "ux_div_other_privileges_roles");
                                full_control_facebook_likebox("#ux_chk_full_control_other_roles", "ux_div_other_roles");
                            });
                            jQuery("#ux_frm_roles_and_capabilities").validate
                                    ({
                                        submitHandler: function (form)
                                        {
                                            premium_edition_notification_facebook_likebox();
                                        }
                                    });
                        <?php
                    }
                    break;
                case "facebook_likebox_feature_request":
                    ?>
                        jQuery("#ux_li_feature_request").addClass("active");
                        var fbl_feature_request_array = [];
                        var url = "<?php echo tech_banker_url . "/feedbacks.php"; ?>";
                        var domain_url = "<?php echo site_url(); ?>";
                        jQuery("#ux_frm_feature_request").validate
                                ({
                                    rules:
                                            {
                                                ux_txt_your_name:
                                                        {
                                                            required: true,
                                                        },
                                                ux_txt_email_address:
                                                        {
                                                            required: true,
                                                            email: true
                                                        },
                                                ux_txtarea_feature_request:
                                                        {
                                                            required: true,
                                                        }
                                            },
                                    errorPlacement: function (error, element)
                                    {
                                        var icon = jQuery(element).parent(".input-icon").children("i");
                                        icon.removeClass("fa-check").addClass("fa-warning");
                                        icon.attr("data-original-title", error.text()).tooltip_tip({"container": "body"});
                                    },
                                    highlight: function (element)
                                    {
                                        jQuery(element).closest(".form-group").removeClass("has-success").addClass("has-error");
                                    },
                                    success: function (label, element)
                                    {
                                        var icon = jQuery(element).parent(".input-icon").children("i");
                                        jQuery(element).closest(".form-group").removeClass("has-error").addClass("has-success");
                                        icon.removeClass("fa-warning").addClass("fa-check");
                                    },
                                    submitHandler: function (form)
                                    {
                                        fbl_feature_request_array.push(jQuery("#ux_txt_your_name").val(), jQuery("#ux_txt_email_address").val(), domain_url, jQuery("#ux_txtarea_feature_request").val());
                                        overlay_loading_facebook_likebox(<?php echo json_encode($fbl_feature_request_message); ?>)
                                        jQuery.post(url,
                                                {
                                                    data: JSON.stringify(fbl_feature_request_array),
                                                    param: "facebook_likebox_feature_request"
                                                },
                                                function (data)
                                                {
                                                    setTimeout(function ()
                                                    {
                                                        remove_overlay_facebook_likebox();
                                                        window.location.href = "admin.php?page=facebook_likebox_feature_request";
                                                    }, 3000);
                                                });
                                    }
                                });
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    break;
                case "facebook_likebox_system_information":
                    ?>
                        jQuery("#ux_li_system_information").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                        setTimeout(function ()
                        {
                            clearInterval(sidebar_load_interval);
                        }, 5000);
                    <?php
                    if (system_information_facebook_likebox == "1") {
                        ?>
                            jQuery.getSystemReport = function (strDefault, stringCount, string, location)
                            {
                                var o = strDefault.toString();
                                if (!string)
                                {
                                    string = "0";
                                }
                                while (o.length < stringCount)
                                {
                                    if (location == "undefined")
                                    {
                                        o = string + o;
                                    } else
                                    {
                                        o = o + string;
                                    }
                                }
                                return o;
                            };
                            jQuery(".system-report").click(function ()
                            {
                                var report = "";
                                jQuery(".custom-form-body").each(function ()
                                {
                                    jQuery("h3.form-section", jQuery(this)).each(function ()
                                    {
                                        report = report + "\n### " + jQuery.trim(jQuery(this).text()) + " ###\n\n";
                                    });
                                    jQuery("tbody > tr", jQuery(this)).each(function ()
                                    {
                                        var the_name = jQuery.getSystemReport(jQuery.trim(jQuery(this).find("strong").text()), 25, " ");
                                        var the_value = jQuery.trim(jQuery(this).find("span").text());
                                        var value_array = the_value.split(", ");
                                        if (value_array.length > 1)
                                        {
                                            var temp_line = "";
                                            jQuery.each(value_array, function (key, line)
                                            {
                                                var tab = (key == 0) ? 0 : 25;
                                                temp_line = temp_line + jQuery.getSystemReport("", tab, " ", "f") + line + "\n";
                                            });
                                            the_value = temp_line;
                                        }
                                        report = report + "" + the_name + the_value + "\n";
                                    });
                                });
                                try
                                {
                                    jQuery("#ux_system_information").slideDown();
                                    jQuery("#ux_system_information textarea").val(report).focus().select();
                                    return false;
                                } catch (e)
                                {
                                    console.log(e);
                                }
                                return false;
                            });
                            jQuery("#ux_btn_system_information").click(function ()
                            {
                                if (jQuery("#ux_btn_system_information").text() == "Close System Information!")
                                {
                                    jQuery("#ux_system_information").slideUp();
                                    jQuery("#ux_btn_system_information").html("Get System Information!");
                                } else
                                {
                                    jQuery("#ux_btn_system_information").html("Close System Information!");
                                    jQuery("#ux_btn_system_information").removeClass("system-information");
                                    jQuery("#ux_btn_system_information").addClass("close-information");
                                }
                            });
                        <?php
                    }
                    break;
                case "facebook_likebox_error_logs":
                    ?>
                        jQuery("#ux_li_error_logs").addClass("active");
                    <?php
                    break;
                case "facebook_likebox_upgrade":
                    ?>
                        jQuery("#ux_li_upgrade").addClass("active");
                        var sidebar_load_interval = setInterval(load_sidebar_content_facebook_likebox, 1000);
                    <?php
                    break;
            }
        }
        ?>
        </script>
        <?php
    }
}