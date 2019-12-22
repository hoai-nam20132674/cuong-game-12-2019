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
        // Model::unguard();

        // $this->call(UserTableSeeder::class);

        // Model::reguard();
        DB::table('users')->insert([
            [
                'name' =>'Nguyễn Hoài Nam',
                'sdt' =>'01642911168',
                'password'=>Hash::make('01642911168'),
                'status'=>0,
                'role'=>0,
            ],
            [
                'name' =>'Nguyễn Quốc Huy',
                'sdt' =>'01642911169',
                'password'=>Hash::make('01642911169'),
                'status'=>0,
                'role'=>0,
            ]
            ]
        );
    }
}
