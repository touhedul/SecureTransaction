@extends('layouts.admin')
@section('title')
    {{ __('Create User') }}
@endsection
@section('content')
    @include('includes.page_header', [
        'title' => __('Create User'),
        'url' => route('admin.users.index'),
        'icon' => 'pe-7s-user',
        'permission' => 'user-view',
    ])
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.users.store', 'files' => true]) !!}

                    @include('admin.users.create_fields')


                    {{-- <a id="sig" target="_blank" class="btn btn-primary" href="http://stellar.solutionpi.com/stellar/akhlak.php" onclick="device_unit_subscribe()">Get
                        Signature</a><br>
                    <input type="hidden" class="form-control" name="manuallyCard" id="manuallyCard" />
                    <div class="form-group"><br>
                        <textarea readonly name="signature" type="text" id="signature" class="form-control" value="" required>{{ old('signature') }}</textarea>
                    </div> --}}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- @push('script')
    <script src="{{ asset('fingerprint/paho-mqtt-min.js') }}"></script>
    <script src="{{ asset('fingerprint/stellar.min.js') }}"></script>

    <script>
        function device_unit_subscribe() {
            var unit_id = "FP2236693829";
            var operation = "template";
            var html_id = "#signature";
            var client_id = "rams" + "/" + unit_id;
            var replace = true;
            stellar_mqtt(operation, html_id, client_id, replace);
      }

    </script>
    <script>
        $("#manuallyCard").change(function() {
            var signature = $("#manuallyCard").val();
            document.getElementById('signature').value = signature;
            console.log(signature);
        });
    </script>
@endpush --}}

