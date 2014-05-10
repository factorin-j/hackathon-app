<?php

class Inquiry extends AppModel
{
    public static function send($phone, $email, $message)
    {
        $con = DB::conn();
        $con->insert('inquiry',
            array('phone' => $phone, 'email' => $email, 'message' => $message, 'created' => date('Y-m-d H:i:s'))
        );
    }
}
