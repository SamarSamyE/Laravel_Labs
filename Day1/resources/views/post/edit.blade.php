@extends('layouts.app')

@section('content')
<form method="post" action="{{route('posts.store')}}">
    @csrf

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="SolidPrinciple">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Description</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="in this post we will know about solidPrinciple"></textarea>
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Solid">
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
