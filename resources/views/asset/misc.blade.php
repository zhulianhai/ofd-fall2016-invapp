{!! Form::open(['method' => 'POST', 'route' => ['all_assets.store']]) !!}
{!! Form::hidden('asset_type', 'misc', ['class' => 'form-control']) !!}

    <div class="row">
        <div class="col-xs-3 form-group">
            {!! Form::label('make', 'Make', ['class' => 'control-label']) !!}
            {!! Form::text('make', old('make'), ['class' => 'form-control']) !!}
        </div>
        <div class="col-xs-3 form-group">
            {!! Form::label('model', 'Model', ['class' => 'control-label']) !!}
            {!! Form::text('model', old('model'), ['class' => 'form-control']) !!}
        </div>
        <div class="col-xs-3 form-group">
            {!! Form::label('serial_number', 'Serial Number *', ['class' => 'control-label']) !!}
            {!! Form::text('serial_number', old('serial_number'), ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-xs-3 form-group">
            {!! Form::label('warranty_date', 'Warranty Date', ['class' => 'control-label']) !!}
            {!! Form::text('warranty_date', old('warranty_date'), ['class' => 'form-control date']) !!}
        </div>
    </div>

    <div class="row">
        {{--<div class="col-xs-3 form-group">--}}
            {{--{!! Form::label('ip_address', 'IP Address', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::text('ip_address', old('ip_address'), ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="col-xs-3 form-group">--}}
            {{--{!! Form::label('firmware_ver', 'Firmware Version', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::text('firmware_ver', old('firmware_ver'), ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="col-xs-3 form-group">--}}
            {{--{!! Form::label('radio_id', 'Radio ID', ['class' => 'control-label']) !!}--}}
            {{--{!! Form::text('radio_id', old('radio_id'), ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        <div class="col-xs-3 form-group">
        {!! Form::label('station_id', 'Assign to Station', ['class' => 'control-label']) !!}
        {!! Form::select('station_id', $stations, old('station_id'), ['class' => 'form-control']) !!}
        <p class="help-block"></p>
        @if($errors->has('station_id'))
            <p class="help-block">
                {{ $errors->first('station_id') }}
            </p>
        @endif
        </div>

        <div class="col-xs-3 form-group">
            {!! Form::label('vehicle_id', 'Assign to a vehicle', ['class' => 'control-label']) !!}
            {!! Form::select('vehicle_id', $vehicles, old('vehicle_id'), ['class' => 'form-control']) !!}
            <p class="help-block"></p>
            @if($errors->has('vehicle_id'))
                <p class="help-block">
                    {{ $errors->first('vehicle_id') }}
                </p>
            @endif
        </div>
        <div class="col-xs-3 form-group">
            {!! Form::label('status_id', 'Status', ['class' => 'control-label']) !!}
            {!! Form::select('status_id', $statuses, old('status_id'), ['class' => 'form-control']) !!}
            <p class="help-block"></p>
            @if($errors->has('status_id'))
                <p class="help-block">
                    {{ $errors->first('status_id') }}
                </p>
            @endif
        </div>
        <div class="col-xs-3 form-group">
            {!! Form::label('vendor_id', 'Vendor', ['class' => 'control-label']) !!}
            {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control']) !!}
            <p class="help-block"></p>
            @if($errors->has('vendor_id'))
                <p class="help-block">
                    {{ $errors->first('vendor_id') }}
                </p>
            @endif
        </div>
        <div class="col-xs-3 form-group">
            {!! Form::label('grant_id', 'Grant', ['class' => 'control-label']) !!}
            {!! Form::select('grant_id[]', $grants, old('grant_id'), [
                'id' => 'grants',
                'class' => 'form-control','multiple',
                ]) !!}

            <p class="help-block"></p>
            @if($errors->has('grant_id'))
                <p class="help-block">
                    {{ $errors->first('grant_id') }}
                </p>
            @endif
        </div>
        <div class="col-xs-6 form-group">
        {!! Form::label('comments', 'Comments', ['class' => 'control-label']) !!}
        {!! Form::textarea('comments', old('comments'), ['class' => 'form-control', 'size' => '30x4']) !!}
    </div>
    </div>
<div>
    {!! Form::submit('Create',['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    <a href="{{ route('all_assets.index') }}" class="btn btn-danger">Cancel</a>
</div>

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd"
        });
    </script>

@stop