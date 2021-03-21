@extends('todos.layout')

@section('contentOne')
<div class="container " style="margin-top: 30px; width: auto">
    <div class="row">
        <div class="col-7">
            <h1 style="text-align: right">ALL TO DO</h1>
        </div>
        <div class="col-5">
            <a href="/todos/create">
                <i class="create1 fas fa-plus-square"></i>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 form-group">
            <input type="text" name="search" id="search" class="form-control input-lg" placeholder="Tip somthing to search..." />
        </div>
    </div>

    <ul class="list-group list-group-horizontal">
        <li class="list-group-item list-group-item-primary"><a class="nav-link" href="{{url('/')}}">All To Do</a></li>
        <li class="list-group-item list-group-item-success"><a class="nav-link" href="{{url('todos/not_comp')}}">Not complete</a></li>
        <li class="list-group-item list-group-item-success"><a class="nav-link" href="{{url('todos/complete')}}">Completed</a></li>
    </ul>


    <div class="col-12">
        <table id="tableTodo" class="table table-bordered text-center" style="border: 1px solid">
            <div class="col-12">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 10%">ID</th>
                    <th onclick="sortTable(0)" style="width: 20%">Title</th>
                    <th onclick="sortTable(1)" style="width: 45%">Description</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Action</th>
                </tr>
                </thead>
                <tbody id="sortThis">
                @if ($todos)
                    @foreach ($todos as $todo)
                        <tr class="row1" data-display="{{ $todo->displayorder }}" data-id="{{ $todo->ID }}">
                            <td>{{$todo->ID}}</td>
                            <td>{{$todo->title}}</td>
                            <td>{{$todo->desc}}</td>
                            @if($todo->completed==0)
                                <td>
                                    <input onclick="handleCLickChechbox(event,{{$todo->ID}})" type="checkbox"  id="check" name="check" value="">
                                    <label class="form-check-label ml-2" for="check">Completed!</label>
                                </td>
                            @else
                                <td>
                                    <input type="checkbox" onclick="handleCLickChechbox(event,{{$todo->ID}})"  id="check" name="check" value="" checked>
                                    <label class="form-check-label ml-2" for="check">Completed!</label>
                                </td>
                            @endif
                            <td>
                                <a href = 'todos/edit/{{ $todo->ID }}'><i class='far fa-sun' style="font-size: 36px"></i></a>
                                <a href = '/todos/delete/{{ $todo->ID }}' onclick="return confirm('Are you sure you want to delete?');"><i class='far fa-trash-alt' style="font-size: 36px"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
        </table>
        {!! $todos->links() !!}
    </div>
</div>
<script src="/js/javascript.js" type="text/javascript"></script>
@endsection

