<?php

/**
 * Created by PhpStorm.
 * User: osamu
 * Date: 2017/04/18
 * Time: 17:41
 */
class Common
{
    public function __construct()
    {
    }

    public static function is_page_parent_slug($slug)
    {
        global $post;

        $_slug = '';

        if (0 != $post->post_parent) {
            $_post = get_post($post->post_parent);
            $_slug = $_post->post_name;
        }

        return $_slug == $slug;
    }
}