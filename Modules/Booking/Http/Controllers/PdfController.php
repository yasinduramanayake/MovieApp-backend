<?php

namespace Modules\Booking\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Booking\Entities\Booking;
use Spatie\QueryBuilder\QueryBuilder;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except(['generatePDF']);
    }

    public function generatePDF(Request $request)
    {
        $data = Booking::all();
    
       
    
        $input = $request->input('text');
            
           
    
        $pdf = PDF::loadView('BookPDF', compact('data'));
        
        return $pdf->save($input . '\booking.pdf');
        
    }
}