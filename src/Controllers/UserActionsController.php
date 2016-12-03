<?php
namespace Jojoramadhan\Skalamusic\Controllers;

use App\Http\Controllers\Controller;
use Jojoramadhan\Skalamusic\Models\UsersLogs;
use Yajra\Datatables\Datatables;

class UserActionsController extends Controller
{
    /**
     * Show User actions log
     *
     * @return Response
     */
    public function index()
    {
        return view('qa::logs.index');
    }

    public function table()
    {
        return Datatables::of(UsersLogs::with('users')->orderBy('id', 'desc'))->make(true);
    }
}