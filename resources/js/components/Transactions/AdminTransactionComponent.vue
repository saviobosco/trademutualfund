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
        time_elapse_after: 0,
        make_payment_user: {
          name: null
        },
        get_payment_user: {
          name: null
        },
        photo_proofs: [],
        transaction_reports: []
      }
    };
  },
  computed: {
    transaction_expires() {
      let time =
        new Date(this.transaction.time_elapse_after.date).getTime() -
        new Date().getTime();
      if (time > 0) {
        return time;
      }
      return 0;
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
        default:
          return '<span class="label label-default"> Unknown </span>';
      }
    }
  },
  methods: {
    async fetchTransaction() {
      let response = await this.$http.get(
        `/transactions/view/${this.transaction_id}`
      );
      this.transaction = { ...response.data.data };
    },
    async confirmTransaction() {
      let result = await this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#388e3c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Confirm Transaction!"
      });
      if (result.value) {
        let response = await this.$http.post(
          `/transactions/confirm/${this.transaction_id}`
        );
        if (response.data.data === "OK") {
          this.transaction.status = 2;
          this.$swal(
            "Confirmed!",
            "transaction has been confirmed.",
            "success"
          );
        }
      }
    },
    async cancelTransaction() {
      let result = await this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#388e3c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Cancel Transaction!"
      });
      if (result.value) {
        let response = await this.$http.post(
          `/transactions/cancel/${this.transaction_id}`
        );
        if (response.data.data === "OK") {
          this.transaction.status = -1;
          this.$swal(
            "Cancelled!",
            "transaction has been cancelled.",
            "success"
          );
        }
      }
    },
    async resetTimer() {
      let result = await this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#388e3c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Reset Transaction Timer!"
      });
      if (result.value) {
        let response = await this.$http.post(
          `/transactions/reset_timer/${this.transaction_id}`
        );
        if (response.data.data === "OK") {
          this.$swal(
            "Timer Reset!",
            "transaction timer has been reset.",
            "success"
          );
          this.fetchTransaction();
        }
      }
    },
    async resolveIssue() {
      let result = await this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#388e3c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Resolve Issue!"
      });
      if (result.value) {
        let response = await this.$http.post(
          `/transactions/resolve_issue/${this.transaction_id}`
        );
        if (response.data.data === "OK") {
          this.$swal(
            "Issue Resolved!",
            "transaction issue has been resolved.",
            "success"
          );
          this.fetchTransaction();
        }
      }
    }
  },
  async created() {
    this.fetchTransaction();
  }
};
</script>
