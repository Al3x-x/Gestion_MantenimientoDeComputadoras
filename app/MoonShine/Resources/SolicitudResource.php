<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Solicitud;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use Moonshine\Fields\Boolean;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Solicitud>
 */
class SolicitudResource extends ModelResource
{
    protected string $model = Solicitud::class;

    protected string $title = 'Solicituds';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Boolean::make('Mantenimiento'),
                Text::make('Responsable'),
                Text::make('Institucion'),
                Text::make('Direccion'),
                Text::make('Referencia'),
            ]),
        ];
    }

    /**
     * @param Solicitud $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
