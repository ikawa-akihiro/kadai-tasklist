<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        // ログイン済みの場合
        if (\Auth::check()) { 
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザのタスク一覧を取得
            $tasks = $user->tasks()->orderBy('id', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
        // タスク一覧画面に表示
        return view('tasks.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        
        // タスク作成画面を表示
        return view('tasks.create', ['task' => $task]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーションを追加
        $request->validate([
            'status' => 'required|max:10', 
            'content' => 'required'
            ]);
        
        // タスクを作成
        $task = new Task();
        $task->status = $request->status;
        $task->content = $request->content;
        \Auth::user()->tasks()->save($task);
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザのタスク一覧を取得
        $tasks = $user->tasks()->get();
        foreach($tasks as $task){
            // リクエストで受け取ったidと一致すればタスク詳細画面へ表示する
            if($task->id == $id){
                return view('tasks.show', ['task' => $task]);
            }
        }
        
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザのタスク一覧を取得
        $tasks = $user->tasks()->get();
        foreach($tasks as $task){
            // リクエストで受け取ったidと一致すればタスク編集画面へ表示する
            if($task->id == $id){
                return view('tasks.edit', ['task' => $task]);
            }
        }
        
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーションの追加
        $request->validate([
            'status' => 'required|max:10', 
            'content' => 'required'
            ]);
        
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        // タスクを更新
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        
        // タスクを削除
        $task->delete();
        
        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
