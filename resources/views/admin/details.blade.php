@extends('layouts.admin')
@section('header', 'Sales Detail')
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
          <a class="btn btn-success btn-sm" href="{{route('printDetail')}}" target="_blank"><i class="fa fa-print"></i> Print PDF</a>
        </div>
      </div>
      <div class="card-body">
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Invoice</th>
                <th>Date</th>
                <th>Cashier</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
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
var actionUrl = '{{ url('sale_details') }}';
var apiUrl ='{{ url('api/sale_details') }}';

var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable:false},
    {data: 'sale_id', class: 'text-center', orderable: true},
    {data: 'date', class: 'text-center', orderable: false},
    {data: 'sales.users.name', class: 'text-center', orderable: false},
    {data: 'sales.members.name', class: 'text-center', orderable: false},
    {data: 'sales.total', class: 'text-center', orderable: false},
    {render: function (index,row, data, meta){
      return `
        <a class="btn btn-success btn-sm" onclick="href='sale_details/receipt'" target="_blank">Print</a>
        <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
      `;
    }, orderable: false, width: '200px', class:'text-center'},
];

var controller = new Vue({
  el: '#controller',
  data: {
    datas: [],
    data: {},
    actionUrl,
    apiUrl,
    editStatus: false,
  },
  mounted: function(){
    this.datatable();
  },
  methods: {
    datatable(){
        const _this = this;
        _this.table = $('#datatable').DataTable({
          ajax: {
            url: _this.apiUrl,
            type: 'GET',
          },
            columns
        }).on('xhr', function () {
            _this.datas = _this.table.ajax.json().data;
        });
    },
    deleteData(event, id){
      if(confirm("Are You Sure ?")){
        $(event.target).parents('tr').remove()
        axios.post(this.actionUrl+'/'+id, {_method: 'DELETE'}).then(response => {
          alert('Data has been removed');
        });
      }
    },
    },
});
</script>
@endsection