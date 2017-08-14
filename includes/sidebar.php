<?php
/**
 * This file is used for displaying sidebar menus.
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
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar-tech-banker navbar-collapse collapse">
                <div class="sidebar-menu-tech-banker">
                    <ul class="page-sidebar-menu-tech-banker" data-slide-speed="200">
                        <div class="sidebar-search-wrapper" style="padding:20px;text-align:center">
                            <a class="plugin-logo" href="<?php echo tech_banker_beta_url; ?>" target="_blank">
                                <img src="<?php echo plugins_url("assets/global/img/logo.png", dirname(__FILE__)); ?>" alt="Facebook Likebox">
                            </a>
                        </div>
                        <li id="ux_li_like_box">
                            <a href="javascript:;">
                                <i class="icon-custom-like"></i>
                                <span class="title">
        <?php echo $fbl_like_box; ?>
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li id="ux_li_manage_like_box">
                                    <a href="admin.php?page=facebook_manage_like_box">
                                        <i class=icon-custom-wrench></i>
                                    <?php echo $fbl_manage_like_box; ?>
                                    </a>
                                </li>
                                <li id="ux_li_add_like_box">
                                    <a href="admin.php?page=facebook_likebox">
                                        <i class="icon-custom-plus"></i>
                                        <?php echo $fbl_add_like_box; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="ux_li_like_box_and_button">
                            <a href="javascript:;">
                                <i class="icon-custom-frame"></i>
                                <span class="title">
        <?php echo $fbl_like_box_and_button; ?>
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li id="ux_li_manage_like_box_and_button">
                                    <a href="admin.php?page=facebook_manage_like_box_and_button">
                                        <i class=icon-custom-wrench></i>
                                    <?php echo $fbl_manage_like_box_and_button; ?>
                                    </a>
                                </li>
                                <li id="ux_li_add_like_box_and_button">
                                    <a href="admin.php?page=facebook_add_like_box_and_button">
                                        <i class="icon-custom-plus"></i>
                                        <?php echo $fbl_add_like_box_and_button; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="ux_li_like_box_popup">
                            <a href="javascript:;">
                                <i class="icon-custom-social-dribbble"></i>
                                <span class="title">
        <?php echo $fbl_like_box_popup; ?>
                                </span>
                                <span class="badge"> Pro </span>
                            </a>
                            <ul class="sub-menu">
                                <li id="ux_li_manage_like_box_popup">
                                    <a href="admin.php?page=facebook_manage_like_box_popup">
                                        <i class=icon-custom-wrench></i>
        <?php echo $fbl_manage_like_box_popup; ?>
                                    </a>
                                </li>
                                <li id="ux_li_add_like_box_popup">
                                    <a href="admin.php?page=facebook_add_like_box_popup">
                                        <i class="icon-custom-plus"></i>
                                        <?php echo $fbl_add_like_box_popup; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="ux_li_like_button">
                            <a href="javascript:;">
                                <i class="icon-custom-grid"></i>
                                <span class="title">
        <?php echo $fbl_like_button; ?>
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li id="ux_li_manage_like_button">
                                    <a href="admin.php?page=facebook_manage_like_button">
                                        <i class=icon-custom-wrench></i>
                                    <?php echo $fbl_manage_like_button; ?>
                                    </a>
                                </li>
                                <li id="ux_li_add_like_button">
                                    <a href="admin.php?page=facebook_add_like_button">
                                        <i class="icon-custom-plus"></i>
                                        <?php echo $fbl_add_like_button; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="ux_li_sticky_like_box">
                            <a href="javascript:;">
                                <i class="icon-custom-tag"></i>
                                <span class="title">
        <?php echo $fbl_sticky_like_box; ?>
                                </span>
                                <span class="badge"> Pro </span>
                            </a>
                            <ul class="sub-menu">
                                <li id="ux_li_manage_sticky_like_box">
                                    <a href="admin.php?page=facebook_manage_sticky_like_box">
                                        <i class=icon-custom-wrench></i>
        <?php echo $fbl_manage_sticky_like_box; ?>
                                    </a>
                                </li>
                                <li id="ux_li_add_sticky_like_box">
                                    <a href="admin.php?page=facebook_add_sticky_like_box">
                                        <i class="icon-custom-plus"></i>
                                        <?php echo $fbl_add_sticky_like_box; ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="ux_li_general_settings">
                            <a href="admin.php?page=facebook_likebox_general_settings">
                                <i class="icon-custom-settings"></i>
        <?php echo $fbl_general_settings; ?>
                            </a>
                        </li>
                        <li id="ux_li_roles_and_capabilities">
                            <a href="admin.php?page=facebook_likebox_roles_and_capabilities">
                                <i class="icon-custom-users"></i>
                                <?php echo $fbl_roles_and_capabilities; ?>
                                <span class="badge"> Pro </span>
                            </a>
                        </li>
                        <li id="ux_li_feature_request">
                            <a href="admin.php?page=facebook_likebox_feature_request">
                                <i class="icon-custom-call-out"></i>
                                <?php echo $fbl_feature_request; ?>
                            </a>
                        </li>
                        <li id="ux_li_system_information">
                            <a href="admin.php?page=facebook_likebox_system_information">
                                <i class="icon-custom-screen-desktop"></i>
                                <?php echo $fbl_system_information; ?>
                            </a>
                        </li>
                        <li id="ux_li_error_logs">
                            <a href="admin.php?page=facebook_likebox_error_logs">
                                <i class="icon-custom-shield"></i>
                                <?php echo $fbl_error_logs; ?>
                            </a>
                        </li>
                        <li id="ux_li_upgrade">
                            <a href="admin.php?page=facebook_likebox_upgrade">
                                <i class="icon-custom-briefcase"></i>
                                <?php echo $fbl_upgrade; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div style="margin-bottom:10px;">
                    <a href="http://beta.tech-banker.com/products/facebook-like-box/" target="_blank">
                        <img title="Facebook Likebox" src="<?php echo plugins_url("assets/global/img/facebook-like-box-banner.png", dirname(__FILE__)); ?>" width="100%">
                    </a>
                </div>
                <div class="container-fluid page-header-container">
                    <div class="row">
                        <div class="col-md-3 page-header-column">
                            <h4>Get Started</h4>
                            <a class="btn" href="#" target="_blank">Watch Video!</a>
                            <p>or <a href="http://beta.tech-banker.com/products/facebook-like-box/user-guide/" target="_blank">read documentation here</a></p>
                        </div>
                        <div class="col-md-3 page-header-column">
                            <h4> Go Premium</h4>
                            <ul>
                                <li><a href="http://beta.tech-banker.com/products/facebook-like-box/" target="_blank">Features</a></li>
                                <li><a href="http://beta.tech-banker.com/products/facebook-like-box/demos/" target="_blank">Online Demos</a></li>
                                <li><a href="http://beta.tech-banker.com/products/facebook-like-box/pricing/" target="_blank">Pricing Plans</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 page-header-column">
                            <h4>User Guide</h4>
                            <ul>
                                <li><a href="http://beta.tech-banker.com/products/facebook-like-box/user-guide/" target="_blank">Documentation</a></li>
                                <li><a href="https://wordpress.org/support/plugin/facebook-likebox" target="_blank">Support Question!</a></li>
                                <li><a href="http://beta.tech-banker.com/contact-us/" target="_blank">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 page-header-column">
                            <h4>More Actions</h4>
                            <ul>
                                <li><a href="https://wordpress.org/support/plugin/facebook-likebox/reviews/?filter=5" target="_blank">Rate Us!</a></li>
                                <li><a href="http://beta.tech-banker.com/products/" target="_blank">Our Other Products</a></li>
                                <li><a href="http://beta.tech-banker.com/services/" target="_blank">Our Other Services</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        <?php
    }
}