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
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                </tr>
        </tbody>
    </table>

    <div class="comments">
        {{-- <a href="{{route()}}"></a> --}}
        @forelse ($post->comments as $comment)
            <ul>
                <li>Scritto da: {{$comment->name}}</li>
                <li>Title: {{$comment->body}}</li>
                <li>Title: {{$comment->updated_at}}</li>
            </ul>
        @empty
            {{-- <p>Non ci sono coomenti</p> --}}
        @endforelse
    </div>

@endsection

