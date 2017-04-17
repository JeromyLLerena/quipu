<?php

namespace App\Repositories;

use App\Models\Label;

class LabelRepository extends BaseRepository
{
	public function __construct()
	{
		$this->model = new Label;
	}

	public function save($data)
	{
		$label = null;

		if (property_exists($data, 'id')) {
			$label = $this->model->find($data->id);
		} else {
			$label = $this->model;
		}

		if (property_exists($data, 'name')) {
			$label->name = $data->name;
		}

		$label->save();

		return $label;
	}

	public function massFirstOrCreate($label_names) {
		$label_ids = [];

		foreach ($label_names as $label_name) {
			$label = $this->model->firstOrCreate(['name' => $label_name]);
			$label_ids[] = $label->id;
		}

		return $label_ids;
	}
}