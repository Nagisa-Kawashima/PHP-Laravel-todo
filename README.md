# インストール手順　

## laravel のインストール　

フォルダーを作る　作成するフォルダに移動する

```sh
composer create-project --prefer-dist laravel/laravel . "9.*"
```

## データーベースの設定　

.env ファイルの修正

```php
DB_DATABASE=laravel_breeze #名前をアプリ名に変更
DB_USERNAME=root
DB_PASSWORD=root #passwordを変更
```

### MAMP を開いてデーターベースの新規作成　

## config\database.php

```
'charset' => 'utf8',
'collation' => 'utf8_general_ci',
実案件などでは、collation(照合順序)は「utf8mb4_bin」というものに変更しておくのがいいでしょう。
```

```
php artisan config:clear

.envファイルやconfig内のファイルを変更したときは、このコマンドを実行しないとうまく反映されないので注意してください。

```

## テーブルを作成する

```
php artisan migrate

```

##　モデルを作成する(model migration conroller を同時に作成する)

```
php artisan make:model TodoList -mc
```

##  migration ファイルにカラムデータの記述を行う　

## todo_lists テーブルの作成を行う

```
php artisan migrate
```

## todo_lists テーブルにサミーデータの投入を行う　

```
php artisan make:seeder TodoListSeeder

database\seedersフォルダ内に、「TodoListSeeder.php」が作成されます。

```

## database\seeders\DatabaseSeeder.php 作成した TodoListSeeder クラスを呼び出すように設定

```
public function run()
{
  $this->call([
    TodoListSeeder::class
  ]);
}
```

## ダミーデータの登録を行う　

```
php artisan db:seed --class=TodoListSeeder
```

## TodoListSeeder.php の編集、ダミーデータの編集を行ったらテーブルの再作成を行う

```
php artisan migrate:fresh --seed


```

## migration ファイルのみ作成　

```
php artisan make:migration create_tasks_table
```

## ## migration ファイルにカラムデータの記述を行う　

## マイグレーションを実行

```sh
php artisan migrate
```

## tasks テーブルが作成されているかブラウザで確認　

## Task モデルを作る

```sh
php artisan make:model Task
```

## Taskcontroller を作る(リソースコントローラー)

```
php artisan make:controller TaskController --resource
```

## routing を追記する

```php
use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class);

```

## routing の確認　

```
php artisan route:list
```

## 「resources/views」内で view の作成

---

# アソシエーションの作り方　

```
Schema::create('todo_lists', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); ##
    $table->string('name', 100);
    $table->timestamps();
});
```

```

    public function todoList()
    //自分で決めた関数名を指定する
    {
        return $this->hasMany('App\Models\TodoList');
    }
```

## 全てリセットしてからマイグレーションを行う

php artisan migrate:refresh

## user の seed data を作成する

```

php artisan make:seeder UserSeeder

そのあと以下のファイルを編集してダミーデータを追加する

 public function run()
    {
        User::create([
            'name'=>'test1',
            'email'=>'test1@example.com',
            'password'=> Hash::make('password'),

        ]);
        User::create([
            'name'=>'test2',
            'email'=>'test2@example.com',
            'password'=> Hash::make('password'),

        ]);

    }
```

## ダミーデータの保存をする

```sh
php artisan db:seed --class=UserSeeder

```

## ダミーデータの変更をした場合

```
php artisan migrate:fresh --seed
```

## これは何？？

public function run()
{
$this->call([
TodoListSeeder::class
]);
}

## routing の記述

```php
Route::get( アドレス , [コントローラーの名前::class , メソッド名] );
```

## 現在認証しているユーザーを取得する場合

```php
$user = Auth::user();
```

## Laravel プロジェクトのディレクトリ構成

```
── sample
    ├── app       ・・・アプリケーションのロジック
    ├── bootstrap ・・・laravelフレームワークの起動コード
    ├── config    ・・・設定ファイル
    ├── database  ・・・MigrationファイルなどDB関連
    ├── public    ・・・Webサーバのドキュメントルート
    ├── resources ・・・ビューや言語変換用ファイルなど
    ├── routes    ・・・ルーティング用ファイル
    ├── storage   ・・・フレームワークが使用するファイル
    ├── tests     ・・・テストコード
    └── vendor    ・・・Composerでインストールしたライブラリ
```

## マイグレーションファイル

> maigration ファイルでは up メソッドにテーブル作成時の情報、down メソッドにマイグレーションを取り消す際の情報を記述

## モデルの命名規則

> モデルは命名規則によってテーブルとマッピングされます。
> テーブル名の単数形を名前につけることで、自動的にそのテーブルとマッピングします。

## シーディング

> シーディングはテストデータやマスタデータなどのアプリケーション起動時に必要なレコードをコマンドで登録する仕組みです。
> 次の手順で実行します。

- シーダーファイルの作成
- シーディングの実行

---
## migration  ファイルの書き方
```php
schema::create('products',function (Blueprint $table) {
    $table->string('name');
    $table->integer('price');
    $table->unsignedBigInteger('company_id');

});
```
> Blueprintは、データーベースに追加できるタイプのカラムに対応するメソッドを提供している

## routing の書き方　
```php
Route::get('/product/', [ProductController::class, 'index'])->name(‘product.index’);

// またroutes/web.php に
 use App\Http\Controllers\ProductController; //の記述を行う

```
> get   ← HTTPのGETメソッド対応する。（普通の閲覧は GET だとおもってOK)
post ← HTTPのPOSTメソッド対応する。（DBへのデータ追加/更新/削除はこちら) 

> getリクエストで'/product/'に来たらProductControllerの'index'の処理をしなさい。
プログラム中で route( ‘product.index’ )  を使ったら '/product/' のURLとしなさい。

```php
// 新規作成ページ
Route::get('/product/new', [ProductController::class, 'new'])->name('product.new');
// 詳細ページ
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
// 編集ページ
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');

// 新規追加処理
Route::post('/product/create', [ProductController::class, 'create'])->name('product.create');
// 既存データ編集処理
Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
// 削除処理
Route::post('/product/delete', [ProductController::class, 'delete'])->name('product.delete');

```


## create処理　
```php
<html>
<body>
    <h1>新規作成</h1>
    <form action="{{route('product.create')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />{{-- //★1 --}}

        名前:<input type="text" name="name"><br/>
        価格:<input type="text" name="price"><br/>
 
        <input type="submit" value="送信">
    </form> 
</body>
</html>


```
```php
  public function create(Request $request){
        $name = $request->input('name');
        $price = $request->input('price');
        Product::create([
            'name'=>$name,
            'price'=>$price,
        ]);
        return redirect()->route('product.index');
    }


```

## Logとは？？？？　→処理の履歴が残っている。バグの原因解明の為にも使う。
```
[2023-02-14 15:56:21] local.ERROR: Target class [TodoListController] does not exist. {"exception":"[object] 
```

## show 処理 

```php
    public function show(Request $request , $id){
        \Log::debug('[ProductController][show]');
        \Log::debug('[ProductController][show] path => ',[$id]);

        $product = Product::find( $id );
        return view('product.show',[
            'product' => $product,
        ]);
    }


```
## showリンク
```php
<a href="{{route('product.show',['id'=>$product->id])}}">詳細</a>

``` 

## edit 処理　
```php
   public function edit(Request $request , $id){
        \Log::debug('[ProductController][edit]');
        \Log::debug('[ProductController][edit] path => ',[$id]);

        $product = Product::find( $id );
        return view('product.edit',[
            'product' => $product,
        ]);
    }


```
```php
<html>
<body>
    <h1>編集</h1>
    <form action="{{route('product.update')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />{{-- //★1 --}}

        <input type="hidden" name="id" value="{{$product->id}}">
        id: {{$product->id}} <br/>
        名前:<input type="text" name="name" value="{{$product->name}}"><br/>
        価格:<input type="text" name="price" value="{{$product->price}}"><br/>
 
        <input type="submit" value="送信">
    </form> 
</body>
</html>


```
## update処理
```php
public function update(Request $request){
        \Log::debug('[ProductController][update]');
        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        \Log::debug('[ProductController][update] inputs => ',[$id,$name,$price]);
        $product = Product::find( $id );
        $product->name = $name;
        $product->price = $price;
        $product->save();
        return redirect()->route('product.index');
    }


``` 

## delete処理
```php
    public function delete(Request $request){
        \Log::debug('[ProductController][delete]');
        $id = $request->input('id');
        \Log::debug('[ProductController][delete] inputs => ',[$id]);
        $product = Product::find( $id );
        $product->delete();
        return redirect()->route('product.index');
    }


```

## リンク
```php
     <li>
            <div>{{$product->id}}</div>
            <div>{{$product->name}}</div>
            <div>{{$product->price}}</div>
            <a href="{{route('product.show',['id'=>$product->id])}}">詳細</a>
            <a href="{{route('product.edit',['id'=>$product->id])}}">編集</a>
            <form action="{{route('product.delete')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />{{-- //★1 --}}
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="submit" value="削除">
            </form>
        </li>

```

## バリデーション
```sh
php artisan make:request ProductCreateRequest
// ??

```

## 検索　
クエリとは？？？？ 　→問い合わせのようなもの


## input hiddenとは？　


resources 引数にidをつけるやり方　
show/{id}になっている　勝手に　
それをメソッドで引数で受け取るようになっている　

resourcesでない場合は
メソッド内で
$id を定義する必要がある　input hidden もつける　

_method Laravelの仕様となっている　

HTTPの理解　
Laravelの特殊ルール 






## 学習で学んだことのメモ

[memo集forLaravel](https://drive.google.com/file/d/1vp5zzrzkweWX65XsGmJmPrsPDbPlciJY/view?usp=sharing)
