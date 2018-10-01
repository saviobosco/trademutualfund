<script>
export default {
    data() {
        return {
            investments: [],
            investment: null,
            testimony: null,
        };
    },
    methods: {
        openModal() {
            $('#addTestimony').modal('show');
        },
        closeModal() {
            $('#addTestimony').modal('hide');
            this.clearTestimony();
            this.clearInvestment();
        },
        async cancelInvestment(id) {
            let result = await Vue.swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#388e3c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Cancel Investment!'
                });
                if (result.value) {
                    let response = await this.$http.post(`/user_investments/cancel/${id}`);
                    if (response.data.data === 'OK') {
                        Vue.swal('Confirmed!','investment has been cancelled.', 'success');
                    }
                }
                this.getInvestments();
        },
        async cashOutInvestment(id) {
            let result = await Vue.swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#388e3c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, CashOut Investment!'
                });
                if (result.value) {
                    let response = await this.$http.post(`/user_investments/cash_out/${id}`);
                    if (response.data.data === 'OK') {
                        Vue.swal('Confirmed!','investment has been cashed out.', 'success');
                    }
                }
                this.getInvestments();
        },
        selectInvestment(id) {
                let selectedInvestment = this.investments.filter((investment) => {
                    return investment.id === id;
                });
            this.investment = selectedInvestment[0];
        },
        async addTestimony(id) {
            // open modal
            $('#addTestimony').modal('show');
            this.selectInvestment(id);            
        },
        async submitTestimony() {
            let response = await this.$http.post(`/user_investments/addTestimony/${this.investment.id}`, {testimony: this.testimony});
             if (response.status === 200) {
                Vue.swal('Success','The testimony was successfully added!','success');
             }
             this.getInvestments();
             this.closeModal();
        },
        clearTestimony() {
            this.testimony = null;
        },
        clearInvestment() {
            this.investment = null;
        },
        async getInvestments() {
            let response = await this.$http.get('/user_investments/index');
            if (response.status === 200) {
                this.investments = [ ...response.data.data];
            }
        }
    },
    filters: {
        status(status) {
            status = parseInt(status);
            switch (status) {
              case 1:
                return '<span class="label label-primary"> active </span>';
              break;
              case 2:
                return '<span class="label label-success"> confirmed </span>';
              break;
              case 3:
                return '<span class="label label-success"> cash out </span>';
              break;
              case 4:
                return '<span class="label label-success"> cashed out </span>';
                break;
              case 5:
                return '<span class="label label-success"> completed </span>';
                break;  
              case -1:
                return '<span class="label label-danger"> cancelled </span>'
                break;
              default:
                return '<span> Unknown </span>';

          }
        }
    },
    async created() {
        this.getInvestments();
    }
}
</script>
