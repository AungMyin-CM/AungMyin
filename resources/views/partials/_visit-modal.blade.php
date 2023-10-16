<div class="card card-primary">
    <div class="card-header" style="background-color: {{config('app.color')}}">
        <h3 class="card-title">Records</h3>
        @if(Auth::guard('user')->user()->role->role_type == '1' || Auth::guard('user')->user()->role->role_type == '5')

            <span id="visitBtn" class="float-right" style="cursor: pointer;">
                {{ ($patient->visits->count() == 0 ? '' : $patient->visits->count().' visit').($patient->visits->count() > 1 ? 's' : '')}} 
            </span>
        @endif
    </div>

    <!-- Visit Records Modal -->
    <div id="visitModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" style="background-color: {{config('app.color')}}">
                <h5 class="modal-title text-white">Visit Records</h5>
                <span id="visitClose" class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div id="accordion" class="">
                    @php
                    $sortedData = $patient->visits->where('deleted_at',null)->sortByDesc('updated_at');
                    @endphp

                    @foreach ($sortedData as $row)
                    <a class="btn d-block text-white mb-1" style="background-color: {{config('app.color')}}" data-toggle="collapse" href="#collapse{{$row->id}}" role="button" aria-expanded="false" aria-controls="collapse{{ $row->id }}">
                        {{ $row->updated_at->format('d-M-Y g:iA') }}
                    </a>

                    <div id="collapse{{ $row->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li>Bp - {{ $row->sys_bp }}/{{ $row->dia_bp }} mmHg</li>
                                    <li>PR - {{ $row->pr }} min</li>
                                    <li>T - {{ $row->temp }}*F</li>
                                    <li>SpO2 - {{ $row->spo2 }} % on Air</li>
                                    <li>RBS - {{ $row->rbs }} mg/dL</li> <br>
                                    <li>Diseases - {{ $row->disease }}</li> <br>
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

                                    <br>
                                    @php
                                    $text = $row->assigned_medicines;
                                    $medicines = str_replace("<br>", "\n", $text);
                                    @endphp
                                    <li>Treatment: {{ $medicines }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card-body" style="max-height: 600px; overflow-y: scroll;">
        @if($visit->isEmpty() != 1)
        @foreach ($visit as $key => $row)
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
                        <small class="text-muted">{{ $row->updated_at->format('d-M-Y') }}</small>
                    </div>
                </div>

                @if(isset($row->diagnosis[0]))<p>Diagnosis: <span id="p_diag">{{$row->diagnosis[0]->diagnosis}}</span></p>@endif

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

                
                <div>
                    <span>Treatment:</span>
                    {{-- <pre>{{ $medicines }}</pre> --}}
                    <p>
                        @php
                            $text = $row->assigned_medicines;
                            $medicines = explode("<br>", $text);
                            foreach($medicines as $d)
                            {
                                $medInfo = explode('^',$d);

                                $medName = DB::table('pharmacy')->where(['id' => $medInfo[0]])->pluck('name')->first();

                                $med = array_filter($medInfo, fn ($value) => !is_null($value));

                                if(isset($med[1]))
                                {
                                    print_r(($medName ? $medName : $medInfo[0]).' ^ '.(isset($med[1]) ? $med[1] : null).' ^ '.(isset($med[2]) ? $med[2] : null).'<br/>');
                                }
                            }
                        @endphp
                    </p>
                </div>

                <p>Fees - {{ $row->fees }} Kyats</p>
                <hr>
                <div class="row">
                    <div class="col-8">
                        @if($row->is_followup == '1')
                        <small>Follow-up: {{ date('d-M-Y', strtotime($row->followup_date)) }}</small>
                        @endif
                    </div>
                    @if(Auth::guard('user')->user()->role->role_type == '1' || Auth::guard('user')->user()->role->role_type == '5')
                        <div class="col-4 text-right">
                            <a class="btn btn-sm btn-tool">
                                <i class="fas fa-copy" id="copy_{{$row->id}}" style="color:black;" onclick="copyData({{$row->id}})"></i>
                                <i class="fa fa-history" id="undo_{{$row->id}}" style="color:black;display:none;" onclick="deleteData({{$row->id}})"></i>

                            </a>
                            <a class="btn btn-sm btn-tool">
                                <i class="fas fa-trash" style="color:black;" onclick="removeData({{$row->id}})"></i>
                            </a>
                        </div>
                    @endif
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
            {{ $visit->links('pagination.bootstrap-4') }}
        </div>
    </div>

</div>