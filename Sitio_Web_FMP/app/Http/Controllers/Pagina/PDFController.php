<?php

namespace App\Http\Controllers\Pagina;

use App\Models\Pagina\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class PDFController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $localizacion)
    {
        $localizacion = base64_decode($localizacion);

        $pdfs = PDF::where('localizacion', $localizacion)->get();   
        $file = $request->file('file'); 
        if(count($pdfs)==0){ 
            
            /**Guardo en carpeta Pdfs */
            $path = public_path() . '/files/pdfs';
            $fileName = uniqid().'.pdf';
            $file->move($path, $fileName);
            
            /**Guardo en base de datos */
            $pdf = new PDF;
            $pdf -> file         = $fileName;
            $pdf -> localizacion = $localizacion;
            $pdf -> user         = auth()->id();
            $pdf -> save();

        }else{
            $_pdf = $pdfs[0];
            
            /**Elimino del servidor el pdf */
            File::delete(public_path() . '/files/pdfs/'.$_pdf->file); 

            /**Guardo en carpeta Pdfs */
            $path = public_path() . '/files/pdfs';
            $fileName = uniqid().'.pdf';
            $file->move($path, $fileName);

            /**Guardo en la base de datos */
            $_pdf -> file   =  $fileName;
            $_pdf -> user   =  auth()->id();
            $_pdf -> save();         
        }

    }
}
