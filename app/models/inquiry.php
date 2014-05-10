<?php

class Inquiry extends AppModel
{
    public static function send($email, $message)
    {
        $con = DB::conn();
        $con->insert('inquiry',
            array('email' => $email, 'message' => $message, 'created' => date('Y-m-d H:i:s'))
        );
        return $con->lastInsertId();
    }
}
