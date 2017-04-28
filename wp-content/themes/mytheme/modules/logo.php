<?php
/**
 * Created by PhpStorm.
 * User: osamu
 * Date: 2017/04/18
 * Time: 17:51
 */

$logo = Core::get('logo');

if ( $logo ) {
    $header_logo = sprintf(
       '<img src="%s" class="logo" />',
        esc_url( $logo ),
        get_bloginfo( 'name' )
    );
} else {
    $header_logo = get_bloginfo( 'name' );
}


echo $header_logo;