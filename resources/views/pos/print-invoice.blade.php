<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Invoice</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");

    body {
      font-family: "Roboto", sans-serif;
    }

    .logo-img {
      width: 50px;
    }

    @media print {
      .btn-primary {
        display: none;
      }
    }
  </style>
</head>

<body class="bg-light">
  <div class="container bg-white rounded mt-4 p-5">
    <div class="invoice">
      <div class="invoice-header">
        <div class="row d-flex align-items-center">
          <div class="col">
            <p class=""><b>Invoice No:</b> {{$pos->invoice_code}}</p>
          </div>
          <div class="col text-end">
            <img class="img-fluid logo-img" src="{{ asset('images/web-photos/aung-myin.png') }}" alt="Logo" />
          </div>
        </div>
        <div class="text-muted">
          <hr />
        </div>
        <div class="row">
          <div class="col">
            <b>Date Of Service:</b><br />
            <span class="text-muted small">{{ $pos->created_at->format("F j, Y") }}</span>
          </div>
          <div class="col text-end">
            <b>{{ $patient_data->clinic->name }}</b><br />
            <span class="text-muted small">{{ $patient_data->clinic->address }}</span><br />
            <span class="text-muted small">aungmyin.cm@gmail.com</span><br />
            <span class="text-muted small"> {{ $patient_data->clinic->phoneNumber }} </span>
          </div>
        </div>
      </div>
      <div class="text-muted">
        <hr />
      </div>
      <div class="invoice-body">
        <h5 class="fw-semibold">Patient Information</h5>
        <div class="text-muted">
          <hr />
        </div>
        <div class="row mb-3">
          <div class="col">
            <b>Patient Name:</b><br />
            <span class="text-muted small">{{ $patient_data->name }}</span>
          </div>
          <div class="col">
            <b>Phone Number:</b><br />
            <span class="text-muted small">{{ $patient_data->phoneNumber }}</span>
          </div>
          <div class="col">
            <b>Address:</b><br />
            <span class="text-muted small">{{ $patient_data->address }}</span>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col">
            <b>Age:</b><br />
            <span class="text-muted small">{{ $patient_data->age }}</span>
          </div>          
          <div class="col">            
            <b>Followup Date:</b><br />
            <span class="text-muted small"></span>
          </div>
          <div class="col"></div>
        </div>

        <div class="mb-4">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th scope="col" class="bg-gray">
                  Description
                </th>
                <th scope="col" class="bg-gray">
                  Quantity
                </th>
                <th scope="col" class="bg-gray">Price</th>
                <th scope="col" class="bg-gray">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pos_detail as $pd)
              <tr>
                <td class="text-muted small">{{ $pd->med_name }}</td>
                <td class="text-muted small">{{ $pd->quantity }}</td>
                <td class="text-muted small">{{ number_format($pd->sell_price) }}</td>
                <td class="text-muted small">{{ number_format($pd->total_price) }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td class="small">Total</td>
                <td class="small">{{ number_format($pos->total_price) }}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="small">Fees</td>
                <td class="small">{{ isset($visit_data['fees']) ? number_format($visit_data['fees']) : 0 }}</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="small">Subtotal</td>
                <td class="small">{{ $visit_data != null ? (number_format($visit_data['fees'] + $pos->total_price)) : number_format($pos->total_price) }}</td>
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="d-flex align-items-center gap-3">
          <i class="fa-regular fa-file-lines fs-2 text-muted"></i>
          <div>
            <b>Note:</b><br />
            <span class="text-muted small">Here you can write additional notes for the client to get a better understanding of this invoice.</span>
          </div>
        </div>
      </div>
    </div>

    <div class="invoice-print mt-5 text-center">
      <button class="btn btn-primary" onclick="printInvoice()">
        <i class="fas fa-print"></i> Print
      </button>
      <a class="btn btn-primary" href="{{route("pos.index")}}">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>
  </div>
</body>
<script>
  function printInvoice() {
    window.print();
  }
</script>

</html>