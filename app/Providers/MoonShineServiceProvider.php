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
use MoonShine\Contracts\Resources\ResourceContract;
use App\MoonShine\Resources\SolicitudResource;
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
            MenuGroup::make(static fn() => __('Panel de Control'), [
                MenuItem::make(
                    static fn() => __('Administradores'),
                    new MoonShineUserResource()
                ),

                MenuDivider::make(),

                MenuItem::make(
                    static fn() => __('Roles'),
                    new MoonShineUserRoleResource()
                ) 

            ],'heroicons.computer-desktop')->canSee(fn()=> false)   
            ->canSee(function(Request $request){
                return $request->user('moonshine')?->name === 'darwin.quezada';
            }),

            MenuItem::make(
                static fn() => __('Solicitud de Mantenimiento'), 
                new SolicitudResource()
            ),

            // MenuItem::make(
            //     static fn() => __('Asignación del Mantenimiento'), 
            //     new MoonShineAsignacionMantenimiento()
            // )->canSee(fn()=> false)   
            //     ->canSee(function(Request $request){
            //         return $request->user('moonshine')?->name === 'darwin.quezada';
            //     }),

            // MenuItem::make(
            //     static fn() => __('Informes'),
            //     new MoonShineInformes()
            // )->canSee(fn()=> false)   
            //     ->canSee(function(Request $request){
            //         return $request->user('moonshine')?->rol === 'Administrador' || $request->user('moonshine')?->rol === 'Tecnico';;
            //     }),

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
