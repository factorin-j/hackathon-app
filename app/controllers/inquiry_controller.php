<?php

class InquiryController extends ApiController
{
    public function send()
    {
        $contact_number = Param::get('contact');
        $email = Param::get('email');
        $message = Param::get('message');

        if (!$contact_number || $email) {
            throw new AppException('Please input at-least one(1) contact detail');
        }

        if (!trim($message)) {
            throw new AppException('Please enter your message(concern/suggestion/reactions[or others]');
        }

        Inquiry::send($contact_number, $email, $message);
        $this->toJson(array(
            'success' => true,
            'message' => 'Your inquiry has been sent to out system administrator. We\'ll contact you as soon as possible'
        ));
    }
}
