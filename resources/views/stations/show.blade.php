@extends('layouts.app')
@section('crumbs')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Dashboard</a></li>
        <li><a href="{{ route('stations.index') }}">Stations</a></li>
        <li class="active">Station {{ $station->station_number }}</li>
    </ol>
@endsection

@section('content')
    {!! Form::model($station,['method' => 'PUT', 'route' => ['stations.reassign', $station->id], 'files' => true,]) !!}
    <div class="col-md-12">
        <div class="col-md-4 nopadding">
            <div class="panel panel-default panel-border">
                <div class="panel-heading">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Information
                </div>
                <div class="panel-body" style="height:150px;">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td>{{ $station->station_name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $station->station_date }}</td>
                    </tr>
                    <tr>
                        <th>Battalion</th>
                        <td>{{ $station->district }}</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 nopadding">
            <div class="panel panel-default panel-border">
                <div class="panel-heading">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Address
                </div>

                <div class="panel-body" style="height:150px;">
                    <table class="table">
                    <tr>
                        <th>Address</th>
                        <td>{{ $station->address }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $station->city }}</td>
                    </tr>
                    <tr>
                        <th>Zipcode</th>
                        <td>{{ $station->zipcode }}</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 nopadding">
            <div class="panel panel-default panel-border">
                <div class="panel-heading">
                    <i class="fa fa-file" aria-hidden="true"></i> Documents
                </div>

                <div class="panel-body" style="height:150px;">
                    <table class="table">
                    <tr>
                        <th>Related Document</th>
                        <td><a href="{{ asset('uploads/'.$station->station_document) }}">Download file</a></td>
                    </tr>
                    <tr>
                        <th>Related Photo</th>
                        <td>@if($station->station_image!= '')<img src="{{ asset('uploads/thumb/'.$station->station_image) }}">@endif</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>

        <div id="exTab3" class="pill-container" >
            <ul  class="nav nav-pills">
                <li class="active">
                    <a href="#1b" data-toggle="tab">Vehicles</a>
                </li>
                <li>
                    <a href="#2b" data-toggle="tab">Assets</a>
                </li>
                <li>
                    <a href="#3b" data-toggle="tab">History</a>
                </li>
            </ul>
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1b">
                    <table
                            data-toggle="table"
                            data-search="true"
                            data-cookie="true"
                            data-click-to-select="true"
                            data-cookie-id-table="station-vehicles-v1.1-1"
                            data-show-columns="true"
                            id="table-station-vehicles">
                        <thead>
                        <tr>
                            <th data-sortable="true">Vehicle Number</th>
                            <th data-sortable="true">OFD VAN Number</th>
                            <th data-sortable="true">Make</th>
                            <th data-sortable="true">Model</th>
                            <th data-sortable="true">Year</th>
                            <th data-sortable="true">Type</th>
                            <th data-sortable="true">Status</th>
                            <th data-switchable="false" data-searchable="false" data-sortable="false">&nbsp;</th>

                        </tr>
                        </thead>
                        <tbody>
                            @foreach($station->vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->vehicle_number }}</td>
                                    <td>{{ $vehicle->van }}</td>
                                    <td>{{ $vehicle->make }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->year }}</td>
                                    <td>{{ $vehicle->unittype->name or '' }}</td>
                                    <td>{{ $vehicle->status->status or '' }}</td>
                                    <td>
                                        <div style="float: right;">
                                            <a href="{{ route('vehicles.show',[$vehicle->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="{{ route('vehicles.edit',[$vehicle->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
                <div class="tab-pane" id="2b">
                    <div class="input-group" style="width: 250px;" id="toolbar">
                        {!! Form::select('station_id', $restations, old('station_id'), ['class' => 'form-control']) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('Reassign',['class' => 'btn btn-default reassign-commit']) !!}
                        </span>
                    </div>
                    <table  data-toolbar="#toolbar"
                            data-toggle="table"
                            data-search="true"
                            data-cookie="true"
                            data-click-to-select="true"
                            data-cookie-id-table="station-assets-v1.1-1"
                            data-show-columns="true"
                            id="table-station-assets">
                        <thead>
                        <tr>
                            <th data-class="hidden-xs" data-switchable="false" data-searchable="false" data-sortable="false" data-field="checkbox"><input type="checkbox" id="checkAll" class="checkbox-rows"></th>
                            <th data-sortable="true">Asset Type</th>
                            <th data-sortable="true">Asset Name</th>
                            <th data-sortable="true" data-visible="false">Model</th>
                            <th data-sortable="true">Make</th>
                            <th data-sortable="true" data-visible="false">Manufacturer</th>
                            <th data-sortable="true">Serial Number</th>
                            <th data-sortable="true" data-visible="false">Date Purchased</th>
                            <th data-sortable="true" data-visible="false">Warranty Date</th>
                            <th data-sortable="true">Cost</th>
                            <th data-sortable="true" data-visible="false">Comments</th>
                            <th data-sortable="true">Status</th>
                            <th data-sortable="true">Location</th>
                            <th data-switchable="false" data-searchable="false" data-sortable="false">&nbsp;</th>

                        </tr>
                        </thead>
                        <tbody>
                                @foreach($station->allassets as $all_asset)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox-rows" id="reassignids" name="reassignval[]" value="{{$all_asset->id}}" ></td>
                                        <td>{{ $all_asset->asset_type }}</td>
                                        <td>{{ $all_asset->name }}</td>
                                        <td>{{ $all_asset->model }}</td>
                                        <td>{{ $all_asset->make }}</td>
                                        <td>{{ $all_asset->manu }}</td>
                                        <td>{{ $all_asset->serial_number }}</td>
                                        <td>{{ $all_asset->date_purchased }}</td>
                                        <td>{{ $all_asset->warranty_date }}</td>
                                        <td>{{ $all_asset->cost }}</td>
                                        <td>{{ $all_asset->comments }}</td>
                                        <td>{{ $all_asset->status->status or '' }}</td>
                                        <td>{{ $all_asset->station->station_number or '' }}</td>
                                        <td>
                                            <div style="float: right;">
                                                <a href="{{ route('all_assets.show',[$all_asset->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('all_assets.edit',[$all_asset->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>

                </div>
                <div class="tab-pane" id="3b">
                    <table data-toggle="table"
                            data-search="true"
                            data-cookie="true"
                            data-click-to-select="true"
                            data-cookie-id-table="station-history-v1.1-1"
                            data-show-columns="true"
                            id="table-station-history">
                        <thead>

                        <tr>
                            <th data-sortable="true">Updated On</th>
                            <th data-sortable="true">Station Name</th>
                            <th data-sortable="true">Station Number</th>
                            <th data-sortable="true">Date</th>
                            <th data-sortable="true">Address</th>
                            <th data-sortable="true">City</th>
                            <th data-sortable="true">Zipcode</th>
                            <th data-sortable="true">District</th>
                            <th data-sortable="true" data-visible="false">Vender</th>
                            <th data-sortable="true" data-visible="false">Grant</th>
                        </tr>
                        </thead>
                        <tbody>
                       @foreach($stationhis2 as $stationhis)
                            <tr>
                                <td>{{ $stationhis->created_at }}</td>
                                <td>{{ $stationhis->station_name }}</td>
                                <td>{{ $stationhis->station_number }}</td>
                                <td>{{ $stationhis->station_date }}</td>
                                <td>{{ $stationhis->address }}</td>
                                <td>{{ $stationhis->city }}</td>
                                <td>{{ $stationhis->zipcode }}</td>
                                <td>{{ $stationhis->district }}</td>
                                <td>{{ $stationhis->vender }}</td>
                                <td>{{ $stationhis->grant }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

<script src="{{ url('js/extensions/cookie') }}/bootstrap-table-cookie.js"></script>
<script src="{{ url('js/extensions/mobile') }}/bootstrap-table-mobile.js"></script>

<script src="{{ url('js/export') }}/bootstrap-table-export.js"></script>
<script src="{{ url('js/export') }}/tableExport.js"></script>
<script src="{{ url('js/export') }}/jquery.base64.js"></script>

<script type="text/javascript">

    $('#table-station-assets').bootstrapTable({
        classes: 'table table-responsive table-no-bordered table-striped table-hover',
        iconsPrefix: 'fa',
        cookie: true,
        cookieExpire: '2y',
        mobileResponsive: true,
        sortable: true,
        showExport: true,
        showColumns: true,
        exportTypes: ['csv', 'excel'],
        pageList: ['10','25','50','100','150','200','500','1000'],
        exportOptions: {
            fileName: 'assets-export-' + (new Date()).toISOString().slice(0,10),
        },
        icons: {
            paginationSwitchDown: 'fa-caret-square-o-down',
            paginationSwitchUp: 'fa-caret-square-o-up',
            sort: 'fa fa-sort-amount-desc',
            plus: 'fa fa-plus',
            minus: 'fa fa-minus',
            columns: 'fa-columns',
            refresh: 'fa-refresh'
        },
    });

    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });

    $('#table-station-vehicles').bootstrapTable({
        classes: 'table table-responsive table-no-bordered table-striped table-hover',
        iconsPrefix: 'fa',
        cookie: true,
        cookieExpire: '2y',
        mobileResponsive: true,
        sortable: true,
        showExport: true,
        showColumns: true,
        exportTypes: ['csv', 'excel'],
        pageList: ['10','25','50','100','150','200','500','1000'],
        exportOptions: {
            fileName: 'assets-export-' + (new Date()).toISOString().slice(0,10),
        },
        icons: {
            paginationSwitchDown: 'fa-caret-square-o-down',
            paginationSwitchUp: 'fa-caret-square-o-up',
            sort: 'fa fa-sort-amount-desc',
            plus: 'fa fa-plus',
            minus: 'fa fa-minus',
            columns: 'fa-columns',
            refresh: 'fa-refresh'
        },
    });

    $('#table-station-history').bootstrapTable({
        classes: 'table table-responsive table-no-bordered table-striped table-hover',
        iconsPrefix: 'fa',
        cookie: true,
        cookieExpire: '2y',
        mobileResponsive: true,
        sortable: true,
        showExport: true,
        showColumns: true,
        exportTypes: ['csv', 'excel'],
        pageList: ['10','25','50','100','150','200','500','1000'],
        exportOptions: {
            fileName: 'assets-export-' + (new Date()).toISOString().slice(0,10),
        },
        icons: {
            paginationSwitchDown: 'fa-caret-square-o-down',
            paginationSwitchUp: 'fa-caret-square-o-up',
            sort: 'fa fa-sort-amount-desc',
            plus: 'fa fa-plus',
            minus: 'fa fa-minus',
            columns: 'fa-columns',
            refresh: 'fa-refresh'
        },
    });

    // $(".reassign-commit").click( function () {
    //     console.log("check if boxs are checked");
    //     $("#reassignids").each( function () {
    //         if($("#reassignids").prop('checked') !== true){
    //             return;
    //         } 
    //     });
    //     $( "form" ).submit(function( event ) { 
    //         return;
    //     });
    // });
</script>

@endsection