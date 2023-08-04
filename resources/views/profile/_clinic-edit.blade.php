<div id="clinicEditModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" style="background-color: {{config('app.color')}}">
            <h5 class="modal-title text-white">Edit Clinic</h5>
            <span id="clinicClose" class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form method="post" id="updateClinic">
                @csrf
                @method('PATCH')
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <div class="card card-primary">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" style="color: #6C757D;">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="clinic_name" name="name" placeholder="Name" value="{{ $package->clinic->name }}">

                                            <span id="nameError" class="text-danger small"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phoneNumber" style="color: #6C757D;">Phone Number</label>
                                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="09xxxxxxxxx" value="{{ $package->clinic->phoneNumber }}">

                                            <span id="phoneError" class="text-danger small"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" style="color: #6C757D;">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" placeholder="Address" name="address">{{ $package->clinic->address }}</textarea>
                                    <span id="addressError" class="text-danger small"></span>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn" style="color: {{config('app.secondary_color')}};background-color: {{config('app.color')}}">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>