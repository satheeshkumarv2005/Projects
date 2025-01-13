@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transfer') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action={{ route('user.account.transfer') }}>
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label for="account_id">Account Id</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="account_id">
                                    <option value="">-- select recipiend --</option>
                                    @foreach ($users as $user)
                                        @if ($user->id != Auth::user()->id)
                                            <option value="{{ $user->account->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                          <div class="col-sm-3 my-1">
                            <label class="sr-only" for="inlineFormInputName">Amount</label>
                            <input type="number" class="form-control" id="inlineFormInputName" placeholder="Amount" name="amount">
                          </div>
                          <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary">Transfer</button>
                          </div>
                        </div>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

