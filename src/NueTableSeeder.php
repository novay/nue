<?php

namespace Novay\Nue;

use Illuminate\Database\Seeder;

class NueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        $users = config('nue.database.users_model');
        $user = new $users();
        $user->truncate();
        $user->create([
            'email' => 'novay@btekno.id',
            'password' => bcrypt('adminsss'),
            'plain' => encrypt('adminsss'),
            'name'     => 'Noviyanto Rahmadi',
        ]);

        // create a role.
        $roles = config('nue.database.roles_model');
        $role = new $roles();
        $role->truncate();
        $role->create([
            'name' => 'Administrator',
            'slug' => 'administrator',
        ]);

        // add role to user.
        $user->first()->roles()->save($role->first());

        //create a permission
        $permissions = config('nue.database.permissions_model');
        $permission = new $permissions();
        $permission->truncate();
        $permission->insert([
            [
                'name'        => 'All Permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'nue.login',
                'http_method' => '',
                'http_path'   => "/login\r\n/logout",
            ],
            [
                'name'        => 'User Profile',
                'slug'        => 'nue.profile',
                'http_method' => 'GET,PUT,DELETE',
                'http_path'   => '/profile',
            ],
            [
                'name'        => 'User Management',
                'slug'        => 'nue.users',
                'http_method' => '',
                'http_path'   => "/users/roles\r\n/users/permission\r\n/users/users",
            ],
            [
                'name'        => 'Nue Settings',
                'slug'        => 'nue.settings',
                'http_method' => '',
                'http_path'   => "/settings/menu\r\n/settings/audit\r\n/settings/system",
            ],
        ]);

        $role->first()->permissions()->save($permission->first());

        // add default menus.
        $menus = config('nue.database.menu_model');
        $menu = new $menus();
        $menu->truncate();
        $menu->insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'Dashboard',
                'icon'      => 'app-indicator',
                'uri'       => 'home',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => 'User Management',
                'icon'      => 'person-video3',
                'uri'       => 'users',
            ],
            [
                'parent_id' => 2,
                'order'     => 1,
                'title'     => 'Permission',
                'icon'      => 'shield-lock',
                'uri'       => 'users/permission',
            ],
            [
                'parent_id' => 2,
                'order'     => 2,
                'title'     => 'Roles',
                'icon'      => 'person-lines-fill',
                'uri'       => 'users/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => 'Users',
                'icon'      => 'people',
                'uri'       => 'users/users',
            ],
            [
                'parent_id' => 0,
                'order'     => 3,
                'title'     => 'Nue Settings',
                'icon'      => 'gear',
                'uri'       => 'settings',
            ],
            [
                'parent_id' => 6,
                'order'     => 1,
                'title'     => 'Menu',
                'icon'      => 'menu-button-fill',
                'uri'       => 'settings/menu',
            ],
            [
                'parent_id' => 6,
                'order'     => 2,
                'title'     => 'Log Activity',
                'icon'      => 'clock-history',
                'uri'       => 'settings/audit',
            ],
            [
                'parent_id' => 6,
                'order'     => 3,
                'title'     => 'System Info.',
                'icon'      => 'qr-code-scan',
                'uri'       => 'settings/system',
            ],
        ]);

        // add role to menu.
        $menu->find(2)->roles()->save($role->first());
    }
}
