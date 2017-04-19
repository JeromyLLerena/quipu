<?php

namespace App\Services\Entities;

use App\Repositories\AccountRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\CategoryRepository;

class AccountManagementService
{
	public function __construct(
		AccountRepository $account_repository,
		TransactionRepository $transaction_repository,
		CategoryRepository $category_repository
	)
	{
		$this->account_repository = $account_repository;
		$this->transaction_repository = $transaction_repository;
		$this->category_repository = $category_repository;
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

	public function authorizeTransaction(array $transaction_data)
	{
		$account = $this->account_repository->find($transaction_data['account_id']);
		$category = $this->category_repository->find($transaction_data['category_id']);
		$operation_successful = false;

		if ($category && $account) {
			switch ($category->transaction_type_id) {
				case config('constants.transaction_types.entry'):
					$operation_successful = $this->account_repository->incrementBalance($account->id, $transaction_data['amount']);
					break;
				case config('constants.transaction_types.discharge'):
					$operation_successful = $this->account_repository->decrementBalance($account->id, $transaction_data['amount']);
					break;
				default:
					# code...
					break;
			}
		}

		return $operation_successful;
	}

	public function getLatestTransactions($account_id)
	{
		return $this->account_repository->getLatestTransactions($account_id, config('constants.transactions_preview'));
	}
}