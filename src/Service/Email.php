<?php

namespace App\Service;

use Mailjet\Client;
use Mailjet\Resources;

class Email
{
    public function sendEmail($toEmail, $toClient, $subject, $content)
    {
        $mj = new Client($_ENV['MAILJET_PRIVATE_KEY'], $_ENV['MAILJET_SECRET_KEY'], true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "cwbertrand8@gmail.com",
                        'Name' => "MyShoes"
                    ],
                    'To' => [
                        [
                            'Email' => $toEmail,
                            'Name' => $toClient
                        ]
                    ],
                    'TemplateID' => 4376726,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];

        //this sends the message to the client
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        //this waits for the response, whether the sending is successful or not
        $response->success();
    }
}