@extends('layouts.app')

@section('content')
<!-- Body Content -->
<div id="body-content-wrapper">
    <div class="container-fluid" style="margin-top: -15px;">
        <div class="container-fluid">
            <div class="col-sm-4">
                <a href="#" data-toggle="modal" data-target="#definematrix">
                    <div class="panel panel-1" style="background-color: #2b235a; color: white;">
                        <div class="panel-heading">
                            <h2 style="text-align: center">Predefine Matrix</h2>
                            <p style="text-align: center"></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{route('v1')}}">
                    <div class="panel panel-1" style="background-color: #2b235a; color: white;">
                        <div class="panel-heading">
                            <h2 style="text-align: center">Trial V1</h2>
                            <p style="text-align: center"></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="{{route('v2')}}">
                    <div class="panel panel-1" style="background-color: #2b235a; color: white;">
                        <div class="panel-heading">
                            <h2 style="text-align: center">Trial V2 (Matrix Kanban)</h2>
                            <p style="text-align: center"></p>
                        </div>
                    </div>
                </a>
            </div>
        <!--======================================== end of content ======================================== -->
        </div>
    </div>
</div>

<!-- Modal Tambah Asset -->
<div class="modal fade" id="definematrix" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel" style="text-align: center"><b>Adjust Matrix</b></h3>
      </div>
      <form method="POST" action="{{route('updatematrix')}}" enctype="multipart/form-data">
        <div class="modal-body">
            {{csrf_field()}}
            <div class="form-group">
              <label for="exampleInputEmail1">Upload file Matrix</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fas fa-upload"></i></div>
                <input type="file" id="asset" name="asset" class="form-control" required>
              </div>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>   
        </div>
      </form>
     
    </div>
  </div>
</div>
@endsection