@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Statement') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Statement</h1>
                    <style>
                        table th,td {
                            border: 3px solid black;
                            border collapse: collabse;
                            padding: 10px;
                        }
                    </style>

                    <table>
                        <thead>
                            <th>S.no</th>
                            <th>Account name</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Transfer To</th>
                        </thead>
                        <tbody>
                            @foreach($statements as $statement)
                                <tr>
                                <td><h2>{{ $statement->id}}</h2></td>
                                <td><h2>{{ $statement->name }}</h2></td>
                                <td><h2>{{ $statement->amount }}</h2></td>
                                <td><h2>{{ $statement->type }}</h2></td>
                                <td><h2>{{ $statement->transfer_to}}</h2></td>
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
