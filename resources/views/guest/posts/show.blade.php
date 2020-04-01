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
        <h2 class="ml-4">Commenti:</h2>

        @forelse ($post->comments as $comment)
            <ul>
                <li>Scritto da: {{$comment->name}}</li>
                <li>Titolo: {{$comment->title}}</li>
                <li>Email: {{$comment->email}}</li>
                <li>Caricato il: {{$comment->updated_at}}</li>
                <li>Commento: {{$comment->body}}</li>
            </ul>
        @empty
            {{-- <h1>Non ci sono coomenti</h1> --}}
        @endforelse
                <h2 class="ml-4">Scrivi un commento:</h2>
                
            <form class="p-4" action="{{route('comment.store')}}" method="post">
        @csrf
        @method('POST')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="name">
                 </div>
                 <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" placeholder="title">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input class="form-control" type="text" name="email" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="body">text</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                </div>

                    <input type="hidden" name="post_id" value="{{$post->id}}">
                    {{-- <input type="hidden" name="slug" value=" {{$post->slug}} "> --}}

                    <button class="btn btn-primary" type="submit">Salva</button>
               
            </form>
    </div>

@endsection

