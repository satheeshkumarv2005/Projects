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
            'transfer_to' => 'null'
        ]);

        $data = [
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Credited',
            'balance' => $user->account->balance
        ];

        Mail::to($user->email)->send(new WelcomeMail($data));

        return Redirect('home')->with('status', 'Successfully Credited!');

    }

    public function withdraw(Request $request){
        $request->validate([
            'amount'=>'required|integer|min:0'
        ]);

        $amount = $request->input('amount');
        $user = Auth::user();
        if ($user->account->balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient Balance !');
        }
        $user->account->balance -= $amount;
        $user->account->update();

        Transaction::create([
            'account_id' => $user->account->id,
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Debit',
            'transfer_to' => 'null'
        ]);

        $data = [
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Debited'
        ];

        Mail::to($user->email)->send(new WelcomeMail($data));


        return Redirect('home')->with('status', 'Successfully Debited!');

    }

    public function transfer(Request $request){
        $data = $request->validate([
                'account_id'=>'required|numeric',
                'amount'=>'required|integer|min:1'
            ]);

        $user = Auth::user();
        $to_account = Account::FindorFail($data['account_id']);
        if ($user->account->balance < $data['amount']) {
            return redirect()->back()->with('error', 'Insufficient Balance !');
        }

        $user->account->balance -= $data['amount'];
        $user->account->update();
        $to_account->balance += $data['amount'];
        $to_account->update();

        Transaction::create([
            'account_id' => $user->account->id,
            'name' => $user->name,
            'amount' => $data['amount'],
            'type' => 'Transfer',
            'transfer_to' => $to_account->id
        ]);

        $data = [
            'name' => $user->name,
            'amount' => $amount,
            'type' => 'Transfer',
            'transfer_to' =>$to_account->id
        ];

        Mail::to($user->email)->send(new WelcomeMail($data));



        return redirect('/home')->with('status', 'Successfully Transfer');
    }


}
