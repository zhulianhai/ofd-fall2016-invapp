@extends('layouts.app')
@section('crumbs')
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Dashboard</a></li>
    <li class="active">Vehicles</li>
  </ol>
@endsection


@section('content')

    <div class="panel panel-default" hidden>
        <div class="panel-heading">
            Vehicle Listing
        </div>
        <div class="panel-body">

            <a id="toolbar" href="{{ route('vehicles.create') }}" class="btn btn-new"><i class="fa fa-plus" aria-hidden="true"></i></a>

            
            <table  data-toolbar="#toolbar"
                    data-toggle="table"  
                    data-search="true" 
                    data-cookie="true"
                    data-click-to-select="true"
                    data-cookie-id-table="vehicles-index-v1.1-1"
                    data-show-columns="true"
                    id="table">
                <thead>
                    <tr>
                    {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}
                    <th data-sortable="true">OFD VAN #</th>
                    <th data-sortable="true">Vehicle #</th>
                    <th data-sortable="true">Make</th>
                    <th data-sortable="true">Model</th>
                    <th data-sortable="true">Year</th>
                    <th data-sortable="true">Type</th>
                    <th data-sortable="true">Status</th>
                    <th data-sortable="true">Location</th>
                    {{--<th data-sortable="true">Grants</th>--}}
                    <th data-switchable="false" data-searchable="false" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($vehicles) > 0)
                        @foreach ($vehicles as $vehicle)
                            <tr data-entry-id="{{ $vehicle->id }}">
                        <td>{{ $vehicle->van }}</td>
                        <td>{{ $vehicle->vehicle_number }}</td>
                        <td>{{ $vehicle->make }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>{{ $vehicle->unittype->name or '' }}</td>
                        <td>{{ $vehicle->status->status or '' }}</td>
                        <td>{{ $vehicle->station->station_name or '' }}</td>
                        {{--<td>--}}
                            {{--{{ $vehicle->grant_name or '' }}--}}
                        {{--</td>--}}
                        
                        <td>
                            <div style="float: right;">
                                <a href="{{ route('vehicles.show',[$vehicle->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{ route('vehicles.edit',[$vehicle->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a type="button" data-toggle="modal" data-target="#{{ $vehicle->van }}" class="btn btn-xs btn-danger"><i class="fa fa-bell-slash" aria-hidden="true"></i></a>
                            </div>
                        </td>
                        </tr>


                        <div class="modal fade" id="{{ $vehicle->van }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Warning</h4>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to deactivate vehicle with VAN #{{ $vehicle->van }}? This action can be undone.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'route' => ['vehicles.destroy', $vehicle->id])) !!}
                                {{Form::button('<i class="fa fa-bell-slash"></i> DEACTIVATE', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">No entries in table</td>
                        </tr>
                    @endif
                </tbody>
            </table>




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

    $('#table').bootstrapTable({
        classes: 'table table-responsive table-no-bordered table-striped table-hover',
        iconsPrefix: 'fa',
        cookie: true,
        cookieExpire: '2y',
        mobileResponsive: true,
        sortable: true,
        pagination: true,
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
    $(".panel").fadeIn("fast");

</script>

<script>
    window.route_mass_crud_entries_destroy = '{{ route('vehicles.mass_destroy') }}';
</script>

@endsection