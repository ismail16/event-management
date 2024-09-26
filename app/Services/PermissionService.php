<?php

namespace App\Services;

class PermissionService extends BaseService
{
    private function buildPermissionList(array $roles): array
    {
        $permissions = [];
        foreach ($roles as $role) {
            $permissions = array_merge($permissions, config('permissions.'.$role));
        }

        return array_unique($permissions);
    }

    private function userHasPermission($route, $roles): bool
    {
        $permissions = $this->buildPermissionList($roles);

        if (empty($permissions)) {
            return false;
        }

        if (in_array($route, $permissions)) {
            return true;
        }

        $routeSegment  = explode('.', $route);
        $action        = array_pop($routeSegment);
        $wildcardRoute = implode('.', $routeSegment).'.*';

        if (in_array($wildcardRoute, $permissions)) {
            return true;
        }

        return false;
    }

    public function check($route): bool
    {
        if (auth_user() === null) {
            return false;
        }

        $roles = auth_user()->roles ?? [];
        if (!empty($roles)) {
            return $this->userHasPermission($route, $roles);
        }

        return false;
    }
}
