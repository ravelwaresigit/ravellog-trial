@extends('layouts.app')

@section('content')
<!--======================================== Content ======================================== -->
<div class="container-fluid">
	<span><strong>SEQUENCE TRIAL: </strong><span id="idtrial">{{$idtrial}}</span></span>
	<button type="button" title="Klik untuk memulai trial baru sebelum kanban lewat di gate" id="setTrialNumber" class="btn btn-primary">NEW TRIAL</button>
	<a href="{{url('/v1/downloadlog?idtrial='.$idtrial)}}"><button type="button" title="Download log trial untuk sementara belum bisa digunakan" id="logResult" class="btn btn-success">DOWNLAOD RESULT</button></a>
 	<div id="readkanban"></div>
<!--======================================== end of content ======================================== -->
{{csrf_field()}}
<script type="text/javascript">
  var ID;
  $('#readkanban').load('/v1/getresult');
    ID = setInterval(function()
    {
        $('#readkanban').load('/v1/getresult');
    }, 1000);

    // Atur tiral number yang baru
	$('#setTrialNumber').click(function(event){
		$.post('/v1/settrialnumber', {'_token':$('input[name="_token"]').val()}, function(data) {
			/*optional stuff to do after success */
			// console.log(ID)
			//clear last timeout
			clearInterval(ID);

			document.getElementById("idtrial").innerHTML = data;
			//set interval show result
			$('#readkanban').load('/v1/getresult');
			ID = setInterval(function(){
				$('#readkanban').load('/v1/getresult');
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
</script>
</div>
@endsection