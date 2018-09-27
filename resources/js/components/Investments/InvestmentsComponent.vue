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
                return '<span class="label label-success"> cashed_out </span>';
              break;
              case 4:
                return '<span class="label label-success"> completed </span>';
                break;
              case -1:
                return '<span class="label label-danger"> active </span>'
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
