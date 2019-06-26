@extends('layouts.app')

@section('content')
<!--======================================== Content ======================================== -->
<div class="container-fluid">
 	<div id="readkanban"></div>
<!--======================================== end of content ======================================== -->
<script type="text/javascript">
  $('#readkanban').load('/v1/getresult');
    var refreshId = setInterval(function()
    {
        $('#readkanban').load('/v1/getresult');
    }, 1000);
</script>
</div>
@endsection