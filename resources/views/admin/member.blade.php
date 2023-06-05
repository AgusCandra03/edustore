@extends('layouts.admin')
@section('header', 'Member')
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
      <div class="row">
        <div class="col-md-10">
          <a href="#" @click="addData()" class="btn btn-primary btn-sm">Add User</a>
        </div>
        <div class="col-md-2">
          <select class="form-control" name="gender">
            <option value="A">All Gender</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
          </select>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="datatable" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width: 10px">No.</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Phone Number</th>
          <th>Date Entry</th>
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
            <h4 class="modal-title">Member</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            @csrf

            <input type="hidden" name="_method" value="PUT" v-if="editStatus">

            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" placeholder="Full Name" :value="data.name" required="">
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select name="gender" class="form-control" required="">
                  <option value="M" :selected="data.gender=='M'">Male</option>
                  <option value="F" :selected="data.gender=='F'">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" name="address" class="form-control" placeholder="Address" :value="data.address" required="">
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" :value="data.phone_number" required="">
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    
      </div>
    </div>
  </div>

  {{-- <div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Member</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4">NIK</label>
            <label class="col-md-1">:</label>
            <label class="col-md-6" name="nik" id="nik"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Name</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" name="name" id="name"></label>
        </div>
        <div class="form-group">
            <label class="col-md-4">Address</label>
            <label class="col-md-1">:</label>
            <label class="col-md-6" name="address" id="address"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Phone Number</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" name="phone_number" id="phone_number"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Entry</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" name="created_at" id="created_at"></label>
      </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}
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
var actionUrl = '{{ url('members') }}';
var apiUrl ='{{ url('api/members') }}';

var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable:false},
    {data: 'name', class: 'text-center', orderable: true},
    {data: 'gender', class: 'text-center', orderable: false},
    {data: 'address', class: 'text-center', orderable: false},
    {data: 'phone_number', class: 'text-center', orderable: false},
    {data: 'date', class: 'text-center', orderable: false},
    {render: function (index,row, data, meta){
      return `
        <a href="#" class="btn btn-success btn-sm" onclick="controller.editData(event, ${meta.row})">Edit</a>
        <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
      `;
    }, orderable: false, width: '200px', class:'text-center'},
  ];
</script>
<script src="{{ asset('js/data.js') }} "></script>
<script type="text/javascript">
  $('select[name=gender]').on('change', function(){
    gender = $('select[name=gender]').val();
    if(gender=='A'){
      controller.table.ajax.url(apiUrl).load();
    } else{
      controller.table.ajax.url(apiUrl+'?gender='+gender).load();
    }
  });
</script>

@endsection