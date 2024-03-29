<!-- Name Field -->
<div class="form-group">
    <b>{!! Form::label('name', __('Name')) !!}</b>
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    <b>{!! Form::label('email', __('Email')) !!}</b>
    <p>{{ $user->email }}</p>
</div>
<!-- Email Field -->
<div class="form-group">
    <b>{!! Form::label('account_number', __('Account Number')) !!}</b>
    <p>{{ $user->account_number }}</p>
</div>
<div class="form-group">
    <b>{!! Form::label('account_number', __('Balance')) !!}</b>
    <p>{{ $user->balance }}</p>
</div>
<div class="form-group">
    <b>{!! Form::label('account_number', __('Phone Registration Number')) !!}</b>
    <p>{{ $user->mac_address }}</p>
</div>


<!-- Phone Field -->
<div class="form-group">
    <b>{!! Form::label('phone', __('Phone')) !!}</b>
    <p>{{ $user->phone }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    <b>{!! Form::label('address', __('Address')) !!}</b>
    <p>{{ $user->address }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    <b>{!! Form::label('address', __('Status')) !!}</b>
    @if ($user->status == 1)
    <div class="mb-2 mr-2 badge badge-success">Active</div>
    @else
    <div class="mb-2 mr-2 badge badge-danger">Deactive</div>
    @endif
</div>

<!-- Image Field -->
<div class="form-group">
    <b>{!! Form::label('image', __('Image')) !!}</b>
    <p><img src="{{asset('images/'.$user->image)}}" alt="No Image Found" /></p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', __('Created At')) !!}</b>
    <p>{{ $user->created_at->toFormattedDateString() }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', __('Updated At')) !!}</b>
    <p>{{ $user->updated_at->toFormattedDateString() }}</p>
</div>
<br>
<h3>Transaction History</h3>
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
