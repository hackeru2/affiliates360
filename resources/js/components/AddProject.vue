<template>
    <div class="col-sm-4">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label" >Add new Project:</label>
                <input type="text" placeholder="Press enter to add"  @keyup.enter="onClick"  class="form-control" v-model="name" >
            </div>

</div>
</template>
<script>
import {mapActions} from "vuex";

export  default {
data(){
    return  {name:''}
},
    methods : {
    async onClick(){

        try {
            await this.addProject(this.name)
            this.name = ''
        }catch (e) {

        }
    },
    ...mapActions(['addProject'])}

}
</script>
