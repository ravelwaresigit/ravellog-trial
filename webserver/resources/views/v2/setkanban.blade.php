@extends('layouts.app')

@section('content')
<!--======================================== Content ======================================== -->
<div class="container-fluid">
	<legend>
		<small>
		<ul class="nav nav-pills" role="tablist">
		  <li role="presentation" title="Mengatur susunan matrix kanban"><a href="/v2/setmatrix">ATUR SUSUNAN KANBAN</a></li>
		  <li role="presentation" title="Mengisi data epc untuk masing-masing kanban" class="active"><a href="/v2/setkanban">ISI DATA KANBAN</a></li>
		  <li role="presentation" title="Melihat hasil trial"><a href="/v2/result">HASIL TRIAL</a></li>
		</ul>
		</small>
	</legend>
	<h5><b>Masukkan 3 digit terakhir dari epc rfid tag</b></h5>
	@if (Session::has('message'))
      <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
	<br>
	<form method="POST" class="form-horizontal" action="{{route('storekanban')}}">
	<div class="row">
		@for ($a=1; $a <= $matrix->z ; $a++)
		<div class="col-sm-6">
			<label>Layer {{$a}}</label>
			<div class="panel panel-default" style="box-shadow: 0 3px 5px #777">
				<div class="panel-body">
				{{csrf_field()}}
					@for($b=1; $b <= $matrix->y ; $b++)  
					<div class="row">
						@for($c=1; $c <= $matrix->x ; $c++) 
						<?php $kanban = 'kanban'.$c.$b.$a;
						?>
						<div class="col-md-2">
							@foreach($readkanbans as $readkanban)
								@if($readkanban->x == $c && $readkanban->y == $b && $readkanban->z == $a)
									@if($readkanban->epc != null)
									<!-- <label>X{{$readkanban->x}}, Y{{$readkanban->y}}, Z{{$readkanban->z}}</label> -->
									<input type="text" class="form-control datakanban" name="{{$kanban}}" value="{{$readkanban->epc}}" data-x="{{$c}}" data-y="{{$b}}" data-z="{{$a}}" onblur="isDuplicate('{{$kanban}}')">
									@else
									<!-- <label>X{{$readkanban->x}}, Y{{$readkanban->y}}, Z{{$readkanban->z}}</label> -->
									<input type="text" class="form-control datakanban" data-x="{{$c}}" data-y="{{$b}}" data-z="{{$a}}" name="{{$kanban}}" value="" onblur="isDuplicate('{{$kanban}}')">
									@endif
								@endif
							@endforeach
						</div>
						@endfor
					</div>
					<br>
					@endfor
				</div>
			</div>
		</div>
		@endfor
	</div>
	<button type="submit" class="btn btn-success" style="width: 100%">SUBMIT</button>
	</form>
	
<!--======================================== end of content ======================================== -->
{{csrf_field()}}
<script type="text/javascript">
	// onblur from event, check ada redundand kanban atau tidak
	function isDuplicate(data){
		var x = $('[name="'+data+'"]').attr("data-x")
		var y = $('[name="'+data+'"]').attr("data-y")
		var z = $('[name="'+data+'"]').attr("data-z")
		var koordinat = data
		console.log(x,y,z)
		var query = '[name="kanban'+data+'"]';
		var kanban = document.querySelector('[name="'+data+'"]').value;
		$.post('/v2/checkduplicatekanban', {'kanban':kanban,'x':x, 'y':y, 'z':z, '_token':$('input[name="_token"]').val()}, function(data) {
			/*optional stuff to do after success */
			console.log(data)
			if(data[0] =="epc sudah dipakai"){
				swal("Peringatan","EPC "+data[4]+" sudah dipakai pada koordinat x="+data[1]+", y="+data[2]+", z="+data[3],"warning");
				$('[name="'+koordinat+'"]').val('')
			}

			// console.log('check kanban '+data);
		});
	}
</script>
</div>
@endsection