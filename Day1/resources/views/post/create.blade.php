@extends('layouts.app')
@section('content')
<form method="post" action="{{route('posts.store')}}">
    @csrf
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" >
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" >
</div>
<button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
