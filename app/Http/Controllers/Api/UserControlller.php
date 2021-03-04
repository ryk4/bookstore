<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserControlller extends Controller
{
    public function status()
    {


        return 'logged in';
    }
}
