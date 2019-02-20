<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'bluesoul',
            'wikidotusername' => 'pxdnbluesoul',
            'email' => 'o5command@nags.me',
            'password' => '$2y$10$D2gvgD6Yd2vJiR/EelZCEOt3VF8B.m5vCQUuXoFkmbqtu4XZi1Yd.',
            'metadata' => json_encode([], JSON_FORCE_OBJECT)
        ]);
    }
}
