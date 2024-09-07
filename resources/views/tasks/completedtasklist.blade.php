<x-layout>
    <header>
        <h1 class="container">Hello <strong>{{ Auth::user()->name }}</strong>, Welcome Universal Task Tracking System
        </h1>
    </header>

    <nav class="container">
        <ul>
            <li><a href="#">Individual</a></li>
            <li><a href="#">Organization</a></li>
            <li><a href="/completedTask">Completed Tasks</a></li>
        </ul>
    </nav>

    <main class="container">
        <form action="/addTask" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="execution_date">Execution Date</label>
                    <input type="date" name="execution_date" id="execution_date" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="execution_time">Execution Time</label>
                    <input type="time" name="execution_time" id="execution_time" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="task_type">Task Type</label>
                    <select name="type" id="task_type" class="form-control">
                        <option value="" disabled selected>Select Option</option>
                        <option value="Namaz">Namaz</option>
                        <option value="Tutoring">Tutoring</option>
                        <option value="Random">Random</option>
                    </select>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </div>
            </div>
        </form>



        <hr>

        <div class="row">
            <div class="col-md-12">
                <h2>Completed Task</h2>
                <div class="row p-4">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary">Namaz
                            <span class="btn btn-danger">
                                {{ $completedTasks->where('type', 'Namaz')->count() }}
                            </span>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary">Tutoring
                            <span class="btn btn-danger">
                                {{ $completedTasks->where('type', 'Tutoring')->count() }}
                            </span>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary">Random
                            <span class="btn btn-danger">
                                {{ $completedTasks->where('type', 'Random')->count() }}
                            </span>
                        </button>
                    </div>
                </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Execution Date</th>
                                <th>Execution Time</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($completedTasks->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-center">No Task Found</td>
                                </tr>
                            @endif
                            @foreach ($completedTasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->execution_date }}</td>
                                    <td>{{ $task->execution_time }}</td>
                                    <td>{{ $task->type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-layout>
