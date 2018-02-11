<?php

require __DIR__ . '/../vendor/autoload.php';

use \GraphQL\Type\Schema;
use \GraphQL\GraphQL;
use \GraphQL\Error\FormattedError;
use \GraphQL\Error\Debug;

use \Gpd\Type\MainTypes;

// Disable default PHP error reporting - we have better one for debug mode (see bellow)
ini_set('display_errors', 0);

$debug = false;
if (!empty($_GET['debug'])) {
    set_error_handler(function($severity, $message, $file, $line) use (&$phpErrors) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    });
    $debug = Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE;
}

try {

    $appContext = new \Gpd\Engine\AppContext;

    // Parse incoming query and variables
    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw, true) ?: [];
    } else {
        $data = $_REQUEST;
    }
    
    // Generate a default response from server if empty query
    if (null === $data['query'] || empty($data['query'])) {
        $data['query'] = '{welcome{welcome}}';
    }

    // GraphQL schema to be passed to query executor:
    $schema = new Schema([
        'query' => MainTypes::query(),
        'mutation' => MainTypes::mutation()
    ]);

    $result = GraphQL::executeQuery(
        $schema,
        $data['query'],
        null,
        $appContext,
        (array) $data['variables']
    );
    $output = $result->toArray($debug);

} catch (\Exception $error) {
    $output['errors'] = [
        FormattedError::createFromException($error, $debug)
    ];
}

return new \Gpd\Helpers\Output($output);