<transactions-component inline-template url_link="{{ $url }}">
    <div>
        <transaction-component
                v-for="transaction in transactions"
                :key="transaction.id"
                :id="transaction.id"
                :transaction="transaction"
                :logged_in_user="{{auth()->user()->id}}"
                @remove-transaction="removeTransactionById($event)"
                >
        </transaction-component>
    </div>
</transactions-component>
