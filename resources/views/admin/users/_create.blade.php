@extends('layouts.admin')
@section('title'){{ __('Create User') }} @endsection
@section('content')
@include('includes.page_header',['title'=>__('Create User'),'url'=>route('admin.users.index'),'icon' => 'pe-7s-user','permission'=>'user-view'])
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                    {!! Form::open(['route' => 'admin.users.store', 'files' => true]) !!}

                        @include('admin.users.create_fields')


                        <a id="sig" class="btn btn-success" onclick="device_unit_subscribe()">Add Fingure print</a>

<button type="submit" onclick="get_data()">Get Data</button>

<div id="user_signature"></div>

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('fingerprint/paho-mqtt-min.js')}}"></script>
<script src="{{asset('fingerprint/stellar.min.js')}}"></script>



<script>
    function device_unit_subscribe() {

        // var operation = "template";
        // var html_id = "#user_signature";
        // var client_id = "touhedul";
        // stellar_mqtt(operation, html_id, client_id);
  }
</script>
@endpush
