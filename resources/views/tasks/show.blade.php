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
 
<body>

<header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-2">
                <p class="text-white text-xl">Todoアプリ</p>
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



    <div class="max-w-7xl mx-auto mt-20">
        <!-- <div class="inline-block min-w-full py-2 align-middle"> -->
            <table class="divide-gray-900 col-md-8 mx-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900" width="400">
                            タスク</th>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900" width="200">
                            投稿時刻</th>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900" width="200">
                            更新時刻</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" width="200">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                <div>
                                    {{ $task->name }}
                                </div>
                            </td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                <div>
                                    {{ $task->created_at }}
                                </div>
                            </td>
                            <td class="px-2 py-3 text-sm text-gray-500">
                                <div>
                                    {{ $task->updated_at }}
                                </div>
                            </td>
                            <td class="p-0 text-right text-sm font-medium">
                                <a href="{{route('tasks.index')}}" class="btn btn-primary">一覧ページへ</a>
                            <td>
                            
                        </tr>
                </tbody>
            </table>
        <!-- </div> -->
    </div>
    <div class="py-5 my-5"></div>

    <footer class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-5 text-center">
                <p class="text-white text-sm">Todoアプリ</p>
            </div>
        </div>
    </footer>




</body>
 
</html>