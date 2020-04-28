<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth:api')->except(['show', 'index']);
        $this->middleware('auth:api')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     *
     *///@return \Illuminate\Http\Response
    public function index(Request $request)
    {
        $user = $request->user();

        $articles = $user->articles()->get();
        return response()->json($articles);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     *///@return \Illuminate\Http\Response
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required|string|max:255',
        ];

        $message = [
            'title.required' => '必须输入title',
            'title.string' => 'title格式为字符串',
            'title.max' => 'title不要超过255',
            'title.unique' => 'title不可重复',
            'body.required' => '必须输入title',
            'body.string' => 'title格式为字符串',
            'body.max' => 'title不要超过255',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 302);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'error' => '请先登录',
            ], 401);
        }

        $data = $validator->validated();

        $data['user_id'] = $user->id;

        $article = Article::create($data);

        return response()->json($article, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Article $article
     *
     */ //@return \Illuminate\Http\Response
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     *
     */ // @return \Illuminate\Http\Response
    public function update(Request $request, Article $article)
    {
        if ($article->user->id !== auth()->id()) {
            return response()->json([
                'error' => '没有权限操作不属于自己的文章',
            ], 402);
        }

        if ($request->get('title') === $article->title) {
            $rules = [
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:255',
            ];
        } else {
            $rules = [
                'title' => 'required|string|unique:articles|max:255',
                'body' => 'required|string|max:255',
            ];
        }

        $message = [
            'title.required' => '必须输入title',
            'title.string' => 'title格式为字符串',
            'title.max' => 'title不要超过255',
            'title.unique' => 'title不可重复',
            'body.required' => '必须输入title',
            'body.string' => 'title格式为字符串',
            'body.max' => 'title不要超过255',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json($validator->errors()->getMessages(), 302);
        }

        $data = $validator->validated();
        if (!$article->update($data)) {
            return response()->json([
                'error' => 'Article update failed',
            ]);
        }

        return response()->json([
            'message' => 'Article updated',
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     *
     */ //@return \Illuminate\Http\Response
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            'message' => 'Successfully Deleted',
        ], 200);
    }
}
