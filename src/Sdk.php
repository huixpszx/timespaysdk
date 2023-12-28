<?php

namespace Timespay\Sdkpayment;

use Exception;

class Sdk
{
    public static function test($text = 'test-ok')
    {
        try {
            return $text;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}