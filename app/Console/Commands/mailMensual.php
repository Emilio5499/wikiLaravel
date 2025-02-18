<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class mailMensual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventos:enviar';
    protected $description = 'Envía correo para avisar del evento';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $evento = [
            'titulo' => 'Nuevo libro ha salido',
            'fecha' => '27 de junio de 2025',
            'descripcion' => 'Ha salido el nuevo libro, unios para comentarlo.',
            'link' => 'https://myevent.com/libro-nuevo'
            ];

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            Mail::to($usuario->email)->send(new \App\Mail\mailMensual($evento));
        }
        $this->info('Se han enviado ' . count($usuarios) . ' correos.');
        
    }
}
