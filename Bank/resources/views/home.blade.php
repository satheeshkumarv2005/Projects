@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ session('success') }}
                    <br>


                    {{ Auth::user()->name }} {{Auth::user()->account->balance ?? "0"}}
                    <br><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons" text-aliment="centre">
                        <a class="btn btn-success" href="/home/deposit" role="button">Deposit</a>
                        <br><br>
                        <a class="btn btn-danger" href="/home/withdraw" role="button">Withdraw</a>
                        <br><br>
                        <a class="btn btn-secondary" href="/home/transfer" role="button">Transfer</a>
                        <br><br>
                        <a class="btn btn-primary" href="/home/statement" role="button">Statement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
