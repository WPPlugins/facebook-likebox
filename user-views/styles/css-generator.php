<?php
/**
 * This File contains frontend css.
 *
 * @author Tech Banker
 * @package facebook-likebox/user-views/styles
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
?>
<style>
<?php
if (isset($case_type)) {
    switch ($case_type) {
        case "like_box":
            $border_style = isset($fbl_unserialized_data["border_style"]) ? explode(",", esc_attr($fbl_unserialized_data["border_style"])) : "";
            ?>
                .iframe_class_<?php echo $unique_id; ?>
                {
                    border: <?php echo isset($border_style[0]) ? intval($border_style[0]) : ""; ?>px <?php echo isset($border_style[1]) ? esc_attr($border_style[1]) : ""; ?> <?php echo isset($border_style[2]) ? esc_attr($border_style[2]) : ""; ?> !important;
                    width: <?php echo isset($fbl_unserialized_data["width"]) ? intval($fbl_unserialized_data["width"]) : ""; ?>px !important;
                    height: <?php echo isset($fbl_unserialized_data["height"]) ? intval($fbl_unserialized_data["height"]) : ""; ?>px !important;
                    border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    -webkit-border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    -moz-border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    -o-border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    overflow: hidden !important;
                }
            <?php
            break;

        case "like_button":
            $border_style = isset($fbl_unserialized_data["border_style"]) ? explode(",", esc_attr($fbl_unserialized_data["border_style"])) : "";
            ?>
                .facebook_like_button_container_<?php echo $unique_id; ?>
                {
                    max-width: <?php echo isset($fbl_unserialized_data["width"]) ? intval($fbl_unserialized_data["width"]) : ""; ?>px !important;
                    padding: 5px !important;
                    overflow: hidden !important;
                }
                .like-button_<?php echo $unique_id; ?>
                {
                    width: <?php echo intval($fbl_unserialized_data["width"]); ?>px;
                }
                .facebook_like_button_container_<?php echo $unique_id; ?>,
                .like-button_<?php echo $unique_id; ?>
                {
            <?php
            if (esc_attr($fbl_unserialized_data["button_size"]) == "large" && esc_attr($fbl_unserialized_data["button_style"]) == "box_count") {
                ?>
                        height: 100px !important;
                <?php
            } else {
                ?>
                        height: 70px !important;
                <?php
            }
            ?>
                }
            <?php
            break;
        case "like_box_button":
            $border_style = isset($fbl_unserialized_data["border_style"]) ? explode(",", esc_attr($fbl_unserialized_data["border_style"])) : "";
            ?>
                #like_box_button_container_<?php echo $unique_id; ?>
                {
                    max-width: <?php echo isset($fbl_unserialized_data["width"]) ? intval($fbl_unserialized_data["width"]) : ""; ?>px !important;
                    border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    -webkit-border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    -moz-border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    -o-border-radius: <?php echo isset($fbl_unserialized_data["border_radius"]) ? intval($fbl_unserialized_data["border_radius"]) : ""; ?>px !important;
                    border: <?php echo isset($border_style[0]) ? intval($border_style[0]) : ""; ?>px <?php echo isset($border_style[1]) ? esc_attr($border_style[1]) : ""; ?> <?php echo isset($border_style[2]) ? esc_attr($border_style[2]) : ""; ?> !important;
                    z-index: 0 !important;
                    overflow: hidden !important;
                }
                .iframe_class_<?php echo $unique_id; ?>
                {
                    width: <?php echo intval($fbl_unserialized_data["width"]) ?>px;
                    height: <?php echo intval($fbl_unserialized_data["height"]) ?>px;
                }
                .iframe_like_button_<?php echo $unique_id; ?>
                {
                    width: <?php echo intval($fbl_unserialized_data["width"]); ?>px;
                }
            <?php
            if (esc_attr($fbl_unserialized_data["button_size"]) == "large" && esc_attr($fbl_unserialized_data["button_style"]) == "box_count") {
                ?>
                    .like-button-div
                    {
                        height: 100px;
                        padding: 5px;
                    }
                <?php
            } else {
                ?>
                    .like-button-div
                    {
                        height: 70px;
                        padding: 5px;
                    }
                <?php
            }
            break;
    }
}

if (isset($display_type)) {
    switch ($display_type) {
        case "like box":
            ?>
                .iframe_class_<?php echo $unique_id; ?>
                {
                    border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    -webkit-border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    -moz-border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    -o-border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    border: <?php echo isset($border_width) ? $border_width : ""; ?>px <?php echo isset($border_style) ? $border_style : ""; ?> <?php echo isset($border_color) ? $border_color : ""; ?> !important;
                    z-index: 0 !important;
                    overflow: hidden !important;
                }
            <?php
            break;

        case "like box button":
            ?>
                .facebook_like_box_button_container_<?php echo $unique_id; ?>
                {
                    border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    -webkit-border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    -moz-border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    -o-border-radius: <?php echo isset($border_radius) ? $border_radius : ""; ?>px !important;
                    border: <?php echo isset($border_width) ? $border_width : ""; ?>px <?php echo isset($border_style) ? $border_style : ""; ?> <?php echo isset($border_color) ? $border_color : ""; ?> !important;
                    z-index: 0 !important;
                    overflow: hidden !important;
                }
            <?php
            break;
    }
}
?>
</style>