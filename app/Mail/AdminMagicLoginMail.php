<?php
namespace App\Mail;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class AdminMagicLoginMail extends Mailable
{
    use Queueable, SerializesModels;
    public $profil;
    public function __construct(
        public User $user,
        public string $url,
    ) {
        $this->profil = Profil::first();
    }
    public function build()
    {
        return $this->subject('Tautan Login Admin — ' . config('app.name'))
            ->view('emails.admin-magic-login');
    }
}                        