<?php


$config['list']['toolbar'] = [
    'buttons' => [
        'create' => [
            'label' => 'lang:admin::lang.button_new',
            'class' => 'btn btn-primary',
            'href' => admin_url('cupnoodles/printlayouts/printlayouts/create'),
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_delete',
            'class' => 'btn btn-danger',
            'data-attach-loading' => '',
            'data-request' => 'onDelete',
            'data-request-form' => '#list-form',
            'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => admin_url('cupnoodles/printlayouts/printlayouts/edit/{printlayouts_id}'),
        ],
    ],
    'name' => [
        'label' => 'lang:cupnoodles.printlayouts::default.name',
        'type' => 'text'
    ],
    'show_button_on_list' => [
        'label' => 'lang:cupnoodles.printlayouts::default.show_button_on_list',
        'type' => 'text'
    ],
    'show_button_on_form' => [
        'label' => 'lang:cupnoodles.printlayouts::default.show_button_on_form',
        'type' => 'text'
    ]

];

$config['form']['toolbar'] = [
    'buttons' => [
        'save' => [
            'label' => 'lang:admin::lang.button_save',
            'class' => 'btn btn-primary',
            'data-request' => 'onSave',
            'data-progress-indicator' => 'admin::lang.text_saving',
        ],
        'saveClose' => [
            'label' => 'lang:admin::lang.button_save_close',
            'class' => 'btn btn-default',
            'data-request' => 'onSave',
            'data-request-data' => 'close:1',
            'data-progress-indicator' => 'admin::lang.text_saving',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_icon_delete',
            'class' => 'btn btn-danger',
            'data-request' => 'onDelete',
            'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
            'data-progress-indicator' => 'admin::lang.text_deleting',
            'context' => ['edit'],
        ],
    ],
];
$config['form']['fields'] = [
    'name' => [
        'label' => 'lang:cupnoodles.printlayouts::default.name',
        'type' => 'text',

    ],
    'separate_pages' => [
        'label' => 'lang:cupnoodles.printlayouts::default.separate_pages',
        'type' => 'switch',

        'cssClass' => 'flex-width',
        'on' => 'lang:admin::lang.text_yes',
        'off' => 'lang:admin::lang.text_no',
    ],
    'page_separator' => [
        'label' => 'lang:cupnoodles.printlayouts::default.order_separator',
        'type' => 'text',

    ],
    'show_button_on_list' => [
        'label' => 'lang:cupnoodles.printlayouts::default.show_button_on_list',
        'type' => 'switch',


        'on' => 'lang:admin::lang.text_yes',
        'off' => 'lang:admin::lang.text_no',
    ],
    'show_button_on_form' => [
        'label' => 'lang:cupnoodles.printlayouts::default.show_button_on_form',
        'type' => 'switch',


        'on' => 'lang:admin::lang.text_yes',
        'off' => 'lang:admin::lang.text_no',
    ]
];

$config['form']['tabs'] = [
    'defaultTab' => 'lang:cupnoodles.printlayouts::default.text_tab_general',
    'fields' => [ 
        'layout' => [
            'label' => 'lang:cupnoodles.printlayouts::default.layout',
            'type' => 'codeeditor',
        ],
        'style' => [
            'tab' => 'lang:cupnoodles.printlayouts::default.style',
            'label' => 'lang:cupnoodles.printlayouts::default.style',
            'type' => 'codeeditor',
        ],
    ],
];

return $config;
