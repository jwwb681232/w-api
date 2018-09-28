<?php

use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'name' => 'WangXiao',
            'email' => 'wx497657341@qq.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
