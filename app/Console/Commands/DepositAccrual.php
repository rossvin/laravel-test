<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;
use App\Http\Controllers;
use App\TransactionTrait;
class DepositAccrual extends Command
{
    use TransactionTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deposit: accrual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deposit accrual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deposits = App\Deposit::where('active', '=', 1)->get();

        foreach($deposits as $deposit){

            $deposit->duration = $deposit->invested * ($deposit->percent / 100);
            $deposits->save();
            $this->createTransaction('accrue',$deposit->user_id,$deposit->wallet_id,$deposit->id,$deposit->duration);
            if($deposit-> accrue_times == 10)$deposit-> active =0; $this->createTransaction('close_deposit',$deposit->user_id,$deposit->wallet_id,$deposit->id,$deposit->duration);


        }
    }
}
