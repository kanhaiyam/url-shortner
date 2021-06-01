<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_master', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('link');
            $table->char('hash',16)->unique();
            $table->dateTime('created_at');
            $table->timestamp('updated_at');
        });
        DB::update("ALTER TABLE link_master AUTO_INCREMENT = 1;");

        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->char('hash',16);
            $table->integer('click_count')->default(1);
            $table->ipAddress('ip');
            $table->text('ua');
            $table->dateTime('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_master');
        Schema::dropIfExists('stats');
    }
}
