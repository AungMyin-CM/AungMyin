<div class="mr-2">
    <button id="myBtn1" style="margin:10px; display: contents; color: {{config('app.color')}};">
        <i class="fas fa-edit fa-lg"></i>
    </button>
</div>

<!-- Edit Patient Modal -->
<!-- The Modal -->
<div id="myModal1" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header" style="background-color: {{config('app.color')}}">
            <h5 class="modal-title text-white">Edit Patient</h5>
            <span id="close1" class="close">&times;</span>
        </div>
        <div class="modal-body">
            @include('partials._patient-update')
        </div>
    </div>
</div>