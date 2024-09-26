<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantExport;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
{
    public function export(Request $request): Response|BinaryFileResponse
    {
        $fromDate = $request->get('from_date', date("Y-m-d", 946684800));
        $toDate   = $request->get('to_date', date("Y-m-d"));

        $fromDate = Carbon::createFromFormat("Y-m-d", $fromDate)->startOfDay();
        $toDate   = Carbon::createFromFormat("Y-m-d", $toDate)->endOfDay();

        if ($request->input('action') == 'pdf') {
            $registrations = Registration::with(['event', 'payment'])
                ->where('created_at', '>=', $fromDate)
                ->where('created_at', '<=', $toDate)->get();

            $pdf = Pdf::loadView('backend.participants.export', [
                'fromDate'      => $fromDate,
                'toDate'        => $toDate,
                'registrations' => $registrations
            ]);

            return $pdf->download('participants.pdf');
        }
        return Excel::download(new ParticipantExport($fromDate, $toDate), 'participants.xlsx');
    }

    public function pdf(Request $request)
    {
        $fromDate = $request->get('from_date', date("Y-m-d", 946684800));
        $toDate   = $request->get('to_date', date("Y-m-d"));

        $fromDate = Carbon::createFromFormat("Y-m-d", $fromDate)->startOfDay();
        $toDate   = Carbon::createFromFormat("Y-m-d", $toDate)->endOfDay();

        $pdf = PDF::loadView('participants.export', [$fromDate, $toDate]);
        return $pdf->download('participants.pdf');
    }
}
