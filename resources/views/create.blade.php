@extends('layouts.app')

@section('title','Add Tasks')

@section('styles')
  <style>
    .error-message {
      color: red;
      font-size: 0.8rem;
    }
  </style>
@endsection

@section('content')
{{-- {{$errors}} --}}
<form method="post" action="{{route('tasks.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title" class="control-label">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter Title" value="{{old('title')}}" />
        @error('title')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="description" class="control-label">Description</label>
        <textarea id="description" name="description" placeholder="Enter Description" rows="5">
            {{old('description')}}
        </textarea>
        @error('description')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="long_description" class="control-label">Long Description</label>
        <textarea id="long_description" name="long_description" placeholder="Enter Long Description" rows="5">
            {{old('long_description')}}
        </textarea>
        @error('long_description')
        <p class="error-message">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="image" class="control-label">Image</label>
        <input type="file" class="form-control" name="image" placeholder />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="submit" name="submit" />
    </div>

</form>
@endsection
