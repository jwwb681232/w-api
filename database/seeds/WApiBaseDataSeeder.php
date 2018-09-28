<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/9/28
 * Time: 14:52
 */

use Illuminate\Database\Seeder;

class WApiBaseDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->managerUser();

        $systemMenuId = $this->AdminMenusSystem();

        $this->AdminMenusMenu($systemMenuId);

        $this->AdminMenusPermission($systemMenuId);
        
        $this->AdminMenusRole($systemMenuId);

        $this->role();

        $this->assignRole();
        
    }

    /**
     * create manager user
     */
    public function managerUser()
    {
        $manager           = new \App\Entities\Manager();
        $manager->name     = 'admin';
        $manager->email    = 'admin@admin.com';
        $manager->password = bcrypt('123456');
        $manager->save();
    }

    /**
     * @return mixed
     */
    public function AdminMenusSystem()
    {
        $systemMenu                  = new \App\Entities\AdminMenu();
        $systemMenu->name            = '系统管理';
        $systemMenu->permission_name = 'admin.systems.index';
        $systemMenu->parent_id       = 0;
        $systemMenu->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.systems.index';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $systemMenu->id;
        $permission->save();

        return $systemMenu->id;
    }

    /**
     * @param $parentId
     */
    public function AdminMenusMenu($parentId)
    {
        $menu                  = new \App\Entities\AdminMenu();
        $menu->name            = '后台菜单';
        $menu->permission_name = 'admin.admin-menus.index';
        $menu->parent_id       = $parentId;
        $menu->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.admin-menus.index';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.admin-menus.create';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.admin-menus.update';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.admin-menus.delete';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();
    }

    /**
     * @param $parentId
     */
    public function AdminMenusPermission($parentId)
    {
        $menu                  = new \App\Entities\AdminMenu();
        $menu->name            = '权限';
        $menu->permission_name = 'admin.permissions.index';
        $menu->parent_id       = $parentId;
        $menu->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.permissions.index';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.permissions.create';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.permissions.update';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.permissions.delete';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();
    }

    /**
     * @param $parentId
     */
    public function AdminMenusRole($parentId)
    {
        $menu                  = new \App\Entities\AdminMenu();
        $menu->name            = '角色';
        $menu->permission_name = 'admin.roles.index';
        $menu->parent_id       = $parentId;
        $menu->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.roles.index';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.roles.create';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.roles.update';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();

        $permission             = new \App\Entities\Permission();
        $permission->name       = 'admin.roles.delete';
        $permission->guard_name = 'manager';
        $permission->menu_id    = $menu->id;
        $permission->save();
    }

    /**
     * create super_admin role
     */
    public function role()
    {
        $role             = new \App\Entities\Role();
        $role->name       = 'super_admin';
        $role->guard_name = 'manager';
        $role->save();
    }

    /**
     * assign role to manager
     */
    public function assignRole()
    {
        $managerModel = new \App\Entities\Manager();
        $manager      = $managerModel->first();
        $manager->assignRole('super_admin');

        /*$manager = new \App\Entities\Manager();
        $manager->first();
        $manager->assignRole('super_admin');*/
    }
}
