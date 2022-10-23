<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
        <style>
            *
            {
                border: 0;
                box-sizing: content-box;
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                line-height: inherit;
                list-style: none;
                margin: 0;
                padding: 0;
                text-decoration: none;
                vertical-align: top;
            }

            /* content editable */

            *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

            *[contenteditable] { cursor: pointer; }

            *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

            span[contenteditable] { display: inline-block; }

            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            /* page */

            html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
            html { background: #999; cursor: default; }

            body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span, header img { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 100%; max-width: 100%; }
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 36%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            /* javascript */

            .add, .cut
            {
                border-width: 1px;
                display: block;
                font-size: .8rem;
                padding: 0.25em 0.5em;	
                float: left;
                text-align: center;
                width: 0.6em;
            }

            .add, .cut
            {
                background: #9AF;
                box-shadow: 0 1px 2px rgba(0,0,0,0.2);
                background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
                background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
                border-radius: 0.5em;
                border-color: #0076A3;
                color: #FFF;
                cursor: pointer;
                font-weight: bold;
                text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
            }

            .add { margin: -2.5em 0 0; }

            .add:hover { background: #00ADEE; }

            .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
            .cut { -webkit-transition: opacity 100ms ease-in; }

            tr:hover .cut { opacity: 1; }

            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                span:empty { display: none; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; }
        </style>
	</head>
    
	<body>

        @if($patient_data != null)

          {{-- <h1>Invoice</h1>
          <address contenteditable>
            <p>{{ $patient_data['name'] }}</p>
            <p>{{ $patient_data['address'] }}</p>
            <p>{{ $patient_data['phoneNumber'] }}</p>
          </address>
          <span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span> --}}
          <section class="content-header">
                 
            <div class="container-fluid">
          <div class="card card-primary {{$patient_data != null ? "d-block" : "d-none"}} mt-2" id="p_detail">
            <div class="card-body" style="padding: 0.9rem !important;" > 
                <div class="row mb-2">
                    <div class="col-sm-2">
                        <h6><b>Name :</b> <span id="p_name">{{$patient_data != null ? $patient_data['name']  : ""}}</span> </h6>
                    </div>
                    <div class="col-sm-2">
                        <h6><b>Age :</b> <span id="p_age">{{$patient_data != null ? $patient_data['age'] : ""}}</span> </h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><b>Father's Name :</b><span id="p_f_name"> {{ $patient_data != null ?$patient_data['father_name'] :"" }}</span> </h6>
                    </div>
                    <div class="col-sm-2">
                        <h6><b>Gender :</b> <span id="p_gender">{{$patient_data != null ? $patient_data['gender'] == 1 ? 'Male' : 'Female' : ""}}</span> </h6>
                    </div>
                    <div class="col-sm-3">
                        <h6><b>Phone-Number :</b> <span id="p_phoneNumber">{{$patient_data != null ? $patient_data['phoneNumber'] : ""}}</span> </h6>
                    </div>
                    
                </div>
                <div class="row mb-2">
                   
                    <div class="col-sm-12">
                        <h6><b>Address :</b><span id="p_address"> {{ $patient_data != null ? $patient_data['address'] :"" }}</span> </h6>
                    </div>
                    
                   
                </div>
                <div class="row mb-2">
                   
                    <div class="col-sm-10" >
                        <h6><b>Allergy :</b><span id="p_allergy"> {{ $patient_data != null ?  $patient_data['drug_allergy'] : ""}}</span> </h6>
                    </div>

                    <div class="col-sm-2" {{ $patient_data != null ?"" :'hidden'}}>
                      <h6><b>Fees :</b>{{ $visit_data != null ? $visit_data['fees'] : ""}} </h6>
                  </div>
                                   
                </div>

            </div>

        </div>
      </div>
    </section>
                    <input type="hidden" name="patient_id" class="form-control" id="patient_id" value={{ $patient_data['id'] }}>
                    <input type="hidden" id="fees" class="form-control" value={{  $visit_data != null ? $visit_data['fees'] : "" }}>
                    <input type="hidden" id="customer_name" name = "customer_name" class="form-control" value={{ $patient_data['name'] }}>
                  @else
                    <input type="hidden" id="fees" class="form-control" value="0">
                  @endif
                    <input type="hidden" name="invoice_code" class="form-control"  value={{ $pos->invoice_code }}>
                    <input type="hidden" name="id" class="form-control"  value={{ $pos->id }}>
                    <input type = "hidden" name = "trash_ids" id = "trash" >
                  <section class="content">
                    
                    <div class="container-fluid">
                      <span style="font-size: 100% !important;margin:5px 0px 5px 0px;" class="badge badge-secondary">Code - {{ $pos->invoice_code }}</span>
                        <table class="table table-bordered" id="product_info_table">
                            <thead>
                              <tr>
                                <th style="width:30%">Name</th>
                                <th style="width:20%">Expire Date</th>
                                <th style="width:10%">A.Qty</th>
                                <th style="width:10%">Qty</th>
                                <th style="width:10%">Sell Price</th>
                                <th style="width:10%">Discount</th>
                                <th style="width:10%">Amount</th>
                                <th ><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                              </tr>
                            </thead>
          
                             <tbody>
                               @foreach ($pos_detail as $pd)
                                 
                               <tr id="row_{{$pd->id}}">
                                 <td>
                                    <input type="text" name="med_name[]" id="product_search_{{$pd->id}}" value="{{$pd->med_name}}" readonly class="form-control">
                                    <input type = "hidden" name = "med_id[]" id = "med_id_{{$pd->id}}" value="{{$pd->med_id}}">
                                    <input type = "hidden" name = "pos_detail_id[]" id = "pos_detail_id_{{$pd->id}}" value="{{$pd->id}}">
                                 </td>
                                  <td>
                                    <input type="text" name="expire_date[]" id="expire_date_{{$pd->id}}" value="{{$pd->expire_date}}" readonly class="form-control"></td>
                                  <td>
                                    <input type="text" name="remain_qty[]" id="remain_qty_{{$pd->id}}" value="{{$pd->pharmacy->quantity}}" readonly class="form-control"></td>
                                  <td>
                                    <input type="text" name="quantity[]" id="qty_{{$pd->id}}" class="form-control" required value="{{$pd->quantity}}" readonly></td>
                                  <td>
                                    <input type="text" name="sell_price[]" id="sell_price_{{$pd->id}}" class="form-control" value="{{$pd->sell_price}}" readonly>
                                    <input type="hidden" name="act_price[]" id="act_price_{{$pd->id}}" class="form-control" value="{{$pd->act_price}}">
                                    <input type="hidden" name="unit[]" id="unit_{{$pd->id}}" class="form-control" value="{{$pd->unit}}">
                                    <input type="hidden" name="margin[]" id="margin_{{$pd->id}}" class="form-control" value="{{$pd->margin}}">
                                  </td>
                                  <td>
                                    <input type="discount" name="discount[]" id="discount_{{$pd->id}}" class="form-control" value="{{$pd->discount}}" readonly>  
                                  </td>
                                  <td>
                                    <input type="text" name="amount[]" id="amount_{{$pd->id}}" class="form-control" readonly style="width: 90px;" value="{{$pd->total_price}}">
                                  </td>
                                  <td><button type="button" class="btn btn-default" onclick="deletedRow({{$pd->id}})"><i class="fa fa-trash"></i></button></td>
                               </tr>
                               @endforeach

                             </tbody>
                          </table>
                          <div class="col-md-4 col-xs-12 float-right">
                            <div class="form-group">
                              <label for="net_amount" class="col-sm-5 control-label">Med Amount</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="med_amount" name="total_med_price" value="{{$pos->total_price}}" readonly autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="net_amount" name="total_price" value="{{ $visit_data != null ? ($visit_data['fees'] + $pos->total_price) : $pos->total_price}}" readonly autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                             <label for="payment_status" class="col-sm-5 control-label">Paid Status</label>
                             <div class="col-sm-7">
                              <select type="text" class="form-control" id="payment_status" name="payment_status" required>
                                @foreach ($payment_types as $key => $value )
                                  <option value="{{$key}}" {{ $pos->payment_status == $key ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                              </select>
                              </div>
                           </div>
                            <input type="submit" value="submit" class="btn btn-primary">
                      </div>    
                  </section>
		{{-- <article>
			<h1>Recipient</h1>
			<address contenteditable>
				<p>Some Company<br>c/o Some Guy</p>
			</address> --}}
			{{-- <table class="meta">
				<tr>
					<th><span contenteditable>Invoice #</span></th>
					<td><span contenteditable>101138</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Date</span></th>
					<td><span contenteditable>January 1, 2012</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Amount Due</span></th>
					<td><span id="prefix" contenteditable>$</span><span>600.00</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Item</span></th>
						<th><span contenteditable>Description</span></th>
						<th><span contenteditable>Rate</span></th>
						<th><span contenteditable>Quantity</span></th>
						<th><span contenteditable>Price</span></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><a class="cut">-</a><span contenteditable>Front End Consultation</span></td>
						<td><span contenteditable>Experience Review</span></td>
						<td><span data-prefix>$</span><span contenteditable>150.00</span></td>
						<td><span contenteditable>4</span></td>
						<td><span data-prefix>$</span><span>600.00</span></td>
					</tr>
				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
				<tr>
					<th><span contenteditable>Total</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Amount Paid</span></th>
					<td><span data-prefix>$</span><span contenteditable>0.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Balance Due</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
			</table> --}}
		{{-- </article> --}}
		{{-- <aside>
			<h1><span contenteditable>Additional Notes</span></h1>
			<div contenteditable>
				<p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
			</div>
		</aside> --}}
	</body>
</html>