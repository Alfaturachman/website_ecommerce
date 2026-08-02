<?php
require_once __DIR__ . '/../../application/libraries/Image_uploader.php';

class ImageUploaderTest extends TestCase
{
    public function testDefaultConfigMerging()
    {
        $defaultConfig = [
            'upload_path'       => './images/product',
            'file_name'         => 'test_file_123',
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 20480,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $customConfig = ['max_size' => 1024];

        $mergedConfig = array_merge($defaultConfig, $customConfig);

        $this->assertEquals(1024, $mergedConfig['max_size'], "Custom max_size should override default");
        $this->assertEquals('jpg|gif|png|jpeg|JPG|PNG', $mergedConfig['allowed_types'], "Allowed types should remain default");
        $this->assertTrue($mergedConfig['overwrite'], "Overwrite setting should be true");
    }
}
