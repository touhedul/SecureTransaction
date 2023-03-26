@extends('layouts.admin')
@section('title', 'Add finger print')
@section('content')
    @include('includes.message')
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Add finger print</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="#">Panel</a>
                    </li>
                    <li>
                        <a href="#">Admin</a>
                    </li>
                    <li class="active">
                        Add finger print
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-12">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">

                        <form action="" method="POST">

                            <a id="user_reg_mode" target="_blank" class="btn btn-primary">Get
                                Signature</a><br>
                            @csrf
                            <div class="form-group"><br>
                                <textarea readonly name="signature" type="text" id="signature" class="form-control" value="" required>{{ old('signature') }}</textarea>
                            </div>
                            <input type="hidden" name="student_id" value="5">
                            <button type="submit" class="btn btn-success">Accept</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
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
        $("#user_reg_mode").click(function() {
            alert('dlkfj');
            var unit_id = $("#unit_id").val();
            var json = {
                unitId: unit_id
            };
            $.ajax({
                type: "POST",
                url: 'https://rumytechnologies.com/rams/active_user_registration_mode.json',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(json),
                success: function(data) {
                    //$("#user_reg_mode").attr('class', 'btn pull-right btn-warning');
                    //$("#user_reg_mode").text("Please Wait").show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("Error Found!");
                }
            });
        });
    </script>
    <script>
        $("#manuallyCard").change(function() {
            var signature = $("#manuallyCard").val();
            document.getElementById('signature').value = signature;
            console.log(signature);
        });
    </script>
@endpush
