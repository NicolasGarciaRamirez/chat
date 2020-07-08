@extends('template.template')

@section('content')
    <div class="container home">
        <home :posts="{{ $posts }}" ref="home"/>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            console.log(window.screen.width)
            if (window.screen.width <= 768){
                $('#ModalMobile').modal('show'); //a donde esta el modal? tenes que ponerlo par que funcione no encuentra el ID
            }
        })
    </script>
@endpush
