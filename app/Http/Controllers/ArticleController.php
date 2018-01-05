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

    public function index()
    {
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
        request()->merge([
            'slug' => preg_replace(['/\s+/', '/(-{2,})/'], ['-', '-'], request('slug'))
        ]);


        $this->validate(request(), [
            'title' => 'required|min:3|max:255',
            'slug'  => 'required|alpha_dash|min:3|max:255|unique:articles,slug',
            'body' => 'required|min:3',
            'category' => 'required|exists:categories,id'
        ]);

        Article::create([
            'title' => request('title'),
            'slug' => request('slug'),
            'body' => request('body'),
            'category_id' => request('category'),
            'user_id'   => auth()->id()
        ]);

        return redirect('/')->with('info', 'Your Article created successfuly!');
    }

    public function edit(Article $article)
    {
        if ($article->user->id !== auth()->id()) {
            return redirect('/')->with('info', 'You can\'t edit article that is not your\'s.');
        }

        return view('article.form', [
                'article' => $article,
                'url' => '/'.$article->slug,
                'method' => 'patch'
            ]);
    }

    public function update(Article $article)
    {
        request()->merge([
            'slug' => preg_replace(['/\s+/', '/(-{2,})/'], ['-', '-'], request('slug'))
        ]);
        
        $this->validate(request(), [
            'title' => 'required|min:3|max:255',
            'slug' => 'required|alpha_dash|min:3|max:255|unique:articles,slug,'.$article->id,
            'body' => 'required|min:3',
            'category' => 'required|exists:categories,id'
        ]);

        $article->update([
            'title' => request('title'),
            'slug' => request('slug'),
            'body' => request('body'),
            'category_id' => request('category'),
            'user_id' => auth()->id()
        ]);

        return redirect('/')->with('info', 'Your Article updated successfuly!');
    }

    public function destroy(Article $article)
    {
        if ($article->user->id !== auth()->id()) {
            return back();
        }

        $article->comments()->delete();
        $article->delete();

        return redirect('/')->with('info', 'The article deleted.');
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
