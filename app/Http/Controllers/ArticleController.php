<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        return view('article.index');
    }

    public function show(Article $article)
    {
        Redis::incr("article.$article->id.views");
        return view('article.show', compact('article'));
    }

    public function create()
    {
        return view('article.form');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|min:3|max:255',
            'slug'  => 'nullable|alpha_dash|unique:articles,slug|max:255',
            'body' => 'required|min:3',
            'category' => 'required|exists:categories,id'
        ]);

        Article::create([
            'title' => request('title'),
            'slug' => request('slug') ?? str_slug(request('title')), // May cause duplications. Need to fix.
            'body' => request('body'),
            'category_id' => request('category'),
            'user_id'   => auth()->id()
        ]);

        return redirect()->route('home');
    }

    public function edit(Article $article)
    {
        if ($article->user->id !== auth()->id()) {
            return redirect('/')->with('You can\'t edit article that is not your\'s.');
        }

        return view('article.form', [
                'article' => $article,
                'url' => '/'.$article->slug,
                'method' => 'patch'
            ]);
    }

    public function update(Article $article)
    {
        $this->validate(request(), [
            'title' => 'required|min:3|max:255',
            'slug' => 'nullable|alpha_dash|max:255|unique:articles,slug,'.$article->id,
            'body' => 'required|min:3',
            'category' => 'required|exists:categories,id'
        ]);

        $article->update([
            'title' => request('title'),
            'slug' => request('slug') ?? str_slug(request('title')), // May cause duplications. Need to fix.
            'body' => request('body'),
            'category_id' => request('category'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('home');
    }

    public function destroy(Article $article)
    {
        if ($article->user->id !== auth()->id()) {
            return back();
        }

        $article->comments()->delete();
        $article->delete();

        return redirect('/')->with('The article deleted.');
    }

    public function comment(Article $article)
    {
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        $article->comments()->create([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        return back();
    }
}
