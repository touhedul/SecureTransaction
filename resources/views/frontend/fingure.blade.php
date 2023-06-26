@extends('layouts.frontend')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Validate Your Fingure') }}</div>

                    <div class="card-body">
                        Press your finger to the machine then click below button
                        <br>
                        <br>
                        <button id="checkFingure" class="btn btn-success">Check Finger</button>
                        <div id="some_div">
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
            $("#checkFingure").click(function() {
                $("#checkFingure").hide();
                var timeLeft = 60;
                var elem = document.getElementById('some_div');

                var timerId = setInterval(countdown, 1000);

                function countdown() {
                    if (timeLeft == -1) {
                        clearTimeout(timerId);
                        doSomething();
                    } else {
                        elem.innerHTML = "Checking in "+ timeLeft ;
                        timeLeft--;
                    }
                }
                window.setTimeout(function() {
                    location.href = "{{ route('checkFingure') }}";
                }, 62000);
            })
        });
    </script>
@endsection
