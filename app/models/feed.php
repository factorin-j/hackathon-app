<?php

class Feed
{
    const POST_TYPE_SYSTEM = 'system';
    const POST_TYPE_USER = 'user';
    const SCORE_TYPE_POSITIVE = 'positive';
    const SCORE_TYPE_NEGATIVE = 'negative';

    public $id;
    public $message;
    public $type;
    public $location;
    public $score;
    public $created;
    public $token;

    /**
     * @param $feed_id
     * @return Feed
     */
    public static function get($feed_id)
    {
        $con = DB::conn();
        $feed = $con->row('SELECT * FROM feed WHERE  id = ?', array($feed_id));
        return (!$feed) ? null : new self($feed);
    }

    public static function getAll($token)
    {
        $con = DB::conn();
        $feeds = $con->rows('SELECT * FROM feed ORDER BY created DESC');
        if (!$feeds) {
            return null;
        }

        $feed_list = array();
        foreach ($feeds as $feed) {
            $vote_status = VoteStatus::get($feed['id'], $token);
            $feed['has_voted'] = $vote_status ? true : false;
            $feed['vote_type'] = $vote_status['type'];
        }
        return $feed_list;
    }

    public static function voteScore($feed_id, $type)
    {
        $con = DB::conn();
        $con->begin();
        try {
            $feed = self::get($feed_id);
            if (!$feed) {
                throw new RecordNotFoundException('Cannot find your specified news feed');
            }

            $score = self::getScoreFromType($feed['score'], $type);
            $con->update('feed', array('score' => $score), array('id' => $feed_id));
            $con->commit();
            return $score;
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    public static function post($message, $picture, $location, $token)
    {
        $con = DB::conn();
        $feed = array(
            'message' => $message,
            'picture' => $picture,
            'location' => $location,
            'type' => self::POST_TYPE_USER,
            'token' => $token
        );

        $con->insert('feed', $feed);
        return $feed;
    }

    protected static function getScoreFromType($score, $type)
    {
        switch ($type) {
            case self::SCORE_TYPE_POSITIVE:
                $score = $score + 1;
                break;
            case self::SCORE_TYPE_NEGATIVE:
                $score = $score - 1;
                break;
            default:
                $score = (int)$score;
                break;
        }
        return $score;
    }
}
