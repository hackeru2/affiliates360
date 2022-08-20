<template>
    <div>


        <TheTopbar  @accepted="navOpen=!navOpen" @togglenav="navOpen = !navOpen" />

    <TheSidebar  :open="navOpen" />
    <!--        <h1>{{ title }}</h1>-->
        <div  style="display: flex;justify-content: space-around;">
    <router-view></router-view>
</div>

    </div>

</template>

<script setup>
import TheTopbar from './TheTopbar'
import TheSidebar from './TheSidebar'
import { ref } from 'vue'
import { useStore } from 'vuex'
const store = useStore()
const users = () => store.dispatch('getUsers')
users()
const title = "12312312312";
const navOpen = ref(true);

</script>
