<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{


    public function articles()
    {
        #new articles list and convert it to json
        $articles = Article::orderBy('id','desc')->get();
        return response([
            'data'  => $articles,
            'status' => '200',
        ]);

    }


    public function article($id)
    {
        #single article info and it's comments and convert it to json
        $article = Article::with('comments')->find($id);

        if ($article)
        {
            return response([
                'data'  => $article,
                'status' => '200'
            ]);
        }
        else
        {
            return response([
                'data'  => 'not found',
            ]);
        }

    }



    public function create(Request $request)
    {
        #validation first
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string'
        ]);


        #create new article
        Article::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response([
            'status' => '200',
        ]);

    }


    public function update(Request $request,$id)
    {

        #request data must send from x-www-form-urlencode in postman . not form data

        #validation first
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string'
        ]);


        #update article
        Article::find($id)->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return response([
            'status' => '200',
        ]);

    }


    public function delete($id)
    {
        #delete article
        $article = Article::find($id);

        if ($article)
        {
            $article->delete();
            return response([
                'status' => '200',
            ]);
        }
        else
        {
            return response([
                'data'  => 'not found',
            ]);
        }

    }




}
