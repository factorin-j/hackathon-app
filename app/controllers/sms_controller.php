<?php

class SmsController extends ApiController
{
    public function callback()
    {
        $code = Param::get('code');

        $globe_api = new GlobeApi();
        $auth = $globe_api->auth(
            'ydGrnSA5A76CG5cjdjiAXnCGzGx4SpdK',
            'acd612ede1444a01ae3934b93226d730ef7ceb845efe87977d1f0277fde4c151'
        );

        $sms = $globe_api->sms(6438);
        $sms->sendMessage(
            'TVy1He5iA-ih_Hp5aaK_fK0bEwShfc7o_t10dN03zeE',
            '9058420569',
            'Hey mardy'
        );

        $this->set('msg', $auth->getAccessToken($code));
        //$this->render('home/index');
    }
}
