<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddGiftColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = Schema::getColumnListing('users');
            
            if (!in_array('giftcard_ver', $columns)) {
                Schema::table('users', function (Blueprint $table) {
                    $table->smallInteger('giftcard_ver')->nullable()->default(0);
                });
            }
            
            if (!in_array('giftcard_crear', $columns)) {
                Schema::table('users', function (Blueprint $table) {
                    $table->smallInteger('giftcard_crear')->nullable()->default(0);
                });
            }
            
            if (!in_array('giftcard_anular', $columns)) {
                Schema::table('users', function (Blueprint $table) {
                    $table->smallInteger('giftcard_anular')->nullable()->default(0);
                });
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['giftcard_ver', 'giftcard_crear', 'giftcard_anular']);
            });            
        });
    }
}
