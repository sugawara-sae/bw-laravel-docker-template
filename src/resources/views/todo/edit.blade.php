<!-- Section18
 編集画面の実装 -->

@extends('layouts.base')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">ToDo編集</div>
      <div class="card-body">
        <form method="POST" action="{{ route('todo.update', $todo->id) }}">
          @csrf
          @method('PUT')
          <!-- Section19
          HTMLの仕様として、<form method="PUT">のようにPUTメソッドを指定することはできない。
          そのため、@method('PUT')を使用して、PUTメソッドでリクエストを送信できるようにしている。 -->
          <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">ToDo入力</label>
            <div class="col-md-6">
              <input type="text" class="fform-control @if($errors->has('content')) border-danger @endif" name="content" value="{{ $todo->content }}">
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
              <button type="submit" class="btn btn-primary">更新</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection