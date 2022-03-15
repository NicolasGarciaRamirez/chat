<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait CreatePaymentAndInvoiceMonthly {

    protected $user;

    public function __construct()
    {
        $this->user = \Auth::user();
    }
    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function createBuyerPaymentAndInvoiceMonthly($user, $amount_date, $type, $payment_method)
    {
        $payment         = new \App\Models\Payments\Payments();
        $payment->amount = $amount_date['total'];
        $payment->type   = $type;
        $payment->to_who = $user->id;
        $payment->payment_token = $payment_method['token'] ;
        $this->user->payments()->save($payment);

        $invoice                   = new Invoices();
        $invoice->invoice_number   = Str::random(10);
        $invoice->expedition_date  = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
        $invoice->location         = $this->response->continent_name.'-'.$this->response->country_name.'-'.$this->response->region_name.'-'.$this->response->city.'-'.$this->response->zip;
        $invoice->amount_net       = $amount_date['tier_amount'];
        $invoice->amount_total     = $amount_date['total'];
        $invoice->description      = $type !== 'support' ? 'One-off Donation' : 'Monthly Support';
        $invoice->vta              = $amount_date['vta_total'];
        $invoice->payment_gateway  = $amount_date['gateway'];
        $invoice->currency         = $this->response->currency->symbol === 'CO$' ? '$' : $this->response->currency->symbol;
        $invoice->payment_method   = $this->user->card_brand.' **** '.$this->user->card_last_four;
        $invoice->tier_id          = $amount_date['tier_id'];
        $payment->invoice()->save($invoice);

        // deberia obtener la proxima factura del cliente y asi generar los datos en noisesharks con los datos de stripe'
        // esto asi requeriria que para los usuarios conectados en CA, tengo que obtener todas las facturas y recorrerlas
        // para saber a cual esta subscrito el usuario
        // este metodo se crea para llamarlos en el envio mensual de la factura de subscripcion
        // sea para el vendedor o para el comprador
        return '';
    }

    public function createSellerPaymentInvoiceMonthly($user, $amount_date, $type)
    {
        $payment_user         = new \App\Models\Payments\Payments();
        $payment_user->amount = $amount_date['total'];
        $payment_user->type   = $type.' receive';
        $payment_user->to_who = $this->user->id;
        $payment_user->payment_token = 'N/A';
        $user->payments()->save($payment_user);

        $invoice_user                   = new Invoices();
        $invoice_user->invoice_number   = Str::random(10);
        $invoice_user->expedition_date  = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
        $invoice_user->location         = $this->response->continent_name.'-'.$this->response->country_name.'-'.$this->response->region_name.'-'.$this->response->city.'-'.$this->response->zip;
        $invoice_user->amount_net       = $amount_date['tier_amount'];
        $invoice_user->amount_total     = $amount_date['amount_transfer_percentage'];
        $invoice_user->description      = $type !== 'support' ? 'One-off Donation' : 'Monthly Support';
        $invoice_user->vta              = $amount_date['vta_total'];
        $invoice_user->noisesharks_fee  = $amount_date['noisesharks_fee'];
        $invoice_user->payment_gateway  = $amount_date['gateway'];
        $invoice_user->currency         = $this->response->currency->symbol === 'CO$' ? '$' : $this->response->currency->symbol;
        $invoice_user->payment_method   = $user->card_brand.' **** '.$user->card_last_four;
        $invoice_user->tier_id          = $amount_date['tier_id'];
        $payment_user->invoice()->save($invoice_user);

        return '';
    }
}

