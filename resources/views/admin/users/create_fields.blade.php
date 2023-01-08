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
    {!! Form::text('account_number', $accountNumber, ['class' => 'form-control','required','maxlength' => 191]) !!}
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


<!-- Submit Field -->
<div class="form-group">
    {{ Form::button('<i class="fas fa-plus-circle"></i> '.__('Submit'), ['type' => 'submit', 'class' => 'btn btn-primary '] )  }}
    <a href="{{ route('admin.users.index') }}" class="btn btn-danger"><i class="fa fa-window-close"
            aria-hidden="true"></i> {{ __('Cancel') }}</a>
</div>

@include('includes.dropify')
