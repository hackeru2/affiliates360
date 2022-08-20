<template>
    <div class="container">
        <h1 class="text-center" style="border-bottom: 1px solid green; padding-bottom: 5px;">Projects</h1>
        <div class="row" >
            <div class="col-sm-8">
                <TransitionGroup name="list"  v-if="projects.length" tag="div">

                    <div    v-for="(project, index) in projects"
                             :key="index"
                             style="padding: 10px; margin-bottom: 10px"
                             class="my-box-shadow "   >

                    {{index+1}}. {{project.name}}
                    </div>
                </TransitionGroup>
                <div v-else>Please wait...</div>

            </div>
            <AddProject />
        </div>
    </div>
</template>

<script>
import {mapState, mapActions} from "vuex"
import { useToast } from "vue-toastification";
import AddProject from "../components/AddProject"
export default {
    components:{AddProject},
    computed :  mapState(['projects']),

    created() {
            this.projectsApi()
    },
    methods: {
        ...mapActions(['projectsApi']),
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
