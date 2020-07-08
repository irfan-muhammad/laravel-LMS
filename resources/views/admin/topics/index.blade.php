@extends('admin.layouts.app')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.topics.create', $targetCourse->id) }}" class="btn btn-primary pull-right">Add Topic</a>
        <a class="btn btn-secondary" href="{{ route('admin.courses.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
    </div>
    <?php $counter = 0;?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <strong>{{$targetCourse->title}}</strong>
                <p>{{$targetCourse->body}}</p>


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
                            @foreach($topics as $topic)
                                <?php $counter++;?>
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td class="text-center">{{ $topic->title }}</td>

                                        <td class="text-center">{{ $topic->author->name}}</td>
                                        <td class="text-center">
                                            @if ($topic->active == 1)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="{{ route('admin.lessons.index', $topic->id) }}" class="btn btn-sm btn-primary">Lessons</a>
                                                <a href="{{ route('admin.topics.edit', $topic->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('admin.topics.delete', $topic->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
