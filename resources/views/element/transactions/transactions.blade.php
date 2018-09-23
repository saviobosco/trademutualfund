<transactions-component inline-template url_link="{{ $url }}">
    <div class="row justify-content-center m-t-20">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Transactions </div>
                <div class="card-body">
                    <transaction-component v-for="transaction in transactions" :key="transaction.id" :id="transaction.id" :transaction="transaction" :logged_in_user="{{auth()->user()->id}}">
                    </transaction-component>
                </div>
            </div>
        </div>
    </div>
</transactions-component>
