<?php
namespace Jojoramadhan\Skalamusic\Controllers;

use App\Http\Controllers\Controller;

class SkalamusicController extends Controller
{
    /**
     * Show SkalaMusic dashboard page
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}