<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CreateTokensController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->is_admin == 1) {
            $token = $request->user()->createToken('news',['news-command']);

            return response()->json([
                'token' => $token->plainTextToken,
                'admin' => "yes"
                ]);
        }

        $token = $request->user()->createToken('news', ['news-show']);
        return response()->json(['token' => $token->plainTextToken]);
    }

}
