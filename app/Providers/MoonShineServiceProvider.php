<?php

declare(strict_types=1);

namespace App\Providers;

use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuDivider;

use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\AsignacionResource;
use MoonShine\Contracts\Resources\ResourceContract;
use App\MoonShine\Resources\SolicitudResource;
use App\MoonShine\Resources\InformeResource;
use App\MoonShine\Resources\DiagnosticoResource;

use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;
use Closure;
use Illuminate\Http\Request; 

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    /**
     * @return list<ResourceContract>
     */
    protected function resources(): array
    {
        return [];
    }

    /**
     * @return list<Page>
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * @return Closure|list<MenuElement>
     */
    protected function menu(): array
    {
        return [
            MenuGroup::make('System', [
                MenuItem::make('Admins', new \Sweet1s\MoonshineRBAC\Resource\UserResource(), 
                'heroicons.outline.users'),
                MenuItem::make('Roles', new \Sweet1s\MoonshineRBAC\Resource\RoleResource(), 
                'heroicons.outline.shield-exclamation'),
                MenuItem::make('Permissions', new \Sweet1s\MoonshineRBAC\Resource\PermissionResource(), 
                'heroicons.outline.shield-exclamation'),
            ], 'heroicons.outline.user-group'),
            
            MenuItem::make(
                static fn() => __('Solicitud de Mantenimiento'), 
                new SolicitudResource()
            ),

            MenuItem::make(
                static fn() => __('Asignación Mantenimiento'), 
                new AsignacionResource()
            ),

            MenuItem::make(
                static fn() => __('Diagnostico'),
                new DiagnosticoResource()
            ),

            MenuItem::make(
                static fn() => __('Reportes'),
                new InformeResource()
            ),

            MenuItem::make('ESPOCH', 'https://www.espoch.edu.ec')
            ->badge(fn() => 'Check')
            ->blank(),
        ];
    }

    /**
     * @return Closure|array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
