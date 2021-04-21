@extends('layouts.app')

@section('content')
  <div class="col-lg-8 mx-auto p-5 my-5 bg-white shadow-sm">
    <form action="{{ route('categories.store') }}"
      method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control "
          type="text"
          name="name"
          id="name">
      </div>
      <button type="submit"
        class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection
