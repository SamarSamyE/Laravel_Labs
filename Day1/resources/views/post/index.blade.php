@extends('layouts.app')


@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{route('posts.create')}}" class="mt-4 btn btn-success fs-4">Create Post</a>
    </div>
    <table class="table mt-4 container fs-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}}</td>

                <td style="display: flex; flex-direction:row; gap: 20px" >
                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-info fs-4">View</a>
                    <a href="{{route('posts.edit', $post->id)}}"  class="btn btn-primary fs-4">Edit</a>
                    <form method="post" action="{{route('posts.destroy', $post->id)}}"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger fs-4">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        {{ $posts->links('pagination::bootstrap-5') }}



        </tbody>
    </table>

@endsection

