<?php

namespace app\models;

use app\core\Model;

/**
 * @author Jonathan Walumbe <nathanwalumbe@gmail.com>
 * @package app\models
*/

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels():array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Enter your Email',
            'body' => 'Type your message',
        ];
    }

    public function send(): bool
    {
        return true;
    }
}