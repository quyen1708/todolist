@extends('todos.layout')

@section('contentOne')
    <div class="container" style="padding-top: 20px">
        <div class="row">
            <a href='/' class="badge badge-pill badge-light" style="font-size: 150%; margin-left: 10%; margin-top: 3px">Get Back</a>
            <h1 class="text-center" style="margin-left: 20%">CREATE TO DO LIST</h1>
        </div>
        <x-alert />
        <br><br>

        <div class="row">
            <div class="col-lg-12" id="form_container">
                <form role="form" method="POST" action="/todos/create">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label for="Description">
                                Description:</label>
                            <textarea class="form-control" type="textarea" name="desc" id="desc" maxlength="6000" rows="7" placeholder="Description...."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <button type="submit" class="btn btn-lg btn-primary" value="Create" style="margin-left: 45%" >Create →</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

