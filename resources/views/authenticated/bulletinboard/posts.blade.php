@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{ $post_comment->commentCounts($post->id)->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>


<!-- 右側のいろいろボード -->
  <div class="other_area w-25">
    <div class="m-4">
      <div class="btn "><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="keyword_area">
        <input class="keyword" type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input class="keyword_btn" type="submit" value="検索" form="postSearchRequest">
      </div>
      <div class="btn_wrapper">
        <input type="submit" name="like_posts" class="category_btn good" value="いいねした投稿" form="postSearchRequest">
        <input type="submit" name="my_posts" class="category_btn mine" value="自分の投稿" form="postSearchRequest">
      </div>
      <ul>
        @foreach($categories as $category)
        <li class="main_categories" category_id="{{ $category->id }}">
          <span>{{ $category->main_category }}<span class=" arrow"></span></span>
<span class="line"></span>
              @foreach($category->subCategories as $sub_category)
                  <p class="category_num{{ $sub_category->main_category_id }}">
                    <input type="submit" name="category_word" value="{{ $sub_category->sub_category }}" data-category_id="{{ $sub_category->id }}" form="postSearchRequest">
                  </p>
              @endforeach
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
