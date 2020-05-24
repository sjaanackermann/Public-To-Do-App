// variables for the switches
const todo = document.getElementById('todo');
const cal = document.getElementById('calendar');
const ppl = document.getElementById('people');

// 2 switches for navigation
function switchTodo() {
    todo.setAttribute('class', 'none');
    ppl.setAttribute('class', 'inactive');
}

function switchPpl() {
    todo.setAttribute('class', 'inactive');
    ppl.setAttribute('class', 'none');
}
