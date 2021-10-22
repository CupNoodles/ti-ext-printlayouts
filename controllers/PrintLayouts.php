<?php

namespace CupNoodles\PrintLayouts\Controllers;

use AdminMenu;

use System\Classes\MailManager;
use System\Classes\ExtensionManager;

class PrintLayouts extends \Admin\Classes\AdminController
{
    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController'
    ];

    public $listConfig = [
        'list' => [
            'model' => 'CupNoodles\PrintLayouts\Models\PrintLayouts',
            'title' => 'cupnoodles.printlayouts::default.text_title',
            'emptyMessage' => 'cupnoodles.printlayouts::default.text_empty',
            'defaultSort' => ['printlayouts_id', 'DESC'],
            'configFile' => 'printlayouts_config',
        ],
    ];

    public $formConfig = [
        'name' => 'cupnoodles.printlayouts::default.text_form_name',
        'model' => 'CupNoodles\PrintLayouts\Models\PrintLayouts',
        'request' => 'CupNoodles\PrintLayouts\Requests\PrintLayouts',
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'cupnoodles/printlayouts/printlayouts/edit/{printlayouts_id}',
            'redirectClose' => 'cupnoodles/printlayouts/printlayouts',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'cupnoodles/printlayouts/printlayouts/edit/{printlayouts_id}',
            'redirectClose' => 'cupnoodles/printlayouts/printlayouts',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'cupnoodles/printlayouts/printlayouts',
        ],
        'delete' => [
            'redirect' => 'cupnoodles/printlayouts/printlayouts',
        ],
        'configFile' => 'printlayouts_config',
    ];

    public function __construct()
    {
        parent::__construct();
    }


    public function layout($context, $layoutId, $recordIds)
    {   

        $orders = [];
        $layout = \CupNoodles\PrintLayouts\Models\PrintLayouts::find($layoutId);
        $records = explode('+', $recordIds);

        //force sorting by order time since why wouldn't you want that?
        usort($records, function($a, $b){
            $orders_model_a = \Admin\Models\Orders_model::find($a);
            $orders_model_b = \Admin\Models\Orders_model::find($b);

            if(strtotime($orders_model_a->order_date) == strtotime($orders_model_b->order_date)){
                return strtotime($orders_model_a->order_time) > strtotime($orders_model_b->order_time);
            }
            else{
                return strtotime($orders_model_a->order_date) > strtotime($orders_model_b->order_date);
            }
            
        });

        foreach($records as $order_id){
            $orders_model = \Admin\Models\Orders_model::find($order_id);
            $data = $this->mailGetData($orders_model);
            $orders[] = html_entity_decode(MailManager::instance()->render($layout->layout, $data));
        }
        
        $this->vars['model'] = $layout;
        $this->vars['orders'] = $orders;
        $this->suppressLayout = TRUE;

    }

    public function mailGetData($orders_model){

        $data = $orders_model->mailGetData();

        

        // Override extra mail variables you'd like to use in the template here
        $data['order_menus'] = [];
        $menus = $orders_model->getOrderMenusWithOptions();
        foreach ($menus as $menu) {
            $optionData = [];
            if ($menuItemOptions = $menu->menu_options) {
                foreach ($menuItemOptions as $menuItemOption) {
                    $optionData[] = $menuItemOption->order_option_name;
                }
            }

            $menu_category = \Admin\Models\Menu_categories_model::where('menu_id', $menu->menu_id)->first();
            if($menu_category){
                $menu_category_id =  $menu_category->category_id;
            }
            else{
                $menu_category_id = 0;
            }
            
            
            $menu_arr = [
                'menu_name' => $menu->name,
                'menu_quantity' => $menu->quantity,
                'menu_price' => currency_format($menu->price),
                'menu_subtotal' => currency_format($menu->subtotal),
                'menu_options' => implode('<br /> ', $optionData),
                'menu_comment' => $menu->comment,
                'menu_id' => $menu->menu_id,
                'category_id' => $menu_category_id
            ];

            // register unit of measure if cupnoodles.pricebyweight is installed
            $manager = ExtensionManager::instance();
            $extension = $manager->findExtension('cupnoodles.pricebyweight');
            if($extension && $extension->disabled == false){
                $menu_arr['uom_tag'] = $menu->uom_tag;
                $menu_arr['uom_decimals'] = $menu->uom_decimals;
            }


            $data['order_menus'][] = $menu_arr;



        }

        return $data;
    }




}
