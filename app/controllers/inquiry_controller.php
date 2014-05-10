<?php

class InquiryController extends ApiController
{
    public function send()
    {
        $email = Param::get('email');
        $message = Param::get('message');

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new AppException('Please input a valid email address');
        }

        if (!trim($message)) {
            throw new AppException('Please enter your message(concern/suggestion/reactions[or others]');
        }

        $id = Inquiry::send($email, $message);
        $this->toJson(array(
            'success' => true,
            'message' => 'Your inquiry has been sent to our system administrator. InquiryID #' . $id
        ));
    }
}
