<?php

namespace App\Http\Controllers\Labels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Entities\LabelManagementService;

class LabelController extends Controller
{
    public function __construct(LabelManagementService $label_management_service)
    {
        $this->label_management_service = $label_management_service;
    }
    public function all()
    {
        return response()->json($this->label_management_service->all()->pluck('name')->toArray());
    }
}
