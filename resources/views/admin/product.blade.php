@extends('layouts.admin')
@section('header', 'Product')
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
          <a href="#" @click="addData()" class="btn btn-primary btn-sm">Add Data</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th style="width: 10px">No.</th>
                <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>price</th>
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
              <h4 class="modal-title">Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
  
            <div class="modal-body">
              @csrf
  
              <input type="hidden" name="_method" value="PUT" v-if="editStatus">

              <div class="form-group">
                <label>Code</label>
                <input type="text" name="code" class="form-control" placeholder="Code" :value="data.code" required="">
              </div>

              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Full Name" :value="data.name" required="">
              </div>

              <div class="form-group">
                  <label class="col-md-3">Category</label>
                  <select name="category_id" class="form-control" required="">
                      @foreach($categories as $category)
                      <option :selected="data.category_id == {{ $category->id }}" value="{{ $category->id }} ">
                          {{ $category->name }}
                      </option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Description" :value="data.description" required="">
              </div>
              
              <div class="form-group">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" placeholder="stock" :value="data.stock" required="">
              </div>

              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" placeholder="Rp. " :value="data.price" required="">
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

  <div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4">Code Product</label>
            <label class="col-md-1">:</label>
            <label class="col-md-6" style="font-weight: normal" name="code" id="code"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Name Product</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" style="font-weight: normal" name="name" id="name"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Category</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" style="font-weight: normal" name="categories.name" id="category_id"></label>
        </div>
        <div class="form-group">
            <label class="col-md-4">Description</label>
            <label class="col-md-1">:</label>
            <label class="col-md-6" style="font-weight: normal" name="description" id="description"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Stock</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" style="font-weight: normal" name="stock" id="stock"></label>
        </div>
        <div class="form-group">
          <label class="col-md-4">Price</label>
          <label class="col-md-1">:</label>
          <label class="col-md-6" style="font-weight: normal" name="price" id="price"></label>
        </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
  var actionUrl = '{{ url('products') }}';
  var apiUrl ='{{ url('api/products') }}';
  
  var columns = [
    {data: 'DT_RowIndex', class: 'text-center', orderable:false},
    {data: 'code', class: 'text-center', orderable: true},
    {data: 'name', class: 'text-center', orderable: true},
    {data: 'categories.name', class: 'text-center', orderable: false},
    {data: 'stock', class: 'text-center', orderable: false},
    {data: 'price', class: 'text-center', orderable: false},
    {render: function (index,row, data, meta){
      return `
        <a href="#" class="btn btn-success btn-sm" onclick="controller.editData(event, ${meta.row})">Edit</a>
        <a href="#" class="btn btn-primary btn-sm" onclick="controller.detailData(event, ${meta.row})">Detail</a>
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
    addData(){
      this.data = {},
      this.editStatus = false;
      $('#modal-default').modal();
    },
    editData(event, row){
      this.data = this.datas[row];
      this.editStatus = true;
      $('#modal-default').modal();
    },
    detailData(event, row){
        this.data = this.datas[row];

        var str = this.data.code;
        $('#code').html(str);

        var str1 = this.data.name;
        $('#name').html(str1);

        var str3 = this.data.description;
        $('#description').html(str3);

        var str4 = this.data.stock;
        $('#stock').html(str4);

        var str5 = this.data.price;
        $('#price').html(str5);

        var str6 = this.data.categories.name;
        $('#category_id').html(str6);

        $('#modal-detail').modal();
    },
    deleteData(event, id){
      if(confirm("Are You Sure ?")){
        $(event.target).parents('tr').remove()
        axios.post(this.actionUrl+'/'+id, {_method: 'DELETE'}).then(response => {
          alert('Data has been removed');
        });
      }
    },
    submitForm(event,id){
        event.preventDefault();
        const _this = this;
        var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
        axios.post(actionUrl, new FormData($(event.target)[0])).then(response=> {
            $('#modal-default').modal('hide');
            _this.table.ajax.reload();
        });
    },
  }
});
</script>
{{-- <script src="{{ asset('js/data.js') }} "></script> --}}
@endsection