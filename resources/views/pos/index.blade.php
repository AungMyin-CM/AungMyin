@extends("layouts.app")
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background:#fff !important;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>POS</h1>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">POS</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <form action="{{ route('pos.store') }}" method="POST">
                  <input type="hidden" name="invoice_code" class="form-control"  value={{ $invoice_code }}>
                  @csrf
                  <section class="content">
                    
                    <div class="container-fluid">
                      <span style="font-size: 100% !important;margin:5px 0px 5px 0px;" class="badge badge-secondary">Code - {{ $invoice_code }}</span>
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
                               
                               <tr id="row_1">
                                 <td>
                                      <input type="text" name="med_name[]" id="product_search_1" onkeyup="searchMed('1')" class="form-control" placeholder="Type your keywords here" required>
                                      <input type = "hidden" name = "med_id[]" id = "med_id_1">
                                      <div id="medList_1" style="display:none;position:absolute;width:22.5%;">
                                       
                                      </div>
                                    <span id="product_status1" class="label label-danger"></span> 
                                </td>
                                  <td>
                                    <input type="text" name="expire_date[]" id="expire_date_1" readonly class="form-control"></td>
                                  <td>
                                    <input type="text" name="remain_qty[]" id="remain_qty_1" readonly class="form-control"></td>
                                  <td>
                                    <input type="text" name="quantity[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                                  <td>
                                    <input type="text" name="sell_price[]" id="sell_price_1" class="form-control" readonly>
                                    <input type="hidden" name="act_price[]" id="act_price_1" class="form-control">
                                    <input type="hidden" name="unit[]" id="unit_1" class="form-control">
                                    <input type="hidden" name="margin[]" id="margin_1" class="form-control" >

                                  </td>
                                  <td>
                                    <input type="discount" name="discount[]" id="discount_1" class="form-control" onkeyup="getTotal(1)">  
                                  </td>
                                  <td>
                                    <input type="text" name="amount[]" id="amount_1" class="form-control" readonly style="width: 90px;">
                                    <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                                  </td>
                               </tr>
                             </tbody>
                          </table>
                          <div class="col-md-4 col-xs-12 float-right">
                            <div class="form-group">
                              <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="net_amount" name="total_price" readonly autocomplete="off">
                                <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                             <label for="payment_status" class="col-sm-5 control-label">Paid Status</label>
                             <div class="col-sm-7">
                              <select type="text" class="form-control" id="payment_status" name="payment_status" required>
                                <option value="1" selected>Paid</option>
                                <option value="0">Unpaid</option>
                              </select>
                              </div>
                           </div>
                            <input type="submit" value="submit" class="btn btn-primary">
                      </div>    
                  </section>
                </form>
        
            </div>
        </div>
    </body>

                  <script src="{{ asset('js/pos.js') }}"></script>
                    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


                    <script>

                      $(document).ready(function() {

                        $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                          });
                        
                      });

                      function searchMed(rowid) {

                          var query = $("#product_search_"+rowid).val();
                  
                          var clinic_id = {{ Auth::guard('user')->user()['clinic_id'] }}

                          $.ajax({
                              type: "POST",
                              url: '/searchMed',
                              data: { key: query, clinic_id: clinic_id, rowid: rowid}
                          }).done(function( response ) {
                            
                          if(query != '')
                          {
                              $('#medList_'+rowid).css("display","block");  
                              $('#medList_'+rowid).html(response);
                          }
                          else{
                              $('#medList_'+rowid).css("display","none");  
                              $('#medList_'+rowid).html("");
                          }
                          });
                      };

                      function s_option(rowid)
                      {
                       var med_id = rowid.getAttribute("data-id");
                       var row_id = rowid.getAttribute("row-id");

                        $.ajax({
                            type: "POST",
                            url: '/medData',
                            data: { med_id: med_id}
                        }).done(function( response ) {

                            data = $.parseJSON(response)
                            $("#product_search_"+row_id).val(data[0].name)
                            $("#med_id_"+row_id).val(data[0].id)
                            $("#expire_date_"+row_id).val(data[0].expire_date)
                            $("#remain_qty_"+row_id).val(data[0].quantity)
                            $("#sell_price_"+row_id).val(data[0].sell_price)
                            $("#act_price_"+row_id).val(data[0].act_price)
                            $("#margin_"+row_id).val(data[0].margin)
                            $("#unit_"+row_id).val(data[0].unit)


                            $('#medList_'+row_id).css("display","none");  
                            $('#medList_'+row_id).html("");

                        });
                      }

                      function subAmount() {

                          var tableProductLength = $("#product_info_table tbody tr").length;
                          var totalSubAmount = 0;
                          for(x = 0; x < tableProductLength; x++) {
                            var tr = $("#product_info_table tbody tr")[x];
                            var count = $(tr).attr('id');
                            count = count.substring(4);

                            totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
                          } // /for

                          totalSubAmount = totalSubAmount.toFixed(2);

                          // sub total
                          $("#gross_amount").val(totalSubAmount);
                          $("#gross_amount_value").val(totalSubAmount);

                          // total amount
                          var totalAmount = (Number(totalSubAmount));
                          totalAmount = totalAmount.toFixed(2);
                          // $("#net_amount").val(totalAmount);
                          // $("#totalAmountValue").val(totalAmount);

                          var discount = $("#discount").val();
                          if(discount) {
                            var grandTotal = Number(totalAmount) - (Number(totalAmount)/100)*discount;
                            grandTotal = grandTotal.toFixed(2);
                            $("#net_amount").val(grandTotal);
                            $("#net_amount_value").val(grandTotal);
                          } else {
                            $("#net_amount").val(totalAmount);
                            $("#net_amount_value").val(totalAmount);
                            
                          } // /else discount 

                        } // /sub total amount

                        function getTotal(row = null) {

                            var qty = Number($("#qty_"+row).val());
                            var avaiqty = Number($("#remain_qty_"+row).val());
                            var rate = Number($("#sell_price_"+row).val());

                            if(qty > avaiqty) {
                                  
                              alert("Not available that amount");
                                  
                            }else{

                              // var tax = (Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val())/100) * $("#tax_"+row).val();
                              var total = rate * qty;
                              var discount =  (Number($("#sell_price_"+row).val()) * Number($("#qty_"+row).val())/100) * $("#discount_"+row).val();
                              total = (total)-discount;
                              total = total.toFixed(2);
                              $("#amount_"+row).val(total);
                              $("#amount_value_"+row).val(total);
                              
                              subAmount();

                          }
                        }

                        function removeRow(tr_id)
                        {
                          $("#product_info_table tbody tr#row_"+tr_id).remove();
                          subAmount();
                        }

           
           
           </script>

@endsection