<template>
    <div>
        <div v-if="parseInt(logged_in_user) === get_payment_user">
                <h5> You are to be paid by</h5>
                <countdown ref="countdown" :time="transaction_expires">
                    <template slot-scope="props">Time Remaining：{{ props.days }} days, {{ props.hours }} hours, {{ props.minutes }} minutes, {{ props.seconds }} seconds.</template>
                </countdown>
                <div>
                    <p> Name : {{ transaction.make_payment_user.name }} </p>
                    <p> Phone : {{ transaction.make_payment_user.phone_number }} </p>
                    <p> Amount : {{ transaction.amount }} </p>
                    <p> Transaction Status : <span v-html="$options.filters.status(transaction.status)"></span> </p>
                </div>
                <div class="m-b-20">
                    <div v-if="transaction.photo_proofs.length > 0" id="gallery" class="gallery clearfix">
                        <div v-for="photo in transaction.photo_proofs" :key="photo.id" class="image pull-left">
                            <div class="image-inner">
                                <a target="_blank" :href="photo.photo_url" data-lightbox="gallery-group-1">
                                    <img class="img-thumbnail" :src="photo.photo_url" :alt="photo.photo_name" />
                                </a>
                                <p class="image-caption">
                                    {{ photo.id }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div v-if="transaction.transaction_reports.length > 0">
                        <div class="alert alert-danger">
                            Image(s) has been report as fake POP!
                        </div>
                    </div>
                </div>
            <div v-if="transaction.status == 1">
                <button @click="confirmTransaction" class="btn btn-sm btn-primary"> Confirm payment  </button>
                <button :disabled="! canRemoveImage" @click="reportFakePOP" class="btn btn-sm btn-danger"> Report Transaction</button>
                <span class="" v-if="transaction.photo_proofs.length > 0">{{ transaction.photo_proofs.length  }} Image(s) Uploaded </span> | 
                <span class="" v-if="transaction.transaction_reports.length > 0">{{ transaction.transaction_reports.length  }} Report(s) </span>
            </div>
            <!-- <div v-if="transaction.status == 2">
                <add-testimony-component :investment_id="transaction.get_payment.investment_id" @testimonyAdded="transactionCompleted">
                </add-testimony-component>
            </div> -->

        </div>




        <div v-if="parseInt(logged_in_user) === make_payment_user">
            <h5> You are to pay </h5>
            <countdown :time="transaction_expires">
                <template slot-scope="props">Time Remaining：{{ props.days }} days, {{ props.hours }} hours, {{ props.minutes }} minutes, {{ props.seconds }} seconds.</template>
            </countdown>
            <div>
                <p> Name : {{ transaction.get_payment_user.name }} </p>
                <p> Phone : {{ transaction.get_payment_user.phone_number }} </p>
                <p> Amount : {{ transaction.amount }} </p>
                <h4> Payment Detail </h4>
                <p> Account Name: {{ transaction.get_payment_user.user_payment_details.account_name }} </p>
                <p> Account Number: {{ transaction.get_payment_user.user_payment_details.account_number }} </p>
                <p> Bank Name: {{ transaction.get_payment_user.user_payment_details.bank.name }} </p>
                <p> Transaction Status : <span v-html="$options.filters.status(transaction.status)"></span> </p>
            </div>

            <div class="m-b-20">
                <div v-if="transaction.photo_proofs.length > 0" id="gallery" class="gallery clearfix">
                    <div v-for="photo in transaction.photo_proofs" :key="photo.id" class="image pull-left">
                        <div class="image-inner">
                            <a target="_blank" :href="photo.photo_url" data-lightbox="gallery-group-1">
                                <img class="img-thumbnail" :src="photo.photo_url" :alt="photo.photo_name" />
                            </a>
                            <p class="image-caption">
                                {{ photo.id }}
                            </p>
                        </div>
                        <!-- <button :disabled="! canRemoveImage" @click="removeImage(photo.id)" class="btn btn-sm btn-danger m-t-5">remove</button> -->
                    </div>
                </div>
            </div>
            <div v-if="transaction.transaction_reports.length > 0">
                <div class="alert alert-danger">
                    Image(s) has been report as fake POP!
                </div>
            </div>
            <div>
                <button :disabled="! canUploadImage" type="button" data-toggle="modal" @click="openModal" class="btn btn-sm btn-primary"> Upload Proof </button>
                <span class="" v-if="transaction.photo_proofs.length > 0">{{ transaction.photo_proofs.length  }} Images Uploaded </span> |
                <span class="" v-if="transaction.transaction_reports.length > 0">{{ transaction.transaction_reports.length  }} Report(s) </span>
            </div>
            <!-- Modal -->
            <div class="modal fade" :id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title"> Upload Proof </h4>
                        </div>
                        <div class="modal-body">
                            <img style="width: 100%;" v-bind:src="imagePreview" v-show="showPreview"/>
                            <label for="file">
                                <input id="file" type="file" ref="file" accept="image/*" v-on:change="handleFileUpload()">
                            </label>
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                            <button :disabled="!showPreview || isUploadingImage" @click="uploadImage" type="button" class="btn btn-sm btn-success"> Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>


<script>
export default {
  name: "Transaction",
  props: {
    id: {
      type: Number,
      required: true
    },
    transaction: {
      type: Object
    },
    logged_in_user: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      file: "",
      showPreview: false,
      imagePreview: "",
      modal: "modal-" + this.id,
      canRemoveImage: this.transaction.transaction_reports.length
        ? false
        : true,
      canUploadImage: this.transaction.photo_proofs.length ? false : true,
      isUploadingImage: false
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
    },
    get_payment_user() {
      return parseInt(this.transaction.get_payment_user_id);
    },
    make_payment_user() {
      return parseInt(this.transaction.make_payment_user_id);
    }
  },
  watch: {
    "transaction.transaction_reports"(value) {
      if (value.length > 0 && this.canRemoveImage === true) {
        this.canRemoveImage = false;
      }
    },
    "transaction.photo_proofs"(value) {
      if (value.length > 0 && this.canRemoveImage === true) {
        this.canUploadImage = false;
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
        default:
          return '<span class="label label-default"> Unknown </span>';
      }
    }
  },
  methods: {
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
        try {
          let response = await this.$http.post(
            `/transactions/confirm/${this.id}`
          );
          if (response.data.data === "OK") {
            this.$swal(
              "Confirmed!",
              "transaction has been confirmed.",
              "success"
            );
            this.transaction.status = 2;
            this.$refs.countdown.stop();
            this.transactionCompleted();
          }
        } catch (error) {
          this.$swal("Error!", "transaction could not be confirmed.", "error");
        }
      }
    },
    handleFileUpload() {
      /*
            Set the local file variable to what the user has selected.
            */
      this.file = this.$refs.file.files[0];
      /*
            Initialize a File Reader object
            */
      let reader = new FileReader();

      /*
            Add an event listener to the reader that when the file
            has been loaded, we flag the show preview as true and set the
            image to be what was read from the reader.
            */
      reader.addEventListener(
        "load",
        function() {
          this.showPreview = true;
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );

      /*
            Check to see if the file is not empty.
            */
      if (this.file) {
        /*
                Ensure the file is an image file.
            */
        if (/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
          /*
                    Fire the readAsDataURL method which will read the file in and
                    upon completion fire a 'load' event which we will listen to and
                    display the image in the preview.
                    */
          reader.readAsDataURL(this.file);
        }
      }
    },
    uploadImage() {
      this.isUploadingImage = true;
      /*
            Initialize the form data
            */
      let formData = new FormData();

      /*
                Add the form data we need to submit
            */
      formData.append("file", this.file);

      /*
                Make the request to the POST /single-file URL
            */
      this.$http
        .post(`/transactions/upload_proof/${this.id}`, formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          this.transaction.photo_proofs.push(response.data.data);
          $(`#modal-${this.id}`).modal("hide");
          this.isUploadingImage = false;
        })
        .catch(function() {
          console.log("FAILURE!!");
          this.isUploadingImage = false;
        });
    },
    removeImage(id) {
      this.$http
        .post(`/transactions/remove_proof/${this.id}`, { image_id: id })
        .then(response => {
          this.transaction.photo_proofs = this.transaction.photo_proofs.filter(
            image => {
              return image.id !== id;
            }
          );
        });
    },
    async reportFakePOP() {
      let result = await this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#388e3c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Report Transaction!"
      });
      if (result.value) {
        let response = await this.$http.post(
          `/transactions/report/${this.id}`,
          {
            type: "fake_pop"
          }
        );
        if (response.data.data === "OK") {
          this.$swal("Reported!", "transaction has been reported.", "success");
          let transaction = response.data.data;
          this.transaction.transaction_reports.push(transaction);
        }
      }
    },
    openModal() {
      $(`#${this.modal}`).modal("show");
    },
    transactionCompleted() {
      this.$emit("remove-transaction", this.transaction.id);
    }
  }
};
</script>
