<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;
use App\TransactionTrait;

class HomeController extends Controller
{
    use TransactionTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postHandler(Request $request) {
        if($request->input('sum-bal-check')){
            $this->validate($request, [
                'sum-bal' => 'required'
            ]);
        }else{
            $this->validate($request, [
                'sum-dep' => 'required'
            ]);
        }

        $sum_balance = $request->input('sum-bal');
        $sum_deposit = $request->input('sum-dep');
        return $sum_balance ? $this->balanceReplenishment($sum_balance) : $this->depositContribution($sum_deposit);
    }

    public function index()
    {
        $data_user = App\User::where('id', '=', Auth::user()->id)->find(1);//имя пользователя
        $data_user=$data_user->name;

        $data_balance = App\Wallet::where('id', '=', Auth::user()->id)->find(1);// баланс кошелька
        if($data_balance){
            $data_balance=$data_balance->balance;
        } else{
            $data_balance = new  App\Wallet;
            $data_balance ->user_id = Auth::user()->id;
            $data_balance ->created_at = date("Y-m-d H:i:s");
            $data_balance->save();
        }


        $data_deposits = App\Deposit::where('user_id', '=', Auth::user()->id)->get();// депозиты

        $data_transaction = App\Transaction::where('user_id', '=', Auth::user()->id)->get();// транзакции

        return view('home', compact(['data_balance','data_user','data_deposits','data_transaction']));
    }

    public function balanceReplenishment($sum)
    {

        //пополнение баланса
        $data_balance = App\Wallet::where('id', '=', Auth::user()->id)->find(1);
        $data_balance->balance = $data_balance->balance + $sum;
        $data_balance->save();
        $this->createTransaction('enter',$data_balance->user_id,$data_balance->id,NULL,$sum);
        return redirect('/home');
    }

    public function depositContribution($sum)
    {
        //снятие суммы депозита с баланса
        $data_balance = App\Wallet::where('id', '=', Auth::user()->id)->find(1);
        $data_balance->balance = $data_balance->balance - $sum;
        $data_balance->save();

       // новый депозит
        $data_deposit = new  App\Deposit;

        $data_deposit->user_id=Auth::user()->id;
        $data_deposit->wallet_id=1;
        $data_deposit->invested=$sum;
        $data_deposit->percent=20;
        $data_deposit->active=1;
        $data_deposit->duration=1;
        $data_deposit->accrue_times=1;
        $data_deposit->created_at = date("Y-m-d H:i:s");
        $data_deposit->save();

        $this->createTransaction('create_deposit',$data_deposit->user_id,$data_deposit->wallet_id,$data_deposit->id,$sum);

        return redirect('/home');
    }


}
