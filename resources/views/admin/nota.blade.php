<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    p{
        font-size: 14px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:60px;        
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0"><u>Invoice</u> </h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">#{{ $sale->id }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Cashier - <span class="gray-color"> {{ $sale->users->name }} </span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color"> {{ $sale->created_at }} </span></p>
        <p class="m-0 pt-5 text-bold w-100">Member - <span class="gray-color">
            @if ($sale->members != Null)
                {{ $sale->members->name }}
            @else
                -    
            @endif
        </span></p>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr align="center">
            <td>
                @if ($sale->status !=0)
                    Cash
                @else
                    Credit Card
                @endif
            </td>
            <td>Free Shipping</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-20">Code Product</th>
            <th class="w-50">Name Product</th>
            <th class="w-20">Price</th>
            <th class="w-20">Qty</th>
            <th class="w-20">Total</th>
        </tr>
        @foreach ($sale->sale_details as $detail)
        <tr align="center">
            <td>{{ $detail->products->code }}</td>
            <td>{{ $detail->products->name }}</td>
            <td> @currency($detail->products->price)</td>
            <td>{{ $detail->qty }}</td>
            <td> @currency($detail->products->price * $detail->qty)</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5">
                <div class="total-part">
                    <div class="total-left w-25 float-left" align="left">
                        <p>Member Discount</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-25 float-right text-bold" align="right">
                        <p>
                            @if ($sale->members != Null)
                                - 10 %
                            @else
                                0,-    
                            @endif
                        </p>
                        <p>
                           Rp. @currency($sale->total)
                        </p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
</html>

<script type="text/javascript">
    function numberWithSpaces(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
</script>