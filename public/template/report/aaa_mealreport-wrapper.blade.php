<div class="report" id="report-id0">
  <div>
    <div>
      <label for="">画像</label>
    </div>
    <input type="file" accept='image/*' onchange="preview_image(this);">
    <div>
      <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
    </div>
  </div>
  <div>
    <div>
      <label for="">ユーザーコメント</label>
    </div>
    <textarea name="" id="user-comment" cols="30" rows="10"></textarea>
  </div>
  <div>
    <div>
      <label for="">トレーナーコメント</label>
    </div>
    <textarea name="" id="trainer-comment" cols="30" rows="10"></textarea>
  </div>
  <div>
    <label>消費カロリー</label>
  </div>
  <div>
    <input type="number" id="cal">
    <label>kcal</label>
  </div>
  <div>
    <label>摂取時刻</label>
  </div>
  <div>
    <input type="time" id="get-time">
  </div>
  <div>
    <button id="report-delete">削除</button>
  </div>
</div>