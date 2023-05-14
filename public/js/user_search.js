$(function () {
  //「検索条件の追加」を押したら
  $('.search_conditions').click(function () {
    //●●をスライドして開く
    $('.search_conditions_inner').slideToggle();
    $('.arrow').toggleClass('active');
  });

  //この子どこの子search.bladeではない？
  //profile.bladeの子でした
  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
    $('.arrow').toggleClass('active');
  });
});
