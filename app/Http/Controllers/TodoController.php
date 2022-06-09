<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', ['todos' => $todos]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'create_content' => 'required|max:20'
        ]);

        $create = new Todo();
        $create->content = $request->create_content;
        $create->save();
        return redirect('/');
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|max:20'
        ]);

        $form = $request->all();
        unset($form['_token']);

        $update = Todo::find($request->id);
        $update->content = $request->content;
        $update->save();
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $delete = Todo::find($request->id);
        $delete->delete();

        return redirect('/');
    }
    // public function index()
    // {
    //     $todos = Todo::all();
    //     return view('index', ['todos' => $todos]);
    // }
    // public function create(Request $request)
    // {
    //     $param = [
    //         'content' => $request->content
    //     ];
    //     DB::table('todos')->insert($param);
    //     return redirect('/');
    // }
    // public function update(Request $request)
    // {
    //     $param = [
    //         'id' => $request->id,
    //         'content' => $request->content
    //     ];
    //     DB::table('todos')->where('id', $request->id)->update($param);
    //     return redirect('/');
    // }
    // public function edit(Request $request)
    // {
    //     $todo = todo::find($request->id);
    //     return view('edit', ['form' => $todo]);
    // }
    // public function update(Request $request)
    // {
    //     // $this->validate($request, Todo::$rules);
    //     $form = $request->all();
    //     unset($form['_token']);
    //     Todo::where('id', $request->id)->update($form);
    //     return redirect('/');
    // }
    // public function delete(Request $request)
    // {
    //     $todo = Todo::find($request->id);
    //     return view('delete', ['form' => $todo]);
    // }
    // public function remove(Request $request)
    // {
    //     Todo::find($request->id)->delete();
    //     return redirect('/');
    // }
    // public function validation(ClientRequest $request)
    // {
    //     return view('index', ['' => '正しい入力です']);
    // }
}