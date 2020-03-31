@extends('layouts.app')

@section('content')
    <div>
    <a class='btn btn-primary' href="{{route('admin.posts.create')}}">Create</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
                <th>User_id</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                     <td>{{$post->body}}</td>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td><a class='btn btn-primary' href="{{route('admin.posts.show', $post->slug)}}">View</a></td>
                    <td><a class='btn btn-primary' href="{{route('admin.posts.edit', $post)}}">Edit</a></td>
                    <td>
                        <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

