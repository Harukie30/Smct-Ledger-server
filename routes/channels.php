<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('logs.{authID}', function (User $user, int $authID) {
    return (int) $user->id === (int) $authID;
});
