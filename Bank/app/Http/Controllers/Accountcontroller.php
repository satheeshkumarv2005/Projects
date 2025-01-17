<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Mail\WelcomeMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class Accountcontroller extends Controller
{
    public function deposit(Request $request){
        $request->validate([
            'amount'=>'required|integer|min:0'
        ]);

        $amount = $request->input('amount');
        $user = Auth::user();
        $user->account->balance += $amount;
        $user->account->update();

        Transaction::create([
            'account_id' => $user->account->id,
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'credit',
            'transfer_to' => '',
            'balance' => $user->account->balance
        ]);

        $data = [
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Credited',
            'balance' => $user->account->balance
        ];

        Mail::to($user->email)->send(new WelcomeMail($data));

        return Redirect('home')->with('success', 'Successfully Credited!');

    }

    public function withdraw(Request $request){
        $request->validate([
            'amount'=>'required|integer|min:0'
        ]);

        $amount = $request->input('amount');
        $user = Auth::user();
        if ($user->account->balance < $amount) {
            return redirect('home')->with('error', 'Insufficient Balance !');
        }
        $user->account->balance -= $amount;
        $user->account->update();

        Transaction::create([
            'account_id' => $user->account->id,
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Debit',
            'transfer_to' => '',
            'balance' => $user->account->balance
        ]);

        $data = [
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Debited',
            'balance' => $user->account->balance
        ];

        Mail::to($user->email)->send(new WelcomeMail($data));


        return Redirect('home')->with('success', 'Successfully Debited!');

    }

    public function transfer(Request $request){
        $datas = $request->validate([
                'account_id'=>'required|numeric',
                'amount'=>'required|integer|min:1'
            ]);

        $user = Auth::user();
        $to_account = Account::FindorFail($datas['account_id']);
        if ($user->account->balance < $datas['amount']) {
            return redirect('home')->with('error', 'Insufficient Balance !');
        }

        $user->account->balance -= $datas['amount'];
        $user->account->update();
        $to_account->balance += $datas['amount'];
        $to_account->update();

        Transaction::create([
            'account_id' => $user->account->id,
            'name' => $user->name,
            'amount' => $datas['amount'],
            'type' => 'Transfer',
            'transfer_to' => $to_account->user->name,
            'balance' => $user->account->balance
        ]);

        $data = [
            'name' => $user->name,
            'amount' => $datas['amount'],
            'type' => 'Transfer',
            'balance' => $user->account->balance
        ];

        Mail::to($user->email)->send(new WelcomeMail($data));



        return redirect('/home')->with('success', 'Successfully Transfer');
    }


}
