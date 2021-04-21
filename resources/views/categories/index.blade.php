@extends('layouts.app')

@section('content')
  <div class="col-lg-12 my-5 bg-white shadow-sm p-5">
    <div class="mb-4">
      <h1 class="mb-2">Categories</h1>
      <a href="{{ route('categories.create') }}">
        <button class="btn btn-info text-white">Create New Category</button>
      </a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $category->name }}</td>

            <td class="d-flex">
              <a href="{{ route('categories.edit', $category) }}"><button
                  class="btn btn-outline-primary mr-2">Edit</button></a>
              <form action="{{ route('articles.destroy', $category) }}"
                method="POST"
                id="delete-category-form">
                @csrf
                @method("DELETE")
                <button type="submit"
                  class="btn btn-outline-danger"
                  onclick="
                                                                                      confirm('Are u sure?');
                                                                                      event.preventDefault();
                                                                                            document.getElementById('delete-category-form').submit();">Delete</button>
              </form>
            </td>
          </tr>

        @endforeach

      </tbody>
    </table>

  </div>
@endsection
