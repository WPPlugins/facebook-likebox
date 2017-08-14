<?php

/**
 * This File is used for Translation Strings.
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
        $wp_langs = array();
        $wp_langs["af"] = "Afrikaans";
        $wp_langs["ak"] = "Akan";
        $wp_langs["sq"] = "Shqip";
        $wp_langs["arq"] = "الدارجة الجزايرية";
        $wp_langs["am"] = "አማርኛ";
        $wp_langs["ar"] = "العربية";
        $wp_langs["hy"] = "Հայերեն";
        $wp_langs["rup_mk"] = "Armãneashce";
        $wp_langs["frp"] = "Arpitan";
        $wp_langs["as"] = "অসমীয়া";
        $wp_langs["ast"] = "Asturianu";
        $wp_langs["az"] = "Azərbaycan dili";
        $wp_langs["az_tr"] = "Azərbaycan Türkcəsi";
        $wp_langs["bcc"] = "بلوچی مکرانی";
        $wp_langs["ba"] = "башҡорт теле";
        $wp_langs["eu"] = "Euskara";
        $wp_langs["bel"] = "Беларуская мова";
        $wp_langs["bn_bd"] = "বাংলা";
        $wp_langs["bs_ba"] = "Bosanski";
        $wp_langs["bre"] = "Brezhoneg";
        $wp_langs["bg_bg"] = "Български";
        $wp_langs["ca"] = "Català";
        $wp_langs["bal"] = "Català (Balear)";
        $wp_langs["ceb"] = "Cebuano";
        $wp_langs["zh_cn"] = "简体中文";
        $wp_langs["zh_hk"] = "香港中文版 ";
        $wp_langs["zh_tw"] = "繁體中文";
        $wp_langs["co"] = "Corsu";
        $wp_langs["hr"] = "Hrvatski";
        $wp_langs["cs_cz"] = "Čeština‎";
        $wp_langs["da_dk"] = "Dansk";
        $wp_langs["dv"] = "ދިވެހި";
        $wp_langs["nl_nl"] = "Nederlands";
        $wp_langs["nl_be"] = "Nederlands (België)";
        $wp_langs["dzo"] = "རྫོང་ཁ";
        $wp_langs["en_au"] = "English (Australia)";
        $wp_langs["en_ca"] = "English (Canada)";
        $wp_langs["en_nz"] = "English (New Zealand)";
        $wp_langs["en_za"] = "English (South Africa)";
        $wp_langs["eo"] = "Esperanto";
        $wp_langs["et"] = "Eesti";
        $wp_langs["fo"] = "Føroyskt";
        $wp_langs["fi"] = "Suomi";
        $wp_langs["fr_be"] = "Français de Belgique";
        $wp_langs["fr_ca"] = "Français du Canada";
        $wp_langs["fr_fr"] = "Français";
        $wp_langs["fy"] = "Frysk";
        $wp_langs["fur"] = "Friulian";
        $wp_langs["fuc"] = "Pulaar";
        $wp_langs["gl_es"] = "Galego";
        $wp_langs["ka_ge"] = "ქართული";
        $wp_langs["de_de"] = "Deutsch";
        $wp_langs["de_ch"] = "Deutsch (Schweiz)";
        $wp_langs["el"] = "Ελληνικά";
        $wp_langs["kal"] = "Kalaallisut";
        $wp_langs["gn"] = "Avañe'ẽ";
        $wp_langs["gu"] = "ગુજરાતી";
        $wp_langs["hat"] = "Kreyol ayisyen";
        $wp_langs["haw_us"] = "Ōlelo Hawaiʻi";
        $wp_langs["haz"] = "هزاره گی";
        $wp_langs["he_il"] = "עִבְרִית";
        $wp_langs["hi_in"] = "हिन्दी";
        $wp_langs["hu_hu"] = "Magyar";
        $wp_langs["is_is"] = "Íslenska";
        $wp_langs["ido"] = "Ido";
        $wp_langs["id_id"] = "Bahasa Indonesia";
        $wp_langs["ga"] = "Gaelige";
        $wp_langs["it_it"] = "Italiano";
        $wp_langs["ja"] = "日本語";
        $wp_langs["jv_id"] = "Basa Jawa";
        $wp_langs["kab"] = "Taqbaylit";
        $wp_langs["kn"] = "ಕನ್ನಡ";
        $wp_langs["kk"] = "Қазақ тілі";
        $wp_langs["km"] = "ភាសាខ្មែរ";
        $wp_langs["kin"] = "Ikinyarwanda";
        $wp_langs["ky_ky"] = "кыргыз тили";
        $wp_langs["ko_kr"] = "한국어";
        $wp_langs["ckb"] = "كوردی‎";
        $wp_langs["lo"] = "ພາສາລາວ";
        $wp_langs["lv"] = "Latviešu valoda";
        $wp_langs["li"] = "Limburgs";
        $wp_langs["lin"] = "Ngala";
        $wp_langs["lt_lt"] = "Lietuvių kalba";
        $wp_langs["lb_lu"] = "Lëtzebuergesch";
        $wp_langs["mk_mk"] = "Македонски јазик";
        $wp_langs["mg_mg"] = "Malagasy";
        $wp_langs["ms_my"] = "Bahasa Melayu";
        $wp_langs["ml_in"] = "മലയാളം";
        $wp_langs["mri"] = "Te Reo Māori";
        $wp_langs["mr"] = "मराठी";
        $wp_langs["xmf"] = "მარგალური ნინა";
        $wp_langs["mn"] = "Монгол";
        $wp_langs["me_me"] = "Crnogorski jezik";
        $wp_langs["ary"] = "العربية المغربية";
        $wp_langs["my_mm"] = "ဗမာစာ";
        $wp_langs["ne_np"] = "नेपाली";
        $wp_langs["nb_no"] = "Norsk bokmål";
        $wp_langs["nn_no"] = "Norsk nynorsk";
        $wp_langs["oci"] = "Occitan";
        $wp_langs["ory"] = "ଓଡ଼ିଆ";
        $wp_langs["os"] = "Ирон";
        $wp_langs["ps"] = "پښتو";
        $wp_langs["fa_ir"] = "فارسی";
        $wp_langs["fa_af"] = "(فارسی (افغانستان";
        $wp_langs["pl_pl"] = "Polski";
        $wp_langs["pt_br"] = "Português do Brasil";
        $wp_langs["pt_pt"] = "Português";
        $wp_langs["pa_in"] = "ਪੰਜਾਬੀ";
        $wp_langs["rhg"] = "Ruáinga";
        $wp_langs["ro_ro"] = "Română";
        $wp_langs["roh"] = "Rumantsch Vallader";
        $wp_langs["ru_ru"] = "Русский";
        $wp_langs["rue"] = "Русиньскый";
        $wp_langs["sah"] = "Сахалыы";
        $wp_langs["sa_in"] = "भारतम्";
        $wp_langs["srd"] = "Sardu";
        $wp_langs["gd"] = "Gàidhlig";
        $wp_langs["sr_rs"] = "Српски језик";
        $wp_langs["szl"] = "Ślōnskŏ gŏdka";
        $wp_langs["snd"] = "سنڌي";
        $wp_langs["si_lk"] = "සිංහල";
        $wp_langs["sk_sk"] = "Slovenčina";
        $wp_langs["sl_si"] = "Slovenščina";
        $wp_langs["so_so"] = "Afsoomaali";
        $wp_langs["azb"] = "گؤنئی آذربایجان";
        $wp_langs["es_ar"] = "Español de Argentina";
        $wp_langs["es_cl"] = "Español de Chile";
        $wp_langs["es_co"] = "Español de Colombia";
        $wp_langs["es_gt"] = "Español de Guatemala";
        $wp_langs["es_mx"] = "Español de México";
        $wp_langs["es_pe"] = "Español de Perú";
        $wp_langs["es_pr"] = "Español de Puerto Rico";
        $wp_langs["es_es"] = "Español";
        $wp_langs["es_ve"] = "Español de Venezuela";
        $wp_langs["su_id"] = "Basa Sunda";
        $wp_langs["sw"] = "Kiswahili";
        $wp_langs["sv_se"] = "Svenska";
        $wp_langs["gsw"] = "Schwyzerdütsch";
        $wp_langs["tl"] = "Tagalog";
        $wp_langs["tah"] = "Reo Tahiti";
        $wp_langs["tg"] = "Тоҷикӣ";
        $wp_langs["tzm"] = "ⵜⴰⵎⴰⵣⵉⵖⵜ";
        $wp_langs["ta_in"] = "தமிழ்";
        $wp_langs["ta_lk"] = "தமிழ்";
        $wp_langs["tt_ru"] = "Татар теле";
        $wp_langs["te"] = "తెలుగు";
        $wp_langs["th"] = "ไทย";
        $wp_langs["bo"] = "བོད་སྐད";
        $wp_langs["tir"] = "ትግርኛ";
        $wp_langs["tr_tr"] = "Türkçe";
        $wp_langs["tuk"] = "Türkmençe";
        $wp_langs["twd"] = "Twents";
        $wp_langs["ug_cn"] = "Uyƣurqə";
        $wp_langs["uk"] = "Українська";
        $wp_langs["ur"] = "اردو";
        $wp_langs["uz_uz"] = "O‘zbekcha";
        $wp_langs["vi"] = "Tiếng Việt";
        $wp_langs["wa"] = "Walon";
        $wp_langs["cy"] = "Cymraeg";
        $wp_langs["yor"] = "Yorùbá";
        $locale = strtolower(get_locale());
        if (array_key_exists("$locale", $wp_langs)) {
            $language = $wp_langs["$locale"];
            $fbl_message_translate_help = __("If you would like to translate in $language & help us, we will reward you with a free Personal Edition License of Facebook Likebox.", "facebook-likebox");
            $fbl_kindly_click = __("If Interested, Kindly click ", "facebook-likebox");
            $fbl_message_translate_here = __("here.", "facebook-likebox");
        } else {
            $fbl_message_translate_help = "";
            $fbl_kindly_click = "";
            $fbl_message_translate_here = "";
        }
        //Disclaimers
        $fbl_message_premium_edition = __("This feature is available only in Premium Editions! <br> Kindly Purchase to unlock it!", "facebook-likebox");
        $fbl_premium_editions_label = __("Premium Edition", "facebook-likebox");
        $fbl_upgrade = __("Upgrade", "facebook-likebox");

        //Footer
        $fbl_likebox_and_button_saved = __("Like Box and Button Settings have been saved Successfully", "facebook-likebox");
        $fbl_popup_likebox_saved_success = __("Like Box Popup Settings have been saved Successfully", "facebook-likebox");
        $fbl_popup_likebox_update_success = __("Like Box Popup Settings have been updated Successfully", "facebook-likebox");
        $fbl_update_general_settings = __("General Settings have been saved Successfully", "facebook-likebox");
        $fbl_bulk_delete_popup_success = __("Selected Like Box Popups have been deleted Successfully", "facebook-likebox");
        $fbl_bulk_delete_sticky_success = __("Selected Sticky Like Boxes have been deleted Successfully", "facebook-likebox");
        $fbl_bulk_delete_boxes_buttons_success = __("Selected Like Boxes and Buttons have been deleted Successfully", "facebook-likebox");
        $fbl_delete_data_success = __("Like Box has been deleted Successfully", "facebook-likebox");
        $fbl_delete_sticky_likebox_success = __("Sticky Like Box has been deleted Successfully", "facebook-likebox");
        $fbl_like_box_button_likebox_success = __("Like Box and Button has been deleted Successfully", "facebook-likebox");
        $fbl_feature_request_message = __("Your request Email has been sent Successfully", "facebook-likebox");
        $fbl_likebox_saved_success = __("Like Box Settings have been saved Successfully", "facebook-likebox");
        $fbl_likebox_update_success = __("Like Box Settings have been updated Successfully", "facebook-likebox");
        $fbl_like_button_saved_success = __("Like Button Settings have been saved Successfully", "facebook-likebox");
        $fbl_like_button_update_success = __("Like Button Settings have been updated Successfully", "facebook-likebox");
        $fbl_likebox_and_button_update_success = __("Like Box and Button Settings have been updated Successfully", "facebook-likebox");
        $fbl_popup_query = __("Query", "facebook-likebox");
        $fbl_language_interested_to_translate = __("Language Interested to Translate", "facebook-likebox");
        $fbl_language_interested_to_translate_tooltip = __("Please enter the language you want to translate.", "facebook-likebox");
        $fbl_language_interested_to_translate_placeholder = __("Please enter the language", "facebook-likebox");
        $fbl_popup_your_name_tooltip = __("Please enter your Name.", "facebook-likebox");
        $fbl_important_disclaimer = __("Important Disclaimer!", "facebook-likebox");
        $fbl_popup_your_email_tooltip = __("Please enter your Email.", "facebook-likebox");
        $fbl_feature_requests_your_email_placeholder = __("Please provide your Email Address", "facebook-likebox");
        $fbl_language_interested_to_translate = __("Language Interested to Translate", "facebook-likebox");
        $fbl_language_interested_to_translate_tooltip = __("Please enter the language you want to translate.", "facebook-likebox");
        $fbl_language_interested_to_translate_placeholder = __("Please enter the language", "facebook-likebox");
        $fbl_popup_query_tooltip = __("Please enter your query.", "facebook-likebox");
        $fbl_popup_query_placeholder = __("Please enter the query.", "facebook-likebox");
        $fbl_manage_backups_close = __("Close", "facebook-likebox");
        $fbl_feature_requests_send_request = __("Send Request", "facebook-likebox");
        $fbl_translation_request = __("Translation Request", "facebook-likebox");
        $fbl_confirm_close = __("Are you sure you want to close without sending Translation Request?", "facebook-likebox");
        $fbl_delete_like_button_success = __("Like Button has been deleted Successfully", "facebook-likebox");

        //Menus
        $facebook_likebox = __("Facebook Like Box", "facebook-likebox");
        $fbl_like_box = __("Like Box", "facebook-likebox");
        $fbl_add_like_box = __("Add Like Box", "facebook-likebox");
        $fbl_edit_like_box = __("Edit Like Box", "facebook-likebox");
        $fbl_manage_like_box = __("Manage Like Boxes", "facebook-likebox");
        $fbl_like_button = __("Like Button", "facebook-likebox");
        $fbl_add_like_button = __("Add Like Button", "facebook-likebox");
        $fbl_edit_like_button = __("Edit Like Button", "facebook-likebox");
        $fbl_manage_like_button = __("Manage Like Buttons", "facebook-likebox");
        $fbl_sticky_like_box = __("Sticky Like Box", "facebook-likebox");
        $fbl_add_sticky_like_box = __("Add Sticky Like Box", "facebook-likebox");
        $fbl_manage_sticky_like_box = __("Manage Sticky Like Boxes", "facebook-likebox");
        $fbl_like_box_popup = __("Like Box Popup", "facebook-likebox");
        $fbl_add_like_box_popup = __("Add Like Box Popup", "facebook-likebox");
        $fbl_edit_likebox_popup = __("Edit Like Box Popup", "facebook-likebox");
        $fbl_manage_like_box_popup = __("Manage Like Box Popup", "facebook-likebox");
        $fbl_like_box_and_button = __("Like Box & Button", "facebook-likebox");
        $fbl_add_like_box_and_button = __("Add Like Box & Button", "facebook-likebox");
        $fbl_edit_like_box_and_button = __("Edit Like Box & Button", "facebook-likebox");
        $fbl_manage_like_box_and_button = __("Manage Like Box & Buttons", "facebook-likebox");
        $fbl_general_settings = __("General Settings", "facebook-likebox");
        $fbl_roles_and_capabilities = __("Roles & Capabilities", "facebook-likebox");
        $fbl_feature_request = __("Feature Requests", "facebook-likebox");
        $fbl_system_information = __("System Information", "facebook-likebox");

        //Common Variables
        $fbl_edit_tooltip = __("Edit", "facebook-likebox");
        $fbl_apply = __("Apply", "facebook-likebox");
        $fbl_success = __("Success!", "facebook-likebox");
        $fbl_enable = __("Enable", "facebook-likebox");
        $fbl_disable = __("Disable", "facebook-likebox");
        $fbl_preview = __("Preview", "facebook-likebox");
        $fbl_save_changes = __("Save Changes", "facebook-likebox");
        $fbl_page_id = __("Page ID", "facebook-likebox");
        $fbl_page_id_url = __("Page ID/Page Url", "facebook-likebox");
        $fbl_page_url = __("Page URL", "facebook-likebox");
        $fbl_page_id_tooltip = __("In this field, you would need to provide your Facebook Page ID. For Example:- if your Facebook Url is https://www.facebook.com/techbanker then type here just techbanker", "facebook-likebox");
        $fbl_page_id_placeholder = __("Please provide Facebook Page ID", "facebook-likebox");
        $fbl_title = __("Title", "facebook-likebox");
        $fbl_title_tooltip = __("In this field, you would need to provide Title for your Facebook Like Box", "facebook-likebox");
        $fbl_title_placeholder = __("Please provide Title", "facebook-likebox");
        $fbl_width = __("Width", "facebook-likebox");
        $fbl_width_tooltip = __("In this field, you would need to provide Width(px). It should be between 260px to 500px", "facebook-likebox");
        $fbl_width_placeholder = __("Please provide Width(px)", "facebook-likebox");
        $fbl_height = __("Height", "facebook-likebox");
        $fbl_height_tooltip = __("In this field, you would need to provide Height(px). It should be Minimum 70px", "facebook-likebox");
        $fbl_height_placeholder = __("Please provide Height(px)", "facebook-likebox");
        $fbl_header = __("Header", "facebook-likebox");
        $fbl_header_tooltip = __("In this field, you would need to choose header size from dropdown. It could be either small or large", "facebook-likebox");
        $fbl_post_stream = __("Post Stream", "facebook-likebox");
        $fbl_post_stream_tooltip = __("If you would like to display latest post then you would need to choose Enable from dropdown or vice-versa", "facebook-likebox");
        $fbl_facebook_action = __("Action", "facebook-likebox");
        $fbl_bulk_action = __("Bulk Action", "facebook-likebox");
        $fbl_delete = __("Delete", "facebook-likebox");
        $fbl_bulk_delete_facebook_likebox = __("Selected Like Box has been deleted Successfully", "facebook-likebox");
        $fbl_confirm_delete = __("Are you sure you want to delete ?", "facebook-likebox");
        $fbl_border_style_title = __("Border Style (Width,Thickness,Color)", "facebook-likebox");
        $fbl_border_radius_tooltip = __("In this field, you would need to provide Border Radius(px)", "facebook-likebox");
        $fbl_border_radius_title = __("Border Radius (Px)", "facebook-likebox");
        $fbl_border_width_placeholder = __("Width", "facebook-likebox");
        $fbl_border_radius_placeholder = __("Please provide Border Radius(px)", "facebook-likebox");
        $fbl_color_placeholder = __("Color", "facebook-likebox");
        $fbl_border_none = __("None", "facebook-likebox");
        $fbl_border_solid = __("Solid", "facebook-likebox");
        $fbl_border_dotted = __("Dotted", "facebook-likebox");
        $fbl_border_dashed = __("Dashed", "facebook-likebox");
        $fbl_position_top = __("Top", "facebook-likebox");
        $fbl_position_bottom = __("Bottom", "facebook-likebox");
        $fbl_show_faces = __("Show User Faces", "facebook-likebox");
        $fbl_show_user_faces_tooltip = __("If you would like to display user faces then you would need to choose Show from dropdown or vice-versa", "facebook-likebox");
        $fbl_border_style = __("Border Style", "facebook-likebox");
        $fbl_border_style_tooltip = __("In this field, you would need to provide Border Width, Thickness and Color", "facebook-likebox");
        $fbl_border_color = __("Border Color", "facebook-likebox");
        $fbl_border_color_tooltip = __("In this field, you would need to choose Border Color", "facebook-likebox");
        $fbl_border_color_placeholder = __("Please choose Border Color", "facebook-likebox");
        $fbl_cover_photo = __("Cover Photo", "facebook-likebox");
        $fbl_cover_photo_tooltip = __("If you would like to display Cover Photo then you would need to choose Show from dropdown or vice-versa", "facebook-likebox");
        $fbl_language = __("Language", "facebook-likebox");
        $fbl_language_tooltip = __("In this field, you would need to choose a Language from dropdown in which you would like to display", "facebook-likebox");
        $fbl_page_url_tooltip = __("In this field, you would need to provide Page Url for particular Facebook Page", "facebook-likebox");
        $fbl_page_url_placeholder = __("Please provide your Facebook Page Url", "facebook-likebox");
        $fbl_shortcode = __("Shortcode", "facebook-likebox");
        $fbl_likebox_source = __("Facebook Source", "facebook-likebox");
        $fbl_copy_to_clipboard = __("Copy Shortcode", "facebook-likebox");
        $fbl_copied_successfully = __("Copied Successfully", "facebook-likebox");
        $fbl_copied_failed = __("Failed to Copy. Please try again!", "facebook-likebox");
        $fbl_user_access_message = __("You don't have Sufficient Access to this Page. Kindly contact the Administrator for more Privileges", "facebook-likebox");
        $fbl_events = __("Events", "facebook-likebox");
        $fbl_events_tooltip = __("If you would like to show current Events then you would need to choose Enable from dropdown or vice-versa", "facebook-likebox");
        $fbl_messages = __("Messages", "facebook-likebox");
        $fbl_messages_tooltip = __("If you would like to show Messages then you would need to choose Enable from dropdown or vice-versa", "facebook-likebox");
        $fbl_small = __("Small", "facebook-likebox");
        $fbl_large = __("Large", "facebook-likebox");
        $fbl_show = __("Show", "facebook-likebox");
        $fbl_hide = __("Hide", "facebook-likebox");
        $fbl_likebox_details = __("Details", "facebook-likebox");
        $fbl_position_left = __("Left", "facebook-likebox");
        $fbl_position_right = __("Right", "facebook-likebox");
        $fbl_edit_sticky_likebox = __("Edit Sticky Like Box", "facebook-likebox");
        $fbl_like_box_preview_title = __("Like Box Preview", "facebook-likebox");
        $fbl_like_button_preview_title = __("Like Button Preview", "facebook-likebox");
        $fbl_like_box_button_preview_title = __("Like Box & Button Preview", "facebook-likebox");
        $fbl_like_button_size = __("Button Size", "facebook-likebox");
        $fbl_button = __("Button", "facebook-likebox");

        //like box
        $fbl_likebox = __("Like Box", "facebook-likebox");
        $fbl_likebox_tooltip = __("In this field, you would need to choose Facebook Source from dropdown", "facebook-likebox");
        $fbl_likebox_animation = __("Animation Effects", "facebook-likebox");
        $fbl_likebox_animation_tooltip = __("In this field, you would need to choose Animation Effects for Like Box from dropdown", "facebook-likebox");

        //like Button
        $fbl_like_button_tooltip = __("In this field, you would need to choose Facebook Source from dropdown", "facebook-likebox");
        $fbl_like_button_style_title = __("Button Style", "facebook-likebox");
        $fbl_like_button_style_tooltip = __("In this field, you would need to choose Button Style for Like Button from dropdown", "facebook-likebox");
        $fbl_like_button_style_standard = __("Standard", "facebook-likebox");
        $fbl_like_button_style_count = __("Button Count", "facebook-likebox");
        $fbl_like_button_style_box_count = __("Box Count", "facebook-likebox");
        $fbl_show_faces_tooltip = __("If you would like to display user faces then you would need to choose Show from dropdown or vice-versa", "facebook-likebox");
        $fbl_action_tooltip = __("In this field, you would need to choose an action for Like Button from dropdown whether it would be like or recommend", "facebook-likebox");
        $fbl_share_button_title = __("Share Button", "facebook-likebox");
        $fbl_share_button_tooltip = __("If you would like to display Share Button then you would need to choose Show from dropdown or vice-versa", "facebook-likebox");
        $fbl_like_buttton_succesfully = __("Like Button Settings have been saved Successfully", "facebook-likebox");
        $fbl_recommended = __("Recommend", "facebook-likebox");
        $fbl_like_button_size_tooltip = __("In this field, you would need to choose Button Size for Like Button from dropdown. It could be small or large", "facebook-likebox");
        $fbl_button_type = __("Button Type", "facebook-likebox");
        $fbl_button_type_tooltip = __("In this field, you would need to choose Button Type for Like Button from dropdown", "facebook-likebox");
        $fbl_like = __("Like", "facebook-likebox");
        $fbl_button_type_follow = __("Follow", "facebook-likebox");
        $fbl_button_type_share = __("Share", "facebook-likebox");

        //sticky facebook likebox
        $fbl_sticky_likebox = __("Sticky Likebox", "facebook-likebox");
        $fbl_sticky_likebox_tooltip = __("In this field, you would need to choose Facebook Source from dropdown", "facebook-likebox");
        $fbl_sticky_likebox_position = __("Position", "facebook-likebox");
        $fbl_sticky_likebox_position_tooltip = __("In this field, you would need to choose Position for Sticky Like Box from dropdown", "facebook-likebox");

        //Likebox Popup
        $fbl_likebox_popup_tooltip = __("In this field, you would need to choose Facebook Source from dropdown", "facebook-likebox");
        $fbl_popup_likebox_overlay_color = __("Overlay Color", "facebook-likebox");
        $fbl_popup_likebox_overlay_color_placeholder = __("Please choose Overlay Color", "facebook-likebox");
        $fbl_popup_likebox_overlay_color_tooltip = __("In this field, you would need to choose color for Overlay", "facebook-likebox");
        $fbl_popup_likebox_overlay_opacity = __("Overlay Color Opacity (%)", "facebook-likebox");
        $fbl_popup_likebox_overlay_opacity_tooltip = __("If you would like to display Overlay on Background then you would need to provide Overlay Color Opacity. It should be between 0 to 100", "facebook-likebox");
        $fbl_popup_likebox_overlay_opacity_placeholder = __("Please provide Overlay Color Opacity", "facebook-likebox");
        $fbl_popup_likebox_display_periodicity = __("Popup Display Periodicity", "facebook-likebox");
        $fbl_popup_likebox_display_periodicity_everytime = __("Everytime", "facebook-likebox");
        $fbl_popup_likebox_display_periodicity_onetime = __("One Time", "facebook-likebox");
        $fbl_popup_likebox_display_periodicity_tooltip = __("In this field, you would need to choose when to display Like Box Popup. It could be either One Time or Everytime", "facebook-likebox");
        $fbl_popup_likebox_time_to_display_popup = __("Time To Display Like Box Popup (seconds)", "facebook-likebox");
        $fbl_popup_likebox_time_to_display_popup_tooltip = __("In this field, you would need to provide after what time would you like to show Popup", "facebook-likebox");
        $fbl_popup_likebox_time_to_display_popup_placeholder = __("Please provide time(seconds)", "facebook-likebox");

        //Like Box and Button
        $fbl_likebox_and_button_animation_tooltip = __("In this field, you would need to choose Animation Effects for Like Box & Button from dropdown", "facebook-likebox");
        $fbl_likebox_and_button_tooltip = __("In this field, you would need to choose Facebook Source from dropdown", "facebook-likebox");
        $fbl_likebox_and_button_show_faces_tooltip = __("If you would like to display user faces then you would need to choose Show from dropdown or vice-versa", "facebook-likebox");

        //general settings
        $fbl_other_general_settings_romove_tables_at_uninstall = __("Remove Tables at uninstall", "facebook-likebox");
        $fbl_other_general_settings_remove_tables_at_uninstall_tooltip = __("If you would like to remove tables during uninstalling the Plugin then you would need to choose Enable or vice-versa from dropdown", "facebook-likebox");
        // error log
        $fbl_error_logs = __("Error Logs", "facebook-likebox");
        $fbl_error_logs_output = __("Output", "facebook-likebox");
        $fbl_error_logs_download = __("Download Error Logs", "facebook-likebox");
        $fbl_error_logs_clear = __("Clear Error Logs", "facebook-likebox");
        $fbl_error_logs_output_tooltip = __("In this field,you would be able to see all PHP Errors", "facebook-likebox");

        //roles and capabilities
        $fbl_roles_and_capabilities_full_control = __("Full Control", "facebook-likebox");
        $fbl_roles_and_capabilities_menu = __("Show Facebook Like Box Menu", "facebook-likebox");
        $fbl_roles_and_capabilities_menu_tooltip = __("In this field, you would need to choose a specific Role who can see Sidebar Menu", "facebook-likebox");
        $fbl_roles_and_capabilities_administrator = __("Administrator", "facebook-likebox");
        $fbl_roles_and_capabilities_author = __("Author", "facebook-likebox");
        $fbl_roles_and_capabilities_editor = __("Editor", "facebook-likebox");
        $fbl_roles_and_capabilities_contributor = __("Contributor", "facebook-likebox");
        $fbl_roles_and_capabilities_subscriber = __("Subscriber", "facebook-likebox");
        $fbl_roles_and_capabilities_others_privileges = __("Others", "facebook-likebox");
        $fbl_roles_and_capabilities_administrator_role = __("An Administrator Role can do the following ", "facebook-likebox");
        $fbl_roles_and_capabilities_administrator_role_tooltip = __("Administrators will have by default full control to manage different options in Facebook Like Box, so all checkboxes will be already selected for the Administrator Role as mentioned below", "facebook-likebox");
        $fbl_roles_and_capabilities_author_role = __("An Author Role can do the following ", "facebook-likebox");
        $fbl_roles_and_capabilities_author_role_tooltip = __("You can choose what pages could be accessed by users having an Author Role and you can also choose additional capabilities that could be accessed by users on your Facebook Like Box for security purpose which is mentioned below in Author Role checkboxes", "facebook-likebox");
        $fbl_roles_and_capabilities_editor_role = __("An Editor Role can do the following ", "facebook-likebox");
        $fbl_roles_and_capabilities_editor_role_tooltip = __("You can choose what pages could be accessed by the users having an Editor Role and you can also choose additional capabilities that could be accessed by users on your Facebook Like Box for security purpose which is mentioned below in Editor Role checkboxes", "facebook-likebox");
        $fbl_roles_and_capabilities_contributor_role = __("A Contributor Role can do the following ", "facebook-likebox");
        $fbl_roles_and_capabilities_contributor_role_tooltip = __("You can choose what pages could be accessed by the users having a Contributor Role and you can also choose additional capabilities that could be accessed by users on your Facebook Like Box for security purpose which is mentioned below in Contributor Role checkboxes", "facebook-likebox");
        $fbl_roles_and_capabilities_subscriber_role = __("A Subscriber Role can do the following ", "facebook-likebox");
        $fbl_roles_and_capabilities_subscriber_role_tooltip = __("You can choose what pages could be accessed by the users having a Subscriber Role and you can also choose additional capabilities that could be accessed by users on your Facebook Like Box for security purpose which is mentioned below in Subscriber Role checkboxes", "facebook-likebox");
        $fbl_roles_and_capabilities_other_roles = __("An Other Roles can do the following ", "facebook-likebox");
        $fbl_roles_and_capabilities_other_roles_tooltip = __("You can choose what pages could be accessed by the users having an Others Role and you can also choose additional capabilities that could be accessed by users on your Facebook Like Box for security purpose which is mentioned below in Others Role checkboxes", "facebook-likebox");
        $fbl_roles_and_capabilities_topbar_menu = __("Show Facebook Likebox Top Bar Menu", "facebook-likebox");
        $fbl_roles_and_capabilities_topbar_menu_tooltip = __("If you would like to show Facebook Like Box Top Bar Menu then you would need to choose Enable from dropdown or vice-versa", "facebook-likebox");
        $fbl_roles_capabilities_other_roles_capabilities = __("In this field, you would need to choose appropriate capabilities for security purposes", "facebook-likebox");
        $fbl_roles_capabilities_other_roles_capabilities_tooltip = __("In this field, only users with these capabilities can access Facebook Like Box", "facebook-likebox");

        //feature request
        $fbl_feature_request_thank_you = __("Thank You", "facebook-likebox");
        $fbl_feature_requests_suggest_some_features = __("Kindly fill in the below form, if you would like to suggest some features which are not in the Plugin", "facebook-likebox");
        $fbl_feature_requests_suggestion_complaint = __("If you also have any suggestion/complaint, you can use the same form below", "facebook-likebox");
        $fbl_feature_requests_write_us_on = __("You can also write us on", "facebook-likebox");
        $fbl_feature_requests_your_name = __("Your Name", "facebook-likebox");
        $fbl_feature_requests_your_name_tooltip = __("In this field, you would need to provide your Name which will be sent along with your Feature Request", "facebook-likebox");
        $fbl_feature_requests_your_name_placeholder = __("Please provide your Name", "facebook-likebox");
        $fbl_feature_requests_your_email = __("Your Email", "facebook-likebox");
        $fbl_feature_requests_your_email_tooltip = __("In this field, you would need to provide your valid Email Address which will be sent along with your Feature Request", "facebook-likebox");
        $fbl_feature_requests_your_email_placeholder = __("Please provide your Email Address", "facebook-likebox");
        $fbl_feature_requests = __("Feature Request", "facebook-likebox");
        $fbl_feature_requests_tooltip = __("In this field, you would need to provide a feature which you would like to request to be added to this Plugin", "facebook-likebox");
        $fbl_feature_requests_placeholder = __("Please provide your Feature Request", "facebook-likebox");
        $fbl_feature_requests_send_request = __("Send Request", "facebook-likebox");
        $fbl_feature_requests_your_email = __("Your Email", "facebook-likebox");
        $fbl_feature_requests_your_name = __("Your Name", "facebook-likebox");
        $fbl_feature_requests_your_name_tooltip = __("In this field, you would need to provide your Name which you would like to request to be added to this Plugin", "facebook-likebox");
        $fbl_feature_requests_your_name_placeholder = __("Please provide your Name", "facebook-likebox");
    }
}