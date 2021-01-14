<?php

namespace sub100\Notifications;

class Message
{
    protected string $subject = '';

    protected string $message = '';

    protected array $emails = [];

    protected array $sms = [];

    protected array $whatsapp = [];

    protected string $smsNotificationType = '';

    protected array $variables = [];

    protected string $mailTemplate = '';

    protected string $mailBody = '';

    protected string $from = '';

    protected string $replyTo = '';

    protected string $originId = '';

    protected string $propertyId = '';

    protected string $reference = '';

    protected string $senderServiceType = '';

    protected string $senderServiceCredentials = '';

    protected string $clientId = '';

    public function subject(string $subject)
    {
        $this->subject = $subject;
    }

    public function message(string $message)
    {
        $this->message = $message;
    }

    public function addEmail(string $email)
    {
        $this->emails[] = $email;
    }

    public function addSms(string $phone)
    {
        $this->sms[] = self::numberOnly($phone);
    }

    public function addWhastapp(string $phone)
    {
        $this->whatsapp[] = self::numberOnly($phone);
    }

    /**
     * Alias for sms
     * @link Message::addSms()
     */
    public function addPhone(string $phone)
    {
        $this->addSms($phone);
    }

    public function originId(string $originId)
    {
        $this->originId = $originId;
    }

    public function propertyId(string $propertyId)
    {
        $this->propertyId = $propertyId;
    }

    public function reference(string $reference)
    {
        $this->reference = $reference;
    }

    public function variables(array $variables)
    {
        $this->variables = $variables;
    }

    public function smsNotificationType(string $smsNotificationType)
    {
        $this->smsNotificationType = $smsNotificationType;
    }

    public function mailTemplate(string $mailTemplate)
    {
        $this->mailTemplate = $mailTemplate;
    }

    public function mailBody(string $mailBody)
    {
        $this->mailBody = $mailBody;
    }

    public function from(string $from)
    {
        $this->from = $from;
    }

    public function replyTo(string $replyTo)
    {
        $this->replyTo = $replyTo;
    }

    public function senderServiceType(string $senderServiceType)
    {
        $this->senderServiceType = $senderServiceType;
    }

    public function senderServiceCredentials(string $senderServiceCredentials)
    {
        $this->senderServiceCredentials = $senderServiceCredentials;
    }

    public function clientId(string $clientId)
    {
        $this->clientId = $clientId;
    }

    public function toArray(): array
    {
        $array = [
            "subject" => $this->subject,
            "message" => $this->message,
            "origin_id" => $this->originId,
        ];

        if ($this->emails) {
            $array["email_recipients"] = $this->emails;
            $array["mail_template"] = $this->mailTemplate;
            $array["mail_body"] = $this->mailBody;
            $array["variables"] = $this->variables;
        }

        if ($this->sms) {
            $array["sms_recipients"] = $this->sms;
            $array["sms_notification_type"] = $this->smsNotificationType;
        }

        if ($this->whatsapp) {
            $array["whatsapp_recipients"] = $this->whatsapp;
        }

        if ($this->propertyId && $this->reference) {
            $array["property_id"] = $this->propertyId;
            $array["reference"] = $this->reference;
        }

        if ($this->from) {
            $array['mail_from'] = $this->from;
        }

        if ($this->replyTo) {
            $array['mail_reply_to'] = $this->replyTo;
        }

        if ($this->senderServiceType) {
            $array['sender_service_type'] = $this->senderServiceType;
        }

        if ($this->senderServiceCredentials) {
            $array['sender_service_credentials'] = $this->senderServiceCredentials;
        }

        if ($this->clientId) {
            $array['client_id'] = $this->clientId;
        }

        return $array;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public static function numberOnly(string $value): string
    {
        return (string)preg_replace('/\D/', '', $value);
    }
}
