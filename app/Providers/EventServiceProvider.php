<?php

namespace App\Providers;

use App\Events\Coment;
use App\Events\TesteRetorno;
use App\Listeners\ComentedPost;
use App\Listeners\ComentList;
use App\Listeners\TesteEventoResp;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            'App\Listeners\SendEmailWelcome'
        ],
        Coment::class => [
            ComentedPost::class
        ],

    ];

    protected $observers = [
        User::class => [UserObserver::class]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
