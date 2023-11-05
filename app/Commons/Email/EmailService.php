<?php

namespace App\Commons\Email;

use Illuminate\Support\Facades\Mail;

class EmailService implements EmailServiceInterface
{
    /**
     * @param object|array|string $to
     * @param $data
     * @param string $template
     */
    public function send($to, $data, $template = 'Base::email.default-template')
    {
        $mailer = new Email();
	    $template = !empty($template) ? $template : 'Base::email.default-template';
        $mailer->view($template);
        if (!empty($data['subject'])) {
            $mailer->subject($data['subject']);
        }
        if (!empty($data['header'])) {
            $mailer->header($data['header']);
        }
        if (!empty($data['body'])) {
            $mailer->body($data['body']);
        }
        if (!empty($data['footer'])) {
            $mailer->footer($data['footer']);
        }
        if (!empty($data['details'])) {
            $mailer->details($data['details']);
        }

        Mail::to($to)->send($mailer);
    }
}
