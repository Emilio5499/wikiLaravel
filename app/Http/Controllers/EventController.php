<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailNotification;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function sendNotifications()
    {
        $users = User::all();

        foreach ($users as $user) {
            SendEmailNotification::dispatch($user);
        }

        return "Correo en cola.";
    }
}
