<template>
    <transition name="show">
        <div class="sidebar" v-if="open">
            <transition-group appear name="fade">
                    <router-link
                        v-for="(item, index) in navElements" :key="item" :style="{'--index': index}"
                        :to="{path: item.path}" class="sidebar-element my-box-shadow">{{item.name}}
                    </router-link>
<!--                    <fa-icon class="icon" :icon="['fas', item]" size="2x" />-->
            </transition-group>
        </div>
    </transition>
</template>

<script>
import routes from "../routes";
export default {
    props: [
        'open'
    ],

    data: () => {
        return {
            // navElements: [
            //     'projects ', 'todos ']
        }
    },
    computed : {
        navElements(){
            return routes.filter(r => r.sidebar)
        }
    }
}
</script>

<style lang="scss" scoped>
.sidebar {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    top:0;
    position: fixed;
    flex-direction: column;
    width: 60px;
    height: calc(100vh);
    padding-top: 68px;
    z-index: 2;
    background-color: rgba($color: #242424, $alpha: .6);

    .sidebar-element {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 60px;
        height: 60px;
        margin-bottom: 8px;
        padding: 3px;
        cursor: pointer;
        color: #fefefe;
        background-color: #242424;
    }
}

.show {
    &-enter, &-leave-to {
        opacity: 0;
        transform: translateX(-60px);
    }

    &-enter-active, &-leave-active {
        transition: all 500ms;
    }
}

.fade {
    &-enter {
        opacity: 0;
        transform: translateX(-60px);
    }

    &-enter-active {
        transition: all 500ms ease-in-out;
        transition-delay: calc( 50ms * var(--index) );
    }
}
</style>
