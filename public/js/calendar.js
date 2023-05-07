$(function () {

});

// 予約キャンセルのmodal
$(".modal-open").on('click', function () {
  $('.modal').fadeIn();

  //値を受け取って変数へ格納
  var day = $(this).attr('value');
  var int_day = $(this).attr('value');
  var string_part = $(this).attr('string_part');
  var int_part = $(this).attr('int_part');

  //取得した内容をmodalの中へ渡す
  $('.modal-day').text(day);
  $('.modal-int-day').val(int_day);
  $('.modal-string-part').text(string_part);
  $('.modal-int-part').val(int_part);

  return false;
});

//予約キャンセルmodalの背景,または閉じるボタンをクリックしたらmodalが消える
$('.modal__bg, .modal-close').on('click', function () {
  $('.modal').fadeOut();

  return false;
});
