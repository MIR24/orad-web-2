<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use Backpack\Base\app\Models\BackpackUser as User;

class AddSuperAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('roles')->where('name', 'Super-admin')
            ->delete();

        $role = Role::create(['guard_name' => 'web', 'name' => 'Super-admin']);

        $user = User::find(1);

        if (!empty($user)) {
            $user->assignRole($role);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::where('name', 'Super-admin')->first();

        if (!empty($role)) {
            $roleId = $role->id;

            DB::table('model_has_roles')->where('role_id', $roleId)
                ->delete();

            DB::table('roles')->where('id', $roleId)
                ->delete();
        }
    }
}
