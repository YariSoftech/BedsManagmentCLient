<?php
/**
* index.php is responsible for carrying out the resource routing process.
 * Depending on the request, the respective driver is also loaded.
 * The chosen controller will take the attributes of the request and consult the persistence layer,
 * to then return the data / errors in the JSON view
 */

require_once 'views/JsonView.php';
require_once 'http/Request.php';
require_once 'InjectionContainer.php';
require_once 'exceptions/ApiException.php';

spl_autoload_register('apiAutoload');
function apiAutoload($classname) {
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        @include __DIR__ . '/controllers/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+Repository$/', $classname)) {
        @include __DIR__ . '/data/' . $classname . '.php';
        return true;
    } elseif (preg_match('/[a-zA-Z]+DataSource$/', $classname)) {
        @include __DIR__ . '/data/datasource/' . $classname . '.php';
        return true;
    }

    return false;
}

set_exception_handler(function (ApiException $exception) {
    $json_view = new JsonView();
    $json_view->render($exception->response);
}
);

// We take the incoming request
$request = new Request();

// Routing guidelines are prepared
$plural_uc_resource_name = ucfirst($request->url_elements[0]);

$controller_name = $plural_uc_resource_name . 'Controller';
$repository_name = $plural_uc_resource_name . 'Repository';
$sql_data_source_name = 'Sql' . $plural_uc_resource_name . 'DataSource';

if (class_exists($controller_name)
    && class_exists($repository_name)
    && class_exists($sql_data_source_name)
) {

    // Now, we assemble the MVC triad
    $json_view = new JsonView();
    $sql_data_source = new $sql_data_source_name(
        InjectionContainer::provideDatabaseInstance());
    $repository = new $repository_name($sql_data_source);
    $controller = new $controller_name($repository);

    // This will allow us to execute the action that comes from the client
    $action_name = strtolower($request->verb) . 'Action';
    $response = $controller->$action_name($request);

    // And finally, we will show the answer
    $json_view->render($response);

} else {
    throw new ApiException(400, STATUS_CODE_400_MALFORMED);
}