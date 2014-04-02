<?php
/**
 * Code contributed to the Learning Layers project
 * http://www.learning-layers.eu
 * Development is partly funded by the FP7 Programme of the European Commission under
 * Grant Agreement FP7-ICT-318209.
 * Copyright (c) 2014, RWTH Aachen University.
 * For a list of contributors see the AUTHORS file at the top-level directory of this distribution.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/

/**
 * WP-Members Pluggable Functions
 *
 * These functions replace those in the wp-members plugin
 *
 */
 
add_filter( 'wpmem_login_form', 'wpmem_login_form_filter' );
if ( ! function_exists( 'wpmem_login_form_filter' ) ):
/**
 * Filter login form to change legend and username label
 *
 */
function wpmem_login_form_filter( $form )
{
 	$form=str_replace(array('Existing Users Login','Username','class="buttons"'),array('Sign In','Email','class="btn-primary"'),$form);
 
	return $form;
}
endif;
 
add_filter('wpmem_register_data','wpmem_create_username_from_email');
if ( ! function_exists( 'wpmem_create_username_from_email' ) ):
/**
 * Create Username from Email
 *
 * Creates a WP-friendly username from email address
 * Address is alreay confirmed valid before filter is called
 * [[[  is_email( $fields['user_email']) in wp-members-register.php/wpmem_registration  ]]]
 *
 * @uses get_user_by
 * @return array Returns filtered registration fields passed in from wp-members-register.php/wpmem_registration
 *
 */
function wpmem_create_username_from_email($fields) {
    $generated_username=sanitize_user($fields['user_email'],true);
    if ($fields['username']=='tempusername') {
        $fields['username']=$generated_username;
        $fields['nickname']=$generated_username;
        $fields['display_name']=$generated_username;
        $fields['user_nicename']=$generated_username;
    }
    return $fields;
}// end create_username_from_email
endif;
 
add_filter('wpmem_register_form','wpmem_hide_username_registration_field');
if ( ! function_exists( 'wpmem_hide_username_registration_field' ) ):
/**
 * Remove username field from registration form, then create a hidden field
 * with name='username' and set value to 'tempusername' so the form validates
 *
 */
function wpmem_hide_username_registration_field($form){
    // include PHP DOM parser from http://simplehtmldom.sourceforge.net/
    include ('simple_html_dom.php');
 
    $html = str_get_html($form);
    // remove username label
    $usernamelabel=$html->find('label[for=username]', 0);
    // remove username input field and wrapping div
    //$usernamediv=$html->find('input[name=log]', 0)->parent ()->outertext='';
    $usernamelabel->next_sibling()->outertext='';
    $usernamelabel->outertext='';
 
    // append hidden field to the <legend> tag (the beginning of the form)
    $legend=$html->find('legend',0);
    $legend->outertext=$legend->outertext.'<input type="hidden" name="log" value="tempusername">';
 
    $rows=$html->find('div.div_text, div.div_checkbox');
    foreach ($rows as $row)
        $row->outertext=$row->outertext.'<br style="clear:both" />';
 
    // these changes are optional, removing 'reset form' button and adding Twitter BS3 classes to the submit button
    $clear_button=$html->find('input[name=reset]',0)->outertext='';
    $submit_button=$html->find('input[name=submit]',0)->class='btn btn-primary';
 
    return $html;
}
endif;

add_filter('wpmem_register_form_args','wpmem_hide_required_label');
if ( ! function_exists( 'wpmem_hide_required_label' ) ):
/**
 * Remove username field from registration form, then create a hidden field
 * with name='username' and set value to 'tempusername' so the form validates
 *
 */
function wpmem_hide_required_label($args,$toggle){
    return array(
            'req_mark'         => '',
            'req_label'        => __( '', 'wp-members' ),
            'req_label_before' => '',
            'req_label_after'  => '',
            'heading_after'    => '</legend><p>Your favorites will be sent to your email address and also a new password will be generated, which you can use later to log in for this site.</p>'
        );
}
endif;

add_filter('wpmem_register_links','wpmem_hide_message_after_reg');
if ( ! function_exists( 'wpmem_hide_message_after_reg' ) ):
/**
 * Remove username field from registration form, then create a hidden field
 * with name='username' and set value to 'tempusername' so the form validates
 *
 */
function wpmem_hide_message_after_reg($str){
    return '';
}

endif;

add_filter('wpmem_register_heading','wpmem_register_heading_modified');
if ( ! function_exists( 'wpmem_register_heading_modified' ) ):
/**
 * Change legend of the registration form
 *
 */
function wpmem_register_heading_modified($str,$toggle){
    return 'Send your favorites to your email';
}

endif;

add_filter('wpmem_inc_login_args','wpmem_inc_login_args_modified');
if ( ! function_exists( 'wpmem_inc_login_args_modified' ) ):
/**
 * Change login header
 *
 */
function wpmem_inc_login_args_modified($args){
    return array('heading' => __( 'Log In', 'wp-members' ));
}
endif;

add_filter('wpmem_login_form_args','wpmem_login_form_args_mod');
if ( ! function_exists( 'wpmem_login_form_args_mod' ) ):
/**
 * Remove remember me option
 *
 */
function wpmem_login_form_args_mod($args){
    return array('remember_check'  => false);
}
endif;

add_action('wpmem_post_register_data', 'autologin_after_registration', 1);
if ( ! function_exists( 'wpmem_post_register_data' ) ):
/**
 * After registration of a new user we autologin him to avoid unnecessary manual logins
*/

function autologin_after_registration($fields) {
    $user_login = $fields[username];
    $user_id = $fields[ID];

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_login);
    do_action('wp_login', $user_login);

    wp_set_current_user($fields[ID]);
}
endif;

/*
 * Filter the wordpress default admin bar after login
*/
add_filter('show_admin_bar', '__return_false'); 

?>
