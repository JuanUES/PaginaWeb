<?php

namespace App\Providers;

use App\Models\Notificaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){

        // Blade::directive('notificaciones', function ($expression) {
        //     $notificaciones = Notificaciones::where('estado', true)
        //                                     ->where('usuario_id', Auth::user()->id)
        //                                     ->get();
        //     $contenido = '';

        //     foreach ($notificaciones as $key => $value) {
        //         $contenido.= '<a href="javascript:void(0);" class="dropdown-item notify-item active">
        //                             <div class="notify-icon bg-warning"><i class="mdi mdi-comment-account-outline"></i> </div>
        //                             <p class="notify-details">'.$value->mensaje.'<small class="text-muted">'.$value->created_at->diffForHumans().'</small></p>
        //                         </a>';
        //     }

        //     return $contenido;
        // });

        // Blade::directive('total_notificaciones', function ($expression) {
        //     $notificaciones = Notificaciones::where('estado', true)
        //                                 ->where('usuario_id', Auth::user()->id)
        //                                 ->count();
        //     return $notificaciones;
        // });

    }
}
