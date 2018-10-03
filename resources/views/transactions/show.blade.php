@extends('layouts.app')

@section('title', 'View Transaction')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> View Transaction </h4>
                    </div>
                    <div class="panel-body">
                        <admin-transaction-component inline-template transaction_id="{{ $transaction->id }}">
                            <div>
                                <div>
                                    <p> Transaction Id: @{{ transaction.id }} </p>
                                    <p> Amount: @{{ transaction.amount }} </p>
                                    <p> Transaction Status : <span v-html="$options.filters.status(transaction.status)"></span> </p>
                                    <countdown ref="countdown" :time="transaction_expires">
                                        <template slot-scope="props">Time Remaining：@{{ props.days }} days, @{{ props.hours }} hours, @{{ props.minutes }} minutes, @{{ props.seconds }} seconds.</template>
                                    </countdown>
                                    <div>
                                        <h5> Provide Help User</h5>
                                        <p> Name : @{{ transaction.make_payment_user.name }} </p>
                                    </div>
                                    <div>
                                        <h5> Get help User</h5>
                                        <p> Name : @{{ transaction.get_payment_user.name }} </p>
                                    </div>
                                    <div class="m-b-20">
                                        <div v-if="transaction.photo_proofs.length > 0" id="gallery" class="gallery clearfix">
                                            <div v-for="photo in transaction.photo_proofs" :key="photo.id" class="image pull-left">
                                                <div class="image-inner">
                                                    <a target="_blank" :href="photo.photo_url" data-lightbox="gallery-group-1">
                                                        <img class="img-thumbnail" :src="photo.photo_url" :alt="photo.photo_name" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="transaction.transaction_reports.length > 0">
                                        <div class="alert alert-danger">
                                            Image(s) has been report as fake POP!
                                        </div>
                                    </div>
                                </div>
                                <button :disabled="transaction.status === 2" @click="confirmTransaction" class="btn btn-sm btn-primary"> Confirm Transaction  </button>
                                <button :disabled="transaction.status === 2" @click="cancelTransaction" class="btn btn-sm btn-danger"> Cancel Transaction</button>
                                <button :disabled="transaction.status === 2" @click="resolveIssue" class="btn btn-sm btn-danger"> Resolved Issue </button>
                                <button :disabled="transaction.status === 2" @click="resetTimer" class="btn btn-sm btn-danger"> Reset Timer </button>
                            </div>
                        </admin-transaction-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection