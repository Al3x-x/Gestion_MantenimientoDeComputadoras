<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Notifications\NuevaSolicitudNotification;
use Illuminate\Support\Facades\Notification;

use App\Models\User;

use MoonShine\Notifications\MoonShineNotification;

use Illuminate\Support\Facades\URL;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicituds';
    protected $fillable = ['Mantenimiento', 'Solicitante', 'Institucion', 'Direccion', 'Referencia'];

    protected static function booted()
    {
        static::created(function ($solicitud) {
            // Obtener los usuarios administradores
            $adminUsers = User::where('moonshine_user_role_id', 1)->get();
            
            // Enviar notificación a los administradores
            Notification::send($adminUsers, new NuevaSolicitudNotification($solicitud));

            // Enviar notificación a la interfaz de Moonshine manualmente
            foreach ($adminUsers as $user) {
                MoonShineNotification::send(
                    message: 'Se ha creado una nueva solicitud.',
                    button: ['link' => URL::to('/admin/resource/solicitud-resource/detail-page?resourceItem=' . $solicitud->id), 'label' => 'Ver Solicitud'],
                    ids: [$user->id],
                    color: 'green'
                );
            }
        });
    }

}
