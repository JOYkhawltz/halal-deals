<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $model = Setting::first();
        if ($model === NULL) {
            $settings = [
                ['slug' => 'contact_number', 'title' => 'Contact Number', 'description' => 'Site contact number', 'type' => 'text', 'default' => '+123456789', 'value' => '+123456789', 'is_required' => 1, 'is_gui' => 1, 'module' => 'General', 'row_order' => 1],
                ['slug' => 'date_format', 'title' => 'Date Format', 'description' => 'How should dates be displayed across the website and control panel? Using the <a target="_blank" href="http://php.net/manual/en/function.date.php">date format</a> from PHP - OR - Using the format of <a target="_blank" href="http://php.net/manual/en/function.strftime.php">strings formatted as date</a> from PHP.', 'type' => 'text', 'default' => 'd-m-Y', 'value' => '01-07-2019', 'is_required' => 1, 'is_gui' => 1, 'module' => 'General', 'row_order' => 2],
                ['slug' => 'contact_email', 'title' => 'Contact Email', 'description' => 'Contact email', 'type' => 'text', 'default' => 'admin@infoway.us', 'value' => 'admin@infoway.us', 'is_required' => 1, 'is_gui' => 1, 'module' => 'General', 'row_order' => 3],
                ['slug' => 'facebook_url', 'title' => 'Facebook', 'description' => 'Facebook url', 'type' => 'text', 'default' => 'https://www.facebook.com', 'value' => 'https://www.facebook.com/laravel', 'is_required' => 1, 'is_gui' => 1, 'module' => 'Social Link', 'row_order' => 4],
                ['slug' => 'google_plus_url', 'title' => 'Google+', 'description' => 'Google+ url', 'type' => 'text', 'default' => 'https://plus.google.com', 'value' => 'https://plus.google.com/laravel', 'is_required' => 1, 'is_gui' => 1, 'module' => 'Social Link', 'row_order' => 5],
                ['slug' => 'linkedin_url', 'title' => 'LinkedIn', 'description' => 'LinkedIn url', 'type' => 'text', 'default' => 'https://www.linkedin.com', 'value' => 'https://www.linkedin.com/laravel', 'is_required' => 1, 'is_gui' => 1, 'module' => 'Social Link', 'row_order' => 6],
                ['slug' => 'twitter_url', 'title' => 'Twitter', 'description' => 'Twitter url', 'type' => 'text', 'default' => 'https://twitter.com', 'value' => 'https://twitter.com/laravel', 'is_required' => 1, 'is_gui' => 1, 'module' => 'Social Link', 'row_order' => 7],
            ];
            Setting::insert($settings);
        }
    }

}
