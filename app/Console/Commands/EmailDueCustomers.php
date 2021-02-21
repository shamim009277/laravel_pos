<?php

namespace App\Console\Commands;

use App\Notifications\DueNotification;
use App\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\notify;

class EmailDueCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:due-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to customer those have due';

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
     * @return int
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(7);

        //$this->info($limit);
        $due_customers = Order::where('last_pay','<',$limit)->where('due','>',0)->get();
        //$this->info(print_r($due_customers));
        foreach ($due_customers as $customer) {
            
            $customer->notify( new DueNotification());
            $this->info('Notification send to '.$customer->customer->email);
        }
    }
}
