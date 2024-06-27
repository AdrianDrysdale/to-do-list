@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control" name="name" type="text" placeholder="Insert task name"/>
                    @if($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <button class="btn btn-primary btn-block" type="submit">Add</button>
            </form>
        </div>
        <div class="col-md-8">
           <div class="panel panel-default">
               <div class="panel-body">
                   @if (session('message'))
                       <div class="alert">{{ session('message') }}</div>
                   @endif
                   <table class="table">
                       <thead>
                        <tr>
                            <th>#</th>
                            <th>Task</th>
                            <th></th>
                        </tr>
                       </thead>
                       <tbody>
                       @foreach ($tasks as $task)
                           <tr>
                               <td>{{ $loop->iteration }}</td>
                               <td><span @if($task->completed) class='strike-through'  @endif>{{ $task->name }}</span></td>
                               <td style="display: flex">
                                 @if(!$task->completed)
                                         <form action="{{ route('tasks.update', $task) }}" method="POST">
                                             @csrf
                                             @method('PATCH')
                                             <input type="hidden" name="completed" value="1" />
                                             <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                                         </form>
                                         <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                             @csrf
                                             @method('DELETE')
                                             <button class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                         </form>
                                 @endif
                               </td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
    </div>
@endsection

