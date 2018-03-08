@extends('layouts.master')

    @component('/tables/css')
    @endcomponent

@section('content')

<div class="normalheader ">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="#">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>

            <div id="hbreadcrumb" class="pull-right m-t-lg">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index-2.html">Dashboard</a></li>
                    <li>
                        <span>Tables</span>
                    </li>
                    <li class="active">
                        <span>DataTables</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                DataTables
            </h2>
            <small>Advanced interaction controls to any HTML table</small>
        </div>
    </div>
</div>
 
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Batches Awaiting Dispatch
                </div>
                <div class="panel-body">
                    <form  method="post" action="{{ url('viralbatch/complete_dispatch') }}  " name="worksheetform"  onSubmit="return confirm('Are you sure you want to dispatch the selected batches?');" >
                        {{ csrf_field() }}

                        <table class="table table-striped table-bordered table-hover data-table" >
                            <thead>
                                <tr>
                                    <th> Check </th>
                                    <th> Batch No </th>
                                    <th> Facility </th>
                                    <th> Email Address </th>
                                    <th> Date Received </th>
                                    <th> Date Entered </th>
                                    <th> Delay(days) </th>  
                                    <th> No. of Samples </th>
                                    <th> Rejected </th>
                                    <th> Results </th>
                                    <th> No Results </th>
                                    <th> Redraw </th>
                                    <th> Status </th>
                                    <th> Task </th>            
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    echo $rows;
                                @endphp 
                            </tbody>
                        </table>

                        <input type="submit" name="Proceed to Confirm Selected Dispatch ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts') 

    @component('/tables/scripts')

    @endcomponent

@endsection