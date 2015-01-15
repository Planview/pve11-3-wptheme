<?php

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_checkbox-for-limelight-video',
        'title' => 'Checkbox for Limelight Video',
        'fields' => array (
            array (
                'key' => 'field_54b7e6ea56ee6',
                'label' => 'Show Limelight Failure Message',
                'name' => 'pve_113_show_limelight_failure_message',
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
                    'value' => 'presentations',
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
