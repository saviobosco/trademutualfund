<template>
    <div>
        <h4> Add Testimony </h4>
        <textarea v-model="testimony" class="form-control"></textarea>
        <div class="form-group m-t-10">
            <button @click="submitTestimony" type="button" class="btn btn-sm btn-success"> Add Testimony </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'add-testimony',
    props: {
        investment_id: null
    },
    data() {
        return {
            testimony: null
        };
    },
    methods: {
        async submitTestimony() {
            
            let response = await this.postTestimony();
             if (response.status === 200) {
                Vue.swal('Success','The testimony was successfully added!','success');
                this.$emit('testimonyAdded');
             }
        },
        async postTestimony() {
            let response;
            if (this.investment_id === null || this.investment_id === 'undefined') {
                response = await this.$http.post('/profile/add_testimony', {testimony: this.testimony});
            } else {
                response = await this.$http.post(`/user_investments/addTestimony/${this.investment_id}`, {testimony: this.testimony});
            }
            return response;
        }
    }
}
</script>
