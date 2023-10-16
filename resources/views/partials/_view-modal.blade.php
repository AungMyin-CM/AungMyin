<!-- View Patient Modal -->
<!-- The Modal -->
<div id="viewModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">

        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <section class="mb-1">
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

                        {{-- <h5 id="modalName" class="mb-3">{{ $patient->name }}</h5> --}}
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</div>