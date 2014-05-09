<?php

class BlockList
{
    public $token;

    /**
     * @param $token
     * @return bool
     */
    public static function isBlocked($token)
    {
        $con = DB::conn();
        $blocked_user = $con->row('SELECT * FROM block_list WHERE token = ?', array($token));
        return (!$blocked_user) ? false : true;
    }
}
