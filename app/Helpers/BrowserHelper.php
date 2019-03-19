<?php
/**
 * Created by PhpStorm.
 * User: vedran
 * Date: 18/03/2019
 * Time: 14:14
 */

namespace App\Helpers;


class BrowserHelper
{

    /**
     * Searches for a specific keyword in a given string and returns browser's name
     *
     * @param  string $browser_string
     * @return string
     */
    public static function detect_browser($browser_string)
    {
        if(strpos($browser_string, 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif(strpos($browser_string, 'Trident') !== FALSE) //For Supporting IE 11
            return 'Internet explorer';
        elseif(strpos($browser_string, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif(strpos($browser_string, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif(strpos($browser_string, 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif(strpos($browser_string, 'Opera') !== FALSE)
            return "Opera";
        elseif(strpos($browser_string, 'Safari') !== FALSE)
            return "Safari";
        else
            return 'Something else';
    }

}