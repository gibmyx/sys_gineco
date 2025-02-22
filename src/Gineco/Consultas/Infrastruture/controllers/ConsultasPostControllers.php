<?php

declare(strict_types=1);

namespace SysGineco\Gineco\Consultas\Infrastruture\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SysGineco\Gineco\Consultas\Application\Create\ConsultaCreator;
use SysGineco\Gineco\Consultas\Application\Create\ConsultaCreatorRequest;

final class ConsultasPostControllers extends Controller
{
    private $creator;

    public function __construct(ConsultaCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(Request $request)
    {
        $this->validateRequest($request);

        ($this->creator)(new ConsultaCreatorRequest(
            !empty($request->id) ? (string) $request->id : '',
            !empty($request->paciente_id) ? (string) $request->paciente_id : '',
            !empty($request->codigo) ? (string) $request->codigo : '',
            !empty($request->fecha) ? (string) $request->fecha : '',
            !empty($request->observacion) ? (string) $request->observacion : '',
            !empty($request->indicacion) ? (string) $request->indicacion : '',
            !empty($request->motivo) ? (string) $request->motivo : '',
            !empty($request->reposo_medico) ? (string) $request->reposo_medico : ''
        ));

        return redirect()->route('consultas.list');
    }

    private function validateRequest(Request $request): void
    {
        $request->validate([
            'paciente_id' => 'required',
            'fecha' => 'required'
        ]);
    }
}
