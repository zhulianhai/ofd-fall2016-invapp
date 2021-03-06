@extends('layouts.app')
@section('crumbs')
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}">Dashboard</a></li>
    <li class="active">Vendors</li>
  </ol>
@endsection

@section('content')

    <div class="panel panel-default" hidden>
        <div class="panel-heading">
            Vendor Listing
        </div>

        <div class="panel-body">

            <a id="toolbar" href="{{ route('vendors.create') }}" class="btn btn-new"><i class="fa fa-plus" aria-hidden="true"></i></a>

            <table  data-toolbar="#toolbar"
                    data-toggle="table"  
                    data-search="true" 
                    data-cookie="true"
                    data-click-to-select="true"
                    data-cookie-id-table="vendor-v1.1-2"
                    data-show-columns="true"
                    id="table">

                <thead>
                    <tr>
                        <th data-sortable="true">Vendor Name</th>
                        <th>Address</th>
                        <th data-sortable="true">Website</th>
                        <th data-visible="false">Phone</th>
                        <th data-visible="false">Fax</th>
                        <th>Tech Support Phone</th>
                        <th>Rep Name</th>
                        <th>Rep Phone</th>
                        <th data-visible="false">Rep Cell</th>
                        <th>Email</th>
                        <th data-switchable="false" data-searchable="false" data-sortable="false">&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($vendors) > 0)
                        @foreach ($vendors as $vendor)
                            <tr data-entry-id="{{ $vendor->id }}">
                                
                                <td>{{ $vendor->vendor_name }}</td>
                                <td>{{ $vendor->vendor_address }}</td>
                                <td><a href="http://{{ $vendor->vendor_web }}" target="_blank">{{ $vendor->vendor_web }}</a></td>
                                <td><a href="tel:{{ $vendor->vendor_phone }}">{{ $vendor->vendor_phone }}</a></td>
                                <td>{{ $vendor->vendor_fax }}</td>
                                <td><a href="tel:{{ $vendor->vendor_tech_sup }}">{{ $vendor->vendor_tech_sup }}</a></td>
                                <td>{{ $vendor->vendor_rep }}</td>
                                <td><a href="tel:{{ $vendor->vendor_rep_phone }}">{{ $vendor->vendor_rep_phone }}</a></td>
                                <td><a href="tel:{{ $vendor->vendor_rep_phone_m }}">{{ $vendor->vendor_rep_phone_m }}</a></td>
                                <td><a href="mailto:{{ $vendor->vendor_email }}" target="_top">{{ $vendor->vendor_email }}</a></td>
                                <td>
                                    <div style="float: right;">
                                        <a href="{{ route('vendors.show',[$vendor->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{ route('vendors.edit',[$vendor->id]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a type="button" data-toggle="modal" data-target="#{{ $vendor->id }}" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
                                  </div>
                                  <div class="modal-body">
                                    Are you sure you want to delete {{ $vendor->vendor_name }}? This action cannot be undone.
                                  </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'route' => ['vendors.destroy', $vendor->id])) !!}
                                        {{Form::button('<i class="fa fa-trash"></i> DELETE', array('type' => 'submit', 'class' => 'btn btn-danger'))}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                              </div>
                            </div>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">No entries in table</td>
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
    window.route_mass_crud_entries_destroy = '{{ route('vendors.mass_destroy') }}';
</script>

@endsection