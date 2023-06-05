@extends('layouts.admin')
@section('header', 'User / Employee')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div id="controller">
    <div class="card">
        <div class="card-header">
                <a href="#" @click="addData()" class="btn btn-primary">Add Data</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="datatable" class="table table-bordered table-hover">
          <thead >
            <tr>
              <th style="width: 10px">No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Date Entry</th>
              {{-- <th>Roles</th> --}}
              <th>Action</th>
            </tr>
          </thead>
        </table>
        </div>
      </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
              <div class="modal-header">
                <h4 class="modal-title">User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> 
              </div>
    
              <div class="modal-body">
                @csrf

                <input type="hidden" name="_method" value="PUT" v-if="editStatus">
    
                <div class="form-group">
                    <label>Name</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" :value="data.name" required autocomplete="name" placeholder="Full Name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" :value="data.email" required autocomplete="email" placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group" v-if="!editStatus">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group" v-if="!editStatus">
                    <label>Retype Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-if="!editStatus" placeholder="Retype Password">
                </div>

                <!-- /.col -->
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </div>
            </form>
        
          </div>
        </div>
      </div>
</div>
@endsection


@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript">
  var actionUrl = '{{ url('registers') }}';
  var apiUrl ='{{ url('api/registers') }}';
  
  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable:false},
    {data: 'name', class: 'text-center', orderable: true},
    {data: 'email', class: 'text-center', orderable: false},
    {data: 'date', class: 'text-center', orderable: false},
    // {data: 'roles.name', class: 'text-center', orderable: false},
    {render: function (index,row, data, meta){
      return `
        <a href="#" class="btn btn-success btn-sm" onclick="controller.editData(event, ${meta.row})">Edit</a>
        <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
        `;
    }, orderable: false, width: '200px', class:'text-center'},
  ];

</script>
<script src="{{ asset('js/data.js') }} "></script>

@endsection