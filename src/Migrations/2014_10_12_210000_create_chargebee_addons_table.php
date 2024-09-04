<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargebeeAddonsTable extends Migration
{
    /**
     * Create the subscription table
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('chargebee.addons_table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer(config('chargebee.addons_subscription_id_column_name'))->index()->unsigned();
            $table->string('name');
            $table->string('addon_id');
            $table->integer('quantity')->default(0);
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
        Schema::drop(config('chargebee.addons_table_name'));
    }
}
