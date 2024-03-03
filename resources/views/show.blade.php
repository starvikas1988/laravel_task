@extends('layouts.app')

@section('title', $task->title)

@section('content')
  <p>{{ $task->description }}</p>

  @if ($task->long_description)
    <p>{{ $task->long_description }}</p>
  @endif

  {{-- Display the image --}}
 
  @if ($task->image_path)
    <img src="{{ asset($task->image_path) }}" alt="Uploaded Image" style="max-width: 200px; height: auto;">
@endif


  <p>{{ $task->created_at }}</p>
  <p>{{ $task->updated_at }}</p>
  <p>
    @if ($task->completed)
      Completed
    @else
      Not completed
    @endif
  </p>

  <div>
    {{-- second way --}}
    <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
      @csrf
      @method('PUT')
      <button type="submit">
        Mark as {{ $task->completed ? 'not completed' : 'completed' }}
      </button>
    </form>
  </div>

 
  
  <div>
    {{-- first way --}}
    <form action="{{ route('tasks.destroy',['id'=>$task->id])}}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </form>
  </div>
  <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">Edit</a>
  <a href="{{ route('tasks.index') }}">Home</a>
@endsection