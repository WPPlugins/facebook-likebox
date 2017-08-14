<?php
/**
 * This File displays Facebook likebox in frontend.
 *
 * @author Tech Banker
 * @package facebook-likebox/user-views/views
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // Exit if accessed directly
if (isset($case_type)) {
    switch ($case_type) {
        case "like_box" :
            $source = esc_attr($fbl_unserialized_data["likebox_source_type"]) == "page_id" ? "http://www.facebook.com/" . $fbl_unserialized_data["page_id"] : esc_attr($fbl_unserialized_data["page_url"]);
            $url = urlencode($source);
            $post_stream = esc_attr($fbl_unserialized_data["post_stream"]);
            $events = esc_attr($fbl_unserialized_data["events"]);
            $messages = esc_attr($fbl_unserialized_data["messages"]);
            $iframe_src = "https://www.facebook.com/plugins/page.php?href=";
            $iframe_src .= $url;
            $iframe_src .= "&tabs=$post_stream,$events,$messages";
            $iframe_src .= "&width=" . esc_attr($fbl_unserialized_data["width"]);
            $iframe_src .= "&height=" . esc_attr($fbl_unserialized_data["height"]);
            $iframe_src .= "&small_header=" . esc_attr($fbl_unserialized_data['header']);
            $iframe_src .= "&adapt_container_width=true";
            $iframe_src .= "&hide_cover=" . esc_attr($fbl_unserialized_data["cover_photo"]);
            $iframe_src .= "&locale=" . esc_attr($fbl_unserialized_data["language"]);
            $iframe_src .= "&show_facepile=" . esc_attr($fbl_unserialized_data["show_user_faces"]);
            ?>
            <div class="fbl_animation_time <?php echo esc_attr($fbl_unserialized_data["animation_effect"]); ?>">
                <iframe class="iframe_class_<?php echo $unique_id; ?>" src="<?php echo $iframe_src; ?>" scrolling="no" frameborder="0" allowTransparency="true">
                </iframe>
            </div>
            <?php
            break;

        case "like_button":
            $source = esc_attr($fbl_unserialized_data["likebox_source_type"]) == "page_id" ? "http://www.facebook.com/" . esc_attr($fbl_unserialized_data["page_id"]) : esc_attr($fbl_unserialized_data["page_url"]);
            $url = urlencode($source);
            $button_type = "";
            switch ($fbl_unserialized_data["button_type"]) {
                case "like":
                    $button_type = "like";
                    break;
                case "follow":
                    $button_type = "follow";
                    break;
                case "share":
                    $button_type = "share_button";
                    break;
            }
            $button_src = "https://www.facebook.com/plugins/$button_type.php?href=";
            $button_src .= $url;
            $button_src .= "&width=" . esc_attr($fbl_unserialized_data["width"]);
            $button_src .= "&layout=" . esc_attr($fbl_unserialized_data["button_style"]);
            $button_src .= "&action=" . esc_attr($fbl_unserialized_data["action"]);
            $button_src .= "&size=" . esc_attr($fbl_unserialized_data["button_size"]);
            $button_src .= "&share=" . esc_attr($fbl_unserialized_data["share_button"]);
            $button_src .= "&locale=" . esc_attr($fbl_unserialized_data["language"]);
            ?>
            <div class="facebook_like_button_container_<?php echo $unique_id; ?>">
                <iframe class="like-button_<?php echo $unique_id; ?>" src="<?php echo $button_src ?>" frameborder="0" allowTransparency="true"></iframe>
            </iframe>
            </div>
            <?php
            break;

        case "like_box_button":
            $source = esc_attr($fbl_unserialized_data["likebox_source_type"]) == "page_id" ? "http://www.facebook.com/" . $fbl_unserialized_data["page_id"] : esc_attr($fbl_unserialized_data["page_url"]);
            $url = urlencode($source);
            $post_stream = esc_attr($fbl_unserialized_data["post_stream"]);
            $events = esc_attr($fbl_unserialized_data["events"]);
            $messages = $fbl_unserialized_data["messages"];
            $iframe_src = "https://www.facebook.com/plugins/page.php?href=";
            $iframe_src .= $url;
            $iframe_src .= "&tabs=$post_stream,$events,$messages";
            $iframe_src .= "&width=" . esc_attr($fbl_unserialized_data["width"]);
            $iframe_src .= "&height=" . esc_attr($fbl_unserialized_data["height"]);
            $iframe_src .= "&small_header=" . esc_attr($fbl_unserialized_data['header']);
            $iframe_src .= "&adapt_container_width=true";
            $iframe_src .= "&hide_cover=" . esc_attr($fbl_unserialized_data["cover_photo"]);
            $iframe_src .= "&locale=" . esc_attr($fbl_unserialized_data["language"]);
            $iframe_src .= "&show_facepile=" . esc_attr($fbl_unserialized_data["show_user_faces"]);
            ?>
            <div id="like_box_button_container_<?php echo $unique_id; ?>" class="fbl_animation_time <?php echo esc_attr($fbl_unserialized_data["animation_effect"]); ?>">
                <iframe class="iframe_class_<?php echo $unique_id; ?>" src="<?php echo $iframe_src; ?>" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                <?php
                $button_type = "";
                switch (esc_attr($fbl_unserialized_data["button_type"])) {
                    case "like":
                        $button_type = "like";
                        break;
                    case "follow":
                        $button_type = "follow";
                        break;
                    case "share":
                        $button_type = "share_button";
                        break;
                }
                $like_button_src = "https://www.facebook.com/plugins/$button_type.php?href=";
                $like_button_src .= $url;
                $like_button_src .= "&width=" . esc_attr($fbl_unserialized_data["width"]);
                $like_button_src .= "&layout=" . esc_attr($fbl_unserialized_data["button_style"]);
                $like_button_src .= "&size=" . esc_attr($fbl_unserialized_data["button_size"]);
                $like_button_src .= "&locale=" . esc_attr($fbl_unserialized_data["language"]);
                $like_button_src .= "&action=" . esc_attr($fbl_unserialized_data["action"]);
                $like_button_src .= "&share=" . esc_attr($fbl_unserialized_data["share_button"]);
                ?>
                <div class="like-button-div">
                    <iframe class="iframe_like_button_<?php echo $unique_id; ?>" src="<?php echo $like_button_src ?>" scrolling="no" frameborder="0" allowTransparency="true">
                    </iframe>
                </div>
            </div>
            <?php
            break;
    }
}
if (isset($display_type)) {
    switch ($display_type) {
        case "like box":
            $post_stream = $streams == "yes" ? "timeline" : "";
            $likebox_header = $header == "yes" ? "true" : "false";
            $likebox_user_faces = $show_faces_like_box == "yes" ? "true" : "false";
            $url = urlencode($facebook_page_url);
            $iframe_src = "https://www.facebook.com/plugins/page.php?href=";
            $iframe_src .= $url;
            $iframe_src .= "&tabs=$post_stream,events,messages";
            $iframe_src .= "&width=" . $width;
            $iframe_src .= "&height=" . $height;
            $iframe_src .= "&small_header=" . $likebox_header;
            $iframe_src .= "&adapt_container_width=true";
            $iframe_src .= "&hide_cover=false";
            $iframe_src .= "&locale=" . $language;
            $iframe_src .= "&show_facepile=" . $likebox_user_faces;
            ?>
            <div id="facebook_likebox_container_<?php echo $unique_id; ?>">
                <iframe class="iframe_class_<?php echo $unique_id; ?>" src="<?php echo $iframe_src; ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" style="overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
                </iframe>
            </div>
            <?php
            break;

        case "like button":
            $url = urlencode($facebook_page_url);
            $button_src = "https://www.facebook.com/plugins/like.php?href=";
            $button_src .= $url;
            $button_src .= "&width=300";
            $button_src .= "&layout=" . $button_style;
            $button_src .= "&action=like";
            $button_src .= "&size=small";
            $button_src .= "&share=" . $share_button;
            $button_src .= "&locale=" . $language;
            ?>
            <div class="facebook_like_button_container_<?php echo $unique_id; ?>">
                <iframe src="<?php echo $button_src ?>" width="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
                </iframe>
            </div>
            <?php
            break;

        case "like box button":
            $post_stream = $streams == "yes" ? "timeline" : "";
            $likebox_header = $header == "yes" ? "true" : "false";
            $likebox_user_faces = $show_faces_like_box == "yes" ? "true" : "false";
            $url = urlencode($facebook_page_url);
            $iframe_src = "https://www.facebook.com/plugins/page.php?href=";
            $iframe_src .= $url;
            $iframe_src .= "&tabs=$post_stream,events,messages";
            $iframe_src .= "&width=" . $width;
            $iframe_src .= "&height=" . $height;
            $iframe_src .= "&small_header=" . $likebox_header;
            $iframe_src .= "&adapt_container_width=true";
            $iframe_src .= "&hide_cover=false";
            $iframe_src .= "&locale=" . $language;
            $iframe_src .= "&show_facepile=" . $likebox_user_faces;
            ?>
            <div class="facebook_like_box_button_container_<?php echo $unique_id; ?>">
                <iframe class="iframe_class_<?php echo $unique_id; ?>" src="<?php echo $iframe_src; ?>" width="<?php echo $width ?>" height="<?php echo $height ?>" style="overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true">
                </iframe>
                <?php
                $like_button_src = "https://www.facebook.com/plugins/like.php?href=";
                $like_button_src .= $url;
                $like_button_src .= "&width=" . $width;
                $like_button_src .= "&layout=" . $button_style;
                $like_button_src .= "&action=like";
                $like_button_src .= "&size=small";
                $like_button_src .= "&share=true";
                $like_button_src .= "&locale=" . $language;
                ?>
                <div style="height:31px;margin:5px;">
                    <iframe src="<?php echo $like_button_src ?>" width="<?php echo $width; ?>"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true">
                    </iframe>
                </div>
            </div>
            <?php
            break;
    }
}