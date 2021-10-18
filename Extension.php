<?php 

namespace CupNoodles\PrintLayouts;

use Admin\Models\Menus_model;
use System\Classes\BaseExtension;
use System\Classes\MailManager;
use System\Classes\ExtensionManager;
use DB;
use Event;
use App;
use Igniter\Flame\Exception\ApplicationException;

use Illuminate\Support\Facades\Route;

/**
 * Print Layout Extension Information File
 */
class Extension extends BaseExtension
{
    /**
     * Returns information about this extension.
     *
     * @return array
     */
    public function extensionMeta()
    {
        return [
            'name'        => 'PrintLayouts',
            'author'      => 'CupNoodles',
            'description' => 'Orders Print Layout Manager.',
            'icon'        => 'fa-print',
            'version'     => '1.0.0'
        ];
    }

    /**
     * Register method, called when the extension is first registered.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        // Register any extra mail variables from PrintLayouts->mailGetData() here so they show up on the list in the admin helper
        $mail_variables = MailManager::instance()->listRegisteredVariables();
        $mail_variables['system::lang.mail_variables.text_group_order']['{{ $order_menu[\'menu_id\'] }}'] = 'cupnoodles.printlayouts::default.menu_id';
        $mail_variables['system::lang.mail_variables.text_group_order']['{{ $order_menu[\'category_id\'] }}'] = 'cupnoodles.printlayouts::default.category_id';

        // register unit of measure if cupnoodles.pricebyweight is installed
        $manager = ExtensionManager::instance();
        $extension = $manager->findExtension('cupnoodles.pricebyweight');
        if($extension && $extension->disabled == false){
            $mail_variables['system::lang.mail_variables.text_group_order']['{{ $order_menu[\'uom_tag\'] }}'] = 'cupnoodles.pricebyweight::default.uom_tag';
            $mail_variables['system::lang.mail_variables.text_group_order']['{{ $order_menu[\'uom_decimals\'] }}'] = 'cupnoodles.pricebyweight::default.uom_decimals';    
        }
       
        MailManager::instance()->registerMailVariables($mail_variables);




        Event::listen('admin.toolbar.extendButtonsBefore', function ($toolbar){
            if(get_class($toolbar->getController()) == 'Admin\Controllers\Orders' ||
            get_class($toolbar->getController()) == 'CupNoodles\OrderMenuEdit\Controllers\Orders' // Exists in the cupnoodles.ordersmenuedit extension
            ) {

                
                if($toolbar->getContext() == 'index'){
                    
                    $toolbar->getController()->addJS('extensions/cupnoodles/printlayouts/assets/js/printlayouts.js', 'cupnoodles-printlayouts');

                    foreach(\CupNoodles\PrintLayouts\Models\PrintLayouts::where('show_button_on_list', '1')->get()->toArray() as $ix=>$layout){
                        
                        $toolbar->buttons['print']  = [
                            'label' => lang('cupnoodles.printlayouts::default.print_layout') . ' - ' . $layout['name'],
                            'class' => 'btn btn-danger checkbox-print-ids',
                            'target' => '_blank',
                            'href' => 'cupnoodles/printlayouts/printlayouts/layout/' . $layout['printlayouts_id'] . '/0',
                        ];
                        
                    }
                }

                if($toolbar->getContext() == 'edit'){

                    foreach(\CupNoodles\PrintLayouts\Models\PrintLayouts::where('show_button_on_form', '1')->get()->toArray() as $ix=>$layout){
                        $order_id = str_replace(['orders/edit/', 'cupnoodles/ordermenuedit/orders/edit/'], ['', ''], Route::current()->parameters['slug']);
                        $toolbar->buttons['print']  = [
                            'label' => lang('cupnoodles.printlayouts::default.print_layout') . ' - ' . $layout['name'],
                            'class' => 'btn btn-danger checkbox-print-ids',
                            'target' => '_blank',
                            'href' => 'cupnoodles/printlayouts/printlayouts/layout/' . $layout['printlayouts_id'] . '/' . $order_id,
                        ];
                    }
                }
            }
        });

    }


    public function registerFormWidgets()
    {

    }

    /**
     * Registers any front-end components implemented in this extension.
     *
     * @return array
     */
    public function registerComponents()
    {

    }

    /**
     * Registers any admin permissions used by this extension.
     *
     * @return array
     */
    public function registerPermissions()
    {

    }

    public function registerNavigation()
    {
        return [
            'design' => [
                'child' => [
                    'printlayouts' => [
                        'priority' => 20,
                        'class' => 'pages',
                        'href' => admin_url('cupnoodles/printlayouts/printlayouts'),
                        'title' => lang('cupnoodles.printlayouts::default.printlayouts_manager_side_menu'),
                    ],
                ],
            ],
        ];
    }
}
