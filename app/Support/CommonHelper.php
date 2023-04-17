<?php

if (!function_exists('generateHashToken')) {
    /**
     * generate token func
     */
    function generateHashToken()
    {
        $newAppKey = base64_decode(substr(config('app.key'), 7));
        return hash_hmac('sha256', \Str::random(40), $newAppKey);
    }
}
