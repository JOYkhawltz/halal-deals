<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserTypesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $model = UserType::first();
        if ($model === NULL) {
            $types = [
                ['type' => 'Admin'],
                ['type' => 'Business Admin'],
                ['type' => 'Business Manager'],
                ['type' => 'Customer'],
            ];
            UserType::insert($types);
        }
    }

}
