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
    @if($type === 'reward')
        <div class="px-4">
            This invoice confirms your one-off donation (aka Reward) to the contributor <b>{{$payment->to_who->artistic_name}}</b> at <b>{{$payment->invoice->currency}}{{$payment->invoice->amount_net}}</b>.
        </div>
    @elseif($type === 'support')
        <div class="px-4">
            This invoice confirms your monthly subscription support to the contributor <b>{{$payment->to_who->artistic_name}}</b> as you have joined the tier <b> {{$tier ? $tier->name : 'N/A'}}</b>
            at {{$payment->invoice->currency}}{{$tier ? $tier->amount : ''}}/per month.
        </div><br>
        <div class="px-4">
            Your next payment will be at the 1st of {{\Carbon\Carbon::now()->addMonth()->isoFormat('MMMM')}}. Please note that we try to
            help organise our contributors’ earnings by unifying their support payments to the 1st of
            every month.
        </div>
    @elseif($type === 'contributor')
        <div class="px-4">
            This invoice confirms your one-off joining fee payment as a percentage mode contributor.
        </div>
    @endif

    @if($type !== 'contributor')
        <div class="text-center">
            <h2 class="font-weight-bold">{{ucfirst($type)}}er's Details</h2>
        </div>
    @else
        <div class="text-center">
            <h2 class="font-weight-bold">{{ucfirst($type)}}'s Details</h2>
        </div>
    @endif

    <div class="text-left px-4">
        <b>Name:</b>
        {{$user->artistic_name}}
        <br><br>
        <b>Billing Address:</b>
        {{$user->payment_methods[0]->biling_information ? $user->payment_methods[0]->biling_information->location : 'N/A' }}
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
                    @if($type === 'contributor')
                        <td></td>
                    @endif
                    <td><b>Description</b></td>

                    @if($type !== 'contributor')
                        <td>
                            <b>Tier</b>
                        </td>
                    @endif
                    @if($type !== 'contributor')
                        <td>
                            <b>Contributor</b>
                        </td>
                    @else
                        <td></td>
                    @endif
                    <td><b>Amount</b></td>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border-bottom" width="20%">
                    {{\Carbon\Carbon::parse($payment->invoice->expedition_date)->format('Y-m-d')}}
                </td>
                @if($type === 'contributor')
                    <td class="border-bottom"></td>
                @endif
                <td class="border-bottom">
                    {{$payment->invoice->description}}
                </td>
                @if($type !== 'contributor')
                    <td class="border-bottom">
                        {{$tier ? $tier->name : 'N/A'}}
                    </td>
                @endif
                @if($type !== 'contributor')
                    <td class="border-bottom">
                        {{$payment->to_who->artistic_name}}
                    </td>
                @else
                    <td></td>
                @endif
                <td class="border-bottom">
                    {{$payment->invoice->currency}}{{ number_format($payment->invoice->amount_net, '2', '.', '')}}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                @if($payment->invoice->currency === '€' || $payment->invoice->currency === '£')
                    <td class="bg-third text-white border-bottom">
                        Subtotal
                    </td>
                    <td class="border-bottom">
                        {{$payment->invoice->currency}}{{number_format($payment->invoice->amount_net, '2', '.', '')}}
                    </td>
                @else
                    <td class="bg-third text-white border-bottom-danger">
                        Subtotal
                    </td>
                    <td class="border-bottom-danger">
                        {{$payment->invoice->currency}}{{number_format($payment->invoice->amount_net, '2', '.', '')}}
                    </td>
                @endif
            </tr>
            @if($payment->invoice->currency === '€' || $payment->invoice->currency === '£')
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="bg-third text-white border-bottom-danger">
                        VAT (20%)
                    </td>
                    <td class="border-bottom-danger">
                        {{$payment->invoice->currency}}{{number_format($payment->invoice->vta,'2','.','')}}
                    </td>
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">
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


