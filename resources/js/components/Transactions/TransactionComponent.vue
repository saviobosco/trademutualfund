<template>
    <div>
        <div v-if="logged_in_user === transaction.get_payment_user_id">
            <h5> You are to be paid by</h5>
            <div>
                <p> Transaction Id: {{ transaction.id }} </p>
                <p> Name : {{ transaction.make_payment_user.name }} </p>
                <p> Phone : {{ transaction.make_payment_user.phone_number }} </p>
                <p> Amount : {{ transaction.amount }} </p>
            </div>
            <div class="row" v-if="transaction.photo_proofs.length > 0">
                <div class="col-sm-3" v-for="photo in transaction.photo_proofs" :key="photo.id">
                    <img class="img-thumbnail" :src="photo.photo_url" :alt="photo.photo_name">
                </div>
            </div>
            <button @click="confirmTransaction" class="btn btn-sm btn-primary"> Confirm payment  </button>
            <button @click="reportFakePOP" class="btn btn-sm btn-danger"> Report Transaction</button>
            <span class="" v-if="transaction.photo_proofs.length > 0">{{ transaction.photo_proofs.length  }} Image(s) Uploaded </span> | 
            <span class="" v-if="transaction.transaction_reports.length > 0">{{ transaction.transaction_reports.length  }} Report(s) </span>

        </div>

        <div v-if="logged_in_user === transaction.make_payment_user_id">
            <h5> You are to pay </h5>
            <div>
                <p> Transaction Id: {{ transaction.id }} </p>
                <p> Name : {{ transaction.get_payment_user.name }} </p>
                <p> Phone : {{ transaction.get_payment_user.phone_number }} </p>
                <p> Amount : {{ transaction.amount }} </p>
            </div>
            <div class="row" v-if="transaction.photo_proofs.length > 0">
                <div class="col-sm-3" v-for="photo in transaction.photo_proofs" :key="photo.id">
                    <img class="img-thumbnail" :src="photo.photo_url" :alt="photo.photo_name">
                    <button :disabled="! canRemoveImage" @click="removeImage(photo.id)" class="btn btn-sm btn-danger">remove</button>
                </div>
            </div>
            <button type="button" data-toggle="modal" @click="openModal" class="btn btn-sm btn-primary"> Upload Proof </button>
            <!-- <button @click="reportFakePOP" class="btn btn-sm btn-danger"> Report Transaction</button> -->
            <span class="" v-if="transaction.photo_proofs.length > 0">{{ transaction.photo_proofs.length  }} Images Uploaded </span> | 
            <span class="" v-if="transaction.transaction_reports.length > 0">{{ transaction.transaction_reports.length  }} Report(s) </span>
            <!-- Modal -->
            <div class="modal fade" :id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload proof - Trans:{{ transaction.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <img style="width: 100%;" v-bind:src="imagePreview" v-show="showPreview"/>
                            <label for="file">
                                <input id="file" type="file" ref="file" accept="image/*" v-on:change="handleFileUpload()">
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button :disabled="!showPreview" @click="uploadImage" type="button" class="btn btn-primary"> Upload</button>
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
    name: 'Transaction',
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
            file: '',
            showPreview: false,
            imagePreview: '',
            modal: 'modal-' + this.id,
            canRemoveImage: (this.transaction.transaction_reports.length) ? false : true
        };
    },
    watch: {
        'transaction.transaction_reports'(value) {
            if (value.length > 0 && this.canRemoveImage === true) {
                this.canRemoveImage = false
            }
        }
    },
    methods: {
        async confirmTransaction() {
            let response = await this.$http.post(`/transactions/confirm/${this.id}`);
            if (response.data.data === 'OK') {
                this.transaction.status = 2;
            }
        },
        handleFileUpload(){
            /*
            Set the local file variable to what the user has selected.
            */
            this.file = this.$refs.file.files[0];
            /*
            Initialize a File Reader object
            */
            let reader  = new FileReader();

            /*
            Add an event listener to the reader that when the file
            has been loaded, we flag the show preview as true and set the
            image to be what was read from the reader.
            */
            reader.addEventListener("load", function () {
            this.showPreview = true;
            this.imagePreview = reader.result;
            }.bind(this), false);

            /*
            Check to see if the file is not empty.
            */
            if( this.file ){
            /*
                Ensure the file is an image file.
            */
                if ( /\.(jpe?g|png|gif)$/i.test( this.file.name ) ) {
                    /*
                    Fire the readAsDataURL method which will read the file in and
                    upon completion fire a 'load' event which we will listen to and
                    display the image in the preview.
                    */
                    reader.readAsDataURL( this.file );
                }
            }
        },
        uploadImage() {
            /*
            Initialize the form data
            */
            let formData = new FormData();

            /*
                Add the form data we need to submit
            */
            formData.append('file', this.file);

            /*
                Make the request to the POST /single-file URL
            */
            this.$http.post( `/transactions/upload_proof/${this.id}`,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then((response) => {
                this.transaction.photo_proofs.push(response.data.data);
                $(`#modal-${this.id}`).modal('hide');
            })
            .catch(function(){
                console.log('FAILURE!!');
            });
        },
        removeImage(id) {
            this.$http.post(`/transactions/remove_proof/${this.id}`,
            {image_id: id}
            )
            .then((response) => {
                this.transaction.photo_proofs = 
                this.transaction.photo_proofs.filter((image) => {
                    return image.id !== id
                });
            })
        },
        reportFakePOP() {
            this.$http.post(`/transactions/report/${this.id}`,
            {
                type: 'fake_pop'
            }
            )
            .then((response) => {
                let transaction = response.data.data;
                this.transaction.transaction_reports.push(transaction);
            })
        },
        openModal()
        {
            $(`#${this.modal}`).modal('show');
        }
    }
}
</script>
