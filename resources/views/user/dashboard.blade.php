@extends('layouts.frontend')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <h3>Total available amount : {{ auth()->user()->balance }}</h3>
                        <br>
                        <form action="{{route('user.cashout')}}" method="POST">
                            @csrf
                            <input placeholder="Enter amount for cashout" type="number" name="amount" max="{{ auth()->user()->balance }}" min="10" class="form-control">
                            <br>
                            <button type="submit" class="btn btn-success">Cashout</button>
                        </form>

                        <br>

                        <table class="table table-striped">
                            <tr>
                                <th>Sl.</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                            @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$transaction->amount}}</td>
                                <td>{{$transaction->created_at->toFormattedDateString()}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td></td>
                                <td>No Data Found</td>
                                <td></td>
                            </tr>
                            @endforelse
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
