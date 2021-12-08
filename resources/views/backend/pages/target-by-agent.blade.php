@extends('backend.layout.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Agent Target</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Target</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('store-target-agent')}}" method="post">
                @csrf
                <div class="card-body">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Target</label>
                    <input type="text" class="form-control " id="exampleInputEmail1"  name="target">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Agent Name</label>
                    <select name="agent_id" class="form-control ">
                     @foreach($agents as $agent)
                     <option value="{{$agent->id}}">{{$agent->name}}</option>
                     @endforeach
                   </select>
                  </div>
                  
                   <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select name="status" class="form-control status">
                      <option value="0">Active</option>
                      <option value="1">De-Active</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Teams Record</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped ">
                  <thead>
                  <tr>
                    <th>S no.</th>
                    <th>Target</th>
                    <th>Agent</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                 
                   
                    @php
                    $sn =1 
                    @endphp
                    @foreach($targets as $target)
                  <tr>
                    <td>{{$sn}}</td>
                    <td>${{$target->target}}</td>
                    @php
                    $agent = \App\Agent::where('id',$target->agent_id)->first();
                    @endphp
                    <td>{{$agent->name}}</td>
                    @if($target->status == 0)
                    <td><span class="badge badge-success">Active</span></td>
                    @else
                    <td><span class="badge badge-warning">De-Active</span></td>
                    @endif
                    <td><a class="btn btn-default " id="agenttargetbtn" data-id="{{$target->id}}" data-target="{{$target->target}}" data-agent="{{$target->agent_id}}"  data-status="{{$target->status}}"><i class="fa fa-pen"></i></a><a class="btn btn-default " href="{{route('del-target-agent',$target->id)}}"><i class="fa fa-trash"></i></a></td>
                  </tr>
                  @php
                  $sn++
                  @endphp
                  @endforeach
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="agenttargetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Agent Target</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('edit-target-agent')}}" method="post">
                @csrf
                    <input type="hidden" class="form-control id" id="exampleInputEmail1"  name="id">

                <div class="card-body">
                   <div class="form-group">
                    <label for="exampleInputEmail1">Target</label>
                    <input type="text" class="form-control target" id="exampleInputEmail1"  name="target">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Agent Name</label>
                    <select name="agent_id" class="form-control agent">
                    @foreach($agents as $agent)
                     <option value="{{$agent->id}}">{{$agent->name}}</option>
                     @endforeach
                   </select>
                  </div>
                  
                   <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select name="status" class="form-control status">
                      <option value="0">Active</option>
                      <option value="1">De-Active</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
      </div>
      
    </div>
  </div>
</div>
  
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).on('click','#agenttargetbtn',function(){
         $('#agenttargetModal').modal('show')
         var id = $(this).data('id');
         var target = $(this).data('target');
         var agent = $(this).data('agent');
         var status = $(this).data('status');
         console.log(name);
         $('.id').val(id);
         $('.target').val(target);
         $('.agent').val(agent);
         $('.status').val(status);
    });
  </script>
@endsection