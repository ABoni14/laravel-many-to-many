@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create new Post</h2>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    

    <form action="{{route("admin.posts.store")}}" method="POST">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" 
        value="{{old("title")}}"
        class="form-control @error('title') is-invalid @enderror" 
        id="title" name="title"
        placeholder="Enter title">
        @error("title")
          <h6>{{$message}}</h6>
        @enderror
      </div>
      <div class="form-group">
        <label for="content">Content</label>
        <textarea 
        class="form-control @error('content') is-invalid @enderror" 
        id="content" name="content"
        placeholder="Enter content">{{old("content")}}
        </textarea>
        @error("content")
        <h6>{{$message}}</h6>
      @enderror
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Inserisci una categoria</label>
        <select class="form-select" name="category_id" id="category_id">
          <option value="" @if($categories == old("category_id")) selected @endif>Categorie</option>
          @foreach ($categories as $category)
            <option @if($category->id == old("category_id")) selected @endif value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>

      <div>
        <h4>Tag</h4>
        @foreach ($tags as $tag)
          <input type="checkbox" name="tags[]" id="tag{{$loop->iteration}}" value="{{$tag->id}}" @if(in_array($tag->id, old("tags", []))) checked @endif>
          <label for="tag{{$loop->iteration}}" class="mr-3">{{$tag->name}}</label>
        @endforeach
      </div>

      <button type="submit" class="btn btn-primary">Send</button>
      <button type="reset" class="btn btn-dark">Reset</button>
    </form>
</div>
@endsection