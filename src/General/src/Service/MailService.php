<?php

declare(strict_types=1);

namespace General\Service;

use Doctrine\ORM\EntityManager;
use AcMailer\Service\MailService as Mailly;

class MailService
{
    /**
     * @var Mailly
     */
    private $mailService;


    public function __construct(Mailly $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @param array $data
     * @param string $template
     * @param string $replyTo
     * @param array $addCc
     * @param array $addBcc
     */
    public function sendMails($data, $template, $replyTo = "", $addCc = [], $addBcc = [])
    {

        $mailService = $this->mailService;
        $mailContent = [
            "to" => $data["to"],
            "template" => $template,
            "from" => "no-reply@aibltd.insure",
            'from_name' => 'AIB Insurance Brokers',
            "subject" => $data["subject"],
            "template_params"=>$data["params"]
            // "body"=>"Welcome",
        ];
        // $mailService->send('contact', [
        //     "template"=>$template,
        //     'template_params' => [
        //         $data["params"]
        //         // 'layout' => 'application/mail/layout',

        //     ]
        // ]);
        $mailService->send($mailContent);
    }
}
