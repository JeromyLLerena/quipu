<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Entities\UserManagementService;
use App\Services\Entities\CurrencyManagementService;
use App\Services\Entities\AccountManagementService;
use App\Http\Requests\Accounts\AccountCreateRequest;

class AccountController extends Controller
{
    public function __construct(
        UserManagementService $user_management_service,
        CurrencyManagementService $currency_management_service,
        AccountManagementService $account_management_service
    )
    {
        $this->user_management_service = $user_management_service;
        $this->currency_management_service = $currency_management_service;
        $this->account_management_service = $account_management_service;
    }

    public function index()
    {
        $user = auth()->user()->toArray();
        $accounts = auth()->user()->accounts;

        return view('accounts.index')->with(compact('user', 'accounts'));
    }

    public function showCreate()
    {
        $user = auth()->user()->toArray();
        $currencies = $this->currency_management_service->all();

        return view('accounts.create')->with(compact('user', 'currencies'));
    }

    public function create(AccountCreateRequest $request)
    {
        $data = [
            'name' => request('name'),
            'description' => request('description'),
            'balance' => request('balance'),
            'currency_id' => request('currency'),
            'icon' => request('icon'),
            'user_id' => auth()->user()->id,
        ];

        $this->account_management_service->save($data);

        return redirect()->route('accounts.index');
    }

    public function showEdit($id)
    {
        $account = $this->account_management_service->find($id);
        $currencies = $this->currency_management_service->all();

        return view('accounts.edit')->with(compact('account', 'currencies'));
    }

    public function edit(AccountCreateRequest $request, $id)
    {
        $data = [
            'id' => $id,
            'name' => request('name'),
            'description' => request('description'),
            'balance' => request('balance'),
            'currency_id' => request('currency'),
            'icon' => request('icon'),
            'user_id' => auth()->user()->id,
        ];

        $this->account_management_service->save($data);

        return redirect()->route('accounts.index');
    }

    public function delete($id)
    {
        $this->account_management_service->delete($id);

        return redirect()->route('accounts.index');
    }
}
