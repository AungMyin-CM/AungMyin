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
                        <h5 id="modalName" class="mb-3">{{ $data['patient']['name'] }}</h5>
                    </section>
                    <section>
                        <span class="text-muted">Age: </span>
                        <span id="modalAge">{{ $data['patient']['age'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Gender: </span>
                        <span id="modalGender">{{ $data['patient']['gender'] == 1 ? 'Male' : 'Female' }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Drug Allergy: </span>
                        <span id="modalDrugAllergy">{{ $data['patient']['drug_allergy'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Diseases: </span>
                        <span id="modalDisease">{{ $data['patient']['disease'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Father name: </span>
                        <span id="modalFatherName">{{ $data['patient']['father_name'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Code: </span>
                        <span id="modalCode">{{ $data['patient']['code'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Phone: </span>
                        <span id="modalPhone">{{ $data['patient']['phoneNumber'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Address: </span>
                        <span id="modalAddress">{{ $data['patient']['address'] }}</span>
                    </section>
                    <section>
                        <span class="text-muted">Summary: </span>
                        <span id="modalSummary">{{ $data['patient']['summary'] }}</span>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>