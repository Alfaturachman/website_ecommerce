<?php
/**
 * Base TestCase for Nomadenstuff Unit & Feature Tests
 */

class TestCase
{
    protected $passedAssertions = 0;
    protected $failedAssertions = 0;
    protected $errors = [];

    public function assertEquals($expected, $actual, $message = '')
    {
        if ($expected === $actual) {
            $this->passedAssertions++;
        } else {
            $this->failedAssertions++;
            $msg = $message ?: "Expected " . var_export($expected, true) . " but got " . var_export($actual, true);
            $this->errors[] = $msg;
        }
    }

    public function assertTrue($condition, $message = '')
    {
        if ($condition === true) {
            $this->passedAssertions++;
        } else {
            $this->failedAssertions++;
            $this->errors[] = $message ?: "Expected true but got false";
        }
    }

    public function assertFalse($condition, $message = '')
    {
        if ($condition === false) {
            $this->passedAssertions++;
        } else {
            $this->failedAssertions++;
            $this->errors[] = $message ?: "Expected false but got true";
        }
    }

    public function assertNotNull($actual, $message = '')
    {
        if ($actual !== null) {
            $this->passedAssertions++;
        } else {
            $this->failedAssertions++;
            $this->errors[] = $message ?: "Expected non-null value but got null";
        }
    }

    public function assertArrayHasKey($key, $array, $message = '')
    {
        if (is_array($array) && array_key_exists($key, $array)) {
            $this->passedAssertions++;
        } else {
            $this->failedAssertions++;
            $this->errors[] = $message ?: "Array does not contain key '{$key}'";
        }
    }

    public function getPassedCount()
    {
        return $this->passedAssertions;
    }

    public function getFailedCount()
    {
        return $this->failedAssertions;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
