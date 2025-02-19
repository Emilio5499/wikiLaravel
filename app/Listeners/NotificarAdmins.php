<?php

namespace App\Listeners;

use App\Events\PostCreado;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotificarAdmins
{

    /**
     * Handle the event.
     */
        public function handle(PostCreado $event)
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::raw(
                "se ha creado un post que requiere revision.",
                function ($message) use ($admin) {
                    $message->to($admin->email)
                        ->subject('Nuevo post para revisar');
                }
            );
        }
    }
}
