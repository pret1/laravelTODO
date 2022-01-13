<?php
$title = "Todo list";

/**
 * @var Illuminate\Http\Request $request
 *
 */

$request = $request ?? (new  Illuminate\Http\Request());
$arrTasks = $arrTasks ?? '';
?>
@include('header')
<div class="container">
    <div class="todo">
        <h1>Todo list</h1>
        <form id="forma1" action="{{ route('store') }}" method="post" name="todoForm">
            @csrf
            @error('task')
            <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="hidden" name="action" id="task" value="add">
            <input type="text" name="task" id="textTask" class="@error('task') is-invalid @enderror">

            <input id="submit-button" type="button" value="Send" class="addTask" >
            <input type="hidden" name="id" id="taskId" class="qqq" value="">
            <input type="hidden" name="done" id="chekTask" value="0">
            <h1>Task</h1>
            <div class="listTask" id="main">
            </div>
        </form>
    </div>
    <div class="logout">
        <a href="{{ route('logout') }}">
            <button id="buttonLogout">Logout</button>
        </a>
    </div>
</div>

<script>

    const updateTasks = (data) => {
        const tasksContainer = document.querySelector('.listTask');
        tasksContainer.innerHTML = '';
        data.forEach((el) => {
            let div = document.createElement('div');
            div.id = el.id;
            div.className = 'oneTask';
            let input = document.createElement('input');
            input.type = 'checkbox';
            input.className = 'chek'
            let p = document.createElement('p');
            if (el.done === 1) {
                input.checked = true;
                p.innerHTML = el.task;
                p.style = 'text-decoration: line-through';
            } else {
                p.innerHTML = el.task;
            }
            let button = document.createElement('button');
            button.className = 'btn';

            div.appendChild(input);
            div.appendChild(p);
            div.appendChild(button);
            tasksContainer.append(div)
        })
    }

    function getTask() {
        axios.get('{{ route('getTask') }}')
            .then(response => {
                updateTasks(response.data)
                })
    }
    getTask();



    function changeId(e) {
        let input = document.getElementById('taskId');
        const id = e.target.parentElement.getAttribute('id')
        input.setAttribute('value', id);
    }

    document.getElementById('main').addEventListener('click', (e) => {
        if (e.target.classList.contains('btn')) {
            document.getElementById('task').value = "delete";
            changeId(e)
        }
        if (e.target.classList.contains('chek')) {
            document.getElementById('task').value = "update"
            if (e.target.checked) {
                document.getElementById('chekTask').value = '1';
            } else {
                document.getElementById('chekTask').value = '0';
            }
            changeId(e)
        }
    });
    let textTask = document.getElementById('textTask')
    let done = document.getElementById('chekTask').value
    const doTask = () =>{
        let data = new FormData(document.getElementById("forma1"));
        axios.post('{{ route('store') }}', data)
            .then(response => {
                updateTasks(response.data)
            })
    }

    const listTask = document.querySelector('.todo');
    listTask.addEventListener('click', (e) => {
        e.preventDefault()
        if (e.target.classList.contains('btn')) {
            doTask()
        }
        if (e.target.classList.contains('addTask')) {
            doTask()
            document.getElementById('textTask').value = '';
        }
        if (e.target.classList.contains('chek')) {
            doTask()
        }
    });

</script>


@include('foter')

