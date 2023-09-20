<!-- Edit Patient Modal -->
<!-- The Modal -->
<div id="editModal" class="modal">
    <!-- Modal content -->
    <form method="post" id="updateForm">

        @csrf
        @method('PATCH')

        <div class="modal-content">
            <div class="modal-header" style="background-color: {{config('app.color')}}">
                <h5 class="modal-title text-white">Edit Patient</h5>
                <span><button type="submit" class="btn btn-secondary" id="updateBtn" style="color: {{config('app.secondary_color')}};background-color: {{config('app.color')}}">Submit</button>
                </span>
            </div>
            <div class="modal-body">
                
                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            <div class="card card-primary">
                                <div class="card-body">
                                    {{-- <p class="badge badge-secondary fs-3">{{ $code }}
                                    </p><br /> --}}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="patient_name" name="name" placeholder="Name" value=" {{ $patient->name }}" autocomplete="off">
                                                <span id="nameError" class="text-danger small"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_name">Father name</label>
                                                <input type="text" class="form-control" id="f-name" name="father_name" placeholder="Father name" value="{{ $patient->father_name }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="age">Age</label>
                                                <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" min="1" max="100" placeholder="Age" value="{{ $patient->age }}" autocomplete="off">
                                                <span id="ageError" class="text-danger small"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="09xxxxxxxxx" value="{{ $patient->phoneNumber }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address" autocomplete="off">{{ $patient->address }}</textarea>
                                        <span id="addressError" class="text-danger small"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        @if($patient->gender == 1)
                                        <?php
                                        $m_checked = 'checked';
                                        $f_checked = '';
                                        ?>
                                        @else
                                        <?php
                                        $m_checked = '';
                                        $f_checked = 'checked';
                                        ?>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="male" type="radio" value="1" name="gender" <?php echo $m_checked; ?>>
                                                    <label class="form-check-label" for="male">
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" id="female" type="radio" value="0" name="gender" <?php echo $f_checked; ?>>
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
                                                <textarea class="form-control" placeholder="Drug Allergy" rows="4" name="drug_allergy" autocomplete="off">{{ $patient->drug_allergy }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Summary</label>
                                                <textarea class="form-control" placeholder="Summary" rows="4" name="summary" autocomplete="off">{{ $patient->summary }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>

</div>