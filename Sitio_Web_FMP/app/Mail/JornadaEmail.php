<?php

namespace App\Mail;

use App\Models\General\Empleado;
use App\Models\Horarios\Departamento;
use App\Models\Jornada\Periodo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JornadaEmail extends Mailable{
    use Queueable, SerializesModels;
    public $recursos_humanos;
    public $empleados;
    public $periodo;
    public $depto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Empleado $recursos_humanos, Periodo $periodo, Departamento $depto, Empleado $empleados){
        $this->recursos_humanos = $recursos_humanos;
        $this->periodo = $periodo;
        $this->depto = $depto;
        $this->empleados = $empleados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->view('Mails.jornada');
    }
}
