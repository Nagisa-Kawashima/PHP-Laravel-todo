<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword = $request->input('keyword'); //keywordが取れる
        
        $user = Auth::user();
        if(is_null($keyword)) {
             //タスクが未完了のものだけ表示 (currentuser用、通常ユーザーに見えている側　falseであれば検索出来るようにする)
            $tasks = Task::where('status', false)->where('user_id', $user->id )->get();
            //taskテーブルの　　　
            // ステータスがfalseのものを探す
            // user_id == current_userであるかどうか
            // その条件のものがあれば取ってくる
        } else {
            $tasks = Task::where('status', false)->orderBy('created_at', 'asc')->where('user_id', $user->id )->where('name','like', "%$keyword%")->get();
            //taskテーブルの　　　
            // ステータスがfalseのものを探す
            //投稿日時が昇順のものに並び変える
            // user_id == current_userであるかどうか
            //nameに入力していたものが含まれているのかどうか
            // その条件のものがあれば取ってくる

        }
       
         //   /「/tasks」にアクセスがあったら,
        // 作成したindex.blade.phpの中身が表示
        return view('tasks.index', ['tasks' => $tasks, 'keyword' => $keyword]); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'task_name' => 'required|max:100',
        ];
        

        $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
        
        Validator::make($request->all(), $rules, $messages)->validate();

        //モデルをインスタンス化
        $task = new Task;
        
        $task->user_id = Auth::user()->id;
        //モデル->カラム名 = 値 で、データを割り当てる
        $task->name = $request->input('task_name');

      
        
        //データベースに保存
        $task->save();
        
        //リダイレクト
        return redirect('/tasks');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    ##showアクションどうするか
    public function show(Request $request)
     { 
        $tasks = Task::all();
        return view('tasks.show', compact('tasks'));
        
        //   $user = Auth::user();
    // //     $task = Task::find($id);
    // //     $task->user_id = user->id;
     
    // //     return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = Auth::user();
        $task = Task::find($id);
        $task->user_id = $user->id; 
        return view('tasks.edit', compact('task'));
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
          //「編集する」ボタンをおしたとき
        if ($request->status === null) {
            $rules = [
            'task_name' => 'required|max:100',
            ];
        
            $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
        
            Validator::make($request->all(), $rules, $messages)->validate();
        
        
            //該当のタスクを検索
            $task = Task::find($id);
        
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->name = $request->input('task_name');
        
            //データベースに保存
            $task->save();
        } else {
            $user = Auth::user();
            //「完了」ボタンを押したとき
        
            //該当のタスクを検索
            $task = Task::find($id);
           
        
            //モデル->カラム名 = 値 で、データを割り当てる
            $task->status = true; //true:完了、false:未完了
            
            // $task->user_id = $user->id; 
            //データベースに保存
            $task->save();
        }
    
    
        //リダイレクト
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);        
        $user = Auth::user();
        if($task->user_id == $user->id) {
            $task->delete();
        }
        
         
        
        return redirect('/tasks');
    }
}
