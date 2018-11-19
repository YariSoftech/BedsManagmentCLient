<?php

/**
 * Personalized exception for sending answers
 */
require_once 'http/status_messages.php';
require_once 'http/Response.php';

class ApiException extends Exception {
    public $response;

    public function __construct($status, $message) {
        $this->response = new Response();
        $this->response->setStatus($status);
        $this->response->setBody(['message' => $message]);
    }

}