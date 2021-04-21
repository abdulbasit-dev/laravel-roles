@extends('layouts.app')

@section('content')
  <div class="col-lg-8 mx-auto p-5 my-5 bg-white">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ route('articles.store') }}"
      method="POST">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control "
          type="text"
          name="title"
          value="{{ old('title') }}"
          id="title">
      </div>
      <div class="form-group">
        <label for="fullText">Full Text</label>
        <textarea rows="5"
          name="full_text"
          class="form-control "
          id="fullText">{{ old('full_text') }}</textarea>
      </div>
      <div class="form-group">
        <label for="category">Select A Category</label>
        <select class="custom-select"
          name="category_id">
          <option selected>Open this select menu</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}"
              @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      @can('publish-articles')
        <div class="form-check form-group">
          <input type="checkbox"
            class="form-check-input"
            id="exampleCheck1"
            name="published"
            value="1">
          <label class="form-check-label"
            for="exampleCheck1">Publised</label>
        </div>
      @endcan
      <button type="submit"
        class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection
