<?php

namespace App\Http\Controllers;

use Illuminate\Support\Number;
use App\Services\BillingService;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController
{
    public static function toCurrency($number) {
        return Number::currency($number, 'USD', 'us');
    }

    public function index($accountId)
    {
        $billingData = BillingService::getAllBillings($accountId);

        $billingData['total'] = static::toCurrency($billingData['total']);
        foreach($billingData['services'] as &$service) {
            $service['cost'] = static::toCurrency($service['cost']);
        }

        $pdf = Pdf::loadView('pdf.invoice', $billingData);
        return $pdf->stream('monthly-invoice.pdf');
    }
}
