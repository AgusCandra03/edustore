@extends('layouts.admin')
@section('header', 'Stock')
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
        <a href="#" @click="addData()" class="btn btn-primary">Add Stock</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <table id="datatable" class="table table-bordered table-hover">
        <thead >
          <tr>
            <th style="width: 10px">No.</th>
            <th>Date Entry</th>
            <th>Product Name</th>
            <th>Supplier</th>
            <th>Note</th>
            <th>Qty</th>
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
              <h4 class="modal-title">Stock</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
  
            <div class="modal-body">
              @csrf
  
              <input type="hidden" name="_method" value="PUT" v-if="editStatus">
  
              <div class="form-group">
                <label>Date Entry</label>
                <input type="date" name="date_entry" class="form-control" :value="data.date_entry" required="">
              </div>
              <div class="form-group">
                <label>Product Name</label>
                <select name="product_id" class="form-control" required="">
                    @foreach($products as $product)
                    <option :selected="data.product_id == {{ $product->id }}" value="{{ $product->id }} ">
                        {{ $product->code }} - {{ $product->name }}
                    </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Supplier</label>
                <select name="supplier_id" class="form-control" required="">
                    @foreach($suppliers as $supplier)
                    <option :selected="data.supplier_id == {{ $supplier->id }}" value="{{ $supplier->id }} ">
                        {{ $supplier->name }}
                    </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Note</label>
                <input type="text" name="note" class="form-control" placeholder="Ex. new stock, additional stock, broken stock, good stock, etc" :value="data.note" required="">
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="text" name="qty" class="form-control" placeholder="Quantity" :value="data.qty" required="">
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
var actionUrl = '{{ url('stocks') }}';
var apiUrl ='{{ url('api/stocks') }}';

var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable:false},
    {data: 'date_entry', class: 'text-center', orderable: true},
    {data: 'products.name', class: 'text-center', orderable: false},
    {data: 'suppliers.name', class: 'text-center', orderable: false},
    {data: 'note', class: 'text-center', orderable: false},
    {data: 'qty', class: 'text-center', orderable: false},
    {render: function (index,row, data, meta){
      return `
        <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
      `;
    }, orderable: false, width: '200px', class:'text-center'},
  ];
</script>
<script src="{{ asset('js/data.js') }} "></script>
@endsection