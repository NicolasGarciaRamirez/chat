@if(\Auth::check())
    @if(\Auth::user()->subscription_type === 'CONTRIBUTOR')
        @if(!\Auth::user()->customer_id)
           <alert-stripe></alert-stripe>
        @endif
    @endif
    <alert-batch></alert-batch>
@endif
