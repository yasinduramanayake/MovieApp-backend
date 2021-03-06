<?php

namespace Modules\Movie\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Movie\Entities\Movie;
use Spatie\QueryBuilder\QueryBuilder;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except(['generatePDF']);
    }

    public function generatePDF(Request $request)
    {
        $data = Movie::all();
     

        $input = $request->input('text');

        $pdf = PDF::loadView('moviePDF', compact('data'));

        return $pdf->save($input . 'movie.pdf');
    }
}
