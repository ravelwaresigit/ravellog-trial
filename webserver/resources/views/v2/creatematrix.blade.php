@extends('layouts.app')

@section('content')
<!--======================================== Content ======================================== -->
<div class="container-fluid">
	<legend>
		<small>
		<ul class="nav nav-pills" role="tablist">
		  <li role="presentation" title="Mengatur susunan matrix kanban" class="active"><a href="/v2/matrix">BUAT MATRIX</a></li>
		  <li role="presentation" title="Mengatur susunan matrix kanban"><a href="/v2/setmatrix">ATUR SUSUNAN KANBAN</a></li>
		  <li role="presentation" title="Mengisi data epc untuk masing-masing kanban"><a href="/v2/setkanban">ISI DATA KANBAN</a></li>
		  <li role="presentation" title="Melihat hasil trial"><a href="/v2/result">HASIL TRIAL</a></li>
		</ul>
		</small>
	</legend>
	<h5>Atur matrix yang diinginkan</h5>
	@if (Session::has('message'))
      <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
	<br>
	<div class="row">
		<div class="col-sm-6 col-xs-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<form method="POST" class="form-horizontal" action="{{route('creatematrix')}}">
						{{csrf_field()}}
							<div class="form-group">
								<div class="col-sm-8">
									<label>Banyak Kanban ke kanan (Sumbu X)</label>
								</div>
								<div class="col-sm-4">
									<input type="text" name="x" class="form-control" placeholder="Nilai antara 1 dan 9" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8">
									<label>Banyak Kanban ke depan (Sumbu Y)</label>
								</div>
								<div class="col-sm-4">
									<input type="text" name="y" class="form-control" placeholder="Nilai antara 1 dan 9" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8">
									<label>Banyak Kanban ke atas (Sumbu Z)</label>
								</div>
								<div class="col-sm-4">
									<input type="text" name="z" class="form-control" placeholder="Nilai antara 1 dan 9" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success" style="width: 100%;">SUBMIT</button>
								</div>
							</div>
					</form>
				</div>
			</div>
			
		</div>
	</div>
	
<!--======================================== end of content ======================================== -->
</div>
<script type="text/javascript">
	@if(Session::has('msg'))
      swal("{{ Session::get('title')}}","{{ Session::get('msg')}}","{{ Session::get('alert-type')}}");
    @endif
</script>
@endsection