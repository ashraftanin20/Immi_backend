<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories() {
        return Category::select('id', 'name')->get();
    }
}
