@extends('layouts.app')

@section('content')
    <form action="{{route('admin.posts.update',$post)}}" method="post">
        @csrf
        @method('PATCH')
        <label for="">title</label>
        <input type="text" name="title" placeholder="title" value='{{$post->title}}'>
        <label for="">text</label>
    <textarea name="body" id="" cols="30" rows="10">{{$post->body}}</textarea>
        <button type="submit">Salva</button>
    </form>
@endsection


