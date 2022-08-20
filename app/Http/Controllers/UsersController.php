<?php
    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Response;

    class UsersController extends Controller
    {
        /**
         * Provision a new web server.
         *
         * @return Response
         */
        public function __invoke(): Response
        {
            return User::all();
        }
    }
