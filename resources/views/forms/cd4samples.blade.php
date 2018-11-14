@extends('layouts.master')

@component('/forms/css')
    <link href="{{ asset('css/datapicker/datepicker3.css') }}" rel="stylesheet" type="text/css">
@endcomponent

@section('custom_css')
    <style type="text/css">
        .hpanel {
            margin-bottom: 4px;
        }
        .hpanel.panel-heading {
            padding-bottom: 2px;
            padding-top: 4px;
        }
    </style>
@endsection

@section('content')

    <div class="content">
        <div>

        @if (isset($sample))
            {{ Form::open(['url' => '/cd4/sample/' . $sample->id, 'method' => 'put', 'class'=>'form-horizontal', 'id' => 'samples_form']) }}
        @else
            {{ Form::open(['url'=>'/cd4/sample', 'method' => 'post', 'class'=>'form-horizontal', 'id' => 'samples_form']) }}
        @endif

        <input type="hidden" value=0 name="new_patient" id="new_patient">

        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-body" style="padding-bottom: 6px;">

                        <div class="alert alert-warning">
                            <center>
                                Please fill the form correctly. <br />
                                Fields with an asterisk(*) are mandatory.
                            </center>
                        </div>
                        <br />

                        @isset($sample)
                            <div class="alert alert-warning">
                                <center>
                                    NB: If you edit the facility name, date received or date dispatched from the facility this will be reflected on the other samples in this batch.
                                </center>
                            </div>
                            <br />
                        @endisset

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Facility 
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control requirable" required name="facility_id" id="facility_id" required>
                                    @isset($sample)
                                        <option value="{{ $sample->facility->id }}" selected>{{ $sample->facility->facilitycode }} {{ $sample->facility->name }}</option>
                                    @endisset
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">AMRS Location</label>
                            <div class="col-sm-8">
                                <select class="form-control ampath-only" name="amrs_location">

                                  <option></option>
                                  @foreach ($amrs_locations as $amrs_location)
                                      <option value="{{ $amrs_location->id }}"

                                      @if (isset($sample) && $sample->amrs_location == $amrs_location->id)
                                          selected
                                      @endif

                                      > {{ $amrs_location->name }}
                                      </option>
                                  @endforeach

                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group ampath-div">
                            <label class="col-sm-4 control-label">AMRS Provider Identifier</label>
                            <div class="col-sm-8">
                                <input class="form-control ampath-only" name="provider_identifier" type="text" value="{{ $sample->provider_identifier ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading" style="padding-bottom: 2px;padding-top: 4px;">
                        <center>Patinet Information</center>
                    </div>
                    <div class="panel-body" style="padding-bottom: 6px;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Medical Record No. (Ampath #)
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                <input class="form-control requirable" required name="medicalrecordno" type="text" value="{{ $sample->patient->patient ?? '' }}" id="medicalrecordno">
                            </div>
                        </div>

                        <div class="form-group ampath-div">
                            <label class="col-sm-4 control-label">Patient Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" name="patient_name" id="patient_name" type="text" value="{{ $sample->patient->patient_name ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Date of Birth
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="dob" required class="form-control lockable requirable" value="{{ $sample->patient->dob ?? '' }}" name="dob">
                                </div>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Gender
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                <select class="form-control lockable requirable" required name="sex" id="sex">
                                    <option></option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}"

                                        @if (isset($sample) && $sample->patient->sex == $gender->id)
                                            selected
                                        @endif

                                        > {{ $gender->gender_description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-heading" style="padding-bottom: 2px;padding-top: 4px;">
                        <center>Sample Information</center>
                    </div>
                    <div class="panel-body" style="padding-bottom: 6px;">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Date of Collection
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="datecollected" required class="form-control requirable" value="{{ $sample->datecollected ?? '' }}" name="datecollected">
                                </div>
                            </div>                            
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Date Received
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="datereceived" required class="form-control requirable" value="{{ $sample->batch->datereceived ?? $batch->datereceived ?? '' }}" name="datereceived">
                                </div>
                            </div>                            
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Received Status
                                <strong><div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-8">
                                    <select class="form-control requirable" required name="receivedstatus" id="receivedstatus">

                                    <option></option>
                                    @foreach ($receivedstatuses as $receivedstatus)
                                        <option value="{{ $receivedstatus->id }}"

                                        @if (isset($sample) && $sample->receivedstatus == $receivedstatus->id)
                                            selected
                                        @endif

                                        > {{ $receivedstatus->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="rejection" >
                            <label class="col-sm-4 control-label">Rejected Reason</label>
                            <div class="col-sm-8">
                                    <select class="form-control" required name="rejectedreason" id="rejectedreason" disabled>

                                    <option></option>
                                    @foreach ($rejectedreasons as $rejectedreason)
                                        <option value="{{ $rejectedreason->id }}"

                                        @if (isset($sample) && $sample->rejectedreason == $rejectedreason->id)
                                            selected
                                        @endif

                                        > {{ $rejectedreason->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                
        <div class="row">
            <div class="col-lg-12">
                <div class="hpanel">
                    <div class="panel-body" style="padding-bottom: 6px;">
                        <div class="form-group"><label class="col-sm-4 control-label">Lab Comments</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="labcomment">{{ $sample->labcomment ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <center>
                        <div class="col-sm-10 col-sm-offset-1">
                            <button class="btn btn-success" type="submit" name="submit_type" value="release">Save & Release sample</button>
                            <button class="btn btn-primary" type="submit" name="submit_type" value="add">Save & Add sample</button>
                            <button class="btn btn-danger" type="submit" formnovalidate name="submit_type" value="cancel">Cancel & Release</button>
                        </div>
                    </center>
                </div>
            </div>
        </div>

        {{ Form::close() }}

      </div>
    </div>

@endsection

@section('scripts')

    @component('/forms/scripts')
        @slot('js_scripts')
            <script src="{{ asset('js/datapicker/bootstrap-datepicker.js') }}"></script>
        @endslot


        @slot('val_rules')
           ,
            rules: {
                dob: {
                    lessThan: ["#datecollected", "Date of Birth", "Date Collected"]
                },
                datecollected: {
                    lessThan: ["#datedispatched", "Date Collected", "Date Dispatched From Facility"],
                    lessThanTwo: ["#datereceived", "Date Collected", "Date Received"]
                },
                datedispatched: {
                    lessThan: ["#datereceived", "Date Dispatched From Facility", "Date Received"]
                } 
                               
            }
        @endslot

        $(".date:not(#datedispatched)").datepicker({
            startView: 0,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            autoclose: true,
            endDate: new Date(),
            format: "yyyy-mm-dd"
        });

        $("#datedispatched").datepicker({
            startView: 0,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            autoclose: true,
            endDate: "+7d",
            format: "yyyy-mm-dd"
        });

        set_select_facility("facility_id", "{{ url('/facility/search') }}", 3, "Search for facility", false);
        set_select_facility("lab_id", "{{ url('/facility/search') }}", 3, "Search for facility", false);

    @endcomponent


    <script type="text/javascript">
        $(document).ready(function(){
            $("#rejection").hide();

            @if(isset($sample))                
                @if($sample->receivedstatus == 2)
                    $("#rejection").show();
                    $("#rejectedreason").removeAttr("disabled");
                    $('.requirable').removeAttr("required");
                @endif
            @else
                $("#medicalrecordno").change(function(){
                    var patient = $(this).val();
                    // console.log(patient);
                    // var facility = $("#facility_id").val();
                    check_new_patient(patient);
                });
            @endif

            $("#facility_id").change(function(){
                var val = $(this).val();

                if(val == 7148 || val == '7148'){
                    $('.requirable').removeAttr("required");
                }
                else{
                    $('.requirable').attr("required", "required");
                }
            }); 



            $("#receivedstatus").change(function(){
                var val = $(this).val();
                if(val == 2){
                    $("#rejection").show();
                    $("#rejectedreason").removeAttr("disabled");
                    $('.requirable').removeAttr("required");
                    // $("#rejectedreason").prop('disabled', false);
                }
                else{
                    $("#rejection").hide();
                    $("#rejectedreason").attr("disabled", "disabled");
                    $('.requirable').attr("required", "required");
                    // $("#enrollment_ccc_no").attr("disabled", "disabled");
                    // $("#rejectedreason").prop('disabled', true);

                }
            }); 

            $("#pcrtype").change(function(){
                var val = $(this).val();
                if(val == 4){
                    $("#enrollment_ccc_no").removeAttr("disabled");
                }
                else{
                    $("#enrollment_ccc_no").attr("disabled", "disabled");
                }
            }); 

        });

        function check_new_patient(patient){
            $.ajax({
               type: "POST",
               data: {
                patient : patient
               },
               url: "{{ url('/cd4/patient/new') }}",


                success: function(data){
                    data = JSON.parse(data);
                    if(data == null) {
                        ("#patient_name").val();
                        ("#dob").val();
                        ("#sex").val();
                        ("#hidden_patient").val();
                    } else {
                        $("#patient_name").val(data.patient_name);
                        $("#dob").val(data.dob);
                        $("#sex").val(data.sex).change();
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'patient_id',
                            value: patient.id,
                            id: 'hidden_patient',
                            class: 'patient_details'
                        }).appendTo("#samples_form");
                    }
                }
            });

        }
    </script>



@endsection
