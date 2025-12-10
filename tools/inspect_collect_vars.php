<?php
// Quick smoke test for BaseExceptionHandler::collectVars
// Provide a minimal Config\Exceptions class (avoid full framework bootstrap)
namespace Config {

class Exceptions
{
    public bool $log = true;
    public array $ignoreCodes = [404];
    public string $errorViewPath;
    public array $sensitiveDataInTrace = [];
    public bool $logDeprecations = true;
    public string $deprecationLogLevel = 'warning';

    public function __construct()
    {
        $this->errorViewPath = realpath(__DIR__ . '/../app/Views/errors') ?: __DIR__ . '/../app/Views/errors';
    }
}

}

namespace CodeIgniter\Exceptions {
    class PageNotFoundException extends \Exception {}
}

namespace {
    require_once __DIR__ . '/../system/Debug/BaseExceptionHandler.php';
    require_once __DIR__ . '/../system/API/ResponseTrait.php';
    require_once __DIR__ . '/../system/Debug/ExceptionHandlerInterface.php';
    require_once __DIR__ . '/../system/Debug/ExceptionHandler.php';

    use CodeIgniter\Debug\ExceptionHandler;
    use Config\Exceptions as ExceptionsConfig;

    // Instantiate config and handler
    $config = new ExceptionsConfig();
    $handler = new ExceptionHandler($config);

$ref = new ReflectionObject($handler);
$method = $ref->getMethod('collectVars');
$method->setAccessible(true);

$tests = [
    ['ex' => new Exception('Generic server error'), 'status' => 500],
    ['ex' => new Exception('Bad request'), 'status' => 400],
    ['ex' => new \CodeIgniter\Exceptions\PageNotFoundException('Not found'), 'status' => 404],
];

foreach ($tests as $t) {
    $ex = $t['ex'];
    $status = $t['status'];

    $vars = $method->invoke($handler, $ex, $status);

    echo "--- Test status: $status ---\n";
    if (isset($vars['heading'])) {
        echo "heading: " . $vars['heading'] . "\n";
    } else {
        echo "heading: <missing>\n";
    }
    echo "message: " . ($vars['message'] ?? '<missing>') . "\n";
    echo "code: " . ($vars['code'] ?? '<missing>') . "\n";
    echo "type: " . ($vars['type'] ?? '<missing>') . "\n";
    echo "file: " . ($vars['file'] ?? '<missing>') . "\n";
    echo "line: " . ($vars['line'] ?? '<missing>') . "\n";
    echo "\n";
}

echo "Done.\n";
}
