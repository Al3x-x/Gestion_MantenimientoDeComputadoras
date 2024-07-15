<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Asignacion;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Components\MoonShineComponent;

use App\Models\Solicitud;
use App\Models\User;

use Illuminate\Support\Facades\Request;

/**
 * @extends ModelResource<Asignacion>
 */

class AsignacionResource extends ModelResource
{
    protected string $model = Asignacion::class;

    protected string $title = 'Asignar Mantenimiento';
    protected bool $createInModal = True;
    protected bool $editInModal = True;
    protected bool $deleteInModal = True;


    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }
    
    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {

        $encargado = User::pluck('name')->toArray();
        $solicitante = Solicitud::pluck('Solicitante', 'id')->toArray();

        return [
            Block::make([
                ID::make()->sortable(),
                Select::make('Encargado')->options($encargado)->nullable(),
                Select::make('Solicitante')->options($solicitante)->nullable(),
            ]),
        ];
    }

    /**
     * @param Asignacion $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
