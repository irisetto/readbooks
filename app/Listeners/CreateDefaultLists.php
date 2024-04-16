<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\Eloquent\Model;

class CreateDefaultLists
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
    public function handle(Registered $event): void
    {
        $user = $event->user;
        UserList::create([
           'name' => 'To Read',
            'user_id' => $user->id,
        ]);
    
        UserList::create([
                'name' => 'Finished',
                'user_id' => $user->id,
        ]);
}
}
