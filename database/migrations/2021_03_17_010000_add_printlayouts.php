<?php

namespace CupNoodles\PrintLayouts\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Schema;

/**
 * 
 */
class AddPrintLayouts extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('printlayouts')) {
            Schema::create('printlayouts', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('printlayouts_id');
                $table->string('name');
                $table->text('layout');
                $table->text('style');
                $table->boolean('separate_pages');
                $table->string('page_separator');
                $table->boolean('show_button_on_list');
                $table->boolean('show_button_on_form');
            });
        }
        $this->insertExamples();
    }

    public function down()
    {
        Schema::dropIfExists('printlayouts');
    }

    public function insertExamples(){
        if (DB::table('printlayouts')->count())
            return;

        DB::table('printlayouts')->insert(json_decode(file_get_contents(__DIR__.'/../records/printlayouts_example.json'), TRUE));
    }
}
