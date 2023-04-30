<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->user()){

        }

        $news = News::select(["id", "body", "title", "created_at as created"])->orderBy('id', 'desc')->with("user")->paginate(10);
        return response()->json($news);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->middleware('isAdmin');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:1300',
        ]);
        $news = News::create([
            "title" =>$validated["title"],
            "body" =>$validated["text"],
            "user_id" => $request->user()->id
        ]);
        return  response()->json(new NewsResource($news), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return  response()->json(new NewsResource($news));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $this->middleware('isAdmin');
        return  response()->json(new NewsResource($news));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->middleware('isAdmin');

        $validated = $request->validate([
            'id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1300',
        ]);

        $news = News::where("id",(int)$validated["id"])->first();
        $news->title = $validated["title"];
        $news->body = $validated["body"];
        $news->save();
        return response()->json( new NewsResource($news), 205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->middleware('isAdmin');
        $news->delete();
        return response('News deleted successfully', 200);
    }
}
