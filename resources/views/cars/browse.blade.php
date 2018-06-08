@extends('voyager::master')

@section('page_header')
    <a href="{{ route('cars.index') }}" class="btn btn-info" style="margin-left: 30px"> 
                <i class="voyager-angle-left"></i>Back
        </a>
    <h1 class="page-title" style="padding-left: 10px">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
         {{-- @if (Voyager::can('add_'.$dataType->name)) --}}
            <a href="{{ route('cars.create') }}" class="btn btn-success">
                <i class="voyager-plus"></i> Add New
            </a>

            

        {{-- @endif --}}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Milage</th>
                                    <th>Year</th>
                                    <th>Type</th>
                                    <th>Pricing</th>
                                    <th>VIN Number</th>
                                    <th class="actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $podcast)
                                <tr>
                                    <td>
                                        {{$podcast->id}}
                                    </td>
                                    <td>
                                        {{$podcast->Make}}
                                    </td>
 {{--                                   <td>
                                        <img src="@if( strpos($podcast->image, 'http://') === false && strpos($podcast->image, 'https://') === false){{ Voyager::image( $podcast->image ) }}@else{{ $podcast->image }}@endif" style="width:150px">
                                    </td>
                                    <td>
                                        <audio controls>
                                          <source src="@if( strpos($podcast->podcast, 'http://') === false && strpos($podcast->podcast, 'https://') === false){{ Voyager::image( $podcast->podcast ) }}@else{{ $podcast->podcast }}@endif" type="audio/mpeg">
                                          Your browser does not support the audio element.
                                        </audio> 
                                    </td>
                                    --}}
                                    <td>
                                        {{$podcast->Model}}
                                    </td>
                                    <td>
                                        {{$podcast->Color}}
                                    </td>
                                    <td>
                                        {{$podcast->Milage}}
                                    </td>
                                    <td>
                                        {{$podcast->Year}}
                                    </td>
                                    <td>
                                        {{$podcast->Type}}
                                    </td>
                                    <td>
                                        {{$podcast->Pricing}}
                                    </td>
                                    <td>
                                        {{$podcast->VIN_Number}}
                                    </td>

                                    <td class="no-sort no-click" >
                                    {{-- @if (Voyager::can('delete_'.$dataType->name)) --}}
                                        <div class="btn-sm btn-danger pull-left delete" data-id="{{ $podcast->id }}" id="delete-{{ $podcast->id }}">
                                            <i class="voyager-trash"></i> 
                                        </div>
                                    {{-- @endif --}}
                                    {{-- @if (Voyager::can('edit_'.$dataType->name)) --}}
                                        <a href="{{ route('voyager.'.$dataType->slug.'.edit', $podcast->id) }}" class="btn-sm btn-primary pull-left edit">
                                            <i class="voyager-edit"></i> 
                                        </a>
                                    {{-- @endif --}}
                                    
                                </td>
                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if (isset($dataType->server_side) && $dataType->server_side)
                            <div class="pull-left">
                                <div role="status" class="show-res" aria-live="polite">Showing {{ $dataTypeContent->firstItem() }} to {{ $dataTypeContent->lastItem() }} of {{ $dataTypeContent->total() }} entries</div>
                            </div>
                            <div class="pull-right">
                                {{ $dataTypeContent->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this {{ $dataType->display_name_singular }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                 value="Yes, Delete This {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    <!-- DataTables -->
    <script>
        @if (!$dataType->server_side)
            $(document).ready(function () {
                $('#dataTable').DataTable({ "order": [] });
            });
        @endif

        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(this).data('id'));

            $('#delete_modal').modal('show');
        });

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
@stop
