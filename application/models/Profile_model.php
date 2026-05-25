<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends MY_Model 
{

    protected $table = 'user';

    public function getDefaultValues()
	{
		return [
			'name' 		=> '',
			'email'		=> '',
			'image'		=> ''
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field'	=> 'name',
				'label'	=> 'Nama',
				'rules'	=> 'trim|required'
			],
			[
				'field'	=> 'email',
				'label'	=> 'E-Mail',
				'rules'	=> 'trim|required|valid_email|callback_unique_email'
			]
		];

		return $validationRules;
	}

	public function uploadImage($fieldName, $fileName)
	{
		$this->load->library('image_uploader');
		return $this->image_uploader->upload($fieldName, $fileName, './images/profile', [
			'max_size' => 10240
		]);
	}

	public function deleteImage($fileName)
	{
		$this->load->library('image_uploader');
		$this->image_uploader->delete($fileName, './images/profile');
	}
}

/* End of file Profile_model.php */
