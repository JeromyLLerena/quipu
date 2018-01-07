<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new Transaction;
	}

	public function save($data)
	{
		$transaction = null;

		if (property_exists($data, 'id')) {
			$transaction = $this->model->find($data->id);
		} else {
			$transaction = $this->model;
		}

		if (property_exists($data, 'title')) {
			$transaction->title = $data->title;
		}

		if (property_exists($data, 'description')) {
			$transaction->description = $data->description;
		}

		if (property_exists($data, 'amount')) {
			$transaction->amount = $data->amount;
		}

		if (property_exists($data, 'register_date')) {
			$transaction->register_date = $data->register_date;
		}

		if (property_exists($data, 'register_time')) {
			$transaction->register_time = $data->register_time;
		}

		if (property_exists($data, 'account_id')) {
			$transaction->account_id = $data->account_id;
		}

		if (property_exists($data, 'user_id')) {
			$transaction->user_id = $data->user_id;
		}

		if (property_exists($data, 'category_id')) {
			$transaction->category_id = $data->category_id;
		}

		if (property_exists($data, 'attachment')) {
			$transaction->attachment = $data->attachment;
		}

		$transaction->save();

		if (property_exists($data, 'labels')) {
			$transaction->labels()->sync($data->labels);
		}

		return $transaction;
	}
}