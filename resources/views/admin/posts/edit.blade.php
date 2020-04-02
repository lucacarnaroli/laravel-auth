@extends('layouts.app')

@section('content')
            <form class="p-4" action="{{route('admin.posts.update',$post)}}" method="post">
        @csrf
        @method('PATCH')
                <img src="{{asset('storage/' . $post->img)}}" alt="">
                <div class="form-group">
                    <label for="title">title</label>
                <input class="form-control" type="text" name="title" placeholder="title" value="{{$post->title}}">
                 </div>
                <div class="form-group">
                    <label for="body">text</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
                </div>

                <div class="form-group">
                   <label for="tags">Tags</label>
                   @foreach ($tags as $tag)
                   {{-- in una situazione in cui posso selezionare più checkbox si può mettere tags[] lui saprà che farranno parte dello stesso gruppo come un array --}}
                        <span>{{$tag->name}}</span>
                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{($post->tags->contains($tag->id)) ? 'checked' : ''}}> 
                        {{-- contains() verifica che l'id sia dentro quel determinato array --}}
                   @endforeach
                </div>

                <button class="btn btn-primary" type="submit">Salva</button>  
            </form>
@endsection

