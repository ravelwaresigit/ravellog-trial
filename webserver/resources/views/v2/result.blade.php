@extends('layouts.app')

@section('content')
<!--======================================== Content ======================================== -->
<div class="container-fluid">
	<legend>
		<small>
		<ul class="nav nav-pills" role="tablist">
		  <li role="presentation" title="Mengatur susunan matrix kanban"><a href="/v2/setmatrix">ATUR SUSUNAN KANBAN</a></li>
		  <li role="presentation" title="Mengisi data epc untuk masing-masing kanban"><a href="/v2/setkanban">ISI DATA KANBAN</a></li>
		  <li role="presentation" title="Melihat hasil trial" class="active"><a href="/v2/result">HASIL TRIAL</a></li>
		</ul>
		</small>
	</legend>
	<span>ID TRIAL <span id="idtrial">{{$idtrial}}</span></span>
	<button type="button" title="Klik untuk memulai trial baru sebelum kanban lewat di gate" id="setTrialNumber" class="btn btn-primary">NEW TRIAL</button>
	<button type="button" title="Klik untuk melihat hasil trial setelah kanban lewat di gate" id="showResult" class="btn btn-primary" onclick="getresult()">SHOW RESULT</button>
	<button type="button" title="Klik untuk mereset hasil trial sebelumnya dan memulai trial baru" id="clearResult" class="btn btn-warning">CLEAR RESULT</button>
	<a href="#"><button type="button" title="Download log trial untuk sementara belum bisa digunakan" disabled="" id="logResult" class="btn btn-success">LOG RESULT</button></a>
 	<div id="result" style="margin-top: 1em"></div>
<!--======================================== end of content ======================================== -->
<script type="text/javascript">
  function getresult(){
  	$('#result').load('/v2/getresult');
	document.getElementById('clearResult').removeAttribute("disabled", "disabled");
  }
</script>
{{csrf_field()}}
<script type="text/javascript">
	$(document).ready(function(){
		var ID;
		$('#result').load('/v2/getresult');
		$('#setTrialNumber').click(function(event){
			$.post('/v2/settrialnumber', {'_token':$('input[name="_token"]').val()}, function(data) {
				/*optional stuff to do after success */
				document.getElementById("idtrial").innerHTML = data;
				//set interval show result
				$('#result').load('/v2/getresult');
				ID = setInterval(function(){
					$('#result').load('/v2/getresult');
					//console.log('interval');
				},1000);
				swal({
	              title: 'Ravellog is Ready!',
	              text: 'Lewatkan Kanban pada Smart Gate System',
	              type: 'success',
	              timer: 3000,
	              showConfirmButton : false
	            });
			});
		});
		$('#clearResult').click(function(event){
			$.post('/v2/clearresult', {'_token':$('input[name="_token"]').val()}, function(data) {
				/*optional stuff to do after success */
				console.log(data);
				document.getElementById('setTrialNumber').removeAttribute("disabled", "disabled");
				//clear setinterval show result
				clearInterval(ID);
				$('#result').load('/v2/getresult');
			});
		});
	});
</script>
</div>
@endsection