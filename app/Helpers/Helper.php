<?php
/**
 * Created by PhpStorm.
 * User: Faby´s
 * Date: 20/06/2019
 * Time: 1:09 PM
 */

namespace App\Helpers;


class Helper
{
    /**
     * @param $url
     * @return Site Title given an URL
     */
    public static function getTitle($url)
    {
        $str = file_get_contents($url);
        if (strlen($str) > 0) {
            $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
            preg_match("/\<title\>(.*)\<\/title\>/i", $str, $title); // ignore case
            return $title[1];
        }
    }
}
