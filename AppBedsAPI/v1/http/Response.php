<?php

/**
 * Represents an HTTP response to the client
 */
class Response {
    private $body;
    private $status;


    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }


}