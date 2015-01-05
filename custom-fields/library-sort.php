<?php

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_launch-11-3-resource-library-sort-order',
        'title' => 'Launch 11.3 - Resource Library - Sort Order',
        'fields' => array (
            array (
                'key' => 'field_54ab00b115a4f',
                'label' => 'Sort Order',
                'name' => 'pve_113_library_sort_order',
                'type' => 'number',
                'instructions' => 'Releases are sorted from low to high',
                'required' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => 0,
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'ef_taxonomy',
                    'operator' => '==',
                    'value' => 'release',
                    'order_no' => 0,
                    'group_no' => 0,
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
