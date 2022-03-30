<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module_user = Module::where('module_name', 'user')->first();
        $module_user->givePermissionTo(['add user', 'view user', 'edit user', 'delete user']);

        $module_category = Module::where('module_name', 'category')->first();
        $module_category->givePermissionTo(['add category', 'view category', 'edit category', 'delete category']);

        $module_brand = Module::where('module_name', 'brands')->first();
        $module_brand->givePermissionTo(['add brand', 'view brand', 'edit brand', 'delete brand']);

        $module_product = Module::where('module_name', 'products')->first();
        $module_product->givePermissionTo(['add product', 'view product', 'edit product', 'delete product']);

        $module_blog = Module::where('module_name', 'blogs')->first();
        $module_blog->givePermissionTo(['add blog', 'view blog', 'edit blog', 'delete blog']);

        //        $modules = Module::all();
//        foreach ($modules as $module){
//            $module->givePermissionTo(Permission::all());
//        }
    }
}
