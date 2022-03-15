import StripeKeys from "./StripeKeys";

export default {
    data:{
        stripe: Stripe(StripeKeys.data_keys.STRIPE_KEY),
        style:{
            base: {
                iconColor: '#FFFFFF',
                color: '#FFFFFF',
                fontFamily: 'Encode Sans',
                fontSize: '14px',
                fontSmoothing: 'antialiased',
                ':-webkit-autofill': {
                    color: '#999999',
                },
                '::placeholder': {
                    color: '#999999',
                },
            },
            invalid: {
                fontFamily: 'Encode Sans',
                color: "#ff0035",
                iconColor: "#ff0035"
            }
        },
        card: null,
        name_card:'',
        client_secret: null,
        token: null,
        data_location: '',
        vta: 0,
        payment_values:{
            currency: '',
            vta: 0,
            gateway : 0,
            total : 0,
        },
    },
    initialize(){
        this.data.stripe = Stripe(StripeKeys.data_keys.STRIPE_KEY)
        this.initializeElementsPaymentMethod()
    },
    initializePaymentData(summary, vta){
        this.data.payment_values.gateway = (2.9 * (( parseFloat(summary.amount) + parseFloat(vta) )) / 100) + .30
        this.data.payment_values.total = parseFloat(summary.amount) + parseFloat(vta)
    },
    initializeElementsPaymentMethod(){
        let elements = this.data.stripe.elements()
        this.data.card = elements.create("card", { style: this.data.style, hidePostalCode: true });
        this.data.card.mount('#card-element')
    },
}
