<?php

namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * Handle user login event.
     *
     * @param \App\Events\Auth\UserLogin $event
     */
    public function onUserLogin($event)
    {
        $this->updateUserInfo($event->user);
    }

    /**
     * Handle user logout event.
     *
     * @param \App\Events\Auth\UserLogout $event
     */
    public function onUserLogout($event)
    {
    }

    /**
     * Handle user register event.
     *
     * @param \App\Events\Auth\UserRegistered $event
     */
    public function onUserRegistered($event)
    {
        $this->updateUserInfo($event->user);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Auth\UserLogin',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'App\Events\Auth\UserLogout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
        $events->listen(
            'App\Events\Auth\UserRegistered',
            'App\Listeners\UserEventSubscriber@onUserRegistered'
        );
    }

    /**
     * Update the user's last known ip and last login time.
     *
     * @param \App\Models\User $user
     */
    protected function updateUserInfo($user)
    {
        
        $user->last_known_ip = ip();
        $user->last_login_at = now();
        $user->save();
    }
}
