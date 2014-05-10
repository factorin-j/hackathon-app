<?php

class HomeController extends ApiController
{
    public function feeds()
    {
        $token = Param::getToken();
        $view_type = Param::get('view_type');

        switch ($view_type) {
            case 'rank':
                $feed_list = Feed::getAllByRank($token);
                break;
            case 'normal':
            default:
                $feed_list = Feed::getAll($token);
        }
        $this->toJson(array(
            'feed_list' => $feed_list
        ));
    }

    public function vote()
    {
        $feed_id = Param::get('feed_id');
        $type = Param::get('type');
        $token = Param::getToken();

        if (VoteStatus::get($feed_id, $token)) {
            throw new AppException('You has already voted for this');
        }

        $con = DB::conn();
        $con->begin();
        try {
            $score = Feed::voteScore($feed_id, $type);
            VoteStatus::doLogEntry($feed_id, $token, $type);
            $this->toJson(array(
                'success' => true,
                'score' => $score
            ));
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }

    public function post()
    {
        $message = Param::get('message');
        $location = Param::get('location');
        $token = Param::getToken();
        $picture = Picture::get('picture');

        if (!$token) {
            throw new AppException('invalid application token');
        }

        $picture_path = Picture::getUploadPath($picture);
        if ($picture_path) {
            Picture::upload($picture, $picture_path);
        }

        $recent_feed = Feed::post($message, $picture_path, $location, $token);
        $this->toJson(array(
            'success' => true,
            'feed' => $recent_feed
        ));
    }
}
