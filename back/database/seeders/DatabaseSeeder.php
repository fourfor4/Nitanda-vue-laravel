<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //DepartmentMaster
        DB::table('department_masters')->insert([
            'department_name' => 'overall',
            'category' => '0',
            'del_flag' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('department_masters')->insert([
            'department_name' => 'developement',
            'category' => '0',
            'del_flag' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('department_masters')->insert([
            'department_name' => 'analysis',
            'category' => '0',
            'del_flag' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        //RoleMaster
        DB::table('role_masters')->insert([
            'role_name' => 'admin',
            'role_level' => 0,
        ]);
        DB::table('role_masters')->insert([
            'role_name' => 'user',
            'role_level' => 1,
        ]);
        DB::table('role_masters')->insert([
            'role_name' => 'guest',
            'role_level' => 2,
        ]);
        
        //TagMaster
        DB::table('tag_masters')->insert([
            'tag_name' => 'tag1',
            'category' => 'java',
        ]);
        DB::table('tag_masters')->insert([
            'tag_name' => 'tag2',
            'category' => 'php',
        ]);
        DB::table('tag_masters')->insert([
            'tag_name' => 'tag3',
            'category' => 'blockchain',
        ]);
        DB::table('tag_masters')->insert([
            'tag_name' => 'tag4',
            'category' => 'iSO',
        ]);
        
        //User
        DB::table('users')->insert([
            'employee_name' => 'admin',
            'employee_id' => 'admin',
            'login_id' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => 1,
            'department_id' => 0,
            'del_flag' => '0',
            'hire_date' => Carbon::now()->format("Y-m-d"),
            'leave_date' => Carbon::now()->format("Y-m-d"),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->insert([
            'employee_name' => 'user',
            'employee_id' => 'user',
            'login_id' => 'user',
            'password' => Hash::make('user'),
            'role_id' => 2,
            'department_id' => 0,
            'del_flag' => '0',
            'hire_date' => Carbon::now()->format("Y-m-d"),
            'leave_date' => Carbon::now()->format("Y-m-d"),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
