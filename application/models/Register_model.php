<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends MY_Model 
{

	protected $table = 'user';

	public function getDefaultValues()
	{
		return [
			'name'		=> '',
			'email'		=> '',
			'password'	=> '',
			'role'		=> '',
			'is_active'	=> ''	
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'name',
				'label'	=> 'Nama',
				'rules'	=> 'trim|required',
			],
			[
				'field' 	=> 'email',
				'label'		=> 'E-Mail',
				'rules'		=> 'trim|required|valid_email|is_unique[user.email]',
				'errors'	=> [
					'is_unique' => 'This %s already exists.'
				]
			],
			[
				'field' => 'password',
				'label'	=> 'Password',
				'rules'	=> 'required|min_length[8]',
			],
			[
				'field' => 'password_confirmation',
				'label'	=> 'Konfirmasi Password',
				'rules'	=> 'required|matches[password]',
			],
		];

		return $validationRules;
	}

	public function run($input)
{
    $hashedPassword = password_hash($input->password, PASSWORD_DEFAULT);

    $data = [
        'name'     => $input->name,
        'email'    => strtolower($input->email),
        'password' => $hashedPassword,
        'role'     => 'member'
    ];

    // Simpan data pengguna ke database
    $user = $this->create($data);

    if ($user) {
        $sess_data = [
            'id'       => $user, // Menggunakan ID pengguna yang baru saja dibuat
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => $data['role'],
            'is_login' => true
        ];

        $this->session->set_userdata($sess_data);
        return true;
    } else {
        // Handle kesalahan jika gagal menyimpan data pengguna
        return false;
    }
}


	// public function run($input)
	// {
	// 	$data		= [
	// 		'name'		=> $input->name,
	// 		'email'		=> strtolower($input->email),
	// 		// 'password'	=> hashEncrypt($input->password),
	// 		'password' => password_hash($input->password, PASSWORD_DEFAULT),
	// 		'role'		=> 'member'
	// 	];

	// 	$user		= $this->create($data);

	// 	$sess_data	= [
	// 		'id'		=> $user,
	// 		'name'		=> $data['name'],
	// 		'email'		=> $data['email'],
	// 		'role'		=> $data['role'],
	// 		'is_login'	=> true
	// 	];

	// 	$this->session->set_userdata($sess_data);
	// 	return true;
	// }

}

/* End of file Register_model.php */