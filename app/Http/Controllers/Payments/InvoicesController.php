<?php

namespace App\Http\Controllers\Payments;

use App\Models\Payments\Invoices;
use App\Models\Payments\Payments;
use App\Models\User\User;
use PDF;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{
    public function generatePdf($type , Payments $payment, $user)
    {
        $user = User::whereToken($user)->first();
        $user->load('payment_methods.biling_information')->get();
        $payment->load('invoice','to_who','user')->get();
        $payment->to_who = User::whereId($payment->to_who)->first();

        if($type === 'contributorInvoiceReward' || $type === 'contributorInvoiceSupport'){
            // nestas son del que recibe
            $pdf = PDF::loadView('invoices.invoice_contributor', ['payment' => $payment, 'user' => $user, 'type' => $type, 'tier' => $payment->invoice->tier_id ?  \App\Models\User\UserTiersInformation::whereId($payment->invoice->tier_id)->first() : null, 'to_who' => User::whereId($payment->to_who)->first()])->setPaper('SRA4', 'portrait');
            return $pdf->download( \Auth::check() ? 'invoice-'.$payment->invoice->invoice_number.'-'.\Auth::user()->artistic_name.'.pdf' : 'invoice-'.$payment->invoice->invoice_number.'.pdf');
        }else{
            // estas son del que envia
            $pdf = PDF::loadView('invoices.invoice_payment', ['payment' => $payment, 'user' => $user, 'type' => $type, 'tier' => $payment->invoice->tier_id ?  \App\Models\User\UserTiersInformation::whereId($payment->invoice->tier_id)->first() : null])->setPaper('SRA4', 'portrait');
            return $pdf->download( \Auth::check() ? 'invoice-'.$payment->invoice->invoice_number.'-'.\Auth::user()->artistic_name.'.pdf' : 'invoice-'.$payment->invoice->invoice_number.'.pdf');
        }
    }
}
