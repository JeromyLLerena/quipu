<?php

namespace App\Http\Controllers\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Entities\TransactionManagementService;
use App\Services\Entities\LabelManagementService;
use App\Services\Entities\CategoryManagementService;
use App\Services\Entities\AccountManagementService;
use App\Services\Entities\TransactionTypeManagementService;
use Storage;
use App\Http\Requests\Transactions\TransactionCreateRequest;

class TransactionController extends Controller
{
    public function __construct(
        TransactionManagementService $transaction_management_service,
        LabelManagementService $label_management_service,
        CategoryManagementService $category_management_service,
        AccountManagementService $account_management_service,
        TransactionTypeManagementService $transaction_type_management_service
    )
    {
        $this->transaction_management_service = $transaction_management_service;
        $this->label_management_service = $label_management_service;
        $this->category_management_service = $category_management_service;
        $this->account_management_service = $account_management_service;
        $this->transaction_type_management_service = $transaction_type_management_service;
    }

    public function index()
    {
    }

    public function showCreate()
    {
        $categories = $this->category_management_service->all();
        $labels = $this->label_management_service->all()->pluck('name');
        $transaction_types = $this->transaction_type_management_service->all();
        $accounts = auth()->user()->accounts;

        return view('transactions.create')->with(compact('categories', 'labels', 'accounts', 'transaction_types'));
    }

    public function create(TransactionCreateRequest $request)
    {
        $data = [
            'title' => request('title'),
            'amount' => request('amount'),
            'description' => request('description'),
            'labels' => request('labels'),
            'account_id' => request('account'),
            'user_id' => auth()->user()->id,
            'category_id' => request('category'),
            'register_date' => request('date'),
            'register_time' => request('time'),
            'attachment' => null,
        ];

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store(config('constants.upload_paths.files.transactions'), 'public');
            $data['attachment'] = Storage::url($path);
        }

        if ($this->account_management_service->authorizeTransaction($data)) {
            $this->transaction_management_service->save($data);
        }

        return redirect()->route('home.dashboard');
    }
}
