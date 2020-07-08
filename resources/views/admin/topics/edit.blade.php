@extends('admin.layouts.app')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mx-auto">

            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                @include('admin.partials.flash')
                <form action="{{ route('admin.topics.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetTopic->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetTopic->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="body">Description</label>
                            <textarea class="form-control" rows="4" name="body" id="body">{{ old('body', $targetTopic->body) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="parent">Course <span class="m-l-5 text-danger"> *</span></label>
                            <select id=course_id class="form-control custom-select mt-15 @error('course_id') is-invalid @enderror" name="course_id">
                                <option value="0">Select category</option>
                                @foreach($courses as $key => $course)

                                    @if ($targetTopic->course_id == $course->id)
                                        <option value="{{ $course->id }}" selected> {{ $course->title }} </option>
                                    @else
                                        <option value="{{ $course->id }}"> {{ $course->title }} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="active" name="active"
                                    {{ $targetTopic->active == 1 ? 'checked' : '' }}
                                    />Active
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Topic</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.topics.index', $targetTopic->course_id) }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                    <input type="hidden" name="author_id" value="{{ old('author_id', $targetTopic->author_id) }}" >
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
