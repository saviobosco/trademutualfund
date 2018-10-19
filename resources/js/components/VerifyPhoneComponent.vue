<template>
    <div>
        <div v-if="step === 1">
            <div class="form-group row ">
            <label class="col-md-4 col-form-label text-md-right" for="amount"> Phone Number </label>
                    <div class="col-sm-6">
                        <input type="text" v-model="phone_number" class="form-control"  required>
                    </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit"
                        class="btn btn-primary"
                        :disabled="phone_number === null || phone_number.length <= 0"
                        @click="sendCode"
                        >
                        Send Code
                    </button>
                </div>
            </div>
        </div>
        <div v-if="step === 2">
            <div class="form-group row ">
            <label class="col-md-4 col-form-label text-md-right" for="amount"> Verification Code </label>
                    <div class="col-sm-6">
                        <input type="text" v-model="code" class="form-control"  required>
                    </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit"
                        class="btn btn-primary"
                        :disabled="code === null || code.length < 4"
                        @click="verifyCode"
                        >
                        Verify
                    </button>
                    <p>
                    Did not recieve any code ? <a href="javascript;" @click.prevent="resendCode">resend code </a> or 
                    <a href="javascript;" @click.prevent="changeNumber"> change number </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "VerifyPhoneComponent",
  props: ["phone_number"],
  data() {
    return {
      step: 1,
      code: null
    };
  },
  methods: {
    sendCode() {
      this.$http
        .post("/phone_verification/send_code", {
          phone_number: this.phone_number
        })
        .then(response => {
          if (response.data.data === "OK") {
            this.$swal(
              "Success!",
              `A verificaction code was successfully sent to ${
                this.phone_number
              }.`,
              "success"
            );
            this.step = 2;
          }
          console.log(response);
        });
    },
    resendCode() {
      this.$http
        .post("/phone_verification/resend_code", {
          phone_number: this.phone_number
        })
        .then(response => {
          if (response.data.data === "OK") {
            this.$swal(
              "Success!",
              `A verificaction code was successfully resent to ${
                this.phone_number
              }.`,
              "success"
            );
          }
          console.log(response);
        });
    },
    submitRequest() {},
    verifyCode() {
      this.$http
        .post("/phone_verification/verify_code", {
          phone_number: this.phone_number,
          code: this.code
        })
        .then(response => {
          if (response.data.data === "OK") {
            this.$swal(
              "Success!",
              "your phone number was successfully verified.",
              "success"
            );
            setTimeout(() => {
              window.location = "/home";
            }, 3000);
          }
        });
    },
    changeNumber() {
      this.step = 1;
      this.code = null;
    }
  }
};
</script>
