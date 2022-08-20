<template>
    <div
          class="todo"
        :class="[todo.state == 'Done' ? 'bg-success text-white' : 'bg-light']"
    >

            <h4 :class="{ completed: done ,['text-white'] : done }" class="todo-h4" >
                <span v-html="done ? '✅' :  '📝' "/>
                {{ todo.name }}</h4>
<!--            <p>{{ todo.time }}</p>-->
            <button
                class="btn btn-primary"

                @click="$router.replace({name:'Todo' ,params: {id: todo.id}})">
                Open
            </button>
        <a-popconfirm title="Are you sure？"
            @confirm="deleteTodo(todo)">
            <button class="btn btn-danger">
                Remove
            </button>
        </a-popconfirm>
            <button
                v-if="!done"
                class="btn btn-success"
                @click="markAsDone(todo)"
            >
                Mark as Done
            </button>
            <button
                v-else
                class="btn btn-warning"
                @click="markAsTodo(todo)"
            >
                Mark as undone
            </button>
    </div>
</template>

<script>
import {useToast} from "vue-toastification";
import  {mapActions} from "vuex";

export  default {
    props :['todo'],
    computed: {
        done (){
        return this.todo.state == "Done"
        }
    },
    methods: mapActions(['updateTodo','deleteTodo','markAsTodo','markAsDone']),

}
</script>
<style>
.todo-h4 {
    display: inline;
}
.todo .todo-h4  , .todo button{
    margin:2px;
}
</style>
