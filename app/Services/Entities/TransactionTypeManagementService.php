<?php

namespace App\Services\Entities;

use App\Repositories\TransactionTypeRepository;

class TransactionTypeManagementService
{
	public function __construct(TransactionTypeRepository $transaction_type_repository)
	{
		$this->transaction_type_repository = $transaction_type_repository;
	}

	public function all()
	{
		return $this->transaction_type_repository->all();
	}
}