<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiDocController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return view('api.documentation');
    }
}
