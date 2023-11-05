<?php

namespace App\Commons\Email;;

interface EmailServiceInterface
{
    public function send($to, $data, $template = 'Base::email.default-template');
}
