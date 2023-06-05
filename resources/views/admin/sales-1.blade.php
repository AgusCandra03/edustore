@extends('layouts.admin')
@section('header', 'Sales')
@section('cs')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endsection

@section('content')
<div id="controller">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Product</label>
                                <label>Minimal</label>
                                <input type="text" name="name" class="form-control" v-model="name" placeholder="Name Product">
                            </div>
                            <div class="col-1">
                                <label>Quantity</label>
                                <input type="number" name="qty" class="form-control" v-model="qty" placeholder="Qty">
                            </div>
                            <div class="col-lg-2">
                                <label style="color: white">...</label>
                                <button type="button" class="form-control btn btn-primary" @click.prevent="addTable">Add product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                        <tr class="text-center">
                            <th>Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Member Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Payment</label>
                        <div class="col-sm-8">
                            <select name="status" class="form-control">
                                <option value="1">Cash</option>
                                <option value="2">Credit Card</option>
                            </select>
                        </div>
                        {{-- <div class="col-sm-8">
                            <input type="text" class="form-control" required>
                        </div> --}}
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sub Total</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Discount</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <h2>Total : Rp. </h1>
                    </div>
                    <button type="submit" class="btn btn-success">Proccess Payment</button>
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
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script type="text/javascript">
    var actionUrl = '{{ url('sales') }}';
    var apiUrl ='{{ url('api/sales') }}';



    // var columns = [
    //   {data: 'DT_RowIndex', class: 'text-center', orderable:false},
    //   {data: 'name', class: 'text-center', orderable: true},
    //   {render: function (index,row, data, meta){
    //     return `
    //       <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">Delete</a>
    //     `;
    //   }, orderable: false, width: '200px', class:'text-center'},
    // ];

    // var controller = new Vue({
    //         el: '#controller',
    //         data : {
    //             datas: [], //menyimpan semua data
    //             data: {},
    //             code: [],
    //             qty: [],
    //             actionUrl,
    //             apiUrl,
    //             editStatus: false,
    //         },
    //         mounted: function(){
    //             this.datatable();
    //         },
    //         methods: {
    //             datatable(){
    //                 const _this = this;
    //                 _this.table = $('#datatable').DataTable({
    //                     ajax:{
    //                         // url: _this.apiUrl,
    //                         url: apiUrl,
    //                         type: 'GET',
    //                     },
    //                     columns
    //                 }).on('xhr', function(){
    //                     _this.datas = _this.table.ajax.json().data;
    //                 });
    //             },
    //         }
    //     });
</script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>

@endsection
