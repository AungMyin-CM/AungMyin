@extends("layouts.app")

@section('content')

<style>
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }
  
  #myImg:hover {opacity: 0.7;}
  
  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }
  
  /* Modal Content (image) */
  .modal-content {
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
  .modal-content, #caption {  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }
  
  @-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
  }
  
  @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
  }
  
  /* The Close Button */
  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }
  
  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }
  
  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
  }
  </style>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="content-wrapper" style="background-color: {{config('app.bg_color')}} !important">
                
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="card card-primary">
                            <div class="card-body" style="padding: 0.9rem !important;"> 
                                <div class="row mb-2">
                                    <div class="col-sm-2">
                                        <h6><b>Name :</b> {{ $data['patient']['name'] }} </h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <h6><b>Age :</b> {{ $data['patient']['age'] }} </h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6><b>Father's Name :</b> {{ $data['patient']['father_name'] }} </h6>
                                    </div>
                                    <div class="col-sm-2">
                                        <h6><b>Gender :</b> {{ $data['patient']['gender'] == 1 ? 'Male' : 'Female' }} </h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h6><b>Phone-Number :</b> {{ $data['patient']['phoneNumber'] }} </h6>
                                    </div>
                                    
                                </div>
                                <div class="row mb-2">
                                   
                                    <div class="col-sm-12">
                                        <h6><b>Address :</b> {{ $data['patient']['address'] }} </h6>
                                    </div>
                                    
                                   
                                </div>
                                <div class="row mb-2">                         
                                    <div class="col-sm-12">
                                        <h6><b>Allergy :</b> {{ $data['patient']['drug_allergy'] }} </h6>
                                    </div>
                                   <div  style="position: absolute; right : 1px ;bottom :10px">
                                    @if(Helper::checkPermission('p_update', $permissions))

                                    <a href="{{ route('patient.edit' ,  Crypt::encrypt($data['patient']['id'])) }}" style="margin:10px; color: {{config('app.color')}}">
                                    <i class="fas fa-edit fa-lg"></i></a>@endif
                                   </div>
                                </div>
      
                            </div>

                        </div>

                    </div>
                </section>                

                <form action="{{ route('create.treatment', $data['patient']['id']) }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                
                    <section class="content">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-4">

                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: {{config('app.color')}}">
                                            <h3 class="card-title">Patient Treatment</h3>
                                        </div>
                                       
                                        <div class="card-body">
                                            @if($data['visit']->isEmpty() != 1)
                                                @foreach ($data['visit'] as $row)
                                                    <div class="card" style="background:#a19090;" id="treatment_data_{{$row['id']}}">
                                                        <div class="card-header border-0">
                                                            <h3 class="card-title" title="{{$row['update_at']}}">{{ $row['updated_at']->diffForHumans() }}</h3>
                                                            <div class="card-tools">
                                                                <a class="btn btn-sm btn-tool">
                                                                    <i class="fas fa-copy" style="color:black;" onclick="copyData({{$row['id']}})"></i>
                                                                </a>
                                                                <a class="btn btn-sm btn-tool">
                                                                    <i class="fas fa-trash" style="color:black;" onclick="removeData({{$row['id']}})"></i>
                                                                </a>
                                                            </div><br/>

                                                            <ul>
                                                                @if($row['prescription'] != '')
                                                                    <li><?php echo Str::limit($row['prescription'], $limit = 100, $end = '...') ;?></li>
                                                                @endif

                                                                @if($row['diag'] != '')
                                                                    <li>{{ Str::limit($row['diag'], $limit = 100, $end = '...') }}</li>
                                                                @endif

                                                                @if($row['investigation'] != '')
                                                                    <li>{{ Str::limit($row['investigation'], $limit = 100, $end = '...') }}</li>
                                                                @endif

                                                                @if($row['procedure'] != '')
                                                                    <li>{{ Str::limit($row['procedure'], $limit = 100, $end = '...') }}</li>
                                                                @endif

                                                    
                                                            </ul>

                                                            <div class="float-left">
                                                                <small>Fees:</small>  {{ $row['fees'] }}
                                                                <input type="hidden" name="code" value="{{ $data['patient']['code'] }}" >
                                                            </div>
                                                            @if($row['is_followup'] == '1')
                                                                <div class="float-right">
                                                                    <small>follow up: {{ date('d-m-Y', strtotime($row['followup_date'])) }}</small>  
                                                                </div>
                                                            @endif
                                                            
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="row">
                                                                <?php
                                                                    $images_r = substr($row['images'],1,-1);

                                                                    $images = explode(",", $images_r);

                                                                    for($i=0; $i < count($images); $i++){
                                                                        if($images[$i] != ''){
                                                                            // echo "<img id='myImg'".$row['id']."onclick='showImage($row['id'])' src="asset('images/'substr(json_encode($data['images'][$i]),1,-1))" style='margin:4px;width:50px;border-radius:5px;cursor:pointer;' alt='img' />";
                                                                            echo "<img id='myImg".$i."' onclick='showImage($i)' src=".asset('images/treatment-images/'.substr($images[$i],1,-1))." style='margin:4px;width:50px;border-radius:5px;cursor:pointer;' alt='img'>";
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                                                            

                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                    <p class="text-center">No records yet.</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="card card-primary">
                                        <div class="card-header" style="background-color: {{config('app.color')}}">
                                            <h3 class="card-title">....</h3>
                                            
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="address">Prescription</label>
                                                <textarea class="form-control c-field" id="dictionary" rows="10" placeholder="Start Typing here..."
                                                    name="prescription">{{ old('prescription') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Diagnosis</label>
                                                <textarea class="form-control c-field" id="diagnosis_dictionary" rows="6" placeholder="Start Typing here..."
                                                    name="diag">{{ old('diag') }}</textarea>

                                            </div>

                                            <div class="form-group">
                                                <label for="address">Search Medicine</label>
                                                <input type="text" class="form-control" id="medicine_dictionary" placeholder="Search by Shorthand..."
                                                    name="medicines"> 
                                            </div>

                                            <div class="form-group" id="medtable">
                                                <section class="content">
                                                    <div class="container-fluid">
                                                        <table class="table table-bordered" id="product_info_table">
                                                            <thead>
                                                              <tr>
                                                                <th style="width:45%">Name</th>                                                   
                                                                <th style="width:25%">Qty</th>
                                                                <th style="width:20%">Days</th>
                                                                <th ><button type="button" id="add_dic_med_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                                              </tr>
                                                            </thead>   
                                                             <tbody>
                                                               <tr id="row_1">
                                                                 <td>
                                                                      <input type="text" name="med_name[]" id="product_search_1" onkeyup="searchMed('1')" class="form-control" placeholder="Search Medicine">
                                                                      <input type = "hidden" name = "med_id[]" id = "med_id_1">
                                                                      <div id="medList_1" style="display:none;position:absolute;width:35%;">
                                                                    </div>
                                                                </td>
                                                                  
                                                                  <td>
                                                                    <input type="text" name="quantity[]" id="qty_1" class="form-control"></td>           
                                                                  <td>
                                                                    <input type="number" name="days[]" id="days_1" class="form-control" >  
                                                                  </td>
                                                                  
                                                               </tr>
                                                             </tbody>
                                                          </table>              
                                                  </section>
                                            </div>

                                            <input type="file" multiple="multiple" onchange="loadFile(event)" name= "images[]" id="upload" hidden/>
                                            <label class="file_upload" for="upload" 
                                            style="background: gray;
                                            padding: 8px;
                                            border-radius: 5px;
                                            cursor: pointer;">Upload Images</label>
                                        
                                            <div id="myModal" class="modal">
                                                <span class="close">&times;</span>
                                                <img class="modal-content" id="img01">
                                                <div id="caption"></div>
                                            </div>

                                            <div class="form-group" id="image">
                                                {{-- <img id="myImg" src="" style='margin:4px;width:100px;border-radius:5px;' alt="img" /> --}}
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Investigation</label>
                                                        <textarea class="form-control c-field" id="investigation" rows="5" placeholder="Start Typing here..."
                                                            name="investigation">{{ old('investigation') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Procedure</label>
                                                        <textarea class="form-control c-field" id="procedure" rows="5" placeholder="Start Typing here..."
                                                            name="procedure">{{ old('procedure') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <input type="hidden" pattern="{0-9}" class="form-control d-none" name="fees" placeholder="Fees" value={{Auth::user()->fees}} readonly />
                                                <div class="col-md-6">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-check" style="padding:6px !important;">
                                                            
                                                            <div class="icheck-primary d-inline mt-2">
                                                                <input type="checkbox" id="foc" name="is_foc" value="1">
                                                                <label for="foc">FOC</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex justify-content-center" id="followUp">
                                                        <div class="form-check" style="padding:6px !important;">
                                                            
                                                            <div class="icheck-primary d-inline mt-2">
                                                                <input type="checkbox" id="isFollowup" name="is_followup" value="1">
                                                                <label for="isFollowup">Follow up</label>
                                                            </div>
                                                        </div>
                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="form-group float-right">
                                                <input type="submit" id = "btnSubmit" value="submit" class="btn btn-primary" style="background-color: {{config('app.color')}}">
                                            </div>
                                        </div>
                                        <!-- Bootstrap Switch -->
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col (right) -->
                                </div>
                            </div>
                    </section>
                </form>

            </div>
        </div>
    </body>
    <script src="{{ asset('js/dictionary.js') }}"></script>
    <script src="{{ asset('js/patient.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>
 $(document).ready(function() {
  $(window).on("keydown", function(event){
 
    // Check to see if ENTER was pressed and the submit button was active or not
    if(event.keyCode === 13 && event.target === document.getElementById("btnSubmit")) {
      // It was, so submit the form
      document.querySelector("form").submit();

    } else if(event.keyCode === 13 && event.target == document.getElementById("medicine_dictionary") ){
        medicine_dictionary(event);
        event.preventDefault();
                
                //  Invoke click event of target so that non-form submit behaviors will work
                event.target.click();
    }
    else if(event.keyCode === 13){
        event.preventDefault();
    }
  });
});
        var loadFile = function(event) {
            for(var i =0; i< event.target.files.length; i++){
                var src = URL.createObjectURL(event.target.files[i]);
                $("#image").append("<img id='myImg"+i+"' onclick='showImage("+i+")' src="+src+" style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");

            }
        };

        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        function showImage(id)
        {
            var origin_image = document.getElementById("myImg"+id);
            modal.style.display = "block";
            modalImg.src = origin_image.src;
            console.log(modalImg.src);
            captionText.innerHTML = origin_image.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
            modal.style.display = "none";
        }

        var dictCode = '';

    function medicine_dictionary(event) {
   
        var key = event.keyCode;
        var evtType = event.type;
        var name = document.getElementById("medicine_dictionary").value;
      
                    if(event.key != '') {

                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: '/clinic-system/fetchIsmed',
                        data: { key:name}
                    }).done(function( response ) {
                      
                        if(response != ''){
                            var obj = JSON.parse(response);
                            const res = obj.meaning.split("<br>");

                            var fil_res = res.filter(function (el) {
                                return el != "";
                            });

                            var table = $("#product_info_table");
        var count_table_tbody_tr = $("#product_info_table tbody tr").length;
        var row_id =  1;
        var html = "";
        for (i =0; i<fil_res.length ; i++){
            data = res[i].split('^');
                html += '<tr id="row_'+row_id+'">'+
            '<td>'+ 
            '<input type="text" name="med_name[]" id="product_search_'+row_id+'" onkeyup="searchMed('+row_id+')" value="'+data[1]+'"  class="form-control" placeholder="Search Medicine">'+
            '<input type = "hidden" name = "med_id[]" id = "med_id_'+row_id+'" value="'+data[0]+'" >'+
            '<div id="medList_'+row_id+'" style="display:none;position:absolute;width:35%;"></div>'+
            '</td>'+ 
            '<td><input type="text" name="quantity[]" id="qty_'+row_id+'" class="form-control" value="'+data[2]+'" ></td>'+           
            '<td><input type="number" name="days[]" id="days_'+row_id+'" class="form-control"  value="'+data[3]+'"></td>'+
            '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-minus"></i></button></td>'+
            '</tr>';
            row_id++;
        }
 
        $("#product_info_table tbody").html(html);
 
                        }
                    });
                    }
 
    }
    function searchMed(rowid) {
            var query = $("#product_search_"+rowid).val();
        
            var clinic_id = {{ session()->get('cc_id') }};
            $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
             $.ajax({
                type: "POST",
                url: '/clinic-system/searchMed',
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
            var med_name = rowid.getAttribute("data-name");
            var row_id = rowid.getAttribute("row-id");
            $("#product_search_"+row_id).val(med_name);
            $("#med_id_"+row_id).val(med_id);      
            $('#medList_'+row_id).css("display","none");  
            $('#medList_'+row_id).html("");
            
        }
    function removeRow(id)
    {
        $("#medtable table tr#row_"+id).remove();
    }

    function copyData(id)
    {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/clinic-system/copy-data',
            data: { id: id},
        beforeSend: function(){
            $('.c-field').attr('style','opacity:0.1');
        },
        success: function( response ) {
            $("#dictionary").text(response.prescription);
            $("#diagnosis_dictionary").text(response.diag);
            $("#investigation").text(response.investigation);
            $("#procedure").text(response.procedure);
        },
        complete: function(response) {
            $('.c-field').removeAttr('style','opacity:0.1');
        }
        });
    }

    function removeData(id)
    {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/clinic-system/remove-data',
            data: { id: id}
        }).done(function( response ) {
            $("#treatment_data_"+id).slideUp();
        });
    }

    </script>
@endsection
{{-- @include('layouts.js') --}}
