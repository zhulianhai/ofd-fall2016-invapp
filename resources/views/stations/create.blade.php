@extends('layouts.app')
@section('crumbs')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Dashboard</a></li>
        <li><a href="{{ route('stations.index') }}">Stations</a></li>
        <li class="active">Create</li>
    </ol>
@endsection
@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['stations.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Create Station
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('station_name', 'Station Name', ['class' => 'control-label']) !!}
                    {!! Form::text('station_name', old('station_name'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('station_name'))
                        <p class="help-block">
                            {{ $errors->first('station_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('station_number', 'Number', ['class' => 'control-label']) !!}
                    {!! Form::number('station_number', old('station_number'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('station_number'))
                        <p class="help-block">
                            {{ $errors->first('station_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('station_date', 'Date', ['class' => 'control-label']) !!}
                    {!! Form::text('station_date', old('station_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('station_date'))
                        <p class="help-block">
                            {{ $errors->first('station_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('zipcode', 'Zipcode', ['class' => 'control-label']) !!}
                    {!! Form::number('zipcode', old('zipcode'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('zipcode'))
                        <p class="help-block">
                            {{ $errors->first('zipcode') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('district', 'District', ['class' => 'control-label']) !!}
                    {!! Form::text('district', old('district'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('district'))
                        <p class="help-block">
                            {{ $errors->first('district') }}
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
                    {!! Form::select('grant_id', $grants, old('grant_id'), [
                        'id' => 'grants',
                        'class' => 'form-control',
                        ]) !!}

                    <p class="help-block"></p>
                    @if($errors->has('grant_id'))
                        <p class="help-block">
                            {{ $errors->first('grant_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('station_document', 'Related Document', ['class' => 'control-label']) !!}
                    {!! Form::file('station_document', old('station_document'), ['class' => 'form-control']) !!}
                    {!! Form::hidden('station_document_max_size', 20) !!}
                    <p class="help-block">up to 20mb</p>
                    @if($errors->has('station_document'))
                        <p class="help-block">
                            {{ $errors->first('station_document') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('station_image', 'Related Photo', ['class' => 'control-label']) !!}
                    {!! Form::file('station_image', old('station_image'), ['class' => 'form-control']) !!}
                    {!! Form::hidden('station_image_max_size', 20) !!}
                    {!! Form::hidden('station_image_max_width', 5000) !!}
                    {!! Form::hidden('station_image_max_height', 5000) !!}
                    <p class="help-block">up to 20mb</p>
                    @if($errors->has('station_image'))
                        <p class="help-block">
                            {{ $errors->first('station_image') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::submit('Create',['class' => 'btn btn-success']) !!}
            <a href="{{ route('stations.index') }}" class="btn btn-default">Cancel</a>
        </div>
    </div>

    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd"
        });
    </script>

@stop