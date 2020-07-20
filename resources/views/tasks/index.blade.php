@extends('layout')

@section('content')

    <style>
        .divtext {
            /*white-space: pre;*/
            border: none;
            padding: 5px;
            width: 20em;
            min-height: 10em;
            overflow: scroll;
        }
    </style>

    <div class="row justify-content-center ">
        @if(session()->has('success'))
            <div class="col-12">
                <div class="alert alert-success">
                    Successfully created task
                </div>
            </div>
        @endif
        <div class="col-10">
            <h1 class="text-center">Task Manager</h1>
            <hr>
            <div class="row">
                <div class="col-6 justify-content-center">
                    <p class="text-center">To Do:</p>
                    @foreach($tasks->where('completed','=',0) as $task)
                        <div class="row justify-content-center">
                            <!-- new tasks would be added here -->
                            <div style="border:1px solid black" class="col-10 mt-2">
                                <div class="row justify-content-center py-2">
                                    <div class="col-2" style="background-color: {{ $task->label }}"></div>
                                    <div class="col-6" style="text-align: center; font-weight: bold">
                                        <p style="word-wrap: break-word; text-align: left">{{ $task->name }}</p>
                                    </div>
                                    <div class="col-2 justify-content-center" style="padding: 0">
                                        <form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button class="btn btn-link m-2" type="submit">X</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row justify-content-start mx-2">Due: {{ $task->due_date }}</div>
                                <div class="row justify-content-start mx-2">Description:</div>
                                <div class="row justify-content-start mx-2">
                                    <textarea class="divtext" readonly="readonly">{{ $task->description }}</textarea>
                                </div>
                                <div class="row justify-content-end mx-2">
                                    <a href="{{route('tasks.edit', $task)}}" class="btn btn-secondary btn-outline m-2">Edit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-6 justify-content-center">
                    <p class="text-center">Done:</p>
                    @foreach($tasks->where('completed','=',1) as $task)
                        <div class="row justify-content-center">
                            <!-- new tasks would be added here -->
                            <div style="border:1px solid black" class="col-10 mt-2">
                                <div class="row justify-content-center py-2">
                                    <div class="col-2" style="background-color: {{ $task->label }}"></div>
                                    <div class="col-6" style="text-align: center; font-weight: bold">
                                        <p style="word-wrap: break-word; text-align: left">{{ $task->name }}</p>
                                    </div>
                                    <div class="col-2 justify-content-center" style="padding: 0">
                                        <form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button class="btn btn-link m-2" type="submit">X</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row justify-content-start mx-2">Due: {{ $task->due_date }}</div>
                                <div class="row justify-content-start mx-2">Description:</div>
                                <div class="row justify-content-start mx-2">
                                    <textarea class="divtext" readonly="readonly">{{ $task->description }}</textarea>
                                </div>
                                <div class="row justify-content-end mx-2">
                                    <a href="{{route('tasks.edit', $task)}}" class="btn btn-secondary btn-outline m-2">Edit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-6 justify-content-center p-2 ">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <a href="{{route('tasks.create')}}" class="btn btn-outline-success btn-lg btn-block"> +
                                Task</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--
@section('modal')

    @section('task')

    <div style="border:1px solid black" class="col-8">
        <p class="text-center">Thing</p>
    </div>

    @endsection

    <!-- Modal -->
    <div class="modal fade" id="task-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Task Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="new-task">
                        @csrf
                        <div class="form-row align-items-center" style="text-align: left">
                            <div class="col-4">
                                <label class=" d-flex justify-content-start" style="padding-left: 0px">Task
                                    Name:</label>
                                <input name="name" class="form-control">
                            </div>
                            <div class="col-4">
                                <label class="d-flex justify-content-start" style="padding-left: 0px">Due Date:</label>
                                <input name="due-date"  type="date" class="form-control">
                            </div>
                            <div class="col-4">
                                <label class="d-flex justify-content-start" style="padding-left: 0px">Label:</label>
                                <select class="form-control" id="sel1" name="label">
                                    <option>Black (default)</option>
                                    <option>Blue</option>
                                    <option>Red</option>
                                    <option>Yellow</option>
                                    <option>Orange</option>
                                    <option>Green</option>
                                    <option>Purple</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row align-items-center" style="text-align: left; padding-top: 20px">
                            <div class="col-12">
                                <label class="" style="padding-left: 0px">Description/Notes:</label>
                                <textarea name="descrip" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-row align-items-center" style="text-align: left; padding-top: 20px">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Confirm Task</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
--}}

