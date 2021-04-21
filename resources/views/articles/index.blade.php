@extends('layouts.app')

@section('content')
  <div class="col-lg-12 my-5 bg-white p-5">
    <div class="mb-4">
      <h1 class="mb-2">Articles</h1>
      <a href="{{ route('articles.create') }}">
        <button class="btn btn-info text-white">Create New Article</button>
      </a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          @can('see-article-user')
            <th>User</th>
          @endcan
          <th scope="col">Created At</th>
          <th scope="col">Published at</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>

        @foreach ($articles as $article)



          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $article->title }}</td>

            @can('see-article-user')
              <td>{{ $article->user->name }}</td>
            @endcan
            <td>{{ $article->created_at->format('Y-m-d h:m') }}</td>
            <td>{{ $article->published_at }}</td>
            <td class="d-flex">
              <a href="{{ route('articles.edit', $article) }}"><button
                  class="btn btn-outline-primary mr-2">Edit</button></a>
              <form action="{{ route('articles.destroy', $article) }}"
                method="POST"
                id="delete-article-form">
                @csrf
                @method("DELETE")
                <button type="submit"
                  class="btn btn-outline-danger"
                  onclick="
                                                                                                                                        confirm('Are u sure?');
                                                                                                                                        event.preventDefault();
                                                                                                                                              document.getElementById('delete-article-form').submit();">Delete</button>
              </form>
            </td>
          </tr>

        @endforeach

      </tbody>
    </table>

  </div>
@endsection
