@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3>{{ Auth::user()->name }} </h3>
                    <h5>Current Balance {{Auth::user()->account->balance ?? "0"}}</h5><br>
                        <a class="btn btn-success" href="/user/deposit" role="button">Deposit</a>

                        <a class="btn btn-danger ml-2" href="/user/withdraw" role="button">Withdraw</a>

                        <a class="btn btn-secondary ml-2" href="/user/transfer" role="button">Transfer</a>

                        <a class="btn btn-primary ml-2" href="/user/statement" role="button">Statement</a>
                </div><br>
                
                <div class="card-body">
                    <h3>Transaction</h3>
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
