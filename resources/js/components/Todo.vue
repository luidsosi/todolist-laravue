<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo</div>

                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" placeholder="Todo..." class="form-control" aria-label="todo"
                                   aria-describedby="todo" v-model="todo_input">
                            <div class="input-group-append">
                                <button v-if="!edit_todo_index" type="button" class="btn btn-info text-white" @click="saveTodo()">Adicionar
                                </button>
                                <button v-else type="button" class="btn btn-info text-white" @click="updateTodo()">Atualizar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered mt-4">
                        <thead>
                        <th>S.no</th>
                        <th>Nome</th>
                        <th colspan="2">Ação</th>
                        </thead>
                        <tbody>
                        <tr v-for="(todo,index) in todos" :key="index">
                            <td>{{ ++index }}</td>
                            <td>{{ todo.name }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" @click="deleteTodo(todo.id)">
                                    Delete
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" @click="editTodo(--index)">
                                    Editar
                                </button>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Todo",
    data() {
        return {
            todos: [],
            api: 'http://localhost:8000/api/todos',
            todo_input: ``,
            edit_todo_index: null,
        }
    },
    mounted() {
        this.axios.get(this.api).then(response => this.todos = response.data);
    },
    methods: {
        saveTodo() {
            if (this.todo_input.length > 0) {
                this.axios.post(this.api, {'name': this.todo_input})
                    .then(response => {
                        this.todos.push(response.data);
                        this.todo_input = '';
                    });
            }
        },
        deleteTodo(id) {
            this.axios.delete(`${this.api}/${id}`).then(response => {
                console.log(response);
                this.todos = this.todos.filter(todo => todo.id !== id);
            });
        },
        editTodo(index) {
            this.todo_input = this.todos[index].name;
            this.edit_todo_index = index;
        },
        updateTodo() {
            this.axios.put(`${this.api}/${this.todos[this.edit_todo_index].id}`, {name: this.todo_input})
                .then(response => {
                    this.todos[this.edit_todo_index].name = response.data.name;
                    this.resetTodo();
                });
        },
        resetTodo(){
            this.todo_input = '';
            this.edit_todo_index = null;
        }
    }
}
</script>

<style scoped>

</style>
