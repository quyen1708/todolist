@extends('todos.layout')

@section('contentOne')
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <a href='/todos' class="badge badge-pill badge-light" style="font-size: 150%; margin-left: 10%; margin-top: 3px">Get Back</a>
            <h1 class="text-center" style="margin-left: 20%">Edit To Do</h1>
        </div>
        <x-alert />
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <form role="form" method="POST" action="/todos/save/{{ $todos->ID }}"">
                @method('PATCH')
                @csrf
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <input type="text" class="form-control" id="title" name="title" value="{{ $todos->title }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label for="description">Description</label><br>
                            <textarea class="form-control" maxlength="6000" rows="7" id="desc" name="desc">{{ $todos->desc }}</textarea>
                    </div>
                            <button type="submit" class="btn btn-lg btn-primary" style="margin-left: 45%"> Edit →</button>
                </form>
            </div>
        </div>
    </div>
@endsection

