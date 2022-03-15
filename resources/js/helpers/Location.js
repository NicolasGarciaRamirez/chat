import StripeKeys from "./StripeKeys";
import Auth from "./Auth";

export default {
    data:{
        location: null,
        currency: null
    },
    initialize(){
        this.data.location = localStorage.getItem('location')
        this.data.currency = localStorage.getItem('currency')
    },
    set(location, currency){
        localStorage.setItem('location', JSON.stringify(location))
        localStorage.setItem('currency', currency)
        this.initialize()
    },
    getIp(user, $refs){
        if(!user.payment_ip_data){
            $.getJSON('https://api.ipstack.com/check?access_key='+StripeKeys.data_keys.CLIENT_IP_STACK_LOCATION, function (res){
                $refs.supportModal.summary = {
                    tier:'',
                    amount:'',
                    description:'',
                }
                $refs.supportModal.currency = res.currency.symbol === 'CO$' ? '$' : res.currency.symbol
                $refs.rewardModal.summary = {
                    tier:'',
                    amount:'',
                    description:'',
                }
                $refs.rewardModal.currency = res.currency.symbol === 'CO$' ? '$' : res.currency.symbol
                $refs.rewardModal.getCurrencyClass(res.currency)
                if(Auth.state.username){
                    axios.post(`/${Auth.state.username}/Payment/Save/Ip/Data`, res).then(res =>{
                        if(res.data.saved){
                            return user.payment_ip_data = res.data.user.payment_ip_data
                        }
                    }).catch(err=>{
                        swal('Error', `${err}`, 'error')
                    })
                }
            })
        } else {
            user.payment_ip_data.currency = typeof user.payment_ip_data.currency === 'string' ? JSON.parse(user.payment_ip_data.currency) : user.payment_ip_data.currency
            $refs.supportModal.summary = {
                tier:'',
                amount:'',
                description:'',
            }
            // ya no es necesario setear el currency para eso es una propiedad computada
            // this.$refs.supportModal.currency = this.user.payment_ip_data.currency.symbol === 'CO$' ? '$' : this.user.payment_ip_data.currency.symbol
            $refs.rewardModal.summary = {
                tier:'',
                amount:'',
                description:'',
            }
            // this.$refs.rewardModal.currency = this.user.payment_ip_data.currency.symbol === 'CO$' ? '$' : this.user.payment_ip_data.currency.symbol
            $refs.rewardModal.getCurrencyClass(user.payment_ip_data.currency)
        }
    },
}
