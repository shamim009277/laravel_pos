<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\OrderConfirm;
use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use App\Events\ProductDeleted;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Listeners\OrderConfirmListener;
use App\Listeners\ProductCacheListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderConfirm::class => [
            OrderConfirmListener::class,
        ],
        ProductCreated::class => [
            ProductCacheListener::class,
        ],
        ProductUpdated::class => [
            ProductCacheListener::class,
        ],
        ProductDeleted::class => [
            ProductCacheListener::class,
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
