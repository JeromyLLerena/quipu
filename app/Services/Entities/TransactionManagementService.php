<?php

namespace App\Services\Entities;

use App\Repositories\TransactionRepository;
use App\Repositories\LabelRepository;
use Carbon\Carbon;

class TransactionManagementService
{
	public function __construct(
		TransactionRepository $transaction_repository,
		LabelRepository $label_repository
	)
	{
		$this->transaction_repository = $transaction_repository;
		$this->label_repository = $label_repository;
	}

	public function find($id)
	{
		return $this->transaction_repository->find($id);
	}

	public function all()
	{
		return $this->transaction_repository->all();
	}

	public function save(array $data)
	{
		$label_names= explode(',', $data['labels']);

		$data['labels'] = $this->label_repository->massFirstOrCreate($label_names);

		if (!$data['register_date']) {
			$data['register_date'] = Carbon::now()->toDateString();
		}

		if (!$data['register_time']) {
			$data['register_time'] = Carbon::now()->toTimeString();
		}

		return $this->transaction_repository->save((object) $data);
	}

	public function delete($id)
	{
		return $this->transaction_repository->delete($id);
	}
}