@extends("layouts.app")
@section('content')
<style>
  #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content,
    .carousel-inner img {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    .carousel-inner img,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
    }

    .pagination .active {
        z-index: 0;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {

        .modal-content,
        .carousel-inner img {
            width: 100%;
        }
    }

    /* Scrollbar */
    /* Adjust the width of the scrollbar */
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Set the background color */
    ::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    /* Thumb styles */
    ::-webkit-scrollbar-thumb {
        background-color: #a9a9a9;
    }

    /* Hover styles */
    ::-webkit-scrollbar-thumb:hover {
        background-color: #858383;
    }

    .tooltip-card {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.8s;
        position: fixed;
        padding-top: 90px;
        margin-left: 12px;
    }

    .tooltip-card .tooltip-content {
        position: relative;
        width: 200px;
        background-color: #003049;
        color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .tooltip-content .arrow {
        position: absolute;
        top: 50%;
        left: -10px;
        margin-top: -10px;
        width: 0;
        height: 0;
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-right: 10px solid #003049;
    }

    .quantity {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .quantity__minus,
    .quantity__plus {
        display: block;
        width: 22px;
        height: 23px;
        margin: 0;
        background: #003049;
        text-decoration: none;
        text-align: center;
        line-height: 23px;
    }

    .quantity__minus:hover,
    .quantity__plus:hover {
        background: #575b71;
        color: #fff;
    }

    .quantity__minus {
        border-radius: 3px 0 0 3px;
    }

    .quantity__plus {
        border-radius: 0 3px 3px 0;
    }

    .quantity__input {
        width: 32px;
        height: 19px;
        margin: 0;
        padding: 0;
        text-align: center;
        border-top: 2px solid #dee0ee;
        border-bottom: 2px solid #dee0ee;
        border-left: 1px solid #dee0ee;
        border-right: 2px solid #dee0ee;
        background: #fff;
        color: #8184a1;
    }

    .quantity__minus:link,
    .quantity__plus:link {
        color: #8184a1;
    }

    .quantity__minus:visited,
    .quantity__plus:visited {
        color: #fff;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">

      <!-- Content Header (Page header) -->
      <section class="content-header">

        <div class="container-fluid">
          <div class="input-group col-md-6 text-center m-auto">
            <input type="search" id="main_search" class="form-control" placeholder="Search Patients.." autocomplete="off">
            <input type="hidden" id="clinic_code" value="{{ session()->get('cc_id') }}">
            <div class="input-group-append" id="search-indicator">
              <a class="btn btn-default" href="#" id="addRoute"><i id="search" class="fa fa-search"></i></a>
            </div>

            <div class="input-group-append">
                <a class="btn btn-default" id="loading-indicator" style="display:none;"><i class="fas fa-spinner fa-spin"></i></a>
            </div>

            <div class="text-center m-auto" id="patientList" style="display:none;cursor:pointer;position: absolute;z-index:99;top:40px;width:98%;">
            </div>

          </div>

          @if($patient != null)

          {{-- <div class="card card-primary {{$patient_data != null ? "d-block" : "d-none"}} mt-2" id="p_detail">
            <div class="card-body" style="padding: 0.9rem !important;">
              <div class="card-body" style="padding: 0.9rem !important;">
                 <div class="card-body" style="padding: 0.9rem !important;">
                  <div class="row mb-2">
                    <div class="col-sm-2">
                      <h6><b>Name :</b> <span id="p_name">{{$patient_data['name'] != null ? $patient_data['name']  : ""}}</span> </h6>
                    </div>
                    <div class="col-sm-2">
                      <h6><b>Age :</b> <span id="p_age">{{$patient_data['age'] != null ? $patient_data['age'] : ""}}</span> </h6>
                    </div>
                    <div class="col-sm-3">
                      <h6><b>Father's Name :</b><span id="p_f_name"> {{ $patient_data['father_name'] != null ?$patient_data['father_name'] :"" }}</span> </h6>
                    </div>
                    <div class="col-sm-2">
                      <h6><b>Gender :</b> <span id="p_gender">{{$patient_data['gender'] != null ? $patient_data['gender'] == 1 ? 'Male' : 'Female' : ""}}</span> </h6>
                    </div>
                    <div class="col-sm-3">
                      <h6><b>Phone-Number :</b> <span id="p_phoneNumber">{{$patient_data['phoneNumber'] != null ? $patient_data['phoneNumber'] : ""}}</span> </h6>
                    </div>

                  </div>
                  <div class="row mb-2">

                    <div class="col-sm-12">
                      <h6><b>Address :</b><span id="p_address"> {{ $patient_data['address'] != null ? $patient_data['address'] :"" }}</span> </h6>
                    </div>


                  </div>
                  <div class="row mb-2">

                    <div class="col-sm-10">
                      <h6><b>Allergy :</b><span id="p_allergy"> {{ $patient_data['drug_allergy'] != null ?  $patient_data['drug_allergy'] : ""}}</span> </h6>
                    </div>

                    <div class="col-sm-2" {{ $patient_data != null ?"" :'hidden'}}>
                      <h6><b>Fees :</b>{{ isset($visit_data['fees'])  ? $visit_data['fees'] : " 0"}} </h6>
                    </div>

                  </div>

                </div> --}}

              {{-- </div> --}}
                    <div class="card card-primary {{$patient != null ? "d-block" : "d-none"}} mt-2" id="p_detail">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-sm-2 mb-2">
                                  <span id="name">{{ $patient->name }}</span>
                                  <span id="gender" class="text-danger" style="font-weight: bold;">{{ $patient->gender == 1 ? 'M' : 'F' }}</span>
                                  <span id="age">{{ $patient->age}} years</span>
                              </div>
                              <div class="col-sm-4">
                                  <h6 id="drug_allergy"><b>Drug Allergy :</b> {{ $patient->drug_allergy ? $patient->drug_allergy : 'None'  }} </h6>
                              </div>
                              @if(isset($patient->disease[0]))
                                  <div class="col-sm-4">
                                      <h6 id="p_di"><b>Disease :</b> <span id="p_disease">{{ $patient->disease[0]->disease }}</span></h6>
                                  </div>
                              @else
                                <div class="col-sm-4">
                                    <h6 id="p_di"><b>Father Name :</b> <span id="p_disease">{{ $patient->father_name }}</span></h6>
                                </div>
                                  
                              @endif
                              {{-- <div class="col-sm-2">
                                  <nav aria-label="breadcrumb" class="float-right">
                                      <ol class="breadcrumb">
                                          <li class="breadcrumb-item">
                                              <button id="viewBtn" style="display: contents;">View</button>

                                              @include('partials._view-modal')
                                          </li>
                                          <li class="breadcrumb-item active" aria-current="page">
                                              @if(Helper::checkPermission('p_update', $permissions))
                                              <button id="editBtn" style="display: contents;">Edit</button>

                                              @include('partials._edit-modal')
                                              @endif
                                          </li>
                                      </ol>
                                  </nav>
                              </div> --}}
                          </div>
                      </div>
                    </div>
              @else
                      {{-- <div class="row mb-2">
                        <div class="col-sm-2">
                          <h6><b>Name :</b> <span id="p_name"></span> </h6>
                        </div>
                        <div class="col-sm-2">
                          <h6><b>Age :</b> <span id="p_age"></span> </h6>
                        </div>
                        <div class="col-sm-3">
                          <h6><b>Father's Name :</b><span id="p_f_name"> </span> </h6>
                        </div>
                        <div class="col-sm-2">
                          <h6><b>Gender :</b> <span id="p_gender"></span> </h6>
                        </div>
                        <div class="col-sm-3">
                          <h6><b>Phone-Number :</b> <span id="p_phoneNumber"></span> </h6>
                        </div>

                      </div>
                      <div class="row mb-2">

                        <div class="col-sm-12">
                          <h6><b>Address :</b><span id="p_address"></span> </h6>
                        </div>


                      </div>
                      <div class="row mb-2">

                        <div class="col-sm-10">
                          <h6><b>Allergy :</b><span id="p_allergy"></span> </h6>
                        </div>

                      </div>

                    </div>

                  </div> --}}
                  <div class="card card-primary d-none mt-2" id="p_detail">

                  <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 mb-2">
                            <span id="p_name"></span>
                            <span id="p_gender" class="text-danger" style="font-weight: bold;"></span>
                            <span id="p_age"></span>
                        </div>
                        <div class="col-sm-4">
                            <h6 ><b>Drug Allergy :</b><span id="p_allergy"></span></h6>
                        </div>
                          <div class="col-sm-4" id="div_disease">
                              <h6><b>Disease :</b> <span id="p_disease"></span></h6>
                          </div>
                        <div class="col-sm-4" id="div_f_name">
                            <h6><b>Father Name :</b> <span id="p_f_name"></span></h6>
                        </div>
                                                    
                          {{-- <div class="col-sm-2">
                            <nav aria-label="breadcrumb" class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <button id="viewBtn" style="display: contents;">View</button>

                                        @include('partials._view-modal')
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        @if(Helper::checkPermission('p_update', $permissions))
                                        <button id="editBtn" style="display: contents;">Edit</button>

                                        @include('partials._edit-modal')
                                        @endif
                                    </li>
                                </ol>
                            </nav>
                        </div> --}}
                    </div>
                  </div>
                  </div>
                @endif
          </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            @if(isset($patient->visits))
              <div id="visit-lists" class="col-md-3">
                @include('partials._visit-modal')
              </div>
            @endif
            <div class={{isset($patient->visits) ? 'col-md-9' : 'col-md-12'}}>
              <form action="{{ route('pos.store') }}" method="POST">

                @if($patient != null)
                <input type="hidden" name="patient_id" class="form-control" id="patient_id" value={{ $patient['id'] }}>
                <input type="hidden" name="visit_id" class="form-control" value={{ isset($visit_data['id']) ? $visit_data['id'] : ''}}>
                <input type="hidden" id="fees" class="form-control" value={{ $visit_data['is_foc'] != '1' ? (isset($visit_data['fees']) ? $visit_data['fees'] : 0): '0'}}>
                <input type="hidden" id="customer_name" name="customer_name" class="form-control" value={{ $patient['name'] }}>
                @else
                <input type="hidden" name="patient_id" class="form-control" id="patient_id">
                <input type="hidden" id="fees" class="form-control" value={{ isset($visit_data['fees'])? $visit_data['fees'] : '0' }}>
                <input type="hidden" id="customer_name" name="customer_name" class="form-control">
                
                @endif
                <input type="hidden" name="invoice_code" class="form-control" value={{ $invoice_code }}>
                @csrf
                <section class="content">
                  <div class="container">

                  

                  <div class="container" style="background-color: {{config('app.color')}};height:50px;padding:4px;border-radius: 5px;">
                     
                      <input type="submit" value="Submit" class="btn btn-primary m-1 float-right" style="background-color: {{config('app.color')}}" name="submit_type">
                      <input type="submit" value="Print" class="btn btn-primary m-1 float-right" name="submit_type" onclick="print()" style="background-color: {{config('app.color')}}">
                    <input id="submittype" type="hidden" name="submit_type" value="" />
                    <a href="{{route('pos.history')}}" class="btn btn-primary m-1 float-right" style="background-color: {{config('app.color')}}"><i id="search" class="fa fa-history"></i> History</a>
                    <span style="font-size: 100% !important;margin:5px 0px 5px 0px;" class="badge badge-secondary">{{ $invoice_code }}</span>
                  </div>


                    @if (Session::has('success'))
                  <div class="alert text-white mt-3" style="background-color: {{config('app.color')}} !important">
                    {{ Session::get('success') }}
                  </div>
                  @endif
                   
                    <table class="table table-bordered mb-2" id="product_info_table">
                      <thead>
                        <tr>
                          <th style="width:30%">Name</th>
                          <th style="width:20%">Expire Date</th>
                          <th style="width:10%">A.Qty</th>
                          <th style="width:10%">Qty</th>
                          <th style="width:10%">Price</th>
                          <th style="width:10%">Discount</th>
                          <th style="width:10%">Amount</th>
                          <th><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                        </tr>
                      </thead>

                      <tbody> 
                        @if ($med_data)
                        @foreach ($med_data as $key => $md)
                        <tr id="row_{{$key+1}}">

                          <td>
                            <input type="text" name="med_name[]" id="product_search_{{$key+1}}" onkeyup="searchMed({{$key+1}})" class="form-control" placeholder="Search medicines.." value="{{$md[0]['name']}}" required autocomplete="off">
                            <input type="hidden" name="med_id[]" id="med_id_{{$key+1}}" value={{$md[0]['id']}}>
                            <div id="medList_{{$key+1}}" style="display:none;position:absolute;width:22.5%;">

                            </div>
                            <span id="product_status_1" class="badge badge-danger"></span>
                          </td>
                          <td>
                            <input type="text" name="expire_date[]" id="expire_date_{{$key+1}}" value="{{$md[0]['expire_date']}}" readonly class="form-control">
                          </td>
                          <td>
                            <input type="text" name="remain_qty[]" id="remain_qty_{{$key+1}}" value="{{$md[0]['quantity']}}" readonly class="form-control">
                          </td>
                          <td>
                            <input type="text" name="quantity[]" id="qty_{{$key+1}}" class="form-control" required onkeyup="getTotal({{$key+1}})" value="{{$total_qty[$key][0]}}" autocomplete="off">
                          </td>
                          <td>
                            <input type="text" name="sell_price[]" id="sell_price_{{$key+1}}" value="{{$md[0]['sell_price']}}" onkeyup="getTotal({{$key+1}})" class="form-control" required autocomplete="off">
                            <input type="hidden" name="act_price[]" id="act_price_{{$key+1}}" value="{{$md[0]['act_price']}}" class="form-control">
                            <input type="hidden" name="unit[]" id="unit_{{$key+1}}" value="{{$md[0]['unit']}}" class="form-control">
                            <input type="hidden" name="margin[]" id="margin_{{$key+1}}" value="{{$md[0]['margin']}}" class="form-control">
                          </td>
                          <td>
                            <input type="discount" name="discount[]" id="discount_{{$key+1}}" class="form-control" onkeyup="getTotal({{$key+1}})" autocomplete="off">
                          </td>
                          <td colspan="2">
                            <input type="text" name="amount[]" id="amount_{{$key+1}}" class="form-control" readonly style="width: 100%;">
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr id="row_1">
                          <td>
                            <input type="text" name="med_name[]" id="product_search_1" onkeyup="searchMed('1')" class="form-control" placeholder="Search medicines" required autocomplete="off">
                            <input type="hidden" name="med_id[]" id="med_id_1">
                            <div id="medList_1" style="display:none;position:absolute;width:22.5%;">

                            </div>
                            <span id="product_status1" class="label label-danger"></span>
                          </td>
                          <td>
                            <input type="text" name="expire_date[]" id="expire_date_1" readonly class="form-control">
                          </td>
                          <td>
                            <input type="text" name="remain_qty[]" id="remain_qty_1" readonly class="form-control">
                          </td>
                          <td>
                            <input type="text" name="quantity[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)" autocomplete="off">
                          </td>
                          <td>
                            <input type="text" name="sell_price[]" id="sell_price_1" class="form-control" onkeyup="getTotal(1)" required autocomplete="off">
                            <input type="hidden" name="act_price[]" id="act_price_1" class="form-control">
                            <input type="hidden" name="unit[]" id="unit_1" class="form-control">
                            <input type="hidden" name="margin[]" id="margin_1" class="form-control">
                          </td>
                          <td>
                            <input type="discount" name="discount[]" id="discount_1" class="form-control" onkeyup="getTotal(1)" autocomplete="off">
                          </td>
                          <td>
                            <input type="text" name="amount[]" id="amount_1" class="form-control" readonly style="width: 90px;">
                          </td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                      <table class="table table-bordered mt-2" id="procedureTable">
                        <tbody>
                          @if($procedures)

                            <span class="show" id="proData">
                              @php

                                $pro = explode('<br>',preg_replace('/(<br>)+$/', '', $procedures));

                                $proInfo = [];
                                
                                foreach ($pro as $key =>$row) {
                                  $proInfo[] = explode("^", $row);
                                }

                                $amount = 0;
                                
                                foreach($proInfo as $key => $d){
                                    echo '<tr id=row_'.($key+1).'>
                                        <td style="width:54%;">
                                          <label for="pro_name">'.$d[0].'</label>
                                        </td>
                                        <td style="width:8%;">
                                          <input type="text" class="form-control" id="p_qty_'.($key+1).'" name="p_quantity" value="'.$d[1].'" readonly>
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" id="p_price_'.($key+1).'" name="p_price" value="'.$d[2].'" readonly>
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" name="chargeType" readonly>
                                        </td>
                                        <td style="width:16%;">
                                          <input type="text" class="form-control" id="p_total_'.($key+1).'" name="total" value="'.$d[1] * $d[2].'" readonly>
                                        </td></tr>';

                                      $amount += $d[1] * $d[2];
                                  }


                              @endphp</span>
                            @endif
                              <tr>
                                <td>
                                  <label for="consult_title">Consultation Fees</label>
                                </td>
                                <td>  
                                  <input type="number" value="1" readonly class="form-control">
                                </td>
                                <td>
                                  <input id="consult_title" class="form-control" value="{{isset($visit_data['fees']) ? $visit_data['fees'] : ''}}" readonly/>
                                </td>
                                <td>
                                  @if(isset($visit_data['is_foc']))
                                    <label for="foc" class="text-center">FOC</label>
                                    <input type="text" class="form-control" id="consult_chargeType" name="chargeType" value="1" readonly hidden>
                                  @else
                                    <input type="text" class="form-control" id="consult_chargeType" name="chargeType" value="0"  readonly hidden>
                                  @endif
                                </td>
                                <td>
                                  <input type="text" class="form-control" name="total" value="{{1 * isset($visit_data['fees']) ? $visit_data['fees'] : 0}}" readonly>

                                </td>
                              </tr>
                              <span id="p_r_t" class="d-none">{{isset($amount) ? $amount : 0}}</span>

                  
                        </tbody>
                      </table>
                    <div class="col-md-8 float-right col-xs-12 mr-3">
    
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <select type="text" class="form-control" id="payment_status" name="payment_status" required>
                              <option value="1" selected>Paid</option>
                              <option value="3">FOC</option>
                            </select>
                            
                          </div>

                        
                          <div class="col-md-3">
                            {{-- <label for="payment_status" class="col-sm-5 control-label">Paid Status</label> --}}

                            
                            <div class="input-group mb-3">
                              <div class="input-group-prepand">
                                  <span class="input-group-text">Total</span>
                              </div>
                              <input type="text" class="form-control" id="net_amount" name="total_price" readonly autocomplete="off">
                          </div>
                               
                          </div>
                        </div>
                      </div>
                      {{-- <div class="form-group">
                        <div class="row">
                          <div class="col-md-3">
                            <input type="submit" value="Submit" class="btn btn-primary" style="background-color: {{config('app.color')}}" name="submit_type">
                          </div>
                          <div class="col-md-3">
                            <input type="submit" value="Print" class="btn btn-primary" name="submit_type" onclick="print()" style="background-color: {{config('app.color')}}">
                          </div>
                          <input id="submittype" type="hidden" name="submit_type" value="" />

                        </div>
                      </div> --}}

                    </div>
                </section>
              </form>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
  <div id="imgModal" class="modal">
    <span id="imgClose" class="close">&times;</span>
    <div id="carousel" class="carousel slide">
        <div class="carousel-inner" id="carousel-inner"></div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="caption"></div>
</div>
</body>

<script src="{{ asset('js/pos.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


<script>
  // Alert Box
  setInterval(function() {
    $(".alert").fadeOut();
  }, 3000);

  var loadFile = function(event) {
        for (var i = 0; i < event.target.files.length; i++) {
            var src = URL.createObjectURL(event.target.files[i]);
            $("#image").append("<img id='myImg" + i + "' onclick='showImage(" + i + ")' src=" + src + " style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");

        }
    };

    let imgModal = document.getElementById("imgModal");
    let captionText = document.getElementById("caption");

    function showImage(id, i) {
        let origin_image = document.getElementById("myImg" + id + i);
        imgModal.style.display = "block";
        captionText.innerHTML = origin_image.alt;

        let carouselInner = document.getElementById("carousel-inner");
        // Clear the previous carousel items
        carouselInner.innerHTML = "";

        let carouselItem = document.createElement("div");
        carouselItem.classList.add("carousel-item");
        carouselItem.classList.add("active");

        let carouselImage = document.createElement("img");
        carouselImage.src = origin_image.src;
        carouselImage.alt = origin_image.alt;

        carouselItem.appendChild(carouselImage);
        carouselInner.appendChild(carouselItem);

        // Select all images with the same ID
        let images = document.querySelectorAll("[id^='myImg" + id + "']");
        console.log(images);

        for (let j = 0; j < images.length; j++) {
            if (images[j] !== origin_image) {
                carouselItem = document.createElement("div");
                carouselItem.classList.add("carousel-item");

                carouselImage = document.createElement("img");
                carouselImage.src = images[j].src;
                carouselImage.alt = images[j].alt;

                carouselItem.appendChild(carouselImage);
                carouselInner.appendChild(carouselItem);
            }
        }
    }

    // Close image model
    $("#imgClose").click(function(e) {
        imgModal.style.display = "none";
    })

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function(event) {
        if (event.target == imgModal) {
            imgModal.style.display = "none";
        }
    });

  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var tableProductLength = $("#product_info_table tbody tr").length;

    for (let x = 1; x <= tableProductLength; x++) {
      getTotal(x);
    }

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $.ajax({
            url: "?page=" + page,
            success: function(data) {
                if (data === "updated") {
                    fetch_data(page);
                    bindModalHandlers();
                } else {
                    $('#visit-lists').html(data);
                    bindModalHandlers();
                }
            }
        });
    }

    function bindModalHandlers() {
        console.log("hello");
    }

  });

  function print() {
    document.getElementById("submittype").value = "print-type";
  }

  let isSearching = false;
  $('#main_search').keyup(function() {
    var query = $(this).val();

    var clinic_id = $("#clinic_code").val();

    if(!isSearching) {
      $('#loading-indicator').show();
      $('#search-indicator').hide();
    }
    $('#patientList').hide();

    if (query === '') {
      $('#loading-indicator').hide();
      $('#search-indicator').show();
    }

    $.ajax({
      type: "POST",
      url: '/clinic-system/searchMedPatient',
      data: {
        key: query,
        clinic_id: clinic_id
      }
    }).done(function(response) {
      $('#loading-indicator').hide();
      $('#search-indicator').show();

      if (query != '') {
        if (response == '') {
          $("#search").removeAttr("class", "fa fa-search");
          $("#search").attr("class", "fa fa-plus");
          $("#addRoute").attr("href", "{{ route('patient.create') }}" + "?name=" + query);

        } else {
          $("#search").removeAttr("class", "fa fa-plus");
          $("#search").attr("class", "fa fa-search");
          $("#addRoute").attr("href", "{{ route('patient.index') }}");
        }

        if (response.trim() !== '') {
          $('#patientList').html(response).show();
        } else {
          $('#patientList').html('<div class="text-white text-center rounded py-1" style="background-color: #6C757D; cursor: auto;">No results found.</div>').show();
        }
      } else {
        $('#patientList').hide();
        $('#patientList').html('');
      }
      isSearching = false;
    });
    isSearching = true;
  });

  function getPatientData(id) {

    var name = document.getElementById("name_" + id).getAttribute('data-name')
    var age = document.getElementById("age_" + id).getAttribute('data-age')
    var f_name = document.getElementById("father_name_" + id).getAttribute('data-f_name')
    var gender = $('#gender_' + id).text();
    var phoneNumber = $('#phoneNumber_' + id).text();
    var address = $('#address_' + id).text();
    var allergy = $('#allergy_' + id).text();
    var disease = $('#disease_' + id).text();

    document.getElementById("p_detail").classList.remove('d-none');

    if(gender == 1){
      gender = 'Male';
    }else{
      gender = 'Female';
    }

    if(allergy == '')
    {  
      allergy = ' None';
    }

    if(disease ==  '' ){
      $("#div_disease").remove()
      $("#p_f_name").text(f_name);

    }else{
      $("#div_f_name").remove()
      $("#p_disease").text(disease);



    }

    $("#p_name").text(name);
    $("#customer_name").val(name);
    $("#p_age").text(age);
    $("#p_gender").text(gender);
    $("#p_phoneNumber").text(phoneNumber);
    $("#p_address").text(address);
    $("#p_allergy").text(allergy);
    $("#patient_id").val(id);
    $('#patientList').css("display", "none");
  }


  function searchMed(rowid) {

    var query = $("#product_search_" + rowid).val();

    var clinic_id = {{ session()->get('cc_id') }};

    $.ajax({
      type: "POST",
      url: '/clinic-system/searchMed',
      data: {
        key: query,
        clinic_id: clinic_id,
        rowid: rowid
      }
    }).done(function(response) {

      if (query != '') {
        $('#medList_' + rowid).css("display", "block");
        $('#medList_' + rowid).html(response);
      } else {
        $('#medList_' + rowid).css("display", "none");
        $('#medList_' + rowid).html("");
      }
    });
  };

  function s_option(rowid) {
    var med_id = rowid.getAttribute("data-id");
    var row_id = rowid.getAttribute("row-id");

    $.ajax({
      type: "POST",
      url: '/clinic-system/medData',
      data: {
        med_id: med_id
      }
    }).done(function(response) {

      data = $.parseJSON(response)
      $("#product_search_" + row_id).val(data[0].name)
      $("#med_id_" + row_id).val(data[0].id)
      $("#expire_date_" + row_id).val(data[0].expire_date)
      $("#remain_qty_" + row_id).val(data[0].quantity)
      $("#sell_price_" + row_id).val(data[0].sell_price)
      $("#act_price_" + row_id).val(data[0].act_price)
      $("#margin_" + row_id).val(data[0].margin)
      $("#unit_" + row_id).val(data[0].unit)
      if($("#qty_"+row_id).val()){
        $("#amount_"+row_id).val(data[0].sell_price * $("#qty_"+row_id).val())
      }

      $('#medList_' + row_id).css("display", "none");
      $('#medList_' + row_id).html("");
      $("#product_status_"+row_id).text('');

    });
  }

  function subAmount() {

    var tableProductLength = $("#product_info_table tbody tr").length;


    var totalSubAmount = 0;
    for (let y = 0; y < tableProductLength; y++) {
      var tr = $("#product_info_table tbody tr")[y];
      var count = $(tr).attr('id');

      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
    } 

    // total amount
    var totalAmount = totalSubAmount;
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);
  
    var fees = Number($('#fees').val());


    var p_total = Number($('#p_r_t').text());
    var discount = $("#discount").val();
    if (discount) {
      var grandTotal = Number(totalAmount) - (Number(totalAmount) / 100) * discount;

      $("#med_amount").val(grandTotal);
      $("#net_amount").val(Number(grandTotal) + fees + p_total);
    } else {
      $("#med_amount").val(totalAmount);
      $("#net_amount").val(Number(totalAmount) + fees + p_total);

    } // /else discount 

  } // /sub total amount

  function getTotal(row = null) {


    var qty = Number($("#qty_" + row).val());
    var avaiqty = Number($("#remain_qty_" + row).val());
    var rate = Number($("#sell_price_" + row).val());

    if (qty > avaiqty) {

      $("#product_status_"+row).text("Unavailable Stock");

      var total = rate * qty;
      var discount = (Number($("#sell_price_" + row).val()) * Number($("#qty_" + row).val()) / 100) * $("#discount_" + row).val();
      total = (total) - discount;

      $("#amount_" + row).val(total);
      $("#amount_value_" + row).val(total);

      subAmount();

    } else {

      var total = rate * qty;
      var discount = (Number($("#sell_price_" + row).val()) * Number($("#qty_" + row).val()) / 100) * $("#discount_" + row).val();
      total = (total) - discount;

      $("#amount_" + row).val(total);
      $("#amount_value_" + row).val(total);

      subAmount();

    }
  }

  function removeRow(tr_id) {
    $("#product_info_table tbody tr#row_" + tr_id).remove();
    subAmount();
  }
</script>

@endsection