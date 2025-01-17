<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    public function deposit(){
        return view('account.deposit');
    }

    public function withdraw(){
        return view('account.withdraw');
    }

    public function transfer(){
        $users = User::all();
        return view('account.transfer', compact('users'));
    }

    public function statement(){
        $transactions = Auth::user()->account->transaction->all();
        return view('account.statement', compact('transactions'));
    }
}
