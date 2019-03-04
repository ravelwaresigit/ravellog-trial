<legend>TOTAL KANBAN : @if(empty($totalkanban)) 0 @else {{$totalkanban}} @endif</legend>
<font>Terakhir Kanban Terbaca : @if(empty($lastupdate)) @else {{$lastupdate->created_at}} @endif</font>
<br>
<div>
	@if(empty($readkanban[0]))
	@else
		@foreach($readkanban as $kanban)
		    <font style="font-size: 30px;"><span class="label label-success">{{$kanban->epc}}</span></font>
		@endforeach
	@endif
</div>