<?php
require_once __DIR__ . '/View.php';

/**
 * Generates outputs in JSON format
 */
class JsonView implements View
{

    public function render($response)
    {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($response->getBody(), JSON_PRETTY_PRINT);
        http_response_code($response->getStatus());
        return true;
    }
}