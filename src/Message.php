<?php

namespace sub100\Notifications;

class Message
{
    protected string $subject = '';

    protected string $message = '';

    protected array $emails = [];

    protected array $phones = [];

    protected string $smsNotificationType = '';

    protected array $variables = [];

    protected string $mailTemplate = '';

    protected string $from = '';

    protected string $replyTo = '';

    protected string $originId = '';

    protected string $propertyId = '';

    protected string $reference = '';

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

    /**
     * Alias for sms
     * @link Message::addSms()
     */
    public function addPhone(string $phone)
    {
        $this->phones[] = (string)preg_replace('/\D/', '', $phone);
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

    public function from(string $from)
    {
        $this->from = $from;
    }

    public function replyTo(string $replyTo)
    {
        $this->replyTo = $replyTo;
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
            $array["variables"] = $this->variables;
        }

        if ($this->phones) {
            $array["sms_recipients"] = $this->phones;
            $array["sms_notification_type"] = $this->smsNotificationType;
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

        return $array;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
