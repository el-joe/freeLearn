<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Traits\Fawry;
use Illuminate\Console\Command;

class checkPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = Order::wherePaid(0)->whereNotNull('payment_data')->get();

        $fawry = new Fawry();

        $payments->map(function ($order) use($fawry) {

            if(isset($order->payment_data['statusCode']) && $order->payment_data['statusCode'] == 200){
                $payment = $fawry->checkPayment($order->payment_data['merchantRefNumber']);
                if($payment != NULL){
                    if($payment['orderStatus'] == 'PAID'){
                        $order->update([
                            'paid'=>1
                        ]);
                        $order->user()->increment('videos',$order->video_num);
                    }
                }
            }
        });
    }
}
