<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="flex flex-col min-h-[50vh]">
<header class="bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="py-2">
                <p class="text-white text-xl">Todoアプリ</p>
            </div>
            
        </div>
    </header>    
    <main>
        <div class="img_area">
            <img src="{{ asset('img/image.jpg') }}" class="img-fluid" alt="">

        <div class="caption_area">
            <div class="card py-2 shadow">
                <div class="card-body">
                    <h3 class="text-center">日々の自分のタスクを管理しましょう。</h3>
                    <div class="d-flex justify-content-around">
                        <a href="login"
                            class="btn btn-secondary">
                            ログインはこちら
                        </a>
                        <a href="register"
                            class="btn btn-primary">
                            新規登録はこちら
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
</div>





    </main>
    

    <!-- <img src="{{ asset('img/image.jpg') }}" alt=""width="700" height="400"> -->
    
    <footer class="bg-slate-800 pb-5">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="py-4 text-center">
            <p class="text-white text-sm">Todoアプリ</p>
        </div>
        </div>
    </footer>

</body>
</html>

