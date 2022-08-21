<template>
        <div class="container">
            <h1 class="text-center" style="border-bottom: 1px solid green; padding-bottom: 5px;">Todos</h1>
            <div class="row">
            <div class="col-sm-8" >
               <div v-for="(projectTodos ,   name , i) in projectsTodos" :key="name"  class="row" >
                <h3 class="mt-3">{{name}}</h3>
                <div class="row">
                    <TransitionGroup name="list"  v-if="projectTodos.length" tag="div">

                        <Todo    v-for="(todo, index) in projectTodos"
                                 :key="todo.name"
                                 style="padding: 10px; margin-bottom: 10px"
                                 class="my-box-shadow " :todo="todo" />
                    </TransitionGroup>
                    <div v-else>You dont have any task to do.</div>
                </div>
            </div>

            </div>
            <AddTodo @add="onAdd" />
            </div>
        </div>
</template>

<script>
import AddTodo from "../components/AddTodo"
import Todo from "../components/Todo"
import {mapState, mapActions} from "vuex"
import { useToast } from "vue-toastification";

export default {
    components:{AddTodo , Todo},
    computed :  {
        ...mapState(['todos']),
        projectsTodos(){
            return _.groupBy(this.todos, 'project.name')
        },
    },

      created() {
        if(!this.todos.length)
          this.todosApi()
    },
    methods: {
        ...mapActions(['todosApi']),
        onAdd(todo) {
            this.todos.unshift(todo)
        },
        onDelete(id) {
            this.todos = this.todos.filter(todo => todo.id != id)
        },
    }
}
</script>
<style>
.my-box-shadow {
    box-shadow: 0 2px 4px #666;
}
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>
