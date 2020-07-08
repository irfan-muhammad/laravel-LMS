@extends('admin.layouts.app')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.lessons.create', $targetTopic->id) }}" class="btn btn-primary pull-right">Add Lesson</a>
        <a class="btn btn-secondary" href="{{ route('admin.topics.index', $targetTopic->course_id) }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
    </div>
    <?php $counter = 0;?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <strong>{{$targetTopic->title}}</strong>
                <p>{{$targetTopic->body}}</p>


                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>


                                <th class="text-center"> Title </th>

                                <th class="text-center"> Author </th>

                                <th class="text-center"> Active </th>

                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessons as $lesson)
                                <?php $counter++;?>
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td class="text-center">{{ $lesson->title }}</td>

                                        <td class="text-center">{{ $lesson->author->name}}</td>
                                        <td class="text-center">
                                            @if ($lesson->active == 1)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">

                                                <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('admin.lessons.delete', $lesson->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
