<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategories;
use App\Http\Requests\BulletinBoard\PostFormRequest; //バリデーションを呼び出す
use App\Http\Requests\BulletinBoard\CommentRequest;
use App\Http\Requests\BulletinBoard\MainCategoryRequest;
use App\Http\Requests\BulletinBoard\SubCategoryRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request)
    {
        $posts = Post::with('user', 'postComments')->get();
        $categories = MainCategory::with('subCategories')->get();
        $sub_categories = SubCategory::get(); //足した
        $like = new Like;
        $post_comment = new Post;
        if (!empty($request->keyword)) {
            $posts = Post::with('user', 'postComments')
                ->where('post_title', 'like', '%' . $request->keyword . '%')
                ->orWhere('post', 'like', '%' . $request->keyword . '%')->get();
        } else if ($request->category_word) {
            //subcategoriesテーブル（←中間テーブル）から、sub_categoryカラムが●●の時のpost_idカラムの値を取り出してきたい
            // dd($request);
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')
                ->whereHas('SubCategories', function ($query) use ($sub_category) {
                    $query->where('sub_category', $sub_category);
                })->get();
        } else if ($request->like_posts) {
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
                ->whereIn('id', $likes)->get();
        } else if ($request->my_posts) {
            $posts = Post::with('user', 'postComments')
                ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'sub_categories', 'like', 'post_comment'));
    }

    //投稿編集画面の表示
    public function postDetail($post_id)
    {
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        // dd($post);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput()
    {
        $main_categories = MainCategory::with('subCategories')->get();
        $sub_categories = SubCategory::get(); //足した
        return view('authenticated.bulletinboard.post_create', compact('main_categories', 'sub_categories'));
    }

    //投稿
    public function postCreate(PostFormRequest $request)
    {

        //postテーブルに値を送信
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);

        //中間テーブルPostSubCategoriesに送信する
        $category = PostSubCategories::create([
            'post_id' => $post->id,
            'sub_category_id' => $request->post_category_id,
        ]);

        return redirect()->route('post.show');
    }

    //投稿編集機能
    public function postEdit(PostFormRequest $request)
    { //バリデーションかけるためにPostFormRequestにしてみた
        // dd($request);
        //アップデートする
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);

        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    //メインカテゴリを作る
    public function mainCategoryCreate(MainCategoryRequest $request)
    {
        MainCategory::create(['main_category' => $request->main_category]);
        return redirect()->route('post.input');
    }

    //サブカテゴリを作る
    public function subCategoryCreate(SubCategoryRequest $request)
    {
        // dd($request);
        SubCategory::create([
            //カラム名 => 格納する値
            'main_category_id' => $request->main_category_id,
            'sub_category' => $request->sub_category
        ]);
        return redirect()->route('post.input');
    }

    //コメント投稿
    public function commentCreate(CommentRequest $request)
    {
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard()
    {
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard()
    {
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json(); //非同期
    }

    public function postUnLike(Request $request)
    {
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
            ->where('like_post_id', $post_id)
            ->delete();

        return response()->json();
    }
}
