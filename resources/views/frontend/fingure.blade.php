@extends('layouts.frontend')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Validate Your Fingure') }}</div>

                    <div class="card-body">
                        Press your fingure to the machine then click below button

                        <a href="{{route('checkFingure')}}" class="btn btn-success">Check Fingure</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
