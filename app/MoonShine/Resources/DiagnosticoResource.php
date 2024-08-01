<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Diagnostico;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Components\MoonShineComponent;

use App\Models\Solicitud;

use Illuminate\Support\Facades\Request;

/**
 * @extends ModelResource<Diagnostico>
 */
class DiagnosticoResource extends ModelResource
{
    protected string $model = Diagnostico::class;

    protected string $title = 'Diagnosticos';
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

        $institucion = Solicitud::pluck('institucion')->toArray();

        return [
            Block::make([
                ID::make()->sortable(),
                Select::make('Institucion')->options($institucion)->nullable(),
                Text::make('Num_Lab'),
                Text::make('Tipos_Equipos'),
                Text::make('Num_Maquinas'),
                Select::make('Categoria')->options(
                    [
                        "op1" => "Hardware",
                        "op2" => "Software",
                        "op3" => "Ambos"
                    ]
                )->nullable(),
                Text::make('Solucion_General'),
                Text::make('Observaciones'),
            ]),
        ];
    }

    /**
     * @param Diagnostico $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
