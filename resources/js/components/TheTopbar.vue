<template>
    <div class="topbar my-box-shadow ">
        <div>
<!--            <p>{{ count }}</p>-->
        <img   :src="imgSrc" @click="$emit('accepted')">

        </div>
        <div>
<!--            <span   >AMIR</span>-->
             USER NAME
        </div>
    </div>
</template>

<style lang="scss" scoped>
.topbar img {
    height: 30px;
    cursor: pointer;
    margin-left: 45px;
}
.topbar {
    display: flex;
    justify-content: space-between;
    width: 100vw;
    height: 50px;
    z-index: 3;
    padding: 10px 16px;
    background-color: #222;
    border-bottom: 1px solid #000;
    color: #fefefe;

    .icon {
        cursor: pointer;
    }

    .icon-circle {
        width: 32px;
        height: 32px;
        padding: 5px;
        margin-left: 10px;
        cursor: pointer;
        color: #222;
        background-color: #fefefe;
        border-radius: 50%;
    }
}
</style>
<script>
import { ref } from 'vue';

export default {
    emits: ['accepted'],

    setup() {
        const count = ref(0);
        const imgSrc="https://warlord0blog.files.wordpress.com/2018/03/vue-laravel.png"
        return { count , imgSrc };
    },
};
</script>
