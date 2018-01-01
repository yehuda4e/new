<?php

namespace App\Http\Controllers;

use App\ForumCategory;

class ForumCategoryController extends Controller
{
    public function index(ForumCategory $category)
    {
        return view('forum.category', compact('category'));
    }
}
