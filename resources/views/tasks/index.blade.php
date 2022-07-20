@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div style="display: flex; justify-content: space-between;">
            <h1>タスク一覧</h1>
            {{--タスク作成ページへのリンク--}}
            {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}
        </div>
        @if (count($tasks) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ステータス</th>
                        <th>タスク</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        {{--タスク詳細ページへのリンク--}}
                        <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->content }}</td>
                        {{-- タスク編集ページへのリンク --}}
                        <td>{!! link_to_route('tasks.edit', '編集', ['task' => $task->id]) !!}</td>
                        {{-- タスク削除フォーム --}}
                        <td>
                        {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        {{-- ページネーションのリンク --}}
        {{$tasks->links()}}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>タスク管理アプリへようこそ！</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
                <h4 style="margin-top:40px;">アカウントをお持ちの場合</h4>
                {{-- ログインページへのリンク --}}
                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    @endif
    

@endsection