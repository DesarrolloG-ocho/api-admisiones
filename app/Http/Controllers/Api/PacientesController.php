<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use BD;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $consulta = DB::Connection('sqlsrv')

        ->select("SELECT 
                    DISTINCT MAEPAB1.MPNumC AS CAMA, 
                    CAPBAS.MPNOMC AS PACIENTE,
                    MAEPAB1.MPUDoc AS TIP_DOC, 
                    MAEPAB1.MPUced AS NUM_DOC,
                    EMPRESS.EMPDSC AS NOMBRE_EPS,		
                    MAEESP.MENOME AS ESPECIALIDAD_TRATANTE,
                    MAEPAB1.MPCtvIn AS CSC_INGRESO,
                    DATEDIFF(dd, TMPFAC.TFFchI,GETDATE()+1) AS Estancia_dias 
        FROM	    MAEPAB1
                    LEFT JOIN CAPBAS ON MAEPAB1.MPUced = CAPBAS.MPCedu AND MAEPAB1.MPUDoc = CAPBAS.MPTDoc
                    LEFT JOIN TMPFAC ON MAEPAB1.MPUced = TMPFAC.TFcedu AND MAEPAB1.MPCtvIn = TMPFAC.TmCtvIng AND TMPFAC.TFTDoc = MAEPAB1.MPUDoc AND TMPFAC.TFcCodCam = MAEPAB1.MPNumC AND TMPFAC.TFcCodPab = MAEPAB1.MPcodP 
                    LEFT JOIN MAEESP ON MAEESP.MECODE = TMPFAC.TFESMT
                    LEFT JOIN MAEEMP ON MAEEMP.MENNIT = TMPFAC.TFMENi
                    LEFT JOIN EMPRESS ON EMPRESS.MEcntr = MAEEMP.MEcntr
        WHERE       MAEPAB1.MPCODP IN (7) AND MAEPAB1.MPActCam <> ? ", ['S']);
;
        return $consulta;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function show(Pacientes $pacientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pacientes $pacientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacientes $pacientes)
    {
        //
    }
}
