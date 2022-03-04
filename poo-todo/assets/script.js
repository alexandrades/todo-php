function renderTasks() {
    const body = {
        action: 'list'
    }

    const request = new XMLHttpRequest()
    request.onreadystatechange = function() {
        if(request.readyState === 4 && request.status === 200) {
            const tasks = JSON.parse(request.responseText).reverse()
            let index = 0;
            let taskList = document.getElementById('task-list')
            let listContent = ""
            
            for(let task of tasks) {
                const content = `
                <form class="item ${index % 2 !== 0 ? "dark" : ""}">
                    <div class="form-group">
                        <div>
                            <h3>${task.titulo}</h3>
                            <p>${task.descricao}</p>
                        </div>
                        <button type=\"submit\" onclick="deleteTask(${task.id})">Apagar</button>
                    </div>
                </form>
                `
                listContent += content
                index++
            }

            taskList.innerHTML = listContent
        }
    }

    request.open("POST", "http://localhost/todo-list/poo-todo/controller/Task.controller.php", true)
    request.setRequestHeader('Content-Type', "application/json")
    request.send(JSON.stringify(body))
}

function saveTask() {
    const body = {
        action: 'save',
        titulo: document.getElementById('titulo').value,
        descricao: document.getElementById('descricao').value
    }
    const request = new XMLHttpRequest()
    request.onreadystatechange = function() {
        if(request.readyState === 4 && request.status === 200){
            renderTasks()
        }
    }

    request.open("POST", "http://localhost/todo-list/poo-todo/controller/Task.controller.php", true)
    request.setRequestHeader('Content-Type', "application/json")
    request.send(JSON.stringify(body))
}

function deleteTask(taskId) {
    const body = {
        action: 'delete',
        taskId: taskId
    }
    const request = new XMLHttpRequest()
    request.onreadystatechange = function() {
        if(request.readyState === 4 && request.status === 200){
            renderTasks()
        }
    }

    request.open("POST", "http://localhost/todo-list/poo-todo/controller/Task.controller.php", true)
    request.setRequestHeader('Content-Type', "application/json")
    request.send(JSON.stringify(body))
}