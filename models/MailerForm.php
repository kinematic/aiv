<?php

namespace app\models;

use Yii;
use yii\base\Model;

class MailerForm extends Model
{
    public $fromEmail;
    public $fromName;
    public $toEmail;
    public $subject;
    public $body;

    public function rules()
    {
        return [
            [['fromEmail', 'fromName', 'toEmail', 'subject', 'body'], 'required'],
            ['fromEmail', 'email'],
            ['toEmail', 'email']
        ];
    }

    public function sendEmail()
    {
        if ($this->validate()) {
//             Yii::$app->mailer->compose()
			Yii::$app->mailer->compose('inventory/siteDiscrepancies', ['dataProvider' => $dataProvider])
                ->setTo($this->toEmail)
                ->setFrom([$this->fromEmail => $this->fromName])
                ->setSubject($this->subject)
//                 ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
} 
