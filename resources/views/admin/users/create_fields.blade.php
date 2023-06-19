<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('Name')) !!}<span style="color: red">*</span>
    {!! Form::text('name', null, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('Email')) !!}<span style="color: red">*</span>
    {!! Form::email('email', null, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

@php
    $accountNumber = date('Ymd').rand(1000,9999);
@endphp

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('account_number', __('Account Number')) !!}<span style="color: red">*</span>
    {!! Form::number('account_number', $accountNumber, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

<div class="form-group">
    {!! Form::label('mac_address', __('IMEI')) !!}<span style="color: red">*</span>
    {!! Form::text('mac_address', null, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

<div class="form-group">
    {!! Form::label('balance', __('Initial balance')) !!}<span style="color: red">*</span>
    {!! Form::number('balance', 1000, ['class' => 'form-control','required','maxlength' => 191]) !!}
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', __('Password')) !!}<span style="color: red">*</span>
    {!! Form::password('password', ['class' => 'form-control','required','minlength' => 8,'maxlength' => 191]) !!}
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('Phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', __('Address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>




<!-- Image Field -->
@isset($user)
<img src="{{asset('images/'.$user->image)}}" alt="" srcset="">
@endisset
<div class="form-group">
    <br>
    {!! Form::label('image', __('Image')) !!}
    {!! Form::file('image',['class' => 'form-control dropify']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    <div class="custom-control custom-switch">
        <input name="status" value="1" checked type="checkbox" class="custom-control-input" id="customSwitch1">
        <label class="custom-control-label" for="customSwitch1">{{ __('Status') }}</label>
    </div>
</div>


<a id="sig" target="_blank" class="btn btn-primary" href="http://stellar.solutionpi.com/stellar/akhlak.php" onclick="device_unit_subscribe()">Get Fingure Print</a><br>
<input type="hidden" class="form-control" name="manuallyCard" id="manuallyCard" />
<div class="form-group"><br>
    <textarea readonly name="signature" type="text" id="signature" class="form-control" value="" required>{{ old('signature') }}</textarea>
</div>


<!-- Submit Field -->
<div class="form-group">
    {{ Form::button('<i class="fas fa-plus-circle"></i> '.__('Submit'), ['type' => 'submit', 'class' => 'btn btn-primary '] )  }}
    <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i class="fa fa-window-close"
            aria-hidden="true"></i> {{ __('Cancel') }}</a>
</div>

@include('includes.dropify')

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

    </script>
    <script>
        $("#manuallyCard").change(function() {
            var signature = $("#manuallyCard").val();
            document.getElementById('signature').value = signature;
            console.log(signature);
        });
    </script>
@endpush
