<?php

namespace CupNoodles\PrintLayouts\Requests;

use System\Classes\FormRequest;

class PrintLayouts extends FormRequest
{
    public function rules()
    {
        return [
            ['name', 'cupnoodles.printlayouts::default.name', 'required|between:2,128'],
            ['layout', 'cupnoodles.printlayouts::default.layout', 'required'],
            ['separate_pages', 'cupnoodles.printlayouts::default.separate_pages', 'required|boolean'],
            ['show_button_on_list', 'cupnoodles.printlayouts::default.show_button_on_list', 'required|boolean'],
            ['show_button_on_form', 'cupnoodles.printlayouts::default.show_button_on_form', 'required|boolean'],
        ];
    }

}
