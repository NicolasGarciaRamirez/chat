@extends('invoices.template_invoice')

@section('content')
    <div class="text-center">
        <h2 class="font-weight-bold">Invoice Details</h2>
    </div>
    <div class="text-left px-4">
        <b> Invoice Number:</b>
        {{$payment->invoice->invoice_number}}<br><br>
        <b> Issue Date:</b>
        {{$payment->invoice->expedition_date}}
    </div>
    <br>
    @if($type === 'contributorInvoiceReward')
        <div class="px-4">
            This invoice confirms that the user <b>{{$payment->to_who->artistic_name}}</b> rewarded you with the
            amount {{$payment->invoice->currency}}{{$payment->invoice->amount_net}}.
        </div>
    @elseif($type === 'contributorInvoiceSupport')
        <div class="px-4">
            This invoice confirms that the user <b>{{$payment->to_who->artistic_name}}</b> supports you at the tier
            <b>{{$tier['name']}}</b> at the amount {{$payment->invoice->currency}}{{$tier['amount']}}/per month. We aim to collect
            your fees from supporters at the 1st of every month. Please note that
        </div>
    @endif
    <div class="text-center">
        <h2 class="font-weight-bold">Contributor's Details</h2>
    </div>
    <div class="text-left px-4">
        <b>Name:</b>
        {{$user->artistic_name}}
        <br><br>
        <b>Billing Address:</b>
        {{$user->biling_information ? $user->biling_information->location : 'N/A'}}
    </div>
    <br>
    <div class="text-center">
        <h2 class="font-weight-bold">Amount Details</h2>
    </div>
    <div class="text-left d-flex flex-row">
        <table class="table table-bordered w-100 mb-2">
            <thead class="bg-third border-bottom-danger">
            <tr class="text-white text-center p-3">
                <td><b>Date</b></td>
                <td><b>Description</b></td>
                <td><b>Tier</b></td>
                <td><b>{{$type === 'contributorInvoiceReward' ? 'Rewarder' : 'Supporter'}}</b></td>
                <td><b>Amount</b></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border-bottom" width="20%">
                    {{\Carbon\Carbon::parse($payment->invoice->expedition_date)->format('Y-m-d')}}
                </td>
                <td class="border-bottom">
                    {{$payment->invoice->description}}
                </td>
                <td class="border-bottom">
                    {{$tier ? $tier->name : 'N/A'}}
                </td>
                <td class="border-bottom">
                    {{$payment->to_who->artistic_name}}
                </td>
                <td class="border-bottom">
                    {{$payment->invoice->currency}}{{ number_format($payment->invoice->amount_net, '2', '.', '')}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="bg-third text-white border-bottom" colspan="3">
                    Subtotal
                </td>
                <td class="border-bottom">
                    {{$payment->invoice->currency}}{{number_format($payment->invoice->amount_net, '2', '.', '')}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="bg-third text-white border-bottom" colspan="3">
                    Noisesharks Fee (15%)
                </td>
                <td class="border-bottom">
                    {{$payment->invoice->currency}}{{number_format($payment->invoice->noisesharks_fee,'2','.','')}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="bg-third text-white border-bottom-danger" colspan="3">
                    Payment Processing Fee (Insert Fee)
                </td>
                <td class="border-bottom-danger">
                    {{$payment->invoice->currency}}{{number_format($payment->invoice->payment_gateway, '2','.','')}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="font-weight-bold" colspan="3">
                    Total
                </td>
                <td class="font-weight-bold">
                    {{$payment->invoice->currency}}{{number_format($payment->invoice->amount_total, '2','.','')}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="my-2">
        <div style="border-bottom: 3px solid #FF0000 ; padding: 1rem"></div>
    </div>
@endsection
