<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'role_menu';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = [
        'owner_id',
    ];

    public static function roles(User $user, $action, $menu) : bool
    {
        $return = false;
        if(false){//($user->owner == 1){
            $return = true;
        }else{
            $role = UserRole::where('user_id' , $user->id)->where('owner_id' , $user->owner_id)->first();
            if($role){
                $action = $action == 'viewAny'? 'view' : $action;
                $role_menu = self::Where([
                    'owner_id' => $user->owner_id,
                    'role' => $role->role,
                    'menus' => $menu,
                ])->first();
                
                if($role_menu){
                    if($role_menu->$action == 1){
                        $return = true;
                    }
                }
            }
            else{
                $return = false;
            }
        }

        return $return;
    }
}
