<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new Account;
	}

	public function save($data)
	{
		$account = null;

		if (property_exists($data, 'id')) {
			$account = $this->model->find($data->id);
		} else {
			$account = $this->model;
		}

		if (property_exists($data, 'name')) {
			$account->name = $data->name;
		}

		if (property_exists($data, 'description')) {
			$account->description = $data->description;
		}

		if (property_exists($data, 'balance')) {
			$account->balance = $data->balance;
		}

		if (property_exists($data, 'icon')) {
			$account->icon = $data->icon;
		}

		if (property_exists($data, 'user_id')) {
			$account->user_id = $data->user_id;
		}

		if (property_exists($data, 'currency_id')) {
			$account->currency_id = $data->currency_id;
		}

		$account->save();

		return $account;
	}

	public function incrementBalance($id, $amount)
	{
		$account = $this->model->find($id);
		$success = false;

		if ($amount >= 0.00) {
			$sucess = $account->increment('balance', $amount);
		}

		return $sucess;
	}

	public function decrementBalance($id, $amount) {
		$account = $this->model->find($id);
		$success = false;

		if ($account->balance >= $amount && $amount >= 0.00) {
			$success = $account->decrement('balance', (double) $amount);
		}

		return $success;
	}

	public function getLatestTransactions($id, $transactions_quantity)
	{
		$account = $this->model->find($id);

		return $account->transactions()->orderBy('register_date' , 'desc')->orderBy('register_time', 'desc')->limit($transactions_quantity)->get();
	}
}