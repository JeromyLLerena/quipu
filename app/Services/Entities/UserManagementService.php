<?php

namespace App\Services\Entities;

use App\Repositories\UserRepository;

class UserManagementService
{
	public function __construct(UserRepository $user_repository)
	{
		$this->user_repository = $user_repository;
	}

	public function find($id)
	{
		return $this->user_repository->find($id);
	}
}