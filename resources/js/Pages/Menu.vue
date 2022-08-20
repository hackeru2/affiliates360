<template>
    <div class="menu-page text-center">
        <h1>HELLO !</h1>

        <router-link :to="{name: 'Todos'}" class="btn btn-primary">Todos
        </router-link>
        <router-link :to="{name: 'Projects'}" class="btn btn-primary">Projects
        </router-link>

    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: []
        }
    },

    created() {
        console.log(axios.baseName)
        console.log(axios.baseURL)
        // this.axios
        //     .get('http://localhost:8000/api/posts')
        //     .then(response => {
        //         this.posts = response.data;
        //     });
    },
    methods: {
        deletePost(id) {
            this.axios
                .delete(`http://localhost:8000/api/post/delete/${id}`)
                .then(response => {
                    let i = this.posts.map(item => item.id).indexOf(id); // find index of object
                    this.posts.splice(i, 1)
                });
        }
    }
}
</script>
<style>
.menu-page {
    margin-left:60px;
    padding: 40px;
    display: flex;
    flex-direction: column;
}
.menu-page a {
    margin-top:30px;
}
</style>
