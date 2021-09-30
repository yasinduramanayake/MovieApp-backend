<?php

namespace Modules\Booking\Http\Controllers;
use PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Booking\Entities\Booking;
use Spatie\QueryBuilder\QueryBuilder;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api-system-user'])->except(['BookingPDF']);
    }

    public function BookingPDF()
    {
        $data = Booking::all();


        $pdf = PDF ::loadView('BookPDF', compact('data'));
        return $pdf->save('booking.pdf');
    }
}