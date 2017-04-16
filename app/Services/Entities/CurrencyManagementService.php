<?php

namespace App\Services\Entities;

use App\Repositories\CurrencyRepository;

class CurrencyManagementService
{
	public function __construct(CurrencyRepository $currency_repository)
	{
		$this->currency_repository = $currency_repository;
	}

	public function find($id)
	{
		return $this->currency_repository->find($id);
	}

	public function all()
	{
		return $this->currency_repository->all();
	}
}