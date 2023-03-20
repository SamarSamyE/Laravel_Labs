@extends('layouts.app')

@section('content')
<form method="post" action="{{route('posts.update', $post->id)}}">
    @csrf
    @method('PUT')

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="text" name="title" value="{{ $post->title }}" class="form-control" id="exampleFormControlInput1">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $post->description }}</textarea>
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$post->user->name}}">
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
