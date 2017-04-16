<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
	public function __construct()
	{
		$this->model = new Model;
	}

	public function find($id)
	{
		return $this->model->find($id);
	}

	public function all()
	{
		return $this->model->all();
	}

	public function delete($id)
	{
		$model = $this->find($id);

		$model->delete();

		return $model->id;
	}
}