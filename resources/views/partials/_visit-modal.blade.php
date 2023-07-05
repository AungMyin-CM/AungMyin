<div class="card card-primary">
    <div class="card-header" style="background-color: {{config('app.color')}}">
        <h3 class="card-title">Previous Records</h3>
        <span class="float-right">{{ $patient->visits->count() }} visits</span>
    </div>

    <div class="card-body" style="max-height: 500px; overflow-y: scroll;">
        @if($visit->isEmpty() != 1)
        @foreach ($visit as $row)
        <div class="card" id="treatment_data_{{$row->id}}">
            <div class="card-header">
                <div class="row mb-3">
                    <div class="col-8">
                        <ul class="list-unstyled">
                            <li>Bp - {{ $row->sys_bp }}/{{ $row->dia_bp }} mmHg</li>
                            <li>PR - {{ $row->pr }} min</li>
                            <li>T - {{ $row->temp }}*F</li>
                            <li>SpO2 - {{ $row->spo2 }} % on Air</li>
                            <li>RBS - {{ $row->rbs }} mg/dL</li>
                        </ul>
                    </div>
                    <div class="col-4 text-right">
                        <small class="text-muted">{{ $row->updated_at->format('d-M-Y g:iA') }}</small>
                    </div>
                </div>

                <p>Diseases: {{ $row->disease }}</p>

                <ul class="list-unstyled">
                    @if($row->prescription != '')
                    <li>Prescription: {{ Str::limit($row->prescription, $limit = 100, $end = '...') }}</li>
                    @endif

                    @if($row->diag != '')
                    <li>Diagnosis: {{ Str::limit($row->diag, $limit = 100, $end = '...') }}</li>
                    @endif

                    @if($row->investigation != '')
                    <li>Investigation: {{ Str::limit($row->investigation, $limit = 100, $end = '...') }}</li>
                    @endif

                    @if($row->procedure != '')
                    <li>Procedure: {{ Str::limit($row->procedure, $limit = 100, $end = '...') }}</li>
                    @endif
                </ul>

                @php
                $text = $row->assigned_medicines;
                $medicines = str_replace("<br>", "\n", $text);
                @endphp
                <div>
                    <span>Treatment:</span>
                    <pre>{{ $medicines }}</pre>
                </div>

                <p>Fees - {{ $row->fees }} Kyats</p>
                <hr>
                <div class="row">
                    <div class="col-8">
                        @if($row->is_followup == '1')
                        <small>Follow-up: {{ date('d-m-Y', strtotime($row->followup_date)) }}</small>
                        @endif
                    </div>
                    <div class="col-4 text-right">
                        <a class="btn btn-sm btn-tool">
                            <i class="fas fa-copy" id="copy_{{$row->id}}" style="color:black;" onclick="copyData({{$row->id}})"></i>
                            <i class="fa fa-history" id="undo_{{$row->id}}" style="color:black;display:none;" onclick="deleteData({{$row->id}})"></i>

                        </a>
                        <a class="btn btn-sm btn-tool">
                            <i class="fas fa-trash" style="color:black;" onclick="removeData({{$row->id}})"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <?php
                    $images_r = substr($row->images, 1, -1);

                    $images = explode(",", $images_r);

                    for ($i = 0; $i < count($images); $i++) {
                        if ($images[$i] != '') {
                            $id = $row->id;

                            echo "<img id='myImg" . $id . $i . "' onclick='showImage($id, $i)' src=" . asset('images/treatment-images/' . substr($images[$i], 1, -1)) . " style='margin:4px;width:50px;border-radius:5px;cursor:pointer;' alt='img'>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="text-center">No records yet.</p>
        @endif

        <div class="d-flex justify-content-center">
            {!! $visit->links('pagination.bootstrap-4') !!}
        </div>
    </div>

</div>