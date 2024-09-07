<x-layout>
    <header>
        <h3 class="container font-weight-bold text-center pb-5">
            Organization Tasks
        </h3>
    </header>

    <main class="container" style="min-height: 100vh">
        @if ($orgTable->count() == 0)
        <form action="/addtableOrg" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-6 form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Create Table</button>
                </div>
            </div>
        </form>
        @endif

        @if ($orgTable->count() !== 0)
        <div class="row">
            <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Severity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orgTable as $tableTask)
                                <tr>
                                    <td id="td-date{{ $tableTask->date }}">{{ $tableTask->date }}</td>
                                    <td id="td-activity{{ $tableTask->date }}"> {{ $tableTask->activity }}</td>
                                    <td id="td-description{{ $tableTask->date }}"> {{ $tableTask->description }}</td>
                                    <td id="td-severity{{ $tableTask->date }}"><span id="td-severity-span{{ $tableTask->date }}">{{ $tableTask->severity }}</span>
                                        <select id="td-severity-select{{ $tableTask->date }}"
                                        style="display: none"
                                        class="form-control">
                                            <option value="" disabled selected>Select Option</option>
                                            <option value="Low">Low</option>
                                            <option value="Medium">Medium</option>
                                            <option value="High">High</option>
                                        </select>
                                    </td>
                                    <td id="td-action{{ $tableTask->date }}">
                                        <form action="/completeTaskOrg" method="post">
                                            @csrf
                                            <input type="hidden" name="task_id" value="{{ $tableTask->date }}">
                                            <button type="submit" class="btn btn-success">Complete</button>
                                        </form>
                                    </td>
                                    <td id={{ $tableTask->date }} onclick="editRow(this)"><button id="editButton{{ $tableTask->date }}" class="btn btn-light">Edit</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        @if ($completedTasks->count() !== 0)
        <div class="col-md-12 mt-5">
            <h3 class="text-center font-weight-semibold">Completed Task</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Severity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedTasks as $task)
                            <tr>
                                <td>{{ $task->activity }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->date }}</td>
                                <td>{{ $task->severity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </main>
</x-layout>

<script>
function editRow(id){
    const tdActivity = document.getElementById("td-activity" + id.id);
    const tdDescription = document.getElementById("td-description" + id.id);
    const tdSeverity = document.getElementById("td-severity" + id.id);
    const tdSeveritySpan = document.getElementById("td-severity-span" + id.id);
    const tdSeveritySelect = document.getElementById("td-severity-select" + id.id);
    const tdEditButton = document.getElementById("editButton" + id.id);


    console.log(tdEditButton.innerHTML);
    if(tdEditButton.innerHTML === "Edit"){
    tdEditButton.classList.remove("btn");
    tdEditButton.classList.remove("btn-light");
    tdEditButton.classList.add("btn");
    tdEditButton.classList.add("btn-success");
    tdEditButton.innerHTML = "Save";

    tdActivity.setAttribute('style','background-color: #f5f5f4');
    tdDescription.setAttribute('style','background-color: #f5f5f4');
    tdSeveritySelect.setAttribute('style','background-color: #f5f5f4');

    tdActivity.contentEditable = true;
    tdDescription.contentEditable = true;
    tdSeveritySpan.style.display = "none";
    tdSeveritySelect.style.display = "block";

    }

    else if(tdEditButton.innerHTML === "Save"){
        const task = {
            date: id.id,
            activity: tdActivity.innerHTML,
            description: tdDescription.innerHTML,
            severity: tdSeveritySelect.value,
        }
        function makeRequest() {
            const csrfToken = '{{ csrf_token() }}';
            const response = fetch('/editTableTask', {
            method: 'POST',
            headers: {
             'Content-type': 'application/json',
             'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(task),
            }).then((response) => {
                if (response.status === 200) {
                console.log(response);
                window.location.href = '/orgTasks';
                } else {
                    console.log(response.status);
                }
            });
        }

        makeRequest();

}
}

</script>
