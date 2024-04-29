<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $laundry;
    public $range;
    public $state;
    public $city;
    public $message;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->laundry = $data['laundry'];
        $this->range = $data['range'];
        $this->state = $data['state'];
        $this->city = $data['city'];
        $this->message = $data['message'];
    }

    public function build()
    {
        return $this->from(config('MAIL_FROM_ADDRESS'))
                    ->subject('Nuevo mensaje de contacto')
                    ->html("
                        <p>Nombre: {$this->name}</p>
                        <p>Correo electrónico: {$this->email}</p>
                        <p>Teléfono: {$this->phone}</p>
                        <p>Lavandería: {$this->laundry}</p>
                        <p>Rango: {$this->range}</p>
                        <p>Estado: {$this->state}</p>
                        <p>Ciudad: {$this->city}</p>
                        <p>Mensaje: {$this->message}</p>
                    ");
    }


}
