<?php
require_once __DIR__ . '/../../application/models/Register_model.php';

class RegisterModelTest extends TestCase
{
    public function testGetValidationRules()
    {
        $model = new Register_model();
        $rules = $model->getValidationRules();

        $this->assertTrue(is_array($rules), "Validation rules should be an array");
        $this->assertEquals(6, count($rules), "Register model should have 6 validation rules");

        $fields = array_column($rules, 'field');
        $this->assertTrue(in_array('name', $fields), "Rules must include name field");
        $this->assertTrue(in_array('email', $fields), "Rules must include email field");
        $this->assertTrue(in_array('password', $fields), "Rules must include password field");
        $this->assertTrue(in_array('password_confirmation', $fields), "Rules must include password_confirmation field");
        $this->assertTrue(in_array('phone', $fields), "Rules must include phone field");
        $this->assertTrue(in_array('address', $fields), "Rules must include address field");
    }

    public function testGetDefaultValues()
    {
        $model = new Register_model();
        $defaults = $model->getDefaultValues();

        $this->assertTrue(is_array($defaults), "Default values should be an array");
        $this->assertArrayHasKey('name', $defaults);
        $this->assertArrayHasKey('email', $defaults);
        $this->assertArrayHasKey('is_active', $defaults);
    }
}
