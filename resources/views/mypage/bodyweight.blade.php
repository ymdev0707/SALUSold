@extends('layouts.template')

@section('css')
{{-- この場所に画面毎のcssを記述する --}}
@endsection

@section('javascript-head')
{{-- この場所に画面毎(ヘッダ位置)のjsを記述する --}}
<script type="text/javascript">
  window.onload = function (){
    // レポートのテンプレートを読み込む
    $("#report-wrapper").load("/template/report/report-wrapper.html");

    // 追加ボタン押下時にレポートを追加する
    $('#add-wrapper').on('click', function() {
      // idを動的にふる
      var last_report_id = increment_target_id_by_class('report-wrapper', 'report-id', "report");
      var target_id = $("#" + last_report_id);

      // 最後に追加したレポートをを追加して初期化する
      $(target_id).parent("#report-wrapper").clone().insertAfter('#report-wrapper');
      var last_report_id = increment_target_id_by_class('report-wrapper', 'report-id', "report");
      init_report(last_report_id);
    });

    $('#report-delete').on('click', function() {
      console.log($(this).parent().attr('id'));  
    });
  }

  function increment_target_id_by_class(target_id, increment_name, target_class_name){
    //複数のdiv要素に動的なidをつける
    var moji = increment_name
    var tmp = document.getElementsByClassName(target_class_name) ;
    var report_id = '';
    for(var i=0;i<=tmp.length-1;i++){
        //id追加
        report_id = moji+i;
        tmp[i].setAttribute("id",report_id);
    }

    return report_id;
  }
  
  function init_report(target_report_id){
    var target_id = $("#" + target_report_id);
    $(target_id).find("textarea").val("");
    $(target_id).find("input").val("");
  }
</script>
@endsection

@section('content')
{{-- @extends('layouts.reportbody') --}}
@extends('layouts.mypageheader')

  <div class="container pt-5 border-primary profile-container">
    <div class="col-md-6" style="max-width: 100%;">
      <h4 class="mb-3 border-bottom">体重報告</h4>
    </div>
      <div id="report-wrapper"></div>
      <div>
        <input type="submit" value="登録">
      </div>
      <div>
        <button id="add-wrapper">追加</button>
      </div>
    {{-- </form> --}}
  </div>

@endsection

@section('javascript-footer')
{{-- この場所に画面毎(フッタ位置)のjsを記述する --}}

@endsection