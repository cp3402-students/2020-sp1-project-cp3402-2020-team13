<?php
/**
 * @package Townsville_Jazz_club
 * @Template name: Check
 */

$loggedin=is_user_logged_in();
if($loggedin){
    if( current_user_can('editor') || current_user_can('administrator')){
        header("Location: http://jazz-club.local/wp-admin/");
        }else{
        header("Location: http://jazz-club.local/yay");
    }

}else{
    header("Location: http://jazz-club.local/wp-login.php");
}