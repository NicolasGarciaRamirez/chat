<template>
    <div>
        <h5 class="text-white mb-3"><b>Invoices History:</b></h5>
        <div class="d-flex flex-row align-items-center">
            <label style="margin-right: 0.8rem;">Show Invoices For: </label>
            <div class="btn-group rounded-pill btn-group-toggle btn-group-slide my-auto" data-toggle="buttons">
                <label class="btn rounded-pill" @click="filter('All', invoices_filter_by, invoices_filter_period)">
                    <input type="radio" name="options" id="invoicesAllFor" autocomplete="off" checked><b>All</b>
                </label>
                <label class="btn rounded-pill" @click="filter('Supports', invoices_filter_by, invoices_filter_period)">
                    <input type="radio" name="options" id="invoicesSupportFor" autocomplete="off"><b>Support</b>
                </label>
                <label class="btn rounded-pill" @click="filter('Rewards', invoices_filter_by, invoices_filter_period)">
                    <input type="radio" name="options" id="invoicesRewardFor" autocomplete="off"><b>Rewards</b>
                </label>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center my-3">
            <label class="mr-3">Show Invoices By: </label>
            <div class="btn-group rounded-pill btn-group-toggle btn-group-slide" data-toggle="buttons" style="min-width: 13.5rem;">
                <label class="btn rounded-pill" style="width: 6.2rem" @click="filter(invoices_filter_for, 'Month', invoices_filter_period)">
                    <input type="radio" name="options" id="invoicesMonthBy" autocomplete="off" checked><b>Month</b>
                </label>
                <label class="btn rounded-pill" style="width: 6.2rem" @click="filter(invoices_filter_for, 'Year', invoices_filter_period)">
                    <input type="radio" name="options" id="invoicesYearBy" autocomplete="off"><b>Year</b>
                </label>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center">
            <label class="mr-5">Select Period:</label>
            <div class="dropdown" style="min-width: 13.5rem;">
                <div class="dropdown-btn" id="dropdown-invoice"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b>{{invoices_filter_period !== null ? invoices_filter_period : 'Select '+invoices_filter_by }}</b>
                    <div class="icon mx-1">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
                <div class="dropdown-menu m-1" aria-labelledby="dropdown">
                    <div class="dropdown-item" v-for="(period, index) in invoices_filter_by === 'Month' ? $parent.filter_months : $parent.filter_years" :key="index" @click="filter(invoices_filter_for, invoices_filter_by, period)">
                        {{period}}
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row align-items-center my-3">
            <div class="table-responsive" style="min-width: 80%; border: 1px solid #303030; border-radius: .365rem;">
                <table class="table bg-second text-white ">
                    <thead>
                        <tr>
                            <th><div>Date</div></th>
                            <th><div>Type</div></th>
                            <th><div>Who?</div></th>
                            <th><div>Amount</div></th>
                            <th><div>Invoice</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(payment, index) in invoices_filtered" :key="index">
                            <td v-if="payment.type === 'reward receive'">{{payment.date}}</td>
                            <td v-if="payment.type === 'reward receive'">{{payment.type === 'reward receive' ? 'Reward' : 'Support'}}</td>
                            <td v-if="payment.type === 'reward receive'"><img class="img-fluid rounded-circle m-auto" :src="payment.to_who.avatar" style="width: 2.2rem"/> {{payment.to_who.artistic_name}}</td>
                            <td v-if="payment.type === 'reward receive'">${{payment.invoice.amount_total}}</td>
                            <td v-if="payment.type === 'reward receive'" @click="$parent.generateInvoice(payment, user)">
                                <svg class="icon fill-fourth cursor-pointer" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M16.1,3.2c0-0.5,0.4-0.9,0.8-0.9V1H9.5C8.4,1,7.5,2,7.5,3.1c0,0,0,0,0,0v5.7h8.6V3.2z"/> <path d="M18.2,1.4v2.2c-0.5,0-0.8,0.4-0.8,0.9V5H19V3.2C19,2.5,18.7,1.8,18.2,1.4z"/> <path d="M17.3,6.4v3.7H6.3V6.4C5.5,6.7,5,7.4,5,8.2v12.9C5,22.1,5.8,23,6.9,23l0,0h9.9c1,0,1.9-0.9,1.9-1.9l0,0 V8.2C18.6,7.4,18.1,6.7,17.3,6.4z M9.4,20.4h-2v-1.3h2V20.4z M9.4,17.8h-2v-1.3h2V17.8z M9.4,15.3h-2V14h2V15.3z M12.8,20.4h-2 v-1.3h2V20.4z M12.8,17.8h-2v-1.3h2V17.8z M12.8,15.3h-2V14h2V15.3z M16.1,20.4h-2v-1.3h2V20.4z M16.1,17.8h-2v-1.3h2V17.8z M16.1,15.3h-2V14h2V15.3z M16.1,12.7H7.5v-1.3h8.6V12.7z"/> </svg>
                            </td>
                            <td v-if="emptyData" colspan="6">{{emptyData}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../../helpers/Auth";

    export default {
        name: "HistoryInvoices",
        props:['user'],
        data(){
            return {
                invoices_filter_for: 'All',
                invoices_filter_by: 'Month',
                invoices_filter_period: null,
                invoices_filtered: [],
                emptyData: null
            }
        },
        mounted(){
            this.invoices_filter_period = this.$parent.filter_months[new Date().getMonth()]
            this.filter()
        },
        methods:{
            async filter(sortFor = 'All', sortBy = 'Month', sortPeriod = this.invoices_filter_period){
                this.invoices_filter_for = sortFor
                this.invoices_filter_by = sortBy
                this.invoices_filter_period = sortPeriod
                if(sortPeriod){
                    await axios.post(`/User/filterInvoices/${Auth.state.username}/${sortPeriod}/${sortFor}/${sortBy}`).then(res =>{
                        res.data.payments ? this.invoices_filtered = res.data.payments : this.emptyData = `You don't have invoices`
                    }).catch(err =>{
                        console.log(err)
                        Auth.keepLogged(err.response.status)
                    })
                }

            }
        }
    }
</script>

<style scoped>
    .table th,
    .table td{
        border: none !important;
    }
    .table th div{
        width: max-content;
        position: relative;
    }
    .table th div::before{
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        right: 0;
        margin: auto;
        width: 100%;
        background-color: white;
        height: 2px;
    }
</style>
