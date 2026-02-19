<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Menus;
use App\Models\RoleMenu;
use App\DTOs\RoleDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleService
{
    public function __construct(
        protected RoleRepositoryInterface $repo
    ) {}

    public function list(array $params, array $where) : array
    {
        return $this->repo->paginateWhere($params, $where);
    }

    public function create(RoleDTO $dto, array $menu_user)
    {   
        $roles = $this->repo->findById($dto->role);
        if ($roles) {
            throw new \RuntimeException('Role already exists');
        }

        $role = $this->repo->create($dto->toArray());

        foreach($menu_user as $menu){
            $menu = RoleMenu::create([
                'owner_id' => $role->owner_id,
                'role' => $dto->role,
                'menus' => $menu['menus'],
                'view' => $menu['view'],
                'create' => $menu['create'],
                'update' => $menu['update'],
                'delete' => $menu['delete'],
            ]);
        }

        return $role;
    }

    public function menu_all()
    {
        $menu = Menus::all();
        return $menu;
    }

    public function find(string $id)
    {
        $role = $this->repo->findById($id);
        if (!$role) {
            throw new \RuntimeException('Role not found');
        }
        return $role;
    }

    public function update(string $id, RoleDTO $dto, array $menu_user)
    {
        $role = $this->repo->findById($id);
        if (!$role) {
            throw new \RuntimeException('Role not found');
        }

        RoleMenu::where([
            'owner_id' => $dto->owner_id,
            'role' => $role->role,
        ])->delete();

        foreach($menu_user as $menu){
            $menu = RoleMenu::create([
                'owner_id' => $dto->owner_id,
                'role' => $dto->role,
                'menus' => $menu['menus'],
                'view' => $menu['view'],
                'create' => $menu['create'],
                'update' => $menu['update'],
                'delete' => $menu['delete'],
            ]);
        }
        
        return $this->repo->update($id, $dto->toArray());
    }

    public function delete(string $id): void
    {
        $role = $this->repo->findById($id);
        if (!$role) {
            throw new \RuntimeException('Role not found');
        }

        RoleMenu::where([
            'owner_id' => $role->owner_id,
            'role' => $role->role,
        ])->delete();
        
        $this->repo->delete($id);
    }
}
