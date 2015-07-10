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
        \Mail::send('emails.email-cliente', array('email' => $this->email, 'mensagem' => $this->mensagem), function($message){
            $message->to($this->email->email, $this->email->cliente)->subject('Promoções Renascer Carnes');
        });
    }
}
