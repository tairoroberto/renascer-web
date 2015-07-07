<?php

namespace Renascer\Jobs;

use Renascer\Email;
use Renascer\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Renascer\MensagemEmail;

class EnviarEmailsJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $email;
    private $mensagem;

    /**
     * Create a new job instance.
     *
     * @param Email $email
     * @param MensagemEmail $mensagem
     */
    public function __construct(Email $email, MensagemEmail $mensagem)
    {
        $this->email = $email;
        $this->mensagem = $mensagem;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $mensagem = $this->mensagem;
        //send email to nutricionist and client
        \Mail::send('emails.email-cliente', array('email' => $email, 'mensagem' => $mensagem), function($message) use($email){
            $message->to($email->email, $email->cliente)->subject('Promoções Renascer Carnes');
        });
    }
}
