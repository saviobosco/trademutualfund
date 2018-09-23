@extends('layouts.app')

@section('title', 'Start New Investment')
@section('content')
    <investment-component inline-template>
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title"> Start New Investment </h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-form-label text-md-right">
                                        <label for="investment_plan_id">Investment Plan</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select @change="getInvestmentRules" class="form-control" name="investment_plan_id" v-model="investment.plan">
                                        <option value="0"> --Select Plan </option>
                                        <option v-for="investmentPlan in investmentPlans" :key="investmentPlan.id" :value="investmentPlan.id"> @{{ investmentPlan.name }} : @{{ investmentPlan.minimum_amount }} - @{{ investmentPlan.maximum_amount }} </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" v-if="investmentRules.length > 0">
                                    <div class="col-md-4 col-form-label text-md-right">
                                        <label for="investment_rules">Choose Investment Rules</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <template v-for="rule in investmentRules">
                                            <div :key="rule.id">
                                                <label :for="rule.id">
                                                    <input type="radio" v-model="investment.rule" :value="rule.id" :id="rule.id">
                                                    <p> duration: @{{ rule.duration }} </p>
                                                    <p> Investment Percentage: @{{ rule.investment_percentage }}% </p>
                                                    <p> Global Percentage : @{{ rule.global_percentage }}% </p>
                                                </label>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-form-label text-md-right">
                                        <label for="amount"> Amount </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" v-model.lazy="investment.amount" required>
                                        <span> @{{ amountValidation }} </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit"
                                                class="btn btn-primary"
                                                :disabled=" investment.amount <= 0 || !Number.isInteger(parseInt(investment.amount)) || investment.rule === null "
                                        @click="submitInvestmentRequest"
                                        >
                                        {{ __('Invest') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </investment-component>
@endsection