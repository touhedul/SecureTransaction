@extends('layouts.frontend')
@section('title', 'Scan QR code')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Scan QR code</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row justify-content-center">
                            {!! QrCode::size(300)->generate(auth()->user()->mac_address) !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            setInterval(() => {
                $.ajax({
                    type: 'GET',
                    url: "{{route('user.checkUser')}}",
                    success: function(data) {
                        if(data == 200){
                            window.location.href = "{{route('user.dashboard')}}";
                        }
                    },
                    error: function(data) {
                    }
                });
            }, 5000);
        });
    </script>
@endsection
