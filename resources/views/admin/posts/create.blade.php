@extends('layouts.app')

@section('content')
            <form class="p-4" action="{{route('admin.posts.store')}}" method="post">
        @csrf
        @method('POST')
                <div class="form-group">
                    <label for="title">title</label>
                    <input class="form-control" type="text" name="title" placeholder="title">
                 </div>
                <div class="form-group">
                    <label for="body">text</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                   <label for="tags">Tags</label>
                   @foreach ($tags as $tag)
                   {{-- in una situazione in cui posso selezionare più checkbox si può mettere tags[] lui saprà che farranno parte dello stesso gruppo come un array --}}
                        <span>{{$tag->name}}</span>
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}"> 
                   @endforeach
                </div>

                <button class="btn btn-primary" type="submit">Salva</button>  
            </form>
@endsection

{{-- @section('content')
    <form action="{{route('admin.posts.store')}}" method="post">
        @csrf
        @method('POST')
        <label for="">title</label>
        <input type="text" name="title" placeholder="title">
        <label for="">text</label>
        <textarea name="body" id="" cols="30" rows="10"></textarea>
        <button type="submit">Salva</button>
    </form>
@endsection --}}