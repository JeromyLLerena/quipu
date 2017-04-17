<?php

namespace App\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Entities\TransactionManagementService;
use App\Services\Entities\LabelManagementService;
use App\Services\Entities\CategoryManagementService;

class TransactionController extends Controller
{
    public function __construct(
        TransactionManagementService $transaction_management_service,
        LabelManagementService $label_management_service,
        CategoryManagementService $category_management_service
    )
    {
        $this->transaction_management_service = $transaction_management_service;
        $this->label_management_service = $label_management_service;
        $this->category_management_service = $category_management_service;
    }

    public function index()
    {
    }

    public function showCreate()
    {
        $categories = $this->category_management_service->all();
        $labels = $this->label_management_service->all()->pluck('name');
        $accounts = auth()->user()->accounts;
        return view('transactions.create')->with(compact('categories', 'labels', 'accounts'));
    }

    public function create(Request $request)
    {
        $data = [
            'title' => request('title'),
            'amount' => request('amount'),
            'description' => request('description'),
            'labels' => request('labels'),
            'account_id' => request('account'),
            'user_id' => auth()->user()->id,
            'category_id' => request('category'),
            'register_date' => request('register_date'),
            'register_time' => request('register_time'),
        ];

        $this->transaction_management_service->save($data);

        return redirect()->route('home.dashboard');
    }
}
