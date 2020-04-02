@extends('layouts.app')

@section('content')
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
                <tr>
                    <td><img src="{{asset('storage/' . $post->img)}}" alt=""></td>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                </tr>
        </tbody>
    </table>

    <div class="form-group">
        <h2 class="ml-4">Commenti: </h2>
    @forelse ($post->comments as $comment)
        <ul>
            <li>Nome: {{$comment->name}}</li>
            <li>Titolo: {{$comment->title}}</li>
            <li>Email: {{$comment->email}}</li>
            <li>Commento: {{$comment->body}}</li>
        </ul>
    @empty
        <h5 class="ml-4">Nessun commento</h5>
    @endforelse
    </div>

@endsection

