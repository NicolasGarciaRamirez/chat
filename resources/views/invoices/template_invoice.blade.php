<!DOCTYPE html>
<html class="bg-primary">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content= "width=device-width, user-scalable=no">
    <title>🎹🦈Noisesharks</title>
    <style type="text/css">
        html {
            margin: 0;
        }
        body {
            margin-top: 0;
            padding: 0;
            font-family:  'Encode Sans', sans-serif;
        }
        .font-weight-bold{
            font-weight: bold;
        }
        .m-0{
            margin:0
        }
        .my-2{
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .my-3{
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .my-4{
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .my-5{
            margin-top: 2.5rem;
        }
        .mb-2{
            margin-bottom: 1rem;
        }
        .p-1{
            padding: 0.5rem;
        }
        .p-2{
            padding: 1rem;
        }
        .p-3{
            padding: 1.5rem;
        }
        .p-4{
            padding: 2rem;
        }
        .p-5{
            padding: 2.5rem;
        }
        .pl-4{
            padding-left: 2rem;
        }
        .py-1{
            padding-top: .3rem;
            padding-bottom: .3rem;
        }
        .py-2{
            padding-top: .5rem;
            padding-bottom: .5rem;
        }
        .py-3{
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .py-4{
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .py-5{
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .px-1{
            padding-left: .3rem;
            padding-right: .3rem;
        }
        .px-2{
            padding-left: .5rem;
            padding-right: .5rem;
        }
        .px-3{
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .px-4{
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .px-5{
            padding-left: 2rem;
            padding-right: 2rem;
        }
        .py-5{
            padding-top: 2.5rem;
        }
        .pb-2{
            padding-bottom: 1rem;
        }
        .d-flex{
            display: flex;
        }
        .flex-column{
            flex-direction: column;
        }
        .flex-row{
            flex-direction: row;
        }
        .justify-content-center{
            justify-content: center;
        }
        .justify-content-between{
            justify-content: space-between;
        }
        .img-logo{
            min-width: 4.2rem;
            min-height: 4.2rem;
            max-height: 4.2rem;
            max-width: 4.2rem;
            margin-top: 5rem;
        }
        .container{
            width: 100%;
            padding-right: 3rem;
            padding-left: 3rem;
            margin-right: auto;
            margin-left: auto;
            margin-top: 0;
        }
        .bg-primary{
            background: #141414;
        }
        .c-primary{
            color: #141414;
        }
        .bg-second{
            background: #1c1c1c;
        }
        .c-second{
            color: #1c1c1c;
        }
        .bg-third{
            background: #262626;
        }
        .c-third{
            color: #262626;
        }
        .bg-fourth{
            background: #565656;
        }
        .c-fourth{
            color: #565656;
        }
        .bg-fifth{
            background: #FF0000;
        }
        .c-fifth{
            color: #FF0000;
        }
        .c-white{
            color: white;
        }
        .position-absolute{
            position: absolute;
        }
        .c-body{
            display: flex;
            flex-direction: column;
            color: white;
        }
        .text-white{
            color: white;
        }
        .text-center{
            text-align: center;
        }
        .w-100{
            width: 100%;
        }
        table{
            margin-left: 1.5rem;
            margin-right: 1.5rem;
            border-collapse: collapse;
        }
        table td{
            align-items: center;
            padding: 0.85rem;
            margin: 0;
        }
        .table-bordered td{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .border-bottom{
            border-bottom: 1px solid black;
        }
        .border-bottom-danger{
            border-bottom: 5px solid #ff0000;
        }
        .body{
            transform: translateY(-6rem)
        }
    </style>
</head>
<body class="d-flex flex-column container">
    <div class="body">
        <div class="d-flex flex-column">
            <div class="border-bottom-danger">
                <img src="{{public_path('/images/noisesharks.svg')}}" class="img-logo text-left">
                @if($type === 'contributor')
                    <h1 class="text-right font-weight-bold mb-2">{{ucfirst($type)}}'s Invoice</h1>
                @elseif($type === 'contributorInvoiceReward' || $type === 'contributorInvoiceSupport')
                    <h1 class="text-right font-weight-bold mb-2">Contributor's Invoice</h1>
                @else
                    <h1 class="text-right font-weight-bold mb-2">{{ucfirst($type)}}er's Invoice</h1>
                @endif
            </div>
        </div>
        @yield('content')
        <div class="px-4">
            <div class="my-3">
                This invoice is issued by Noisesharks LTD, located at 1 Westhill Pathfields Business Park,
                South Molton, England, EX36 3BS. Vat No: GB328184395.
            </div>
            <div>
                Please don’t hesitate to contact us at <a href="mailto:support@noisesahrks.com">support@noisesharks.com</a> if you need any help!.
            </div>
            <div class="my-3">
                Rewarding a user means you have already agreed and accepted Noisesharks’
                <a href="https://www.noisesharks.com/docs/Terms%20and%20Conditions.pdf">Terms and Conditions</a>,
                <a href="https://www.noisesharks.com/docs/Privacy%20and%20Cookies%20Policy.pdf">Privacy and Cookie Policy</a> and
                <a href="https://www.noisesharks.com/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf">Copyright Policy.</a>
            </div>
        </div>
    </div>
</body>
</html>

