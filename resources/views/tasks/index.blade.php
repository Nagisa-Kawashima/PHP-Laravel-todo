<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite('resources/css/app.css')
    
</head>
 
<body class="flex flex-col min-h-[100vh]">
    <header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-2">
                <p class="text-white text-xl">Todoアプリ</p>
            </div>
            <div class="py-2">
                <div class="col-md-4">
                    <div class="bg-white shadow-sm sm:rounded-sm">
                        <div class="p-2 text-white-100">
                            <div>{{ "ようこそ".$user->name."さん！！" }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex py-2 ">
                <div class="me-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="text-md text-white btn btn-primary">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
                <div>
                    <a href="/"
                        class="inline-block text-white text-x2 btn btn-secondary">
                        トップページへ
                    </a>
                </div>
            </div>
        </div>
    </header>
 
    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-[100px]">
                <p class="text-2xl font-bold text-center">今日は何する？</p>
                <!-- <form action="/tasks" method="post" class="mt-10"> -->
                <form action="{{route('tasks.create')}}" method="post" class="mt-10">

                  @csrf
 
                  <div class="flex flex-col items-center">
                    <label class="w-full max-w-3xl mx-auto">
                        <input
                            class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                            placeholder="勉強をする..." type="text" name="task_name" />
                    </label>
                    @error('task_name')
                    <div class="mt-3">
                        <p class="text-red-500">
                            {{ $message }}
                        </p>
                    </div>
                    @enderror
                    <button type="submit" class="mt-8 p-4 bg-slate-800 text-white w-full max-w-xs hover:bg-slate-900 transition-colors">
                        追加する
                    </button>
                  </div>
 
                </form>


                <form action="" method ="get" class=" col-md-4  col-sm-8 mx-auto mt-5">

                    <input value ="{{ $keyword }}"
                    
                     
                        placeholder="検索キーワード" type="text" name="keyword" />
                    <button type="submit" class="ms-4 p-4 bg-slate-800 text-white hover:bg-slate-900 transition-colors">検索</button>
                </form>

                @if ($tasks->isNotEmpty())
                <div class="max-w-7xl mx-auto mt-20">
                    <div class="inline-block min-w-full py-2 align-middle">
                        <!-- <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"> -->
                            <table class="divide-gray-300 col-md-8 mx-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            タスク</th>
                                        <!-- <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                            投稿時刻</th> -->
                                        <th scope="col" class="">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($tasks as $item)
                                        <tr>
                                            <td class="px-3 py-4 text-sm text-gray-500">

                                                <div>
                                                    {{ $item->name }}
                                                </div>
                                            </td>
                                            <!-- <td class="px-3 py-4 text-sm text-gray-500">
                                                <div>
                                                    {{ $item->created_at }}
                                                </div>
                                            </td> -->
                                            <td class="p-0 text-right text-sm font-medium">
                                                <div class="d-flex justify-content-around">
                                                    <div>
                                                        <form action="{{route('tasks.update')}}" method="post" 
                                                            class="inline-block text-gray-500 font-medium"
                                                            role="menuitem" tabindex="-1">
                                                            @csrf
                                                            <!-- @method('PUT') -->
                                                            <!-- <input type="hidden" name="_method" value="PUT">                 -->


                                                            <input type="hidden" name="status" value="{{$item->status}}">
                                                            <input type="hidden" name="id" value="{{$item->id}}">


                                                            <button type="submit" class="bg-emerald-700 py-4 w-20 text-white md:hover:bg-emerald-800 transition-colors">完了</button>
                                                        </form>
                                                    </div>
                                                    <div>
                                                        <!-- <a href="/tasks/{{ $item->id }}/edit/" -->
                                                        <a href="{{route('tasks.edit',['id'=>$item->id])}}"
                                                            class="inline-block text-center py-4 w-20 underline underline-offset-2 text-sky-600 md:hover:bg-sky-100 transition-colors">編集
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <form onsubmit="return deleteTask();"
                                                            action="{{route('tasks.destroy')}}" method="post"
                                                            class="inline-block text-gray-500 font-medium"
                                                            role="menuitem" tabindex="-1">
                                                            @csrf
                                                            <!-- @method('DELETE') -->
                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                            <button type="submit"
                                                                class="py-4 w-20 md:hover:bg-slate-200 transition-colors">削除
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="p-3">
                                                    <a href="{{route('tasks.show',['id'=>$item->id])}}" class="btn btn-primary">詳細へ</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- </div> -->
                    </div>
                </div>
                @endif

            </div>
        </div>
    </main>
    <footer class="bg-slate-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="py-4 text-center">
            <p class="text-white text-sm">Todoアプリ</p>
        </div>
    </div>
    </footer>

    <script>
    function deleteTask() {
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>
 
</html>