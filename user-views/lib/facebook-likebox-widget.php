<?php
/**
 * This File contains frontend likebox Widget.
 *
 * @author Tech Banker
 * @package facebook-likebox-business-edition/user-views/lib
 * @version 2.1.0
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
        $facebook_likebox_widget_nonce = wp_create_nonce("facebook_likebox_widget_nonce");
        ?>
        <div style="margin-top:10px;margin-bottom:10px;">
            <label for="<?php echo $this->get_field_id("ux_ddl_likebox_title"); ?>"><?php echo $fbl_select_title ?></label> :
            <select class="facebook_likebox_widget_title" id="<?php echo $this->get_field_id("ux_ddl_likebox_title"); ?>" name="<?php echo $this->get_field_name("ux_ddl_likebox_title"); ?>" style="width:100%;">
                <option value=""><?php echo $fbl_select_title; ?></option>
            </select>
        </div>
        <script>
            function facebook_widget_likebox_type(control, nonce)
            {
                jQuery.post(ajaxurl,
                        {
                            type: control,
                            param: "facebook_likebox_widget_module",
                            action: "facebook_likebox_frontend_ajax_call",
                            _wp_nonce: nonce
                        },
                        function (data)
                        {
                            if (data == "")
                            {
                                jQuery(".facebook_likebox_widget_title").html("<option value=\"\"><?php echo $fbl_select_title; ?></option>");
                            } else
                            {
                                jQuery(".facebook_likebox_widget_title").html(data);
                            }
                        });
            }
            facebook_widget_likebox_type("add_like_box_settings", "<?php echo isset($facebook_likebox_widget_nonce) ? $facebook_likebox_widget_nonce : ""; ?>");
        </script>
        <?php
    }
}