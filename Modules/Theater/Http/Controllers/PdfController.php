<?php

namespace Modules\Theater\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Theater\Entities\Theater;
use Spatie\QueryBuilder\QueryBuilder;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except(['generatePDF']);
    }

    public function generatePDF(Request $request)
    {
        $data = Theater::all();
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        // ];
    
       
    
        $input = $request->input('text');
            
           
    
        $pdf = PDF::loadView('PDF', compact('data'));
        
        return $pdf->save($input . '\theater.pdf');
        
    }
}