<?php

namespace App\Services\Entities;

use App\Repositories\LabelRepository;

class LabelManagementService
{
	public function __construct(LabelRepository $label_repository)
	{
		$this->label_repository = $label_repository;
	}

	public function all()
	{
		return $this->label_repository->all();
	}

	public function save(array $data)
	{
		return $this->label_repository->save((object) $data);
	}
}