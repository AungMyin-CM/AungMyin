<style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }
      
  body
{
  height: 100vh;
  display: grid;
  place-items: center;
  background-color: rgb(253, 250, 240) !important;
  /* background: #003049 !important; */

}
.form-container
{
  width: 500px;
  background-color: white;
  /* padding: 3rem 1.5rem; */
  border-radius: 8px;
  box-shadow: 0 0 20px rgba(0, 0, 0, .2);
}
/* Sub forms carousel */
.carousel .inner
{
  overflow: hidden;
}
.carousel .inner .sub-forms
{
    display: flex;
    --transX: 0px;
    transform: translateX(var(--transX));
    transition: all .5s ease;
}
.carousel .inner .sub-forms .sub-form
{
  padding: .5rem;
  flex-basis: 100%;
  flex-shrink: 0;
}
.form-actions
{
 width: fit-content;
}
.form-step-indicators
{
  display: flex;
  justify-content: center;
  column-gap: .7rem;
}
.form-step-indicators button.step-indicator
{
   outline: none;
   border: none;
   height: 5px;
   width: 25px;
   background-color: rgb(214, 214, 214);
   border-radius: 8px;
   transition: all .3s ease;
}
.form-step-indicators button.step-indicator.active
{
   background-color: rgb(0, 94, 235);
}
.form-step-indicators button.step-indicator.visited:not(.active)
{
   background-color: rgb(112, 169, 255);
}
.form-finish-box
{
  display: flex;
  align-items: center;
  justify-content: center;
  height: 300px;
  position: relative;
}
.form-finish-box .party-confetti-toggler-btns
{
  width: 100%;
  display: flex;
  justify-content: space-between;
  position: absolute;
  bottom: 0;
  left: 0;
  visibility: hidden;
}

.image-style{
    width: 50%;
    padding: 5px;
}
.link-hover{
    text-decoration: none;
    color: #fff;
}

.link-hover:hover{
    color: #003049;
}

input
{
    border: 1px solid #003049 !important;
}
.eye-position{
    position: absolute;
    top: 21px;
    right: 21px;
    cursor: pointer;
}
.avatar{
    vertical-align: middle;
    width: 85px;
    height: 81px;
    border-radius: 50%;
    margin: 0 auto;
    cursor: pointer;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" type="image/x-icon"/>


<div class="form-container" style="">
        <form action="" class="form">
            <div class="container" style=" background-color: #003049;">
                <div class="row"><div class="col-md-6"><img src="{{ asset('images/web-photos/aung-myin.png') }}" alt="" class="image-style"></div><div class="col-md-6"><h6 class="text-small text-white mt-3">Registration</h6></div></div>
            </div>
            {{-- <h2 class="form-title mb-4 text-black text-center">Email</h2> --}}
            <div class="carousel">
                <div class="inner ">
                    <div class="sub-forms">
                        <div class="sub-form" data-index="0">
                            <div class="form-floating m-5">
                                <input class="form-control" type="text" name="Email" id="email" placeholder="email">
                                <label for="email">Email</label>
                                <span class="text-danger d-none" id="email-error">Email already taken !</span>
                           </div>
                        
                        </div>
                        <div class="sub-form" data-index="1">
                            <div class="row">
                                <div class="input-group m-auto">
                                    <input type="file" class="@error('avatar') is-invalid @enderror" onchange="loadFile(event)" name="avatar" id="upload" hidden/>
                                    <label class="file_upload m-auto hover" for="upload" id="image_upload">
                                        <img src="{{asset('images/web-photos/no-image.jpg')}}" alt="Avatar" class="avatar mb-2" id="image_logo">
                                    </label>
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert" id="alert-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-2">
                                        <input class="form-control" type="text" name="first_name" id="f_name" placeholder="First Name">
                                        <label for="f_name">First Name</label>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-2">
                                        <input class="form-control" type="text" name="last_name" id="l_name" placeholder="Last Name">
                                        <label for="l_name">Last Name</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                        <i class="fas fa-eye-slash eye-position" id="togglePassword"></i>

                                        <label for="password">Password</label>
                                        <span class="text-danger" id="password-error"></span>
                                    </div> 
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
           <div class="form-actions ms-auto mt-2" id="user-form">
                
               <button class="btn btn-secondary float-left d-none" id="prev"><a href="{{route('user-login')}}" class="nav-link">Back to Login</a></button>
               <button id="next" class="btn btn-primary m-3" style="background-color: #003049 !important;"><i class="fas fa-circle-arrow-right"></i> Next</button>
           </div>
           {{-- <div class="form-step-indicators mt-5">
               <button class="step-indicator active"></button>
               <button class="step-indicator"></button>
           </div> --}}
        </form>
        <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true" style="position: absolute;top:69px;">
            <div class="modal-dialog">
              <div class="modal-content">
                {{-- <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">
                    @include('registration.layouts._otp-modal')
                </div>
                {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
              </div>
            </div>
          </div>
          <button type="button" class="d-none" id="modal-btn" data-bs-toggle="modal" data-bs-target="#otpModal">
            Launch demo modal
          </button>
        <div class="form-finish-box d-none">
            <a href="{{route('user.home')}}" class="btn btn-primary app-color" style="background-color:#003049 !important;">Continue to your dashboard</a>
            <div class="party-confetti-toggler-btns">
                <button class="party-toggler btn"></button>
                <button class="party-toggler btn"></button>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <script>

        const parentForm = document.querySelector("form.form");
        const subFormsWrapper = parentForm.querySelector(".carousel .sub-forms");
        const subForms = subFormsWrapper.querySelectorAll(".sub-form");
        const nextStepBtn = document.getElementById("next");
        const prevStepBtn = document.getElementById("prev");
        const stepsIndicators = Array.from(document.querySelectorAll(".form-step-indicators button.step-indicator"));
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        let activeStepIndex = 0;

        var loadFile = function(event) {
            for(var i =0; i< event.target.files.length; i++){
                var src = URL.createObjectURL(event.target.files[i]);
                $("#image_logo").remove();
                $("#image_upload").append("<img id='image_logo' onclick='showImage("+i+")' src="+src+" class='avatar mb-3' alt='img' />");

            }
        };

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $('#otpModal').modal({
                backdrop: 'static',
                keyboard: false
            })
            $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });

       
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
        });
        


        stepsIndicators.forEach(e => {
            e.addEventListener("click", e => { e.preventDefault() })
        })

        nextStepBtn.addEventListener("click", e => {
            e.preventDefault();
            nextStep()
        });

        prevStepBtn.addEventListener("click", e => {
            e.preventDefault();
            prevStep()
        });


function nextStep(){

    var email = $('#email').val();
    var _token = $('input[name="_token"]').val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!filter.test(email))
    {    
        $('#email-error').text('Invalid Email !');
        $('#email-error').removeClass('d-none');
    }
    else
    {

        $.ajax({
        url:"{{ route('email_available.check') }}",
        method:"POST",
        data:{email:email},
        success:function(result)
        {
        
            if(result != 'unique')
            {
                $('#email-error').text('Email already exists !');
                $('#email-error').removeClass('d-none');
                

            }else{
                // prevStepBtn.classList.remove("d-none");
                // let transBy = subForms[activeStepIndex].clientWidth * ++activeStepIndex * -1;
                // //Check if we reached the last step
                // if(activeStepIndex >= subForms.length - 1)
                //     nextStepBtn.innerText = "Finish";
                // slide(transBy);
                $.ajax({
                    url : "{{route('send-otp')}}",
                    method : "POST",
                    data:{email:email},
                    beforeSend: function(){
                        $(".form").addClass('opacity-25');
                    },
                    success:function(result)
                    {

                        if(result == "Email Sent")
                        {
                            $("#mail").text(email);
                            $("#modal-btn").trigger('click');
                            $(".form").removeClass('opacity-25');

                        }
                    }

                });
            }
            
        }
        })
    }
    
}



function verifyOtp()
{

    const inputs = document.querySelectorAll("input[type='number']")
    var email = $('#email').val();

    let otp = [];
    inputs.forEach((input, index1) => {
       otp.push(input.value);
    });

    var otpValue = otp.toString();

    $.ajax({
        url:"{{ route('verify-otp') }}",
        method:"POST",
        data:{email:email,otp: otpValue},
        beforeSend: function(){
            $("#verify").text('');
            $("#loader").removeClass('d-none');
        },
        success:function(result)
        {
            $("#verify").text('Verify');
            $("#loader").addClass('d-none');

            if(result == 'valid')
            {

                $('#otpModal').modal('toggle');

                let transBy = subForms[activeStepIndex].clientWidth * ++activeStepIndex * -1;
                //Check if we reached the last step
                if(activeStepIndex >= subForms.length - 1)
                    nextStepBtn.setAttribute('hidden','hidden');
                    nextStepBtn.setAttribute('disabled','disabled');

                    // button = document.createElement('button');
                    // $(button).addClass('btn btn-primary').css({'background-color':'#003049 !important;'}).setAttribute('id','completeRegistration');
                    var button = $('<input/>').attr({ type: 'button', name:'btn1',id: 'complete-registration', value:'Complete Registration',class: 'btn btn-primary m-2',style: 'background-color:#003049 !important;' });
                    $('#user-form').append('<i class="fa fa-spinner fa-spin d-none m-2" id="loader"></i>',button);


                slide(transBy);

                $('#complete-registration').on('click',function(){
                        console.log(checkEmptysubForm());
                        if(checkEmptysubForm())
                        {
                            if($("#password").val().length > 5)
                            {

                                let f_name = $("#f_name").val();
                                let l_name = $("#l_name").val();
                                let password = $("#password").val();
                                let email = $("#email").val();

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                });

                                $.ajax({
                                url:"{{ route('user.register') }}",
                                method:"POST",
                                data:{email: email,first_name: f_name,last_name: l_name,password: password},
                                beforeSend: function(){
                                    $(".form").addClass('opacity-25');
                                    $("#loader").removeClass('d-none');
                                    $("#complete-registration").addClass('d-none');
                                },

                                success:function(result){
                                    if(result == 'complete-registration'){
                                        endFormJourney();
                                    }


                                }
                                

                                });
                            }else{
                                $("#password-error").text('Password should be at least 6 letters');
                                
                            }
                        }

                    

                    
                });
            }else if(result == 'invalid')
            {
                $("#otp-validation").text("Invalid Otp");

            }
        }
    });
}

   
    function prevStep(){
        nextStepBtn.innerText = "Next";
        let transBy = subForms[activeStepIndex].clientWidth * --activeStepIndex * -1;
        //Check if we are at the first step
        if(activeStepIndex < 1)
        prevStepBtn.classList.add("d-none");
        slide(transBy);
    }


    function slide(slideBy){
        subFormsWrapper.style.setProperty("--transX", `${slideBy}px`);
        // updateIndicators();
    }

    function updateIndicators(){
        stepsIndicators.forEach(indic => {
            indic.classList.remove("active");
        });
        stepsIndicators[activeStepIndex].classList.add("active")
    }

    function checkEmptysubForm(){
        const subFormIndex = activeStepIndex;
        const subFormInputs = Array.from(subForms[subFormIndex].querySelectorAll("input:not([type=file])"));
        let validsubForm = true;
        subFormInputs.forEach(inpt => {
            if(!inpt.value)
            {
                inpt.classList.add("is-invalid");
                validsubForm = false;
            } else{
                inpt.classList.remove("is-invalid");

            }   
        });
        return validsubForm;
    }

 //When the form is ended remove hte form element from the document 
 //And display a greeting message with party animation
    function endFormJourney(){
        const userName = document.querySelector("form.form input[name='first_name']").value+' '+document.querySelector("form.form input[name='first_name']").value;
        const greetingBox = document.querySelector(".form-container .form-finish-box");
        const greetingPhrase = greetingBox.querySelector("h3.greeting-phrase");
        parentForm.remove();
        greetingBox.classList.remove("d-none");
        toggleParty(greetingBox);
    }

 //Since party function needs a button to be triggred
 //I made a div of 2 buttons space between
 //And set an interavl to click them for 1.5sec
    function toggleParty(finishBox){
        var party = '';
        const partyTogglerBtns = Array.from(finishBox.querySelectorAll(".party-confetti-toggler-btns .party-toggler"));
        partyTogglerBtns.forEach(btn => {
            btn.addEventListener("click", e => {party.confetti(e.target)});
        });

        //Toggle the party animation every 1.5sec
        //SetTimeout just to run the animation at first time without any animation collisions
        partyTogglerBtns.forEach(btn => {btn.click()});
        setTimeout(() => {
            setInterval(() => {
                partyTogglerBtns.forEach(btn => {btn.click()});
            }, 1500);
        }, 1000);
    }

    
</script>