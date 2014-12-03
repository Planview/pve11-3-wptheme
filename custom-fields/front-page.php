<?php

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_front-page-11-3-launch-logged-out-content',
        'title' => 'Front Page &ndash; Logged out content',
        'fields' => array (
            array (
                'key' => 'field_546b9e1e714d7',
                'label' => 'Jumbotron Content',
                'name' => '113_front_jumbotron_content',
                'type' => 'wp_wysiwyg',
                'default_value' => '',
                'teeny' => 0,
                'media_buttons' => 1,
                'dfw' => 1,
            ),
            array (
                'key' => 'field_546b9e41714d8',
                'label' => 'Image Banner Content',
                'name' => '113_front_image_banner_content',
                'type' => 'wp_wysiwyg',
                'default_value' => '',
                'teeny' => 0,
                'media_buttons' => 1,
                'dfw' => 1,
            ),
            array (
                'key' => 'field_546bc424513d9',
                'label' => 'Registration Modal Content',
                'name' => '113_front_reg_modal_content',
                'type' => 'wp_wysiwyg',
                'default_value' => '',
                'teeny' => 0,
                'media_buttons' => 1,
                'dfw' => 1,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 1,
    ));
}

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_front-page-11-3-launch-logged-in-content',
        'title' => 'Front Page – 11.3 Launch – Logged in content',
        'fields' => array (
            array (
                'key' => 'field_547f50f5a81ba',
                'label' => 'Jumbotron content - Logged In',
                'name' => '113_front_auth_jumbotron_content',
                'type' => 'wp_wysiwyg',
                'default_value' => '',
                'teeny' => 0,
                'media_buttons' => 1,
                'dfw' => 1,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
