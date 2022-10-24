<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private string $table = 'gateways';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table($this->table)->insert([
            ['name' => 'One', 'code' => 'one', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Two', 'code' => 'two', 'created_at' => date('Y-m-d H:i:s')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table($this->table)->truncate();
    }
};
