@extends('layouts.base')

@section('title')
	Crear cuenta
@endsection

@section('extra_css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">
				<div class="section-title-text">Crear cuenta</div>
			</h1>
		</div>
	</div>
	<div class="row col-md-12">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form class="form-wrapper" action="{{route('accounts.create')}}" method="post">
			<div class="form-flex-wrapper in-form-group-wrapper">
				<div class="row">
					<div class="form-group col-md-4">
						<label for="name">Nombre</label>
						<input type="text" class="form-control" placeholder="Nombre" id="name" name="name" value="{{old('name')}}">
					</div>
					<div class="form-group col-md-2">
						<label for="balance">Saldo</label>
						<input type="text" class="form-control" placeholder="Saldo" id="balance" name="balance" value="{{old('balance')}}">
					</div>
					<div class="form-group col-md-2">
						<label for="currency">Tipo de moneda</label>
						<select class="form-control" id="currency" name="currency">
							@foreach($currencies as $currency)
								<option value="{{$currency->id}}" {{old('currency') == $currency->id ? 'selected' : ''}}>
									{{ucfirst($currency->name)}} - {{$currency->symbol}}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-8">
						<label for="description">Descripción</label>
						<textarea class="form-control" id="description" name="description" placeholder="Descripción">{{old('description')}}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-2">
						<label for="icon">Ícono</label>
						<button id="icon" type="button" class="form-control btn btn-default" data-toggle="modal" data-target=".bs-icons-modal-lg">Seleccionar ícono</button>
					</div>
					<div class="form-group col-md-2">
						<label class="account-icon-label">
							<img class="icon-selected" src="{{old('icon') ? old('icon') : asset(config('constants.default_paths.account_icon'))}}">
						</label>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<button type="submit" class="btn btn-primary">Crear</button>
						<a href="{{route('accounts.index')}}" class="btn btn-default">Cancelar</a>
					</div>
				</div>
			</div>
			<input type="hidden" name="icon" id="icon-input" value="{{old('icon') ? old('icon') : asset(config('constants.default_paths.account_icon'))}}">
			{!! csrf_field() !!}
		</form>
	</div>
	<div class="modal fade bs-icons-modal-lg" tabindex="-1" role="dialog" aria-labelledby="icons_modal">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Seleccione un ícono</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'bag.png')}}" data-name="bag">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'bank_black.png')}}" data-name="bank_black">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'bank_blue.png')}}" data-name="bank_blue">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'bitcoin.png')}}" data-name="bitcoin">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'card.png')}}" data-name="card">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'coin.png')}}" data-name="coin">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'coin_tower.png')}}" data-name="coin_tower">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'hard_box.png')}}" data-name="hard_box">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'money.png')}}" data-name="money">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'piggy_bank.png')}}" data-name="piggy_bank">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'purse.png')}}" data-name="purse">
						</div>
						<div class="col-md-3">
							<img class="img-icon" src="{{asset(config('constants.paths.account_icons') . 'visa.png')}}" data-name="visa">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra_scripts')
<script type="text/javascript" src="{{asset('js/custom-modal.js')}}"></script>
@endsection