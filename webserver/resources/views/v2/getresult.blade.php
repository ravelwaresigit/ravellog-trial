<legend style="margin-top: -5px">KANBAN TERBACA : @if(empty($totalkanbanterbaca)) 0 @else {{$totalkanbanterbaca}} @endif / @if(empty($totalkanbandipakai)) 0 @else {{$totalkanbandipakai}} @endif
<font style="margin-right: 20px;float: right;">Terakhir Update: @if(empty($lastupdate)) @else {{$lastupdate->created_at}} @endif</font>
</legend>
<div style="margin-top: -20px">
	@if(empty($readkanban[0]))
	@else
		@for($z=1;$z<=$matrixset->z;$z++)
			<div class="col-md-4">
			<h4><b>Layer {{$z}}</b></h4>
				<div class="panel panel-default" style="padding: 10px;">
		    		@for($y=1;$y<=$matrixset->y;$y++)
		    			<div class="row">
		    			@for($x=1;$x<=$matrixset->x;$x++)
							@foreach($readkanban as $kanban)
			    				@if($kanban->z == $z && $kanban->y == $y && $kanban->x == $x)
			    					<div class="col-sm-2">
			    						<font style="font-size: 24px;">
			    							@if($kanban->epc == null or $kanban->epc == '')
												<span class="label label-default">___</span>
			    							@else
						    					@if($kanban->status == 1) <span class="label label-success">{{$kanban->epc}}</span> @else <span class="label label-danger">___</span> 
						    					@endif
			    							@endif
				    					</font>
			    					</div>
			    				@endif
							@endforeach
						@endfor
						</div>
		    		@endfor
			    </div>
			</div>
		@endfor
	@endif
</div>