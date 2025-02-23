<?php

namespace Tests\Feature;

use App\Console\Commands\mailMensual;
use App\Mail\mailMensual as MailEvento;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\artisan;

beforeEach(function () {
    Mail::fake();
});

test('mail_sends_when_command_activates', function () {
    User::factory()->create();

    artisan('eventos:enviar')->assertExitCode(0);

    Mail::assertSent(MailEvento::class);
});

test('mail_sends_to_all_users', function () {
    $usuarios = User::factory()->count(3)->create();

    artisan('eventos:enviar');

    foreach ($usuarios as $usuario) {
        Mail::assertSent(MailEvento::class, fn ($mail) => $mail->hasTo($usuario->email));
    }
});

test('mail_content_is_expected', function () {
    $usuario = User::factory()->create();

    artisan('eventos:enviar');

    Mail::assertSent(MailEvento::class, function ($mail) {
        return str_contains($mail->viewData['titulo'], 'Nuevo libro ha salido') &&
            str_contains($mail->viewData['descripcion'], 'Ha salido el nuevo libro');
    });
});

test('no_mail_sent_if_no_users_exist', function () {
    artisan('eventos:enviar');

    Mail::assertNothingSent();
});
