<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <div class="container">
    <div class="box">
      <h1 class="title mb-15">@yield('title')</h1>
      <div class="content">
        @yield('content')
        @if (count($errors) > 0)
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
        @endif
        <form action="/todo/create" method="POST" class="flex between mb-30">
          @csrf
          <input type="text" class="input-create" name="create_content" value="{{ old('create_content') }}">
          <input class="button-create" type="submit" value="追加">
        </form>
        <table>
          @csrf
          <tbody>

            <tr>
              <th>作成日</th>
              <th>タスク名</th>
              <th>更新</th>
              <th>削除</th>
            </tr>
            @foreach ($todos as $todo)
            <tr>
              <td>
                {{ $todo->created_at }}
              </td>
              <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="POST">
                @csrf
                <td>
                  <input type="text" class="input-update" name="content" value="{{ $todo->content }}">
                </td>
                <td>
                  <input type="submit" value="更新" class="button-update">
              </form>
              </td>
              <td>
                <form action="{{ route('todo.delete', ['id' => $todo->id]) }}" method="POST">
                  @csrf
                  <input type="submit" value="削除" class="button-delete">
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>