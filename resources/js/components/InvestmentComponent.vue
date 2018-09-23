<script>
 export default {
     data() {
         return {
             investmentPlans: [],
             investmentRules: [],
             rulesLoaded: false,
             investment: {
                 plan: 0,
                 rule: null,
                 amount: null
             },
             validation: {
                 minimum_amount: null,
                 maximum_amount: null
             }
         };
     },
     computed: {
         amountValidation() {
             let amountValidationMessage = '';
             if (this.validation.minimum_amount && this.validation.maximum_amount && this.investment.amount) {
                 if ( (parseInt(this.investment.amount) < parseInt(this.validation.minimum_amount))
                  || 
                  (parseInt(this.investment.amount) > parseInt(this.validation.maximum_amount)) ) {
                        amountValidationMessage = `Amount must be between ${this.validation.minimum_amount} and ${this.validation.maximum_amount}`
                 }
             } else {
                 amountValidationMessage = '';
             }
             return amountValidationMessage;
         }
     },
     watch: {
         'investment.plan'() {
             let selectedPlan = this.investmentPlans.filter((plan) => {
                 return plan.id === this.investment.plan;
             })
             if (selectedPlan.length === 0) {
                 return;
             }
             this.validation.minimum_amount = selectedPlan[0].minimum_amount;
             this.validation.maximum_amount = selectedPlan[0].maximum_amount;
         }
     },
     methods:{
         async submitInvestmentRequest() {
             let response = await this.$http.post('/investments/create', this.investment);
             if (response.status === 200) {
                 // notify user of successful investment
                 alert('You investment was successful');
             }
             
         },
         async getInvestmentRules() {
             let investmentPlanId = parseInt(event.target.value);
             if (investmentPlanId === 0) {
                 this.resetInvestment();
                 this.clearInvestmentRules();
                 return ;
             }
             let response = await this.$http.get(`/api/investment_plans/${investmentPlanId}/investment_rules`);
             this.investmentRules = response.data.data;
             if (Array.isArray(this.investmentRules) && this.investmentRules.length) {
                 this.rulesLoaded = true;
             }
         },
         resetInvestment() {
             this.investment = {
                 plan: 0,
                 rule: null,
                 amount: null
             }
         },
         clearInvestmentRules() {
             this.investmentRules = [];
         }
     },
     async created() {
         // load the data
         let response = await this.$http.get('/user_investment_plans')
         this.investmentPlans = response.data.data;
     }
 }
</script>