<?php

/**
 * Controlador de los Productos
 */

require_once 'Controller.php';
require_once 'http/response.php';
require_once 'http/status_messages.php';


class ProductsController implements Controller {

    private $productsRepository;


    public function __construct($productsRepository) {
        $this->productsRepository = $productsRepository;
    }


    public function getAction($request) {
        $response = new Response();

        if (isset($request->url_elements[1])) {

            throw new ApiException(400, STATUS_CODE_400_MALFORMED);

        } else {

            $results = $this->productsRepository->getAllProducts();

            if (is_array($results)) {
                $response->setBody($results);
                $response->setStatus(200);
            } else if (is_string($results)) {
                $response->setBody(['message' => $results]);
                $response->setStatus(200);
            }

        }
        return $response;
    }

    public function postAction($request) {
        throw new ApiException(501, STATUS_CODE_501);

    }

    public function putAction($request) {
        throw new ApiException(501, STATUS_CODE_501);
    }

    public function deleteAction($request) {
        throw new ApiException(501, STATUS_CODE_501);
    }
}

