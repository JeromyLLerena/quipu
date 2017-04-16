<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new Currency;
	}
}