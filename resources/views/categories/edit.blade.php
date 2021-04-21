@extends('layouts.app')

@section('content')
  <div class="col-lg-8 mx-auto p-5 my-5 bg-white shadow-sm">

    <form action="{{ route('categories.update', $category) }}"
      method="POST">
      @csrf
      @method("PUT")
      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control "
          type="text"
          name="name"
          value="{{ $category->name }}"
          id="name">
      </div>
      <button type="submit"
        class="btn btn-success">Update</button>
    </form>
  </div>
@endsection
