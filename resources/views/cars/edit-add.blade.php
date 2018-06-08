@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
@stop

@section('content')


    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    
                    <div class="panel-heading">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Add New' }}@endif {{ $dataType->display_name_singular }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-edit-add" role="form"
                          action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('cars.store') }}@endif"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if(isset($dataTypeContent->id))
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                                
                        {{ csrf_field() }}

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Make</label>
                                <input type="text" class="form-control" name="Make"
                                    placeholder="Make" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Model</label>
                                <input type="text" class="form-control" name="Model"
                                    placeholder="Model" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Color</label>
                                <input type="text" class="form-control" name="Color"
                                    placeholder="Color" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Milage</label>
                                <input type="text" class="form-control" name="Milage"
                                    placeholder="Milage" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Year</label>
                                <input type="text" class="form-control" name="Year"
                                    placeholder="Year" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Type</label>
                                <input type="text" class="form-control" name="Type"
                                    placeholder="Type" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">Pricing</label>
                                <input type="text" class="form-control" name="Pricing"
                                    placeholder="$0" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">VIN Number</label>
                                <input type="text" class="form-control" name="VIN_Number"
                                    placeholder="VIN Number" id="title"
                                    value="@if(isset($dataTypeContent->title)){{ old('title', $dataTypeContent->title) }}@else{{old('title')}}@endif">
                            </div>



     {{--                       <div class="form-group">
                                <label for="image">Image</label>
                                @if(isset($dataTypeContent->image))
                                    <img src="{{ Voyager::image( $dataTypeContent->image ) }}"
                                         style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                @endif
                                <input type="file" name="image">
                            </div>
                             <div class="form-group">
                                <label for="podcast">Podcast</label>
                                @if(isset($dataTypeContent->podcast))
                                    <audio controls>
                                          <source src="@if( strpos($dataTypeContent->podcast, 'http://') === false && strpos($dataTypeContent->podcast, 'https://') === false){{ Voyager::image( $dataTypeContent->podcast ) }}@else{{ $dataTypeContent->podcast }}@endif" type="audio/mpeg">
                                          Your browser does not support the audio element.
                                    </audio> 

                                @endif
                                <input type="file" name="car">
                            </div>
                            <div class="form-group">
                                <label for="keywords">Keywords</label>
                                <textarea name="keywords" id="keywords" class="form-control" cols="50" rows="5">@if(isset($dataTypeContent->description)){{ old('description', $dataTypeContent->keywords) }}@else{{old('keywords')}}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="50" rows="5">@if(isset($dataTypeContent->description)){{ old('description', $dataTypeContent->description) }}@else{{old('description')}}@endif</textarea>
                            </div>                  --}}

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

               {{--     <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('cars.store') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input name="podcast" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form> --}}

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')

    <script type="text/javascript">
        $(function () {
            $('#birthday').datetimepicker({
                viewMode: 'days',
                format: 'YYYY/MM/DD'
            });
        });
    </script>

    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
@stop
