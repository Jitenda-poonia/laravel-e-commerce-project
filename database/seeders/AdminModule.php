<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminModule extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'user_create',
            'user_edit',
            'user_delete',
            'user_index',
            'slider_create',
            'slider_edit',
            'slider_delete',
            'slider_index',
            'page_create',
            'page_edit',
            'page_delete',
            'page_index',
            'block_create',
            'block_edit',
            'block_delete',
            'block_index',
            'manage_permission',
            'manage_role',
            'enquiry',
            'product_index',
            'product_create',
            'product_edit',
            'product_delete',
            'product_show',
            'category_index',
            'category_create',
            'category_edit',
            'category_delete',
            'category_show',
            'attribute_index',
            'attribute_create',
            'attribute_edit',
            'attribute_delete',
            'attribute_show',
            'coupon_create',
            'coupon_index',
            'coupon_edit',
            'coupon_delete',
            'manage_orders',
            'manage_customer',
        ];
        foreach ($permissions as $permission) {
            if(!Permission::where('name',$permission )->where('guard_name' ,'web')->exists()){

                Permission::create(['name' => $permission, 'guard_name' => 'web']);
            }

        }
    }
}
