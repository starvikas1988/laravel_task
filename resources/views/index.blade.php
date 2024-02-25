
@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')

<div>
  <a href="{{ route('tasks.create') }}">Add Task!</a>
</div>

  @forelse ($tasks as $key=> $task)
    <div>
    <p> Serial No: {{$key+1 }}</p>
    <p> Task: {{ $task->title }}</p>
    <p>Description: {{ $task->description }}</p>
    <p>Long Description: {{ $task->long_description }}</p>
    <p>Status: {{ ($task->completed)? 'Completed':'Incomplete' }}</p>
    <p>Created At: {{ $task->created_at }}</p>
    <p>Updated At: {{ $task->updated_at }}</p>
    
     <!-- View link -->
    <a href="{{ route('tasks.show', ['id' => $task->id]) }}">View</a>

  <!-- Edit link -->
    <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">Edit</a>
    <p>-----------------------------------------------------</p>
      
    </div>
  @empty
    <div>There are no tasks!</div>
  @endforelse

  @if ($tasks->count())
    <nav>
      {{ $tasks->links() }}
    </nav>
  @endif

@endsection