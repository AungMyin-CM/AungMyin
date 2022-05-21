@extends("layouts.app")
@section('content')

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background:#fff !important;">
              
                <!-- Content Header (Page header) -->
                <section class="content-header">
                 
                  <div class="container-fluid">
                    
                    <div class="input-group col-md-6 text-center m-auto">
                      <input type="search" id="main_search" class="form-control" placeholder="Type your keywords here">
                      <input type="hidden" id="clinic_code" value="{{ Auth::guard('user')->user()['clinic_id'] }}" >
                      <div class="input-group-append">
                          <a class="btn btn-default" href="#" id="addRoute"><i id="search" class="fa fa-search"></i></a>
                      </div>
                    </div>
                    <div class="col-md-6 text-center m-auto" id="patientList" style="display:none;cursor:pointer">
                    </div>
                    
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
                <form action="{{ route('pos.store') }}" method="POST">
                
                  @if($patient_data != null)
                  <input type="hidden" name="patient_id" class="form-control" id="patient_id" value={{ $patient_data['id'] }}>
                  <input type="hidden" name="visit_id" class="form-control"  value={{ $visit_data['id'] }}>
                  <input type="hidden" id="fees" class="form-control" value={{ $visit_data['fees'] }}>
                  <input type="hidden" id="customer_name" name = "customer_name" class="form-control" value={{ $patient_data['name'] }}>
                  @else
                  <input type="hidden" name="patient_id" class="form-control" id="patient_id">
                  <input type="hidden" id="fees" class="form-control" value=0>
                  <input type="hidden" id="customer_name" name="customer_name" class="form-control">
                  @endif
                  <input type="hidden" name="invoice_code" class="form-control"  value={{ $invoice_code }}>
                  @csrf
                  <section class="content">
                    
                    <div class="container-fluid">
                      <a href="{{route('pos.history')}}" class="btn btn-primary m-1 float-right" ><i id="search" class="fa fa-history"></i> History</a> 
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
                              <label for="net_amount" class="col-sm-5 control-label">Med Amount</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="med_amount" name="total_med_price" readonly autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control" id="net_amount" name="total_price" readonly autocomplete="off">
                              </div>
                            </div>
                            <div class="form-group">
                             <label for="payment_status" class="col-sm-5 control-label">Paid Status</label>
                             <div class="col-sm-7">
                              <select type="text" class="form-control" id="payment_status" name="payment_status" required>
                                <option value="1" selected>Paid</option>
                                <option value="2">Partial Paid</option>
                                <option value="3">FOC</option>
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

                      $('#main_search').keyup(function(){ 
                          var query = $(this).val();
                          
                          var clinic_id = $("#clinic_code").val();

                          $.ajax({
                              type: "POST",
                              url: '/searchMedPatient',
                              data: { key: query, clinic_id: clinic_id}
                          }).done(function( response ) {
                            
                          if(query != '')
                          {
                              if(response == ''){
                                  $("#search").removeAttr("class","fa fa-search");
                                  $("#search").attr("class","fa fa-plus");
                                  $("#addRoute").attr("href", "{{ route('patient.create') }}"+"?name="+query);

                              }else{
                                  $("#search").removeAttr("class","fa fa-plus");
                                  $("#search").attr("class","fa fa-search");
                                  $("#addRoute").attr("href", "{{ route('patient.index') }}"+"?name="+query);
                              }

                              $('#patientList').css("display","block");  
                              $('#patientList').html(response);
                          }
                          else{
                              $('#patientList').css("display","none");  
                              $('#patientList').html("");
                          }
                        });
                      });

                      function getPatientData(id)
                      {
                         var name = document.getElementById("name_"+id).getAttribute('data-name')
                         var age = document.getElementById("age_"+id).getAttribute('data-age')
                         var f_name = document.getElementById("father_name_"+id).getAttribute('data-f_name')
                         var gender = $('#gender_'+id).text();
                         var phoneNumber = $('#phoneNumber_'+id).text();
                         var address = $('#address_'+id).text();
                         var allergy = $('#allergy_'+id).text();

                         document.getElementById("p_detail").classList.remove('d-none');

                         $("#p_name").text(name);
                         $("#customer_name").val(name);
                         $("#p_age").text(age);
                         $("#p_f_name").text(f_name);
                         $("#p_gender").text(gender);
                         $("#p_phoneNumber").text(phoneNumber);
                         $("#p_address").text(address);
                         $("#p_allergy").text(allergy);
                         $("#patient_id").val(id);
                         $('#patientList').css("display","none");  



                      }


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

                          // total amount
                          var totalAmount = totalSubAmount;
                          // $("#net_amount").val(totalAmount);
                          // $("#totalAmountValue").val(totalAmount);
                          var fees = Number($('#fees').val());
                          var discount = $("#discount").val();
                          if(discount) {
                            var grandTotal = Number(totalAmount) - (Number(totalAmount)/100)*discount;
                           
                            $("#med_amount").val(grandTotal);
                            $("#net_amount").val(Number(grandTotal)+fees);
                          } else {
                            $("#med_amount").val(totalAmount);
                            $("#net_amount").val(Number(totalAmount)+fees);
                            
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