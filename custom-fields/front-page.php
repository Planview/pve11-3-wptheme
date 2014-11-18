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
                    'value' => 'page-templates/contributors.php',
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
        'menu_order' => 0,
    ));
}
