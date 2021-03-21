@extends('todos.layout')

@section('contentOne')
    <div class="container" style="margin-top: 30px">
        <div class="row">
            <div class="col-7">
                <h1 style="text-align: right">Not complete list</h1>
            </div>
            <div class="col-5">
                <a href="/todos/create">
                    <i class="create1 fas fa-plus-square"></i>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 form-group">
                <input type="text" name="search1" id="search1" class="form-control input-lg" placeholder="Tip somthing to search..." />
            </div>
        </div>

        <ul class="list-group list-group-horizontal">
            <li class="list-group-item list-group-item-success"><a class="nav-link" href="{{url('/')}}">All To Do</a></li>
            <li class="list-group-item list-group-item-primary"><a class="nav-link" href="{{url('todos/not_comp')}}">Not complete</a></li>
            <li class="list-group-item list-group-item-success"><a class="nav-link" href="{{url('todos/complete')}}">Completed</a></li>
            <p> #Note: click on master row for sorf </p>
        </ul>


        <div class="col-12">
            <table id="tableTodo" class="table table-bordered text-center" style="border: 1px solid">
                <div class="col-12">
                    <thead class="thead-dark">
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th id="facility_header" style="width: 20%">Title</th>
                        <th id="city_header" style="width: 45%">Description</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 15%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="sortThis">
                    @if ($tododatas)
                        @foreach ($tododatas as $tododata)
                            <tr class="row1" data-display="{{ $tododata->displayorder }}" data-id="{{ $tododata->ID }}">
                                <td>{{$tododata->ID}}</td>
                                <td>{{$tododata->title}}</td>
                                <td>{{$tododata->desc}}</td>
                                @if($tododata->completed==0)
                                    <td>
                                        <input onclick="handleCLickChechbox(event,{{$tododata->ID}})" type="checkbox"  id="check" name="check" value="">
                                        <label class="form-check-label ml-2" for="check">Completed!</label>
                                    </td>
                                @else
                                    <td>
                                        <input type="checkbox" onclick="handleCLickChechbox(event,{{$tododata->ID}})"  id="check" name="check" value="" checked>
                                        <label class="form-check-label ml-2" for="check">Completed!</label>
                                    </td>
                                @endif
                                <td>
                                    <a href = '../todos/edit/{{ $tododata->ID }}'><i class='far fa-sun' style="font-size: 36px"></i></a>
                                    <a href = '../todos/delete/{{ $tododata->ID }}' onclick="return confirm('Are you sure you want to delete?');"><i class='far fa-trash-alt' style="font-size: 36px"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
            </table>
            {!! $tododatas->links() !!}
        </div>
    </div>
    <script src="/js/javascript.js" type="text/javascript"></script>
@endsection

