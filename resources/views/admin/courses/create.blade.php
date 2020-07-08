@extends('admin.layouts.app')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.courses.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="body">Description</label>
                            <textarea class="form-control" rows="4" name="body" id="body">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="parent">Parent Category <span class="m-l-5 text-danger"> *</span></label>
                            <select id=category_id class="form-control custom-select mt-15 @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="0">Select category</option>
                                @foreach($categories as $key => $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="duration">Duration <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('duration') is-invalid @enderror" type="text" name="duration" id="duration" value="{{ old('duration') }}"/>
                            @error('duration') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="credits">Credits <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('credits') is-invalid @enderror" type="text" name="credits" id="credits" value="{{ old('credits') }}"/>
                            @error('credits') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="lectures">Lectures <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('lectures') is-invalid @enderror" type="text" name="lectures" id="lectures" value="{{ old('lectures') }}"/>
                            @error('duration') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="classdays">Class Days <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('classdays') is-invalid @enderror" type="text" name="classdays" id="classdays" value="{{ old('classdays') }}"/>
                            @error('classdays') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="classtiming">Class Timing <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('classtiming') is-invalid @enderror" type="text" name="classtiming" id="classtiming" value="{{ old('classtiming') }}"/>
                            @error('classtiming') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="seatsavailabity">Seats Availabity <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('seatsavailabity') is-invalid @enderror" type="text" name="seatsavailabity" id="seatsavailabity" value="{{ old('seatsavailabity') }}"/>
                            @error('seatsavailabity') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="active" name="active"/> Active
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Course Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.courses.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                    <input type="hidden" name="author_id" value="{{Auth::id()}}" >
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
