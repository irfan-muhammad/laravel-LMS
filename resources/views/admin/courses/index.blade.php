@extends('admin.layouts.app')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary pull-right">Add Course</a>
    </div>
    <?php $counter = 0;?>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>


                                <th class="text-center"> Title </th>
                                <th class="text-center"> Category </th>
                                <th class="text-center"> Duration </th>
                                <th class="text-center"> credits </th>
                                <th class="text-center"> lectures </th>
                                <th class="text-center"> classdays </th>
                                <th class="text-center"> Active </th>

                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)

                                <?php $counter++;?>
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td class="text-center">{{ $course->title }}</td>
                                        <td class="text-center">{{ $course->category->name }}</td>
                                        <td class="text-center">{{ $course->duration }}</td>


                                        <td class="text-center">{{ $course->credits}}</td>
                                        <td class="text-center">{{ $course->lectures}}</td>
                                        <td class="text-center">{{ $course->classdays}}</td>

                                        <td class="text-center">
                                            @if ($course->active == 1)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="{{ route('admin.topics.index', $course->id) }}" class="btn btn-sm btn-primary">Topics</a>
                                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('admin.courses.delete', $course->id) }}" class="btn btn-sm btn-danger">Delete</a>
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
