<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ModerarPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:moderar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'borra posts con palabras prohibidas sin necesitar a un admin';

    protected $palabrasBloquear = ['tonto', 'feo', 'mojino', 'moash'];
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $postsPendientes = Post::where('status', 'pending')->get();

        foreach ($postsPendientes as $post) {

            if ($this->contienePalabrasProhibidas($post->content)) {
                $autor = User::find($post->user_id);

                $post->delete();

                if ($autor) {
                    Mail::raw(
                        "Tu post ha sido eliminado porque contiene palabras prohibidas.",
                        function ($message) use ($autor) {
                            $message->to($autor->email)
                                ->subject('El post ha sido eliminado');
                        }
                    );
                }
            }
        }
    }
private function contienePalabrasProhibidas($contenido)
{
    foreach ($this->palabrasBloquear as $palabra) {
        if (stripos($contenido, $palabra) !== false) {
            return true;
        }
    }
    return false;
}
}
