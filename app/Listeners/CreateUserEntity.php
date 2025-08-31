<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserEntity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
                $user = $event->user;
                // Создаем новую сущность и связываем её с пользователем
                $user->employee()->create([
                    //'bio' => 'Новый био пользователя'
                ]);
    }
}
