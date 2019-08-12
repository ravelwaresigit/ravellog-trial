<legend>TOTAL KANBAN : @if(empty($totalkanban)) 0 @else {{$totalkanban}} @endif</legend>
<font>Terakhir Kanban Terbaca : @if(empty($lastupdate)) @else {{$lastupdate->created_at}} @endif</font>
<br>
<div>
	@if(empty($readkanban[0]))
	@else
		@foreach($readkanban as $kanban)
		    <font style="font-size: 30px;">
		    	@if($kanban->epc === 'sensor') <span class="label label-warning" style="margin-right: 0.5em"> {{$kanban->epc}} || <small> {{$kanban->created_at}} </small></span>
		    	@else <span class="label label-success" style="margin-right: 0.5em"> {{$kanban->epc}} || <small> {{$kanban->created_at}} </small></span>
		    	@endif
		    </font>
		@endforeach
	@endif
</div>