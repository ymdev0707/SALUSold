<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class TestController extends Controller
{
    public function index($slug)
    {
        return htmlspecialchars($slug);
    }
}