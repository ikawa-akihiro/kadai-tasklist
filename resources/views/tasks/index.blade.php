@extends('layouts.app')

@section('content')
    
    <h1>タスク一覧</h1>
    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
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
    {{--メッセージ作成ページへのリンク--}}
    {!! link_to_route('tasks.create', '新規タスクの投稿', [], ['class' => 'btn btn-primary']) !!}
    

@endsection