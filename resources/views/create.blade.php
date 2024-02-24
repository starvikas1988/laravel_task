@extends('layouts.app')

@section('title','Add Tasks')

@section('content')
{{$errors}}
<form method="post" action="{{route('tasks.store')}}">
    @csrf
    <div class="form-group">
        <label for="title" class="control-label">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter Title" />
    </div>

    <div class="form-group">
        <label for="description" class="control-label">Description</label>
        <textarea id="description" name="description" placeholder="Enter Description" rows="5">

        </textarea>
    </div>

    <div class="form-group">
        <label for="long_description" class="control-label">Long Description</label>
        <textarea id="long_description" name="long_description" placeholder="Enter Long Description" rows="5">
            
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="submit" name="submit" />
    </div>

</form>
@endsection
