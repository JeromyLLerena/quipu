<?php

namespace App\Services\Entities;

use App\Repositories\AccountRepository;

class AccountManagementService
{
	public function __construct(AccountRepository $account_repository)
	{
		$this->account_repository = $account_repository;
	}

	public function find($id)
	{
		return $this->account_repository->find($id);
	}

	public function all()
	{
		return $this->account_repository->all();
	}

	public function save(array $data)
	{
		return $this->account_repository->save((object) $data);
	}

	public function delete($id)
	{
		return $this->account_repository->delete($id);
	}
}