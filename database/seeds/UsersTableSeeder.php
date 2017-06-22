<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'kenjisaitovn@gmail.com',
            'password' => bcrypt('G3m4Pr0vN'),
            'partnerCode' => $faker->uuid
        ]);
        $data = [['name'=>'s-root'],['name'=>'s-admin'],['name'=>'s-mod'],['name'=>'partner']];
        DB::table('roles')->insert($data);
        $data = [['name'=>'Administer'],['name'=>'viewTrans'],['name'=>'userInfo'],['name'=>'transManager'],['name'=>'usersManager'],['name'=>'buyinManager'],['name'=>'notificationManager']];
        DB::table('permissions')->insert($data);
        $data = [['permission_id'=>1,'role_id'=>1],['permission_id'=>2,'role_id'=>1],['permission_id'=>2,'role_id'=>4],['permission_id'=>3,'role_id'=>1],['permission_id'=>3,'role_id'=>4],['permission_id'=>4,'role_id'=>1],['permission_id'=>4,'role_id'=>3],['permission_id'=>5,'role_id'=>1],['permission_id'=>5,'role_id'=>2],['permission_id'=>6,'role_id'=>1],['permission_id'=>6,'role_id'=>2],['permission_id'=>7,'role_id'=>1],['permission_id'=>7,'role_id'=>2]];
        DB::table('role_has_permissions')->insert($data);
        $data = [['role_id'=>1,'user_id'=>1]];
        DB::table('user_has_roles')->insert($data);
        $data = [['user_id'=>1,'permission_id'=>1]];
        DB::table('user_has_permissions')->insert($data);
    }
}
