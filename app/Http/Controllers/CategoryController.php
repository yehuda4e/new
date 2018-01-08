<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function show($category)
    {
        $category = Category::whereSlug($category)
                            ->withCount('articles')
                            ->first();

        if (!$category) {
            abort(404);
        }

        return view('category.show', compact('category'));
    }
}
