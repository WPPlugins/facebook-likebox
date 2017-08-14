<?php
/**
 * This File contains Frontend javascript code.
 *
 * @author Tech Banker
 * @package facebook-likebox/user-views/includes
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
?>
<script type="text/javascript">
    jQuery(".tooltips").tooltip_tip({placement: "right"});
    var ajaxurl = "<?php echo admin_url("admin-ajax.php"); ?>";

    jQuery("[data-media-popup-close]").on("click", function (e)
    {
        jQuery("[data-popup=ux_open_popup_media_button]").fadeOut(350);
        e.preventDefault();
    });
    function show_pop_up_facebook_likebox()
    {
        jQuery("[data-media-popup-open]").on("click", function (e)
        {
            jQuery("[data-popup=ux_open_popup_media_button]").fadeIn(350);
            e.preventDefault();
        });
    }
    function like_box_type()
    {
        var like_box_type_data = jQuery("#ux_ddl_layout_likebox").val();
        jQuery.post(ajaxurl,
                {
                    type: like_box_type_data,
                    param: "facebook_likebox_shortcode_module",
                    action: "facebook_likebox_frontend_ajax_call",
                    _wp_nonce: "<?php echo isset($facebook_likebox_shortcode_nonce) ? $facebook_likebox_shortcode_nonce : ""; ?>"
                },
                function (data)
                {
                    jQuery("#ux_ddl_layout_title").html(data);
                });
    }
    function insert_like_box()
    {
        var value = jQuery("#ux_ddl_layout_likebox").val();
        var fbl_id = jQuery("#ux_ddl_layout_title").val();
        var case_type = "";
        switch (value)
        {
            case "add_like_box_settings":
                case_type = "like_box";
                break;
            case "add_like_button_settings":
                case_type = "like_button";
                break;
            case "like_box_and_button_settings":
                case_type = "like_box_button";
                break;
        }
        var shortcode = "[facebook_likebox case_type=\"" + case_type + "\" " + "fbl_id=\"" + fbl_id + "\"][/facebook_likebox]";
        if (window.CKEDITOR)
        {
            CKEDITOR.instances["content"].insertHtml(shortcode + "\r\n");
        } else
        {
            window.send_to_editor(shortcode + "\r\n");
        }
        jQuery("[data-popup=ux_open_popup_media_button]").fadeOut(350);
    }
    function fbl_validate_fields()
    {
        var likebox_type = jQuery("#ux_ddl_layout_likebox").val();
        var likebox = jQuery("#ux_ddl_layout_title").val();
        if (likebox_type == "")
        {
            var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
            toastr[shortCutFunction](<?php echo json_encode($fbl_choose_likebox_type); ?>);
            return;
        } else
        {
            like_box_type();
        }
        if (likebox == "")
        {
            var shortCutFunction = jQuery("#toastTypeGroup_error input:checked").val();
            toastr[shortCutFunction](<?php echo json_encode($fbl_choose_likebox); ?>);
            return;
        }
        insert_like_box();
    }
    jQuery(document).ready(function ()
    {
        show_pop_up_facebook_likebox();
    });
</script>