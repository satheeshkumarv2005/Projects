@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Withdraw') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action={{ route('user.account.withdraw') }}>
                        @csrf
                        <div class="form-row align-items-center">
                          <div class="col-sm-3 my-1">
                            <label class="sr-only" for="inlineFormInputName">Amount</label>
                            <input type="number" class="form-control" id="inlineFormInputName" required="required" placeholder="Amount" name="amount">
                          </div>
                          <div class="col-sm-3 my-1">
                            <label class="sr-only" for="inlineFormInputName">Remark</label>
                            <input type="text" class="form-control" id="inlineFormInputName" placeholder="Remark" name="remark">
                          </div>
                          <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary">Withdraw</button>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
