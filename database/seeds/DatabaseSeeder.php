<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        $this->call('UserTableSeeder');
        $this->call('OAuthClientsSeeder');
        $this->call('OAuthUsersSeeder');
        Model::reguard();
    }

}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(array(
            'first_name' => "testclient",
            'last_name' => "testpass",
            'email' => "admin@admin.com",
            'password' => Hash::make('admin'),
            'photo_url' => '',
            'status' => 1,
        ));

        DB::table('users')->insert(array(
            'first_name' => "haqi",
            'last_name' => "haqi",
            'email' => "haqi@admin.com",
            'password' => hash::make('haqi'),
            'photo_url' => '',
            'status' => 1,
        ));
    }
}

class OAuthClientsSeeder extends Seeder
{
    public function run()
    {
        DB::table('oauth_clients')->insert(array(
            'client_id' => "testclient",
            'client_secret' => "testpass",
            'redirect_uri' => "http://fake/",
        ));
    }
}
class OAuthUsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('oauth_users')->insert(array(
            'username' => "bshaffer",
            'password' => sha1("brent123"),
            'first_name' => "Brent",
            'last_name' => "Shaffer",
        ));
    }
}