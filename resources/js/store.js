import {createStore} from "vuex";
import {useToast} from "vue-toastification";
const toast = useToast()
export default   createStore({
    state () {
        return {

            todos : [],
            users : [],
            projects : [],
        }
    },
    mutations: {

        setTodos(state, todos) {
            state.todos = todos
        },
        markedAsDone(state, todo) {

            state.todos = state.todos.map(t =>{
                 if (t.id == todo.id) {
                     t.state = todo.state
                     t.views_count = todo.views_count
                 }
                return t
            })
            console.log({TODOS: state.todos , state})
        },
        setUsers(state , users){
            state.users = users
        },
        setProjects(state , projects){
            state.projects = projects
        },
    },
    actions: {
        async  addProject({state , commit} , name ){

            try {
                if(!name || name.length < 2) throw {message : "Project needs to be at least 2 chars"}
                let {data: projects} = await axios.post("api/projects"  , {name} )
                commit('setProjects' , projects)
                toast.success("Project "+name + " Added!" , {timeout:2000});
            }catch (e) {
                toast.error(e.message , {timeout:2000});
                throw e
            }
        },
        async  projectsApi({state , commit} ){

            let {data: projects} = await axios.get("api/projects"  )
            commit('setProjects' , projects)
      },
      async  getUsers({state , commit} ){

          let {data: users} = await axios.get("api/users"  )
          commit('setUsers' , users)
      },
      async  onViewed({state , commit} , {id}){
            try {
                let {data: todo} = await axios.put("api/todos/" + id +"/views", {views_count : true }   )
                // toast[todoState == "Done" ? 'success' : 'warning' ](todoState+"!" , {timeout:2000});
                if(state.todos.length)
                commit('markedAsDone' , todo)
                return todo
            }catch(e) {
                console.error(e)
                toast.error("Something went Wrong..in views count" , {timeout:2000});
            }
        },
        markAsDone({dispatch} , todo){
           return  dispatch('updateTodo', {...todo , state:"Done"})
        },
          markAsTodo({dispatch} , todo){
            return  dispatch('updateTodo', {...todo , state:"Todo"})
        },
        async updateTodo({state , commit} , {id  , state: todoState  }){
            try {
                let {data: todo} = await axios.put("api/todos/" + id, {state : todoState })
                // this.$emit('markedAsDone', todo)
                commit('markedAsDone' , todo)
                toast[todoState == "Done" ? 'success' : 'warning' ](todoState+"!" , {timeout:2000});
                return todo
            }catch(e) {
                console.error(e)
                toast.error("Something went Wrong.." , {timeout:2000});
            }
        },
        async deleteTodo({state ,commit} , {name, id}) {

            axios
                .delete(`api/todos/${id}`)
                .then(response => {
                    toast.success(name + " Deleted!")
                    commit('setTodos', state.todos.filter(todo => todo.id != id))
                });
        },
        async todosApi ({ commit }) {

                try {
                    let {data : todos} = await  axios.get('api/todos')
                    // this.todos = todos
                    commit('setTodos' , todos)
                }catch (e) {
                    console.error(e)
            }


        }
    }
})
