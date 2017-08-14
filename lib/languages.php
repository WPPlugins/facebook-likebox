<?php

/**
 * This file contains list of Languages.
 *
 * @author	Tech Banker
 * @package facebook-likebox/lib
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
}// Exit if accessed directly
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
        $fbl_langs = array();
        $fbl_langs["af_ZA"] = "Afrikaans";
        $fbl_langs["sq_AL"] = "Albanian";
        $fbl_langs["be_BY"] = "Belarusian";
        $fbl_langs["bn_IN"] = "Bengali";
        $fbl_langs["en_PI"] = "English (Pirate)";
        $fbl_langs["en_UD"] = "English (Upside Down)";
        $fbl_langs["ar_AR"] = "العربية";
        $fbl_langs["hy_AM"] = "Հայերեն";
        $fbl_langs["az_AZ"] = "Azərbaycan dili";
        $fbl_langs["eu_ES"] = "Euskara";
        $fbl_langs["bs_BA"] = "Bosanski";
        $fbl_langs["bg_BG"] = "Български";
        $fbl_langs["ca_ES"] = "Català";
        $fbl_langs["zh_CN"] = "简体中文";
        $fbl_langs["zh_HK"] = "香港中文版 ";
        $fbl_langs["zh_TW"] = "繁體中文";
        $fbl_langs["hr_HR"] = "Hrvatski";
        $fbl_langs["cs_CZ"] = "Čeština‎";
        $fbl_langs["da_DK"] = "Dansk";
        $fbl_langs["nl_NL"] = "Nederlands";
        $fbl_langs["nl_BE"] = "Nederlands (België)";
        $fbl_langs["en_US"] = "English (US)";
        $fbl_langs["en_GB"] = "English (UK)";
        $fbl_langs["eo_EO"] = "Esperanto";
        $fbl_langs["et_EE"] = "Eesti";
        $fbl_langs["fo_FO"] = "Føroyskt";
        $fbl_langs["fi_FI"] = "Finnish";
        $fbl_langs["fr_CA"] = "Français du Canada";
        $fbl_langs["fr_FR"] = "Français";
        $fbl_langs["gl_ES"] = "Galego";
        $fbl_langs["ka_GE"] = "ქართული";
        $fbl_langs["de_DE"] = "Deutsch";
        $fbl_langs["el_GR"] = "Greek";
        $fbl_langs["gn_PY"] = "Avañe'ẽ";
        $fbl_langs["gu_IN"] = "ગુજરાતી";
        $fbl_langs["he_IL"] = "עִבְרִית";
        $fbl_langs["hi_IN"] = "हिन्दी";
        $fbl_langs["hu_HU"] = "Magyar";
        $fbl_langs["is_IS"] = "Íslenska";
        $fbl_langs["id_ID"] = "Bahasa Indonesia";
        $fbl_langs["ga_IE"] = "Gaelige";
        $fbl_langs["it_IT"] = "Italiano";
        $fbl_langs["ja_JP"] = "日本語";
        $fbl_langs["jv_ID"] = "Basa Jawa";
        $fbl_langs["kn_IN"] = "ಕನ್ನಡ";
        $fbl_langs["kk_KZ"] = "Қазақ тілі";
        $fbl_langs["km_KH"] = "ភាសាខ្មែរ";
        $fbl_langs["ko_KR"] = "한국어";
        $fbl_langs["ku_TR"] = "Kurdish";
        $fbl_langs["la_VA"] = "Latin";
        $fbl_langs["lv_LV"] = "Latviešu valoda";
        $fbl_langs["fb_LT"] = "Leet Speak";
        $fbl_langs["lt_LT"] = "Lietuvių kalba";
        $fbl_langs["mk_MK"] = "Македонски јазик";
        $fbl_langs["mg_MG"] = "Malagasy";
        $fbl_langs["sy_SY"] = "Syriac";
        $fbl_langs["ms_MY"] = "Bahasa Melayu";
        $fbl_langs["ml_IN"] = "മലയാളം";
        $fbl_langs["mt_MT"] = "Maltese";
        $fbl_langs["mr_IN"] = "मराठी";
        $fbl_langs["mn_MN"] = "Монгол";
        $fbl_langs["ne_NP"] = "नेपाली";
        $fbl_langs["nb_NO"] = "Norsk bokmål";
        $fbl_langs["nn_NO"] = "Norsk nynorsk";
        $fbl_langs["ps_AF"] = "پښتو";
        $fbl_langs["fa_IR"] = "فارسی";
        $fbl_langs["pl_PL"] = "Polski";
        $fbl_langs["pt_BR"] = "Português do Brasil";
        $fbl_langs["pt_PT"] = "Português";
        $fbl_langs["pa_IN"] = "ਪੰਜਾਬੀ";
        $fbl_langs["ro_RO"] = "Română";
        $fbl_langs["ru_RU"] = "Русский";
        $fbl_langs["sr_RS"] = "Српски језик";
        $fbl_langs["sk_SK"] = "Slovenčina";
        $fbl_langs["sl_SI"] = "Slovenščina";
        $fbl_langs["so_SO"] = "Afsoomaali";
        $fbl_langs["es_LA"] = "Spanish";
        $fbl_langs["es_ES"] = "Español";
        $fbl_langs["sw_KE"] = "Swahili";
        $fbl_langs["sv_SE"] = "Svenska";
        $fbl_langs["tl_PH"] = "Tagalog";
        $fbl_langs["tg_TJ"] = "Тоҷикӣ";
        $fbl_langs["ta_IN"] = "தமிழ்";
        $fbl_langs["te_IN"] = "తెలుగు";
        $fbl_langs["th_TH"] = "ไทย";
        $fbl_langs["tr_TR"] = "Türkçe";
        $fbl_langs["uk_UA"] = "Українська";
        $fbl_langs["ur_PK"] = "اردو";
        $fbl_langs["uz_UZ"] = "O‘zbekcha";
        $fbl_langs["vi_VN"] = "Tiếng Việt";
        $fbl_langs["cy_GB"] = "Cymraeg";
    }
}