<?php

namespace Modules\Theater\Http\Controllers;
use PDF;
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

    public function generatePDF()
    {
        $data = Theater::all();
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        // ];

        //yasindu


        $pdf = PDF::loadView('PDF', compact('data'));
        return $pdf->save('D:\theaters.pdf');
    }
}