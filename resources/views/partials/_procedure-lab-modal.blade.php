<!-- View Patient Modal -->
<!-- The Modal -->
<style>

ul.ks-cboxtags {
    list-style: none;
    padding: 20px;
}
ul.ks-cboxtags li{
  display: inline;
}
ul.ks-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 3px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ks-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ks-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\f067";
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label::before {
    content: "\f00c";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ks-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ks-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ks-cboxtags li input[type="checkbox"]:focus + label {
  border: 2px solid #e9a1ff;
}
</style>
<div id="procedure_modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header" style="background-color: {{config('app.color')}}">
            <h5 class="modal-title text-white">Patient Info</h5>
            <span id="procedureClose" class="close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                  <div class="container">
                    <ul class="ks-cboxtags">
                      {{-- <li><input type="checkbox" id="checkboxOne" value="Rainbow Dash"><label for="checkboxOne">Rainbow Dash</label></li>
                      <li><input type="checkbox" id="checkboxTwo" value="Cotton Candy" checked><label for="checkboxTwo">Cotton Candy</label></li> --}}
                      {{-- <li><input type="checkbox" id="checkboxThree" value="Rarity" checked><label for="checkboxThree">Rarity</label></li>
                      <li><input type="checkbox" id="checkboxFour" value="Moondancer"><label for="checkboxFour">Moondancer</label></li>
                      <li><input type="checkbox" id="checkboxFive" value="Surprise"><label for="checkboxFive">Surprise</label></li>
                      <li><input type="checkbox" id="checkboxSix" value="Twilight Sparkle" checked><label for="checkboxSix">Twilight
                                      Sparkle</label></li>
                      <li><input type="checkbox" id="checkboxSeven" value="Fluttershy"><label for="checkboxSeven">Fluttershy</label></li>
                      <li><input type="checkbox" id="checkboxEight" value="Derpy Hooves"><label for="checkboxEight">Derpy Hooves</label></li>
                      <li><input type="checkbox" id="checkboxNine" value="Princess Celestia"><label for="checkboxNine">Princess
                                      Celestia</label></li>
                      <li><input type="checkbox" id="checkboxTen" value="Gusty"><label for="checkboxTen">Gusty</label></li>
                      <li class="ks-selected"><input type="checkbox" id="checkboxEleven" value="Discord"><label for="checkboxEleven">Discord</label></li>
                      <li><input type="checkbox" id="checkboxTwelve" value="Clover"><label for="checkboxTwelve">Clover</label></li>
                      <li><input type="checkbox" id="checkboxThirteen" value="Baby Moondancer"><label for="checkboxThirteen">Baby
                                      Moondancer</label></li>
                      <li><input type="checkbox" id="checkboxFourteen" value="Medley"><label for="checkboxFourteen">Medley</label></li>
                      <li><input type="checkbox" id="checkboxFifteen" value="Firefly"><label for="checkboxFifteen">Firefly</label></li> --}}
                    </ul>
                  
                  </div>
                      
                </div>
            </div>
        </div>
    </div>
</div>