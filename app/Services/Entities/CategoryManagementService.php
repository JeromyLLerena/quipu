<?php

namespace App\Services\Entities;

use App\Repositories\CategoryRepository;

class CategoryManagementService
{
	public function __construct(CategoryRepository $category_repository)
	{
		$this->category_repository = $category_repository;
	}

	public function all()
	{
		return $this->category_repository->all();
	}

	public function save(array $data)
	{
		return $this->category_repository->save((object) $data);
	}
}