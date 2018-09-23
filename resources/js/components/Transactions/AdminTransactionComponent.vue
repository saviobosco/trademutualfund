<script>
export default {
    props: {
        transaction_id: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            transaction: {
                make_payment_user: {
                    name: null
                },
                get_payment_user: {
                    name: null
                },
                photo_proofs:[],
                transaction_reports: []
            }
        }
    },
    methods: {
        async confirmTransaction() {
            let response = await this.$http.post(`/transactions/confirm/${this.transaction_id}`);
            if (response.data.data === 'OK') {
                this.transaction.status = 2;
            }
        },
        async cancelTransaction() {
            // cancel transaction
            let response = await this.$http.post(`/transactions/cancel/${this.transaction_id}`);
            if (response.data.data === 'OK') {
                this.transaction.status = -1;
            }
        }
    },
    async created() {
        let response = await this.$http.get(`/transactions/view/${this.transaction_id}`);
        this.transaction = { ...response.data.data};
    }
}
</script>
