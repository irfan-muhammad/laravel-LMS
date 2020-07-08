@extends('admin.layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mx-auto">
        @include('admin.partials.flash')
        <div class="tile">
            <h3 class="tile-title">{{ $subTitle }}</h3>
            <strong>{{$targetTopic->title}}</strong>
            <form action="{{ route('admin.lessons.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="title">Name <span class="m-l-5 text-danger"> *</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" value="{{ old('title') }}" />
                        @error('title') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="body">Description</label>
                        <textarea class="form-control" rows="4" name="body" id="body">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="topic_id">Course <span class="m-l-5 text-danger"> *</span></label>
                        <select id=topic_id
                            class="form-control custom-select mt-15 @error('topic_id') is-invalid @enderror"
                            name="topic_id">
                            <option value="0">Select Course</option>
                            @foreach($topics as $key => $topic)
                            @if ($targetTopic->id == $topic->id)
                            <option value="{{ $topic->id }}" selected> {{ $topic->title }} </option>
                            <option value="{{ $topic->id }}"> {{ $topic->title }} </option>


                            @else

                            @endif

                            @endforeach
                        </select>
                        @error('topic_id') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="videourl">Video URL <span class="m-l-5 text-danger">
                                *</span></label>
                        <input class="form-control @error('videourl') is-invalid @enderror" type="text" name="videourl"
                            id="videourl" value="{{ old('videourl') }}" />
                        @error('videourl') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="active" name="active" /> Active
                            </label>
                        </div>
                    </div>

                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                        Topic</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('admin.courses.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
                <input type="hidden" name="author_id" value="{{Auth::id()}}">
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
