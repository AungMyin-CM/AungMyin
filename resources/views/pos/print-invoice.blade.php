
<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    
    <meta charset="UTF-8">
    <title>Invoice Template</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th {
        text-align: left;
        border-bottom: 1px solid #ccc;
        padding: 10px;
      }
      td {
        border-bottom: 1px solid #ccc;
        padding: 10px;
      }
      .text-right {
        text-align: right;
      }
      .text-center {
        text-align: center;
      }
      .logo {
        max-width: 150px;
        margin-bottom: 20px;
      }
      .invoice-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
      }
      .invoice-details {
        margin-bottom: 20px;
      }
      .invoice-details th {
        width: 30%;
      }
      .invoice-summary {
        margin-top: 20px;
        font-weight: bold;
      }

      body {
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
      }
      @media print
      {
        .btn-primary
        {
          display: none;
        }
      }
    </style>
  </head>
  <body>
    <img src="{{ asset('images/web-photos/aung-myin.png') }}" class="logo"  >
      <div class="text-right">
        <button class="btn btn-primary m-3" onclick="printInvoice()"><i class="fas fa-print"></i> Print</button>
        <a class="btn btn-primary m-3" href="{{route("pos.index")}}"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
    <h1 class="invoice-title">Invoice</h1>
    <table class="invoice-details">
      <tr>
        <th>Invoice Number:</th>
        <td>{{$pos->invoice_code}}</td>
      </tr>
      <tr>
        <th>Date:</th>
        <td>{{ \Carbon\Carbon::parse($pos->created_at)->format('d/m/Y')}}
        </td>
      </tr>
     
    </table>
    <table>
      <thead>
        <tr>
          <th>Description</th>
          <th class="text-right">Quantity</th>
          <th class="text-right">Price</th>
          <th class="text-right">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pos_detail as $pd)
          <tr>
            <td>{{$pd->med_name}}</td>
            <td class="text-right">{{$pd->quantity}}</td>
            <td class="text-right">{{number_format($pd->sell_price)}}</td>
            <td class="text-right">{{number_format($pd->total_price)}}</td>
          </tr>
       
        @endforeach
        
      </tbody>
    </table>
    <table class="invoice-summary">
      <tr>
        <th>Total Amount ( Medicines ):</th>
        <td class="text-right">{{number_format($pos->total_price)}}</td>
      </tr>
      <tr>
        <th>Fees:</th>
        <td class="text-right">{{isset($visit_data['fees']) ? number_format($visit_data['fees']) : 0}}</td>
      </tr>
      <tr>
        <th>Total:</th>
        <td class="text-right">{{ $visit_data != null ? (number_format($visit_data['fees'] + $pos->total_price)) : number_format($pos->total_price)}}</td>
      </tr>
    </table>
  </body>
  <script>
    function printInvoice()
    {
      window.print();
    }
  </script>
</html>
