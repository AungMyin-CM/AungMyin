<style>
  body
{
  height: 100vh;
  display: grid;
  place-items: center;
  /* background: #003049 !important; */

}
.form-container
{
  width: 350px;
  background-color: white;
  padding: 3rem 1.5rem;
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
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<div class="form-container" style="background: #003049;">
        <form action="" class="form">
            {{-- <h2 class="form-title mb-4 text-white">Email</h2> --}}
            <div class="carousel">
                <div class="inner ">
                    <div class="sub-forms">
                        <div class="sub-form" data-index="0">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="Email" id="email" placeholder="email">
                                <label for="email">Email</label>
                                <span class="text-danger d-none" id="email-error">Email already taken !</span>
                           </div>
                        
                        </div>
                        <div class="sub-form" data-index="1">
                            
                            <div class="form-floating mb-2">
                                <input class="form-control" type="text" name="username" id="userName" placeholder="username">
                                <label for="userName">Username</label>
                            </div> 
                        </div>
                        <div class="sub-form" data-index="2">
                            <div class="form-floating mb-3">
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                                <label for="password">Password</label>
                           </div>
                            <div class="form-floating mb-2">
                                <input class="form-control" type="password" name="password" id="confirmPassword" placeholder="Confirm password">
                                <label for="confirmPassword">Confirm password</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="form-actions ms-auto mt-2">
               <button id="prev" class="btn btn-secondary d-none">Previous</button>
               <button id="next" class="btn btn-primary">Next</button>
           </div>
           {{-- <div class="form-step-indicators mt-5">
               <button class="step-indicator active"></button>
               <button class="step-indicator"></button>
           </div> --}}
        </form>
        <div class="form-finish-box d-none">
            <h3 class="greeting-phrase"></h3>
            <div class="party-confetti-toggler-btns">
                <button class="party-toggler btn"></button>
                <button class="party-toggler btn"></button>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script>

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        })
        
const parentForm = document.querySelector("form.form");
const subFormsWrapper = parentForm.querySelector(".carousel .sub-forms");
const subForms = subFormsWrapper.querySelectorAll(".sub-form");
const nextStepBtn = document.getElementById("next");
const prevStepBtn = document.getElementById("prev");
const stepsIndicators = Array.from(document.querySelectorAll(".form-step-indicators button.step-indicator"));
let activeStepIndex = 0;

stepsIndicators.forEach(e => {
    e.addEventListener("click", e => { e.preventDefault() })
})

nextStepBtn.addEventListener("click", e => {
    e.preventDefault();
    if(checkEmptysubForm())
     nextStepBtn.innerText.toLowerCase() == "next" ? nextStep() : endFormJourney();
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
      
        $('#email-error').text('Invalid Email');
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
                method : "GET",
                data:{email:email},
                success:function(result)
                {
                   alert(result)
                }

            });
        }
        
    }
    })
    }
    
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
    updateIndicators();
 }

 function updateIndicators(){
     stepsIndicators.forEach(indic => {
         indic.classList.remove("active");
     });
     stepsIndicators[activeStepIndex].classList.add("active")
 }

 function checkEmptysubForm(){
  const subFormIndex = activeStepIndex;
  const subFormInputs = Array.from(subForms[subFormIndex].querySelectorAll("input"));
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
    const userName = document.querySelector("form.form input[name='username']").value;
    const greetingBox = document.querySelector(".form-container .form-finish-box");
    const greetingPhrase = greetingBox.querySelector("h3.greeting-phrase");
    parentForm.remove();
    greetingPhrase.textContent = `Welcome ${userName}`;
    greetingBox.classList.remove("d-none");
    toggleParty(greetingBox);
 }

 //Since party function needs a button to be triggred
 //I made a div of 2 buttons space between
 //And set an interavl to click them for 1.5sec
 function toggleParty(finishBox){
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