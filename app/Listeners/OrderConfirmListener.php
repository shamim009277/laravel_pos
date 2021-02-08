<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OrderConfirmMail;
use Illuminate\Support\Facades\Mail;
use App\Order;


class OrderConfirmListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //dd($event->order->customer->email);
        $email = $event->order->customer->email;
        Mail::to($email)->send(new OrderConfirmMail($event->order));
    }
}
