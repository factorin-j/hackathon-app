<?php

class User extends AppModel
{
    public $phone_number;
    public $access_token;

    /**
     * Get user by phone number
     * @param $phone_number
     * @return User
     */
    public static function get($phone_number)
    {
        $con = DB::conn();
        $user = $con->row('SELECT * FROM users WHERE phone_number = ?', array($phone_number));
        return (!$user) ? null : new User($user);
    }

    
}
