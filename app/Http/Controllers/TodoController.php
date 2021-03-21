<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\TodoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {
        $todos = TodoModel::orderBy('displayorder','ASC')->paginate(5);
        return view('todos.index', compact('todos'));
    }

    public function edit($id)
    {
        $todos = TodoModel::findOrFail($id);
        return view('/todos.edit', compact('todos'));
    }

    public function save(TodoCreateRequest $request, $id)
    {
        $todos = TodoModel::find($id);
        $todos->title = $request->title;
        $todos->desc = $request->desc;

        $todos->save();
        return redirect()->action('TodoController@index');
    }


    public function store(TodoCreateRequest $request)
    {
        $todos = TodoModel::create($request->only('title', 'desc'));
        return redirect()->back()->with('message', 'New Todo created!');
    }

    public function create()
    {
        return view('todos.create');
    }


    public function update(Request $request)
    {

        $data = $request->all();
        $todo = TodoModel::findOrFail($data['ID']);
//        $todo->completed = 1;
        $todo->update([
            'completed' => intval($data['status'])
        ]);
        return response()->json([
            'success' => true,
            'data' => $todo
        ], 200);
    }

    public function search(Request $request)
    {
        $output = "";
        $q = $request->get('search');
        if ($q) {
            $todos = TodoModel::where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('desc', 'LIKE', '%' . $request->search . '%')
                ->orderBy('displayorder','ASC')
                ->get();
        } else {
            $todos = TodoModel::orderBy('displayorder','ASC')
                ->paginate(5);
        }


        if ($todos) {
            $output = '';
            foreach ($todos as $key => $todo) {
                $id = $todo->ID;
                if ($todo->completed == 0) {
                    $output .= "
                <tr class=\"row1\" data-id=\"{{ $todo->ID }}\">
                    <td>$todo->ID</td>
                    <td>$todo->title</td>
                    <td>$todo->desc</td>
                    <td>
                        <input type=\"checkbox\" onchange=\"handleCLickChechbox(event,$id)\" id=\"check\" name=\"check\" value=\"\">
                        <label class=\"form-check-label ml-2\" for=\"check\">Completed!</label>
                    </td>
                    <td>
                      <a href = 'todos/edit/{{ $todo->ID }}'><i class='far fa-sun' style=\"font-size: 36px\"></i></a>
                                <a href = '/todos/delete/{{ $todo->ID }}' onclick=\"return confirm('Are you sure you want to delete?');\"><i class='far fa-trash-alt' style=\"font-size: 36px\"></i></a>
                    </td>
                </tr>";
                } else {
                    $output .= "
                <tr class=\"row1\" data-id=\"{{ $todo->ID }}\">
                    <td>$todo->ID</td>
                    <td>$todo->title</td>
                    <td>$todo->desc</td>
                    <td>
                        <input type=\"checkbox\" onchange=\"handleCLickChechbox(event,$id)\" id=\"check\" name=\"check\" value=\"\" checked>
                        <label class=\"form-check-label ml-2\" for=\"check\">Completed!</label>
                    </td>
                    <td>
                       <a href = 'todos/edit/{{ $todo->ID }}'><i class='far fa-sun' style=\"font-size: 36px\"></i></a>
                                <a href = '/todos/delete/{{ $todo->ID }}' onclick=\"return confirm('Are you sure you want to delete?');\"><i class='far fa-trash-alt' style=\"font-size: 36px\"></i></a>
                    </td>
                </tr>";
                }
            }
        }

        return response()->json([
            'success' => true,
            'output' => $output
        ], 200);
    }

    public function dragdrop(Request $request)
    {
        $todos = TodoModel::all();

        foreach ($todos as $todo) {
            $todo->timestamps = false; // To disable update_at field updation
            $id = $todo->ID;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $todo->update(['displayorder' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }

    public function notcomp(){
        $tododatas = TodoModel::where('completed', 0)->orderBy('displayorder','ASC')->paginate(5);
        return view('todos/not_comp', compact('tododatas'));
    }

    public function searchnotcomp(Request $request){
        $output = "";
        $q = $request->get('search');
        if ($q) {
            $tododatas = TodoModel::where([
                ['title', 'LIKE', '%' . $request->search . '%'],
                ['completed', '==', '0']
            ])->orWhere([
                    ['desc', 'LIKE', '%' . $request->search . '%'],
                    ['completed', '==', '0']
                ])->orderBy('displayorder','ASC')
                ->paginate(5);
        } else {
            $tododatas = TodoModel::where('completed', 0)->orderBy('displayorder','ASC')
                ->paginate(5);
        }


        if ($tododatas) {
            $output = '';
            foreach ($tododatas as $tododata) {
                if ($tododata->completed == 0) {
                    $id = $tododata->ID;
                    $output .= "
                <tr class=\"row1\" data-id=\"{{ $tododata->ID }}\">
                    <td>$tododata->ID</td>
                    <td>$tododata->title</td>
                    <td>$tododata->desc</td>
                    <td>
                        <input type=\"checkbox\" onchange=\"handleCLickChechbox(event,$id)\" id=\"check\" name=\"check\" value=\"\">
                        <label class=\"form-check-label ml-2\" for=\"check\">Completed!</label>
                    </td>
                    <td>
                       <a href=\"{{'/todos/'.$tododata->ID.'/edit'}}\"><i class='far fa-sun' style=\"font-size: 36px\"></i></a>
                       <a href=\"#\"><i class='far fa-trash-alt' style=\"font-size: 36px\"></i></a>
                    </td>
                </tr>";
                }
            }
        }

        return response()->json([
            'success' => true,
            'output' => $output
        ], 200);
    }

    public function comp(){
        $tododatas1s = TodoModel::where('completed', 1)->orderBy('displayorder','ASC')->paginate(5);
        return view('todos/complete', compact('tododatas1s'));
    }

    public function searchcomp(Request $request){
        $output = "";
        $q = $request->get('search');
        if ($q) {
            $tododatas1s = TodoModel::where([
                ['title', 'LIKE', '%' . $request->search . '%'],
                ['completed', '=', '1']
            ])->orWhere([
                    ['title', 'LIKE', '%' . $request->search . '%'],
                    ['completed', '=', '1']
                ])->orderBy('displayorder','ASC')
                ->paginate(5);
        } else {
            $tododatas1s = TodoModel::where('completed', 1)->orderBy('displayorder','ASC')
                ->paginate(5);
        }


        if ($tododatas1s) {
            $output = '';
            foreach ($tododatas1s as $tododatas1) {
                if ($tododatas1->completed == 1) {
                    $id = $tododatas1->ID;
                    $output .= "
                <tr class=\"row1\" data-id=\"{{ $tododatas1->ID }}\">
                    <td>$tododatas1->ID</td>
                    <td>$tododatas1->title</td>
                    <td>$tododatas1->desc</td>
                    <td>
                        <input type=\"checkbox\" onclick=\"handleCLickChechbox(event,{{$tododatas1->ID}})\"  id=\"check\" name=\"check\" value=\"\" checked>
                        <label class=\"form-check-label ml-2\" for=\"check\">Completed!</label>
                    </td>
                    <td>
                       <a href=\"{{'/todos/'.$tododatas1->ID.'/edit'}}\"><i class='far fa-sun' style=\"font-size: 36px\"></i></a>
                       <a href=\"#\"><i class='far fa-trash-alt' style=\"font-size: 36px\"></i></a>
                    </td>
                </tr>";
                }
            }
        }

        return response()->json([
            'success' => true,
            'output' => $output
        ], 200);
    }

    public function destroy($id)
    {
        $todos = TodoModel::find($id);
        $todos->delete();
        return redirect()->back()->with('success', 'Dữ liệu xóa thành công.');

    }
}

