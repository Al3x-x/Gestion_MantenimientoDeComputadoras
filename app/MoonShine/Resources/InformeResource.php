<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Informe;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;
use MoonShine\Fields\File;
use MoonShine\Components\MoonShineComponent;

use App\Models\Solicitud;

use Illuminate\Support\Facades\Request;

/**
 * @extends ModelResource<Informe>
 */
class InformeResource extends ModelResource
{
    protected string $model = Informe::class;

    protected string $title = 'Informes';
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
                Select::make('Estado')
                    ->options([
                        'op1' => 'Inconveniente',
                        'op2' => 'Finalizado'
                    ])->nullable(),
                File::make('Informe')->removable()->keepOriginalFileName(),
                Text::make('Observacion'),
            ]),
        ];
    }

    /**
     * @param Informe $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
