<?php

class VoteStatus extends AppModel
{
    public static function get($feed_id, $token)
    {
        $con = DB::conn();
        $row = $con->row('SELECT * FROM vote_status WHERE feed_id = ? AND token = ?', array($feed_id, $token));
        return (!$row) ? null : $row;
    }

    public static function doLogEntry($feed_id, $token, $type)
    {
        $con = DB::conn();
        $con->insert('vote_status', array('feed_id' => $feed_id, 'token' => $token, 'type' => $type));
    }
}
