@extends('layouts.app')

@section('content')
<!--======================================== Content ======================================== -->
<div class="container-fluid">
	<legend>
		<small>
		<ul class="nav nav-pills" role="tablist">
		  <li role="presentation" title="Mengatur susunan matrix kanban" class="active"><a href="/v2/setmatrix">ATUR SUSUNAN KANBAN</a></li>
		  <li role="presentation" title="Mengisi data epc untuk masing-masing kanban"><a href="/v2/setkanban">ISI DATA KANBAN</a></li>
		  <li role="presentation" title="Melihat hasil trial"><a href="/v2/result">HASIL TRIAL</a></li>
		</ul>
		</small>
	</legend>
	<h5>Atur susunan kanban yang diinginkan</h5>
	@if (Session::has('message'))
      <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
	<br>
	<div class="row">
		<div class="col-sm-6 col-xs-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<form method="POST" class="form-horizontal" action="{{route('storematrix')}}">
						{{csrf_field()}}
							<div class="form-group">
								<div class="col-sm-8">
									<label>Banya Kanban ke kanan (Sumbu X)</label>
								</div>
								<div class="col-sm-4">
									<select name="x" class="form-control">
										<option value="1" @if($matrixset->x == '1') selected="" @endif>1</option>
										<option value="2" @if($matrixset->x == '2') selected="" @endif>2</option>
										<option value="3" @if($matrixset->x == '3') selected="" @endif>3</option>
										<option value="4" @if($matrixset->x == '4') selected="" @endif>4</option>
										<option value="5" @if($matrixset->x == '5') selected="" @endif>5</option>
										<option value="6" @if($matrixset->x == '6') selected="" @endif>6</option>
										<option value="7" @if($matrixset->x == '7') selected="" @endif>7</option>
										<option value="8" @if($matrixset->x == '8') selected="" @endif>8</option>
										<option value="9" @if($matrixset->x == '9') selected="" @endif>9</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8">
									<label>Banyak Kanban ke depan (Sumbu Y)</label>
								</div>
								<div class="col-sm-4">
									<select name="y" class="form-control">
										<option value="1" @if($matrixset->y == '1') selected="" @endif>1</option>
										<option value="2" @if($matrixset->y == '2') selected="" @endif>2</option>
										<option value="3" @if($matrixset->y == '3') selected="" @endif>3</option>
										<option value="4" @if($matrixset->y == '4') selected="" @endif>4</option>
										<option value="5" @if($matrixset->y == '5') selected="" @endif>5</option>
										<option value="6" @if($matrixset->y == '6') selected="" @endif>6</option>
										<option value="7" @if($matrixset->y == '7') selected="" @endif>7</option>
										<option value="8" @if($matrixset->y == '8') selected="" @endif>8</option>
										<option value="9" @if($matrixset->y == '9') selected="" @endif>9</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8">
									<label>Banyak Kanban ke atas (Sumbu Z)</label>
								</div>
								<div class="col-sm-4">
									<select name="z" class="form-control">
										<option value="1" @if($matrixset->z == '1') selected="" @endif>1</option>
										<option value="2" @if($matrixset->z == '2') selected="" @endif>2</option>
										<option value="3" @if($matrixset->z == '3') selected="" @endif>3</option>
										<option value="4" @if($matrixset->z == '4') selected="" @endif>4</option>
										<option value="5" @if($matrixset->z == '5') selected="" @endif>5</option>
										<option value="6" @if($matrixset->z == '6') selected="" @endif>6</option>
										<option value="7" @if($matrixset->z == '7') selected="" @endif>7</option>
										<option value="8" @if($matrixset->z == '8') selected="" @endif>8</option>
										<option value="9" @if($matrixset->z == '9') selected="" @endif>9</option>
									</select>
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
@endsection