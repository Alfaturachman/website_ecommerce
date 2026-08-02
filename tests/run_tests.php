<?php
/**
 * CLI Test Runner for Nomadenstuff E-Commerce
 * Executable via: php tests/run_tests.php
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/TestCase.php';

// Include Unit Tests
require_once __DIR__ . '/unit/RegisterModelTest.php';
require_once __DIR__ . '/unit/CheckoutCalculationTest.php';
require_once __DIR__ . '/unit/ImageUploaderTest.php';

// Include Feature Tests
require_once __DIR__ . '/feature/ProfileAuthorizationTest.php';
require_once __DIR__ . '/feature/CartIsolationTest.php';
require_once __DIR__ . '/feature/SearchPaginationTest.php';

$testClasses = [
    'RegisterModelTest',
    'CheckoutCalculationTest',
    'ImageUploaderTest',
    'ProfileAuthorizationTest',
    'CartIsolationTest',
    'SearchPaginationTest'
];

echo "========================================================\n";
echo " NOMADENSTUFF E-COMMERCE TEST SUITE RUNNER\n";
echo "========================================================\n\n";

$totalPassed = 0;
$totalFailed = 0;
$allErrors = [];

foreach ($testClasses as $className) {
    echo "Running Test Suite: {$className} ... ";
    $testObject = new $className();
    $methods = get_class_methods($testObject);

    foreach ($methods as $method) {
        if (strpos($method, 'test') === 0) {
            $testObject->$method();
        }
    }

    $passed = $testObject->getPassedCount();
    $failed = $testObject->getFailedCount();

    $totalPassed += $passed;
    $totalFailed += $failed;

    if ($failed === 0) {
        echo "[OK] ({$passed} assertions passed)\n";
    } else {
        echo "[FAILED] ({$failed} assertions failed)\n";
        foreach ($testObject->getErrors() as $err) {
            $allErrors[] = "  [{$className}] " . $err;
        }
    }
}

echo "\n--------------------------------------------------------\n";
echo "SUMMARY RESULTS:\n";
echo "Total Assertions Passed: {$totalPassed}\n";
echo "Total Assertions Failed: {$totalFailed}\n";
echo "--------------------------------------------------------\n";

if ($totalFailed > 0) {
    echo "\nFAILURES DETECTED:\n";
    foreach ($allErrors as $error) {
        echo $error . "\n";
    }
    echo "\nTEST SUITE FAILED!\n";
    exit(1);
} else {
    echo "\nALL TESTS PASSED SUCCESSFULLY!\n";
    exit(0);
}
