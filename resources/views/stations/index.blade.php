@extends('layouts.app')
@section('crumbs')
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Dashboard</a></li>
    <li class="active">Stations</li>
  </ol>
@endsection


@section('content')

    <div class="panel panel-default panel-shadow" hidden>
        <div class="panel-heading">
            Station Listing
        </div>

        <div class="panel-body">
            <a id="toolbar" href="{{ route('stations.create') }}" class="btn btn-new"><i class="fa fa-plus" aria-hidden="true"></i></a>

            <table  data-toolbar="#toolbar"
                    data-toggle="table"  
                    data-search="true" 
                    data-cookie="true"
                    data-click-to-select="true"
                    data-cookie-id-table="station-index-v1.1-1"
                    data-show-columns="true"
                    id="table">
                    <thead>
                        <tr>
                            <th data-sortable="true">Name</th>
                            <th data-sortable="true">Number</th>
                            <th data-sortable="true">Date</th>
                            <th data-sortable="true">Address</th>
                            <th data-sortable="true">City</th>
                            <th data-sortable="true">Zipcode</th>
                            <th data-sortable="true">Battalion</th>
                            <th data-switchable="false" data-searchable="false" data-sortable="false">&nbsp;</th>

                        </tr>
                    </thead>
                <tbody>
                @if(count($stations) > 0)
                    @foreach($stations as $station)
                        <tr>
                        <td>{{ $station->station_name }}</td>
                        <td>{{ $station->station_number }}</td>
                        <td>{{ $station->station_date }}</td>
                        <td>{{ $station->address }}</td>
                        <td>{{ $station->city }}</td>
                        <td>{{ $station->zipcode }}</td>
                        <td>{{ $station->district }}</td>
                        
                        <td>
                            <div style="float: right;">
                                <a href="{{ route('stations.show',[$station->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{ route('stations.edit',[$station->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a type="button" data-toggle="modal" data-target="#{{ $station->station_number }}" class="btn btn-xs btn-danger"><i class="fa fa-bell-slash" aria-hidden="true"></i></a>
                            </div>
                        </td>
                        </tr>


                        <div class="modal fade" id="{{ $station->station_number }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Warning</h4>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to deactivate {{ $station->station_name }}? Before deactivating please reassign related units and assets. You can restore deactivated station.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'route' => ['stations.destroy', $station->id])) !!}
                                {{Form::button('<i class="fa fa-bell-slash"></i> DEACTIVATE', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">No entries in table</td>
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

@endsection