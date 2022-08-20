<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Collection
     */
    public function __invoke(Request $request): Collection
    {

        return User::select('id','name')->get();
    }
}
