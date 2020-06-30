<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibAttachedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bib_attached_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('file_path');
            $table->text('file_orig_name')->nullable();
            $table->text('file_save_name')->nullable();
            $table->text('file_type')->nullable();
            $table->bigInteger('bib_entity_id')->unsigned();
            $table->foreign('bib_entity_id')->references('id')->on('biblioteca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bib_attached_files');
    }
}
