<template>
    <section>
        <input id="name_card" type="text" placeholder="Name on Bank Account" class="form-control my-2" v-model="name_card" onkeyup="disabled = false" required/>
        <div id="card-element" :class="type_action === 'update' ? 'd-none' :'form-control border-0 pt-2 my-2'"></div>
        <div :class="type_action !== 'update'? 'd-none': 'd-flex'">
            <div class="flex-grow-1">
                <input type="text" class="form-control bg-third c-fourth my-auto" :value="`**** `+payment_method.card.last4" disabled>
            </div>
            <div class="flex-fill">
                <div id="card-expiry" class="form-control border-0 pt-2 my-auto" style="border-radius: 0px !important;width: 136%; position: relative; left: -15px;"></div>
            </div>
            <div class="flex-fill">
                <div id="card-cvc" class="form-control border-0 pt-2 my-auto"></div>
            </div>
        </div>
    </section>

</template>

<script>
    export default {
        name: "slotPaymentInputs"
    }
</script>

<style scoped>

</style>
