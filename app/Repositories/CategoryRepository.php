<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new Category;
	}

	public function save($data)
	{
		$category = null;

		if (property_exists($data, 'id')) {
			$category = $this->model->find($data->id);
		} else {
			$category = $this->model;
		}

		if (property_exists($data, 'name')) {
			$category->name = $data->name;
		}

		if (property_exists($data, 'transaction_type_id')) {
			$category->transaction_type_id = $data->transaction_type_id;
		}

		$category->save();

		return $category;
	}
}