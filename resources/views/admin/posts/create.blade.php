@extends('layouts.app')

@section('content')
    <form action="{{route('admin.posts.store')}}" method="post">
        @csrf
        @method('POST')
        <label for="">title</label>
        <input type="text" name="title" placeholder="title">
        <label for="">text</label>
        <textarea name="body" id="" cols="30" rows="10"></textarea>
        <button type="submit">Salva</button>
    </form>
@endsection


