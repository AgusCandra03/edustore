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
      <div class="card-body">
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Invoice</th>
                <th>Date</th>
                <th>Cashier</th>
                <th>Customer</th>
                <th>Total Product</th>
                <th>Total</th>
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
    {data: 'id', class: 'text-center', orderable: true},
    {data: 'date', class: 'text-center', orderable: false},
    {data: 'users.name', class: 'text-center', orderable: false},
    {data: 'member_name', class: 'text-center', orderable: false},
    {data: 'total_product', class: 'text-center', orderable: false},
    {data: 'total', class: 'text-center', orderable: false},
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
  },
});
</script>
@endsection