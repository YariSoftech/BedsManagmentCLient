<?php

/**
 * Represents an HTTP request from the Android client
 */
class Request
{
    public $url_elements;
    public $verb;

    public function __construct()
    {
        // Get HTTP verb
        $this->verb = $_SERVER['REQUEST_METHOD'];

        // Is not the path defined in the URL?
        if (!isset($_GET['PATH_INFO'])) {
            return false;
        }

        // What segments does the URL bring?
        $this->url_elements = explode('/', $_GET['PATH_INFO']);

        return true;
    }

}