<?php

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_launch-11-3-lock-pages',
        'title' => 'Lock Pages',
        'fields' => array (
            array (
                'key' => 'field_5486086088579',
                'label' => 'User must be logged in to view',
                'name' => 'pve_113_page_logged_in_only',
                'type' => 'true_false',
                'message' => '',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
