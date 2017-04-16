@extends('layouts.base')

@section('title')
	Manejo de Cuentas
@endsection

@section('extra_css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
@endsection

@section('content')
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header">
						<div class="section-title-text">Cuentas</div>
						<div class="section-title-button">
							<a href="{{route('accounts.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear cuenta</a>
						</div>
					</h1>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				@foreach($accounts as $account)
					<div class="col-lg-4 col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="row account-title">
									<p class="text-center"><strong>{{strtoupper($account->name)}}</strong></p>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<img src="{{$account->icon}}">
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">{{$account->decimal_balance}}</div>
										<div>{{$account->currency->symbol}}</div>
									</div>
								</div>
							</div>
							<a href="{{route('accounts.edit', $account->id)}}">
								<div class="panel-footer">
									<span class="pull-left">Ver detalles</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
			<!-- /.row -->
@endsection