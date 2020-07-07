@extends('template.template')

@section('content')
    <div class="container home">
        <home :posts="{{ $posts }}" ref="home"/>
    </div>
@endsection

@section('js')
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(){--}}
{{--            console.log(window.screen.width)--}}
{{--            if (window.screen.width <= 360){--}}
{{--                $('#ModalMobile').modal('show');--}}
{{--            }--}}
{{--        })--}}
{{--    </script>--}}
@endsection
