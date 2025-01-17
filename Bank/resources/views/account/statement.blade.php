@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Statement') }} <br><a href="/home">Back</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Statement</h3>

                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Date</th>
                            <th scope="col">Account name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Transfer To</th>
                            <th scope="col">Current Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->name }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->transfer_to }}</td>
                                    <td>{{ $transaction->balance }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
