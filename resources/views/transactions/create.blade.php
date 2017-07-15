@extends('layouts.base')

@section('title')
	Nueva Transacción
@endsection

@section('extra_css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('bootstrap-tagsinput-latest/examples/assets/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('ericjgagnon-wickedpicker-acee210/dist/wickedpicker.min.css')}}">
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-header">
				<div class="section-title-text">Agregar Transacción</div>
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
		<form class="form-wrapper" action="{{route('transactions.create')}}" method="post">
			<div class="form-flex-wrapper in-form-group-wrapper">
				<div class="row">
					<div class="form-group col-md-3">
						<label for="title">Título</label>
						<input type="text" class="form-control" placeholder="Título" id="title" name="title" value="{{old('title')}}">
					</div>
					<div class="form-group col-md-2">
						<label for="amount">Monto</label>
						<input type="text" class="form-control" placeholder="Monto" id="amount" name="amount" value="{{old('amount') ? number_format(old('amount'), config('constants.decimal_digits')) : ''}}">
					</div>
					<div class="form-group col-md-3">
						<label for="account">Cuenta</label>
						<select class="form-control" id="account" name="account">
							@foreach($accounts as $account)
								<option value="{{$account->id}}" {{old('account') == $account->id ? 'selected' : ''}}>
									{{ucfirst($account->name)}} ( {{$account->currency->symbol . ' ' . number_format($account->balance, config('constants.decimal_digits'))}} ) 
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-2">
						<label for="type">Tipo</label>
						<select class="form-control" name="type" id="type">
							@foreach($transaction_types as $type)
								<option value="{{$type->id}}" {{old('type') == $type->id ? 'selected' : ''}}>
									{{$type->name}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-2">
						<label for="category">Categoría</label>
						<select class="form-control" name="category" id="category">
							@foreach($categories as $category)
								<option data-type="{{$category->type->id}}" value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>
									{{$category->name}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="description">Descripción</label>
						<textarea class="form-control" id="description" name="description" placeholder="Descripción">{{old('description')}}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-3">
						<label for="labels">Etiquetas <small>(separadas por comas)</small></label>
						<input type="text" id="labels" name="labels" data-role="tagsinput" value="{{old('labels')}}">
					</div>
					<div class="form-group col-md-3">
						<label for="date">Fecha</label>
						<input type="text" class="form-control" id="date" name="date" value="{{old('date')}}">
					</div>
					<div class="form-group col-md-2">
						<label for="time">Hora</label>
						<input type="text" class="form-control timepicker" id="time" name="time" value="{{old('time')}}">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<button type="submit" class="btn btn-primary">Agregar</button>
						<a href="{{route('home.dashboard')}}" class="btn btn-default">Cancelar</a>
					</div>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@endsection

@section('extra_scripts')
<script type="text/javascript" src="{{asset('bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js')}}"></script>
<script type="text/javascript" src="{{asset('js/typehead.js')}}"></script>
<script type="text/javascript" src="{{asset('bootstrap-tagsinput-latest/examples/assets/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{asset('ericjgagnon-wickedpicker-acee210/src/wickedpicker.js')}}" ></script>
<script type="text/javascript">
	var today = new Date();
	console.log(today);
	$('#date').datepicker();
	$('#date').datepicker('setDate', today.getDate() + "/" + (parseInt(today.getMonth()) + 1) + "/" + today.getFullYear());
	$('#time').wickedpicker();
	var labelnames = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: {
			url: "{{route('labels.json.all')}}",
			filter: function(list) {
				return $.map(list, function(tagname) {
					return { name: tagname }; });
			}
		}
	});

	labelnames.initialize();

	$('#labels').tagsinput({
		typeaheadjs: {
			name: 'labelnames',
			displayKey: 'name',
			valueKey: 'name',
			source: labelnames.ttAdapter()
		}
	});

	$('#type').change(function(){
		var type = $(this).val();
		var visible_options = $("[data-type='" + type + "']");
		var all_options = $('#category').find('option')
		all_options.hide();
		visible_options.show();
		all_options.removeAttr('selected');
		visible_options.first().attr('selected', 'selected');
		visible_options.first().click();
	});
</script>
@endsection