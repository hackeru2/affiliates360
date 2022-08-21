<template>
        <div v-if="todo" class="card text-center my-box-shadow todo-page" >
            <div class="card-header">
                <span v-html="done ? '✅ ' :  '📝 ' "/>
                {{ todoState }}
            </div>
            <div class="card-body" :class="[done ? 'bg-success text-white' : 'bg-light']">
                <h1 class="card-title"  :class="{['text-white']: done }" >
                    #{{todo.id}}
                    {{todo.name}}</h1>
                <p class="card-text">{{todo.description}}</p>
                <p class="card-text">User: <b>{{userName}}</b></p>
                <p class="card-text">Project: <b>{{projectName}}</b></p>
                <h3 class="card-title"  :class="{['text-white']: done }" >Views Count: {{todo.views_count}}</h3>
                <button
                    class="btn btn-primary"
                    @click="$router.push({name : 'Todos'})">
                    Back
                </button>
                <a-popconfirm title="Are you sure？"
                              @confirm="onDelete"
                >
                    <button class="btn btn-danger">
                        Remove
                    </button>
                </a-popconfirm>
                <button
                    v-if="!done"
                    class="btn btn-success"
                    title="Mark as done"
                    @click="onClickDone"
                >
                    Mark as Done
                </button>
                <button
                    v-else
                    class="btn btn-warning"
                    title="Mark as undone"
                    @click="onClickTodo"
                >
                    Mark as undone
                </button>
            </div>
            <div class="card-footer text-muted">
                {{ timeFromNow }}
            </div>
        </div>
</template>

<script>
    import {useToast} from "vue-toastification";
    import moment from 'moment';
    import  {mapMutations,mapState , mapActions} from "vuex";
    export  default {
        data() {
            return {
                lonelyTodo : null
            }
        },
    computed: {
        projectName(){
            try {
                return this.todo.project.name
            }catch (e) {
               return e
            }
        },
        userName(){
            try {
                return this.todo.user.name
            }catch (e) {
                return e
            }
        },
        timeFromNow(){
            return moment(this.todo.created_at).fromNow()
        },
            id() {
                return this.$route.params.id
            },
            todo()
            {
                    return this.todos.find(todo => todo.id == this.id ) || this.lonelyTodo
            },
        todoState() {
            try {
                return this.todo.state
            } catch (e) {

            }
        },
        done() {
            return this.todo.state === "Done"
        },
        ...mapState(['todos'])


    },
    watch : {
        todo(nv) {
            if(!nv) this.$router.replace({name:"Todos"})
        }
    },
    async created() {
        if(!this.todo)
            await this.getTodo()
        if(this.todo) {
            console.log(this.todo)
         this.lonelyTodo =  await this.onViewed(this.todo)
        }
    },
        methods:{
        onDelete(){
            this.deleteTodo(this.todo)
            this.lonelyTodo = null;
        },
        async getTodo(){
            {
                try {
                    let {data : todo} = await axios.get(`api/todos/${this.$route.params.id}`)
                     this.lonelyTodo = todo
                }catch (e) {
                    this.redirectIf404(e)
                }

            }
        },
    ...mapActions(['updateTodo','deleteTodo','markAsTodo','markAsDone','onViewed']),
    ...mapMutations(['setTodos']),
            async onClickTodo(){
                this.lonelyTodo = await this.markAsTodo(this.todo)
            },
            async onClickDone(){
               this.lonelyTodo = await this.markAsDone(this.todo)
            },
        redirectIf404(e) {
                try {
                    if (e.response.status == 404)
                        this.$router.replace({name:"Todos"})
                    const toast = useToast();
                    toast.warning('Sorry page doesnt exists');
                }catch (e) {
                    console.error("error redirect")
                }
    },
},

    }
</script>
<style>
.todo-page {
    width: 80vw;
    margin-top: 27px;
    margin-left: 61px;
}
.todo-page button {
    margin: 4px;
}
</style>
