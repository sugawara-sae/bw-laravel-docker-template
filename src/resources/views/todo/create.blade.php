<!-- Section11
新規作成画面の実装 -->

@extends('layouts.base')
<!-- Section12
分割したBladeを継承。
()内に親ファイルの名前を指定。 -->

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">ToDo作成</div>
        <div class="card-body">
          <form method="post" action="{{ route('todo.store') }}">
            @csrf
            <!-- Section13
            Laravelではフォーム内に@csrfを追記するだけでCSRF対策が完了する。
            POST送信するものには必ず記述しないとエラーになる。 -->
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">ToDo入力</label>
              <div class="col-md-6">
                <input type="text" class="form-control @if($errors->has('content')) border-danger @endif" name="content" value="">
                @if($errors->has('content'))
                <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif
                <!-- Section20
                バリデーション実装。class内の設定追加。
                バリデーションエラーとなった項目が存在した場合、対応するエラーメッセージが自動的にセッションに保存される。
                セッションに保存されたメッセージは、グローバル変数 $errors を通してどのBladeからでも取得できる。
                $errors は MessageBagクラスのインスタンスが代入されており、発生したバリデーションエラーの情報を持っている。
                $errors->has('入力欄のname属性') = その入力欄でバリデーションエラーが発生しているか判定。
                $errors->first('入力欄のname属性') = その入力欄で最初に発生したエラーメッセージを出力。 
                このセッションは1リクエスト間のみ有効で、その後は自動的に削除される。-->
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">作成</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection