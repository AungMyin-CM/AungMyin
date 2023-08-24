<style>
    .patient-modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
        text-align: left;
    }

    .patient-modal h5,
    .patient-modal label {
        color: #000;
    }

    .patient-modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        background-color: #fff;
    }

    /* Add Animation */
    .patient-modal-content {
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
    .patient-close {
        padding: 0;
        color: #495057;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .patient-close:hover,
    .patient-close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {

        .patient-modal-content {
            width: 100%;
        }
    }
</style>

<div id="addModal" class="patient-modal">
    <!-- Modal content -->
    <div class="patient-modal-content">

        <div class="modal-body" style="padding-top: 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Add Patient</h5>
                <span id="addClose" class="patient-close">&times;</span>
            </div>
            <form method="post" id="patientAddForm">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <div class="card card-primary">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="patient_name" name="name" placeholder="Name">
                                            <span id="nameError" class="text-danger small"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="father_name">Father name</label>
                                            <input type="text" class="form-control" id="f-name" name="father_name" placeholder="Father name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" min="1" max="100" placeholder="Age">
                                            <span id="ageError" class="text-danger small"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phoneNumber">Phone Number</label>
                                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="09xxxxxxxxx">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address"></textarea>
                                    <span id="addressError" class="text-danger small"></span>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="male" type="radio" value="1" name="gender">
                                                <label class="form-check-label" for="male">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="female" type="radio" value="0" name="gender">
                                                <label class="form-check-label" for="female">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="genderError" class="text-danger small"></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Drug Allergy</label>
                                            <textarea class="form-control" placeholder="Drug Allergy" rows="4" name="drug_allergy"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Summary</label>
                                            <textarea class="form-control" placeholder="Summary" rows="4" name="summary"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn text-white" id="addBtn" style="background-color: {{config('app.color')}}">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>