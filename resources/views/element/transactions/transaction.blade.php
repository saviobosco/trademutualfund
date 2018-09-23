<transaction-component inline-template id="{{$transaction->id}}" :transaction="{{ $transaction }}">
    <div>
        @if(auth()->user()->id === $transaction->get_payment_user->id)
            <p> You are to be paid by</p>
            <div>
                <p> Transaction Id: {{ $transaction->id }} </p>
                <p> Name : {{ $transaction->make_payment_user->name }} </p>
                <p> Phone : {{ $transaction->make_payment_user->phone_number }} </p>
                <p> Amount : {{ $transaction->amount }} </p>
            </div>
            <button class="btn btn-sm btn-primary"> Confirm payment  </button>
            <button class="btn btn-sm btn-danger"> Report Transaction</button>
        @elseif(auth()->user()->id === $transaction->make_payment_user->id)
            <h5> You are to pay </h5>
            <div>
                <p> Transaction Id: {{ $transaction->id }} </p>
                <p> Name : {{ $transaction->get_payment_user->name }} </p>
                <p> Phone : {{ $transaction->get_payment_user->phone_number }} </p>
                <p> Amount : {{ $transaction->amount }} </p>
            </div>
            <div class="row" v-if="transaction.photo_proofs.length > 0">
                <div class="col-sm-3" v-for="photo in transaction.photo_proofs" :key="photo.id">
                    <img class="img-thumbnail" :src="photo.photo_url" :alt="photo.photo_name">
                    <button @click="removeImage(photo.id)" class="btn btn-sm btn-danger">remove</button>
                </div>
            </div>
            <button type="button" data-toggle="modal" data-target="#modal-{{$transaction->id}}" class="btn btn-sm btn-primary"> Upload Proof </button>
            <button class="btn btn-sm btn-danger"> Report Transaction</button>
            <span class="" v-if="transaction.photo_proofs.length > 0"> @{{ transaction.photo_proofs.length  }} Images Uploaded </span>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$transaction->id}}ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload proof - Trans:{{ $transaction->id }}</h5>
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
        @endif
            <hr>
    </div>
</transaction-component>