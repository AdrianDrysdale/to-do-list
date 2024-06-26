<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MLP To-Do</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('assets/logo.png')}}"  alt="logo"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <form action="{{url('/tasks')}}" method="POST">
                    @csrf
                    <input class="form-control" name="name" type="text" placeholder="Insert Task Name"/>
                    <button class="btn btn-primary btn-block" type="submit">Add</button>
                </form>
            </div>
            <div class="col-md-6">
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
                           <td>{{ $task->id }}</td>
                           <td>{{ $task->name }}</td>
                           <td>
                             @if(!$task->completed)
                                 <div>
                                     <form {{url('/tasks')}} method="POST">
                                         @csrf
                                         <button class="btn btn-success">tick</button>
                                     </form>
                                     <form {{url('/tasks')}} method="POST">
                                         @csrf
                                         <button class="btn btn-danger">x</button>
                                     </form>
                                 </div>
                             @endif
                           </td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">CopyRight &copy; 2024 All rights reserved</p>
            </div>
        </div>
    </div>
    </body>
</html>
