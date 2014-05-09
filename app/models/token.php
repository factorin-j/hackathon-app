<?php

class Token
{
    public static function generate($code)
    {
        return sha1(md5($code));
    }
}
