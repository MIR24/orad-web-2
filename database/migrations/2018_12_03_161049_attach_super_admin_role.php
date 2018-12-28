<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use Backpack\Base\app\Models\BackpackUser as User;

class AttachSuperAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::where('name', 'Super-admin')->first();

        $user = User::where('name', 'Developer')->first();

        if (!empty($user) && !empty($role) && !$user->hasRole($role)) {
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

        $user = User::where('name', 'Developer')->first();

        if (!empty($user) && !empty($role) && $user->hasRole($role)) {
            $user->removeRole($role);
        }
    }
}
