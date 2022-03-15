<template>
    <div>
        <h5 class="text-white mb-3"><b>Earnings History:</b></h5>
        <div class="d-flex flex-row align-items-center">
            <label style="margin-right: 0.8rem;">Show Earnings For: </label>
            <div class="btn-group rounded-pill btn-group-toggle btn-group-slide my-auto" data-toggle="buttons">
                <label class="btn rounded-pill" @click="filter('all', earnings_filter_by, earnings_filter_period)">
                    <input type="radio" name="earnings_all" id="earningsAllFor" autocomplete="off"><b>All</b>
                </label>
                <label class="btn rounded-pill" @click="filter('supports', earnings_filter_by, earnings_filter_period)">
                    <input type="radio" name="earnings_support" id="earningsSupportFor" autocomplete="off"><b>Support</b>
                </label>
                <label class="btn rounded-pill" @click="filter('rewards', earnings_filter_by, earnings_filter_period)">
                    <input type="radio" name="earnings_reward" id="earningsRewardFor" autocomplete="off"><b>Rewards</b>
                </label>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center my-3">
            <label class="mr-3">Show Earnings By: </label>
            <div class="btn-group rounded-pill btn-group-toggle btn-group-slide" data-toggle="buttons" style="min-width: 13.5rem;">
                <label class="btn rounded-pill" style="width: 6.2rem" @click="filter(earnings_filter_for, 'Month', earnings_filter_period)">
                    <input type="radio" name="earnings_filter_month" id="earningsMonthBy" autocomplete="off"><b>Month</b>
                </label>
                <label class="btn rounded-pill" style="width: 6.2rem" @click="filter(earnings_filter_for, 'Year', earnings_filter_period)">
                    <input type="radio" name="earnings_filter_year" id="earningsYearBy" autocomplete="off"><b>Year</b>
                </label>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center">
            <label class="mr-5">Select Period:</label>
            <div class="dropdown" style="width: 13.5rem;">
                <div class="dropdown-btn" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <b>{{earnings_filter_period !== null ? earnings_filter_period : `Select ${earnings_filter_by}` }}</b>
                    <div class="icon mx-1">
                        <i class="fas fa-caret-down"></i>
                    </div>
                </div>
                <div class="dropdown-menu m-1" aria-labelledby="dropdown">
                    <div class="dropdown-item"
                         v-for="(period, index) in earnings_filter_by === 'Month' ? $parent.filter_months : $parent.filter_years"
                         :key="index"
                         @click="filter(earnings_filter_for, earnings_filter_by, period)">
                        {{period}}
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center my-3">
            <div>Result:&nbsp;</div>
            <div class="c-seven font-weight-bolder"> ${{earnings_filtered.toFixed(2)}}</div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../../helpers/Auth";

    export default {
        name: "HistoryEarnings",
        data(){
            return {
                earnings_filter_for: 'all',
                earnings_filter_by: 'Month',
                earnings_filter_period: null,
                earnings_filtered: 0,
            }
        },
        mounted() {
            $('#earningsAllFor').prop('checked', true)
            $('#earningsMonthBy').prop('checked', true)
            this.earnings_filter_period = this.$parent.filter_months[new Date().getMonth()]
            this.filter()
        },
        methods:{
            async filter(sortFor = 'all', sortBy = 'Month', sortPeriod = this.earnings_filter_period){
                this.earnings_filter_for = sortFor
                this.earnings_filter_by = sortBy
                this.earnings_filter_period = sortPeriod
                if(sortPeriod){
                    await axios.post(`/User/filterEarnings/${Auth.state.username}/${sortPeriod}/${sortFor}/${sortBy}`).then(res =>{
                         this.earnings_filtered = res.data.earnings ? res.data.earnings  : 0
                    }).catch(err =>{
                        console.log(err)
                        Auth.keepLogged(err.response.status)
                    })
                }
            },
        }
    }
</script>

<style scoped>

</style>
