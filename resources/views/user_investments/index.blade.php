@extends('layouts.app')

@section('title', 'Investments')
@section('content')
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">

                        <h4 class="panel-title"> Investments </h4>
                    </div>
                    <div class="panel-body">
                        <investments-component inline-template>
                            <div>
                                <table class="table table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th> id</th>
                                        <th> amount invested </th>
                                        <th> return on investment </th>
                                        <th> global funds amount </th>
                                        <th> release date </th>
                                        <th> status </th>
                                        <th> actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="investment in investments" :key="investment.id">
                                        <td> @{{ investment.id }} </td>
                                        <td> @{{ investment.amount_invested }} </td>
                                        <td> @{{ investment.roi_amount }} </td>
                                        <td> @{{ investment.global_funds_amount }} </td>
                                        <td> @{{ investment.release_date }} </td>
                                        <td v-html="$options.filters.status(investment.status)"> </td>
                                        <td>
                                            <button v-if="investment.status == 3"  @click="cashOutInvestment(investment.id)"  class="btn btn-sm btn-success">
                                                Cash Out
                                            </button>
                                            <button v-if="investment.status == 1" @click="cancelInvestment(investment.id)"  class="btn btn-sm btn-danger">
                                                Cancel
                                            </button>
                                            <button v-if="investment.status == 5 && investment.testimony === null" @click="addTestimony(investment.id)"  class="btn btn-sm btn-primary">
                                                Add testimony
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="addTestimony">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" @click="closeModal" aria-hidden="true">×</button>
                                                <h4 class="modal-title"> Add Testimony </h4>
                                            </div>
                                            <div class="modal-body">
                                                <textarea v-model="testimony" class="form-control"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:;" @click="closeModal" class="btn btn-sm btn-white">Close</a>
                                                <button @click="submitTestimony" type="button" class="btn btn-sm btn-success"> Add Testimony </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </investments-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
