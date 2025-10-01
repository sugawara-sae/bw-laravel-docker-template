<!-- Section7
一覧表示画面の実装 -->

@extends('layouts.base')
<!-- Section12
分割したBladeを継承
()内に親ファイルの名前を指定 -->

@section('content') 
  <div class="row justify-content-center">
    <div class="col-md-8">
      <p class="text-left">
        <a class="btn btn-success" href="{{ route('todo.create') }}">ToDoを追加</a>
        <!-- Section11
        「ToDoを追加」のボタンを実装 -->
        <!-- Section12
        ルート定義に名前をつける = リファクタリング
        URLを直接記述しないので、保守性と可読性が高い。 -->
      </p>
      <div class="card">
        <div class="card-header">
          ToDo一覧
        </div>
        <div class="list-group list-group-flush">
          @foreach ($todos as $todo)
          <!-- Section10
          Collectionインスタンスに格納されているTodoインスタンスを一つずつ$todoとして取り出している。 -->
            <div class="d-flex align-items-center p-2">
              <span class="col-9">{{ $todo->content }}</span>
              <!-- Section10
              画面上に取得したデータを表示 -->
                <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-info ml-3">詳細</a>
                <!-- Section16
                詳細画面遷移ボタンを一覧画面に表示
                web.phpで定義したルートに遷移できるように、href属性を記述 -->
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
