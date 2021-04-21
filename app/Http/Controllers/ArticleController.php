<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\StoreArticleRequet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $articles = Article::with('user', 'user.role')->orderBy("created_at", "desc")->get();
    return view("articles.index", compact("articles"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::all();
    return view("articles.create", compact("categories"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreArticleRequet $request)
  {
    Article::create($request->all() +
      [
        "user_id" => auth()->id(),
        'published_at' => Gate::allows('publish-articles') && $request->published ? now() : null
      ]);
    return redirect()->route("articles.index");
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function edit(Article $article)
  {

    $this->authorize("update", $article);
    $categories = Category::all();
    return view("articles.edit", compact("categories", 'article'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Article $article)
  {
    $this->authorize("update", $article);
    $data = $request->all();
    if (Gate::allows('publish-articles')) {
      $data['published_at'] =  $request->published ? now() : null;
    }

    $article->update($data);
    return redirect()->route("articles.index");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article)
  {
    $this->authorize("update", $article);
    $article->delete();
    return redirect()->route("articles.index");
  }
}
