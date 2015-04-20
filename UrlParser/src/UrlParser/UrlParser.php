<?php

namespace UrlParser;

use UrlParser\NotValidURLException;

class UrlParser
{
    public function helloWorld()
    {
        return "Hello World";
    }

    public function getProtocolType($string)
    {
        $uri = parse_url($string);
        if (isset($uri['scheme'])) {
            return $uri['scheme'];
        } else {
            return false;
        }
    }


    public function getQueryParameterCount($string)
    {
        $uri = parse_url($string);
        if (isset($uri['query'])) {
            $query = explode("&", $uri['query']);
            return count($query);
        } else {
            return false;
        }
    }

    public function getHostname($string)
    {
        $uri = parse_url($string);
        if (isset($uri['host'])) {
            return $uri['host'];
        } else {
            return false;
        }
    }

    public function isValid($data)
    {
        if (filter_var($data, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            throw new NotValidURLException("url is not valid", 404);
        }
    }
}