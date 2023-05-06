$(function () {

});

// 予約キャンセルのmodal
$(".modal-open").on('click', function () {
  $('.modal').fadeIn();

  //値を受け取って変数へ格納
  var day = $(this).attr('day');
  var part = $(this).attr('part');
  var id = $(this).attr('id');

  //取得した内容をmodalの中へ渡す
  $('.modal-day').text(day);
  $('.modal-part').text(part);
  $('.modal-id').val(id);

  return false;
});

//予約キャンセルmodalの背景,または閉じるボタンをクリックしたらmodalが消える
$('.modal__bg, .modal-close').on('click', function () {
  $('.modal').fadeOut();

  return false;
});
