$(function () {
  //メインカテゴリをクリックしたら「カテゴリID」を付ける（？）
  $('.main_categories').click(function () {
    var category_id = $(this).attr('category_id');
    $('.category_num' + category_id).slideToggle();
    $(this).find('.arrow').toggleClass('active');
  });

  $(document).on('click', '.like_btn', function (e) {
    e.preventDefault();//デフォルトアクションをキャンセル（=クリックによるリンクの遷移を防ぐ）
    $(this).addClass('un_like_btn');//thisはクリックされた要素 にun_like_btnを付ける
    $(this).removeClass('like_btn');
    var post_id = $(this).attr('post_id');//クリックされた要素のpost_id属性を取得する
    var count = $('.like_counts' + post_id).text();//text()は要素のテキストコンテンツを取得するメソッド => like_countsクラスを持つ要素のテキストコンテンツがcount変数に代入される
    var countInt = Number(count);
    $.ajax({//Ajaxリクエストを行なっていくよー
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },//リクエストヘッダーに追加する情報を指定
      method: "post",//HTTPメソッドを指定
      url: "/like/post/" + post_id,//リクエスト先のURLを指定
      data: {//リクエストデータを指定
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {//Ajaxリクエストが成功したときのコールバック関数 引数のresはサーバーからのレスポンスデータ
      console.log(res);
      $('.like_counts' + post_id).text(countInt + 1);
    }).fail(function (res) {//Ajaxリクエストが失敗したとき resの中身はエラー情報
      console.log('fail');
    });
  });

  $(document).on('click', '.un_like_btn', function (e) {
    e.preventDefault();
    $(this).removeClass('un_like_btn');
    $(this).addClass('like_btn');
    var post_id = $(this).attr('post_id');
    var count = $('.like_counts' + post_id).text();
    var countInt = Number(count);

    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      method: "post",
      url: "/unlike/post/" + post_id,
      data: {
        post_id: $(this).attr('post_id'),
      },
    }).done(function (res) {
      $('.like_counts' + post_id).text(countInt - 1);
    }).fail(function () {

    });
  });

  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var post_title = $(this).attr('post_title');
    var post_body = $(this).attr('post_body');
    var post_id = $(this).attr('post_id');
    $('.modal-inner-title input').val(post_title);
    $('.modal-inner-body textarea').text(post_body);
    $('.edit-modal-hidden').val(post_id);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

});
