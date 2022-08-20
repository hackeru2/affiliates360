<template>
    <div class="col-sm-4">

        <button type="button" class="btn btn-primary-outline" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">➕ Add  New Todo</button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Todo</h5>
                        <button type="button" class="btn-close" ref="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Name:</label>
                                <input type="text" @input="removeErrors('name')" :class="nameValidation" class="form-control" v-model="form.name" >
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" >Description:</label>
                                <textarea class="form-control"  :class="descriptionValidation" v-model="form.description" ></textarea>
                            </div>
                            <div class="mb-3">
                            <label for="user" class="col-form-label">User:</label>
                            <select class="form-select" aria-label="Default select example" :class="userIdValidation" v-model="form.user_id">
                                <option selected disabled>Open this select menu</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                            </select>
                            </div>
                            <div class="mb-3">
                            <label for="project" class="col-form-label" >Project:</label>
                            <select v-model="form.project_id"  :class="projectIdValidation" class="form-select" aria-label="Default select example">
                                <option disabled selected>Open this Users menu</option>
                                <option value=1>PROJECT One</option>
                                <option value=2>PROJECT  Two</option>
                                <option value=3>PROJECT  Three</option>
                            </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="onSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!--                    <div>-->
        <!--                        <h2>Add a todo</h2>-->
        <!--                        <input-->
        <!--                            type="text"-->
        <!--                            @keydown.enter="addNewItem"-->
        <!--                            v-model="item"-->
        <!--                            placeholder="Enter your Task and press enter"-->
        <!--                            class="form-control"-->
        <!--                        />-->
        <!--                    </div>-->
    </div>
</template>
<script>
import {useToast} from "vue-toastification";
import {mapState} from "vuex";

export default {
    data(){
        return {
            errorResponse : {},
            form:{
                name:'',project_id: null,user_id: null, description:""
            }
        }

},
    computed : {
        ...mapState(['users']),
        nameValidation(){
            try {
                return this.errorResponse.errors.name.length ? "is-invalid" : ""
            }
            catch(e){

            }
        },
        projectIdValidation(){
            try {
                return this.errorResponse.errors.project_id.length ? "is-invalid" : ""
            }
            catch(e){

            }
        },
        userIdValidation(){
            try {
                return this.errorResponse.errors.user_id.length ? "is-invalid" : ""
            }
            catch(e){

            }
        },
        descriptionValidation(){
            try {
                return this.errorResponse.errors.description.length ? "is-invalid" : ""
            }
            catch(e){

            }
        },
    },
    methods : {
        removeErrors(field) {
            try {
                this.errorResponse.errors[field] = []
            }catch (e){

            }
        },
        async onSubmit() {
            const toast = useToast()
            try {
                let { data:  todo } = await axios.post("api/todos", {...this.form})
                toast.success("My toast content", {
                    timeout: 2000
                });
                this.$emit('add' , todo)
                this.closeBtn()
            } catch (err) {
                console.log(err)
                let message = this.getError(err)
                toast.error(message, {
                    timeout: 2000
                });

            }

        },
        getError(err){
            try {
                this.errorResponse = err.response.data
                return this.errorResponse.message
            }catch (e){
                console.error(e)
                return "Sorry there is an error, please contact webmaster"
            }
        },
        closeBtn() {
            this.$refs.closeBtn.click()
        }
    }
}
</script>
