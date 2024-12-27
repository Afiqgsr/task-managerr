<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\Assign;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class seederuserapi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            'Lihat Task',
            'Tambah Task',
            'Ubah Task',
            'Hapus Task',
        ];
        foreach ($permissions as $permissions){
            Permission::create(['name'=>$permissions]);
        }
        $role1 = Role::create(['name'=>'superadmin']);
        $role1->givePermissionTo(Permission::all());

        $role2 = Role::create(['name'=>'user']);
        $role2->givePermissionTo(['Lihat Task']);


        $superman = User::create([
            "name" => "superman",
            "email" => "superman@gmail.com",
            "password" => Hash::make("superman123")
            
        ]);
        $superman->assignRole($role1);
        
        $orang_biasa = User::create([
            "name" => "orangbiasa",
            "email" => "orangbiasa@gmail.com",
            "password" =>Hash::make( "orangbiasa123") 
        ]);
        $orang_biasa->assignRole($role2);
    }
}