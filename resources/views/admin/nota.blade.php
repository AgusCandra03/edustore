<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nota</h3>
        </div>
        <div class="card-body">
            <table border="1">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->sale_details as $detail)
                    <tr>
                        <td>{{ $detail->products->name }}</td>
                        <td>{{ $detail->products->price }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ $detail->products->price * $detail->qty }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Grand Total</th>
                        <th>{{ $sale->total }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>
