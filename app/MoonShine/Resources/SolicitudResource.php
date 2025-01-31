<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Solicitud;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select; 
use MoonShine\Components\MoonShineComponent;

use Illuminate\Support\Facades\Request;

/**
 * @extends ModelResource<Solicitud>
 */
class SolicitudResource extends ModelResource
{
    protected string $model = Solicitud::class;

    protected string $title = 'Solicitudes';
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
        return [
            Block::make([
                ID::make()->sortable(),
                Select::make('Mantenimiento')
                ->options([
                    'op1' => 'Si',
                    'op2' => 'No'
                ])
                ->nullable(),
                Text::make('Solicitante'),
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
