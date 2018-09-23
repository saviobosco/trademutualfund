<script>
// This component is the main transactions component that work with the vue file
export default {
    name: 'Transactions',
    props: {
        url_link : {
            type: String,
            required: true
        }
    },
    data() {
        return {
            transactions: []
        };
    },
    components: {
        'transaction-component': require('./TransactionComponent.vue')
    },
    async created() {
        let response = await this.$http.get(this.url_link);
        if (response.status === 200) {
            this.transactions = response.data.data;
        }
    }
}
</script>
