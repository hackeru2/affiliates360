import TodosPage from '../components/AllPosts.vue';
import ProjectsPage from '../Pages/Projects.vue';
import TodoPage from "../Pages/Todo.vue"
import Menu from "../Pages/Menu"
export default  [
    {
        name: 'Home',
        path: '/',
        sidebar:true,
        component: Menu
    },
    {
        name: 'Todos',
        path: '/todos',
        sidebar:true,
        component: TodosPage
    },
    {
        name: 'Todo',
        path: '/todos/:id',
        component: TodoPage
    },
    {
        name: 'Projects',
        path: '/projects',
        sidebar:true,
        component: ProjectsPage
    },


];
