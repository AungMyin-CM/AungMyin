<!-- View Patient Modal -->
<!-- The Modal -->
<div id="viewModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header" style="background-color: {{config('app.color')}}">
            <h5 class="modal-title text-white">Patient Info</h5>
            <span id="viewClose" class="close">&times;</span>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <section class="mb-1">
<<<<<<< HEAD
                        <h5 id="modalName" class="mb-3">{{ $patient->name }}</h5>
                    </section>
                    <section>
                        <span class="text-muted">Age: </span>
                        <span id="modalAge">{{ $patient->age }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Gender: </span>
                        <span id="modalGender">{{ $patient->gender == 1 ? 'Male' : 'Female' }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Drug Allergy: </span>
                        <span id="modalDrugAllergy">{{ $patient->drug_allergy }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Diseases: </span>
                        <span id="modalDisease">{{ $patient->disease }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Father name: </span>
                        <span id="modalFatherName">{{ $patient->father_name }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Code: </span>
                        <span id="modalCode">{{ $patient->code }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Phone: </span>
                        <span id="modalPhone">{{ $patient->phoneNumber }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Address: </span>
                        <span id="modalAddress">{{ $patient->address }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Summary: </span>
                        <span id="modalSummary">{{ $patient->summary }}</span>
=======
                        <h5 class="mb-3">{{ $data['patient']['name'] }}</h5>
                    </section>
                    <section>
                        <span class="text-muted">Age: </span>{{ $data['patient']['age'] }}
                    </section>
                    <section>
                        <span class="text-muted">Gender: </span>{{ $data['patient']['gender'] == 1 ? 'Male' : 'Female' }}
                    </section>
                    <section>
                        <span class="text-muted">Drug Allergy: </span>{{ $data['patient']['drug_allergy'] }}
                    </section>
                    <section>
                        <span class="text-muted">Diseases: </span>
                    </section>
                    <section>
                        <span class="text-muted">Father name: </span>{{ $data['patient']['father_name'] }}
                    </section>
                    <section>
                        <span class="text-muted">Code: </span>{{ $data['patient']['code'] }}
                    </section>
                    <section>
                        <span class="text-muted">Phone: </span>{{ $data['patient']['phoneNumber'] }}
                    </section>
                    <section>
                        <span class="text-muted">Address: </span>{{ $data['patient']['address'] }}
>>>>>>> 78e7ce2 (Merge conflict solved)
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>