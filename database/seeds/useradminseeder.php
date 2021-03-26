<?php

use Illuminate\Database\Seeder;

class useradminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(['type_id' => '1', 'first_name' => 'Super', 'last_name' => 'Admin', 'email' => 'admin@infoway.us', 'password' => bcrypt('123456'), 'status' => '1']);
    }
}
