<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
//Questi file si chiamano Guest perchè altrimenti nella rotta principale mi dice che il nome cel controller è già in uso
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function adminindex()
    {
        return view('admin.welcome');
    }
}
