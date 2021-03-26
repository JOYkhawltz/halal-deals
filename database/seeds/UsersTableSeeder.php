<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $model = User::first();
        if ($model === NULL) {
            $admin = ['type_id' => '1', 'first_name' => 'Super', 'last_name' => 'Admin', 'email' => 'admin@infoway.us', 'password' => bcrypt('123456'), 'status' => '1'];
            User::insert($admin);
        }
    }

}
