<?php
namespace App;
/**
 * Class HasAccountTrait
 *
 * @package App
 */
use App;
trait TransactionTrait
{

    public function createTransaction($name,$user_id,$wallet_id,$deposit_id,$amount){
        // создание транзакций
        $transaction = new App\Transaction();
        $transaction->name = $name;
        $transaction->user_id = $user_id;
        $transaction->wallet_id = $wallet_id;
        $transaction->deposit_id = $deposit_id;
        $transaction->amount = $amount;
        $transaction->created_at = date("Y-m-d H:i:s");
        $transaction->save();
    }


    public function enterErrors(){
        // ошибки



    }

}