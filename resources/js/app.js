import { createApp  } from 'vue'

import HelloWorld from './components/Welcome.vue';
import App from "./components/App";
import VueRouter, {createRouter, createWebHashHistory, createWebHistory} from "vue-router"
import routes from "./routes";
import "./bootstrap"
import Toast from "vue-toastification";
import store from "./store"
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';


// Import the CSS or use your own!
import "vue-toastification/dist/index.css";



// Install the store instance as a plugin
const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
})
const app = createApp({ });
app.use(router)
app.use(store)
app.use(Toast, {});
app.use(Antd);
app.component('App', App)

app.mount('#app')
