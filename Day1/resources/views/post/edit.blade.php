@extends('layouts.app')

@section('content')
<form method="post" action="{{route('posts.update', $post->id)}}" enctype="multipart/form-data">
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
<label for="exampleFormControlTextarea1" class="form-label">Image</label>
<input type="file" name="image" class="form-control" id="exampleFormControlTextarea1" rows="3">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$post->user->name}}">
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
