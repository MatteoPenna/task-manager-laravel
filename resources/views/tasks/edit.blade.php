@extends('layout')

@section('content')

{{--    @dd($errors)--}}

    <div class="row justify-content-center mt-5">
        <div class="col-10 col-md-8">
            <form method="post" action="{{ route('tasks.update',$task->id) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-row align-items-center" style="text-align: left">
                    <div class="col-4">
                        <label class=" d-flex justify-content-start" style="padding-left: 0px">Task Name:</label>
                        <input name="name" class="form-control" value="{{ $task->name }}">
                    </div>
                    <div class="col-4">
                        <label class="d-flex justify-content-start" style="padding-left: 0px">Due Date:</label>
                        <input name="due_date" type="date" class="form-control" value="{{ $task->due_date }}">
                    </div>
                    <div class="col-4">
                        <label class="d-flex justify-content-start" style="padding-left: 0px">Label:</label>
                        <select class="form-control" name="label">
                            @foreach($colors as $color)
                                <option {{ ($task->label == $color) ? "selected" : ""}}>
                                    {{ $color }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row align-items-center" style="text-align: left; padding-top: 20px">
                    <div class="col-12">
                        <label class="" style="padding-left: 0px">Description:</label>
                        <textarea name="descrip" class="form-control" rows="4">{{ $task->description }}</textarea>
                    </div>
                </div>
                <div class="form-row align-items-center" style="text-align: left; padding-top: 20px">
                    <div class="col-6 d-flex justify-content-start">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="complete" id="complete">Done:&nbsp</label>
                            <input class="form-check-input" name="completed" value="1" type="checkbox" {{ $task->completed ? "checked" : ""}}>
                        </div>
                    </div>

                    <div class="col-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Confirm Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
