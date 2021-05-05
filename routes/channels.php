<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

<<<<<<< HEAD
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
=======
Broadcast::channel('App.User.{id}', function ($user, $id) {
>>>>>>> origin/master
    return (int) $user->id === (int) $id;
});
