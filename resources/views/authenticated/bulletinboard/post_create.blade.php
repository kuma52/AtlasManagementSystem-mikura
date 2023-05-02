@extends('layouts.sidebar')

@section('content')
<div class="post_create_container d-flex">
  <div class="post_create_area border w-50 m-5 p-5">
    <div class="wrapper">
      <p class="mb-0">カテゴリー</p>
    <form action="{{ route('post.create') }}" method="post" id="postCreate">
      {{ csrf_field() }}
      <select class="w-100" form="postCreate" name="post_category_id">
        @foreach($main_categories as $main_category)
        <optgroup label="{{ $main_category->main_category }}">
          @foreach($main_category->subCategories as $sub_category)
          <!-- サブカテゴリー表示 -->
            <option value="{{ $sub_category->sub_category }}">{{ $sub_category->sub_category }}</option>
            <!-- </optgroup> -->
          @endforeach
        </optgroup>
        <!-- サブカテゴリー表示
        <option value=""></option>
        </optgroup> -->
        @endforeach
      </select>
    </div>

    <div class="mt-3">
      @if($errors->first('post_title'))
      <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
      <p class="mb-0">タイトル</p>
      <input type="text" class="w-100" form="postCreate" name="post_title" value="{{ old('post_title') }}">
    </div>
    <div class="mt-3">
      @if($errors->first('post'))
      <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      <p class="mb-0">投稿内容</p>
      <textarea class="w-100" form="postCreate" name="post_body">{{ old('post_body') }}</textarea>
    </div>
    <div class="mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
    </div>
</form>
  </div>



  @can('admin')
  <div class="w-25 ml-auto mr-auto">
    <div class="category_area mt-5 p-5">
      <div class="">
        <p class="m-0">メインカテゴリー</p>
        <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">{{ csrf_field() }}
        <input type="text" class="w-100" name="main_category" form="mainCategoryRequest">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">
        </form>
        @if($errors->first('main_category'))
          <span class="error_message">{{ $errors->first('main_category') }}</span>
        @endif
      </div>
      <!-- サブカテゴリー追加 -->
      <div class="">
        <p class="m-0">サブカテゴリー</p>
        <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">{{ csrf_field() }}
            <select name="main_category_id" form="subCategoryRequest">
              <option value="none">-----</option>
              @foreach($main_categories as $main_category)
              <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
              @endforeach
            </select>
        <input type="text" class="w-100" name="sub_category" form="subCategoryRequest">
        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
        </form>
      </div>
      @if($errors->first('main_category_id'))
          <p class="error_message">{{ $errors->first('main_category_id') }}</p>
      @endif
      @if($errors->first('sub_category'))
      <span class="error_message">{{ $errors->first('sub_category') }}</span>
      @endif
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->
    </div>
  </div>
  @endcan
</div>
@endsection
