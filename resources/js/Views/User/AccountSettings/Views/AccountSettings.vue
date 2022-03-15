<template>
    <section>
        <div class="container-fluid modal-login px-0">
            <h2 class="text-center my-5 font-weight-bold">Account Settings</h2>
            <div class="accordion" id="AccordionAccountSettings">
                <div class="card">
                    <div class="card-header" data-target="accountOverview" >
                        <div>
                            <div>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="icon-m"><g><path d="M22.7,11.7c0.4-0.5,0.4-1.1-0.1-1.6l-9.8-8.9c-0.4-0.4-1.2-0.4-1.6,0l-9.9,9.3c-0.4,0.4-0.5,1.1,0,1.5l0.2,0.3 C2,12.9,2.6,13,3,12.6l0.7-0.7v10c0,0.6,0.5,1.1,1.1,1.1h3.8c0.6,0,1.1-0.5,1.1-1.1v-7h4.9v7c0,0.6,0.4,1.1,1,1.1h4.1 c0.6,0,1.1-0.5,1.1-1.1V12c0,0,0.2,0.2,0.5,0.4c0.3,0.2,0.8,0,1.2-0.4L22.7,11.7z"/></g></svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold">Account Overview</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="accountOverviewIcon" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div class="card-body" id="accountOverview" >
                        <div>
                            <div>
                                <div><label>Account Type: </label><b class="c-fifth font-weight-bold mx-1">{{user.subscription_type}}</b></div>
                                <div v-if="user.subscription_type === 'CONTRIBUTOR'"><label>Plan: </label><b class="c-fifth font-weight-bold mx-1">{{user.contributor_type}} MODE</b></div>
                                <div v-if="user.subscription_type === 'CONTRIBUTOR'"><label>Promo Code: </label><b class="c-fifth font-weight-bold mx-1">-</b></div>
                                <div><label>Joined: </label><b class="text-white mx-1">{{ user.created_at }}</b></div>
                                <div><label>Email: </label><b class="text-white mx-1">{{ user.email }}</b></div>
                                <div><label>Stripe ID: </label><label class="text-white font-weight-bold" v-if="user">{{user.customer_id}}</label></div>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <button type="button" @click="showModalEditAccount" class="btn rounded-pill btn-outline-light">
                                    Edit
                                    <svg class="icon-sm ml-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="personalDetails">
                        <div>
                            <div>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="icon-m" ><g><g><path d="M8.4,21.9c0,0.2,0,0.3,0.1,0.4c0.1,0.1,0.2,0.1,0.3,0.1c0,0,0.1,0,0.1,0l4-1.2l-3.4-3.4L8.4,21.9z"/><path d="M8.8,22.5c-0.1,0-0.2,0-0.3-0.1c-0.1-0.1-0.2-0.3-0.1-0.4l1.2-4.1l3.4,3.5l-4,1.2C8.9,22.5,8.8,22.5,8.8,22.5 z M9.5,17.9l-1.1,4c0,0.1,0,0.3,0.1,0.4c0.1,0.1,0.2,0.1,0.3,0.1c0,0,0.1,0,0.1,0l4-1.2L9.5,17.9z"/><path d="M22.6,9.9L20.8,8c-0.2-0.2-0.6-0.4-0.9-0.4c-0.3,0-0.7,0.1-0.9,0.4l-0.9,0.9l3.6,3.7l0.9-0.9 c0.2-0.2,0.4-0.6,0.4-0.9C23,10.4,22.9,10.1,22.6,9.9z"/><path d="M21.7,12.7L18,8.9L19,8c0.2-0.2,0.6-0.4,0.9-0.4c0.3,0,0.7,0.1,0.9,0.4l1.8,1.8c0.2,0.2,0.4,0.6,0.4,0.9 c0,0.4-0.1,0.7-0.4,0.9L21.7,12.7z M18.1,8.9l3.6,3.7l0.9-0.9c0.2-0.2,0.4-0.6,0.4-0.9s-0.1-0.7-0.4-0.9L20.8,8 c-0.2-0.2-0.6-0.4-0.9-0.4c-0.3,0-0.7,0.1-0.9,0.4L18.1,8.9z"/><path d="M10,17.1l7.5-7.6l3.6,3.7l-7.5,7.6L10,17.1z"/><path d="M13.6,20.8L10,17.1l7.5-7.6l3.7,3.7L13.6,20.8z M10,17.1l3.6,3.7l7.4-7.5l-3.6-3.7L10,17.1z"/></g><g><path d="M7.5,1.5c2.2,0,4,1.9,3.5,4.2c-0.2,1.5-1.4,2.6-2.9,2.9C5.8,9,3.9,7.3,3.9,5.1C3.9,3.2,5.4,1.5,7.5,1.5 L7.5,1.5z"/><g><path d="M12.4,12.7c-1.2-1.4-2.9-2.3-4.9-2.4c-3.4,0-6.1,2.6-6.5,5.9c0,0.3,0.2,0.6,0.5,0.6c1.2,0,4.1,0,6.9,0 L12.4,12.7z"/></g></g></g></svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold" >Personal Details</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="personalDetailsIcon"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div class="card-body" id="personalDetails">
                        <div class="">
                            <div class="">
                                <div><label>Name: </label><label class="text-white mx-1">{{ user.personal_information.full_name }}</label></div>
                                <div><label>Date of birth: </label><label class="text-white mx-1">{{ user.personal_information.date_of_birth }}</label></div>
                                <div><label>Gender: </label><label class="text-white mx-1">{{ user.personal_information.gender }}</label></div>
                                <div><label>Location: </label><label class="text-white mx-1">{{ user.personal_information.location }}</label></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" @click="showModalEditPersonalDetails" class="btn btn-outline-light rounded-pill">
                                    Edit
                                    <svg class="icon-sm ml-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" >
                    <div class="card-header" data-target="subscriptionSettings">
                        <div>
                            <div>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="icon-m" ><g><g id="Layer_1-2"><path d="M1.7,4h20.6C22.7,4,23,4.3,23,4.7v1.1c0,0.4-0.3,0.7-0.7,0.7H1.7C1.3,6.5,1,6.2,1,5.8V4.7C1,4.3,1.3,4,1.7,4z"/><path d="M15.2,13.8c-0.7,0-1.3,0.6-1.3,1.2c0,0.7,0.6,1.2,1.3,1.2s1.3-0.6,1.3-1.2l0,0C16.5,14.4,15.9,13.8,15.2,13.8z"/><rect x="1" y="7.7" width="22" height="1.2"/><rect x="4.9" y="15.1" width="2.6" height="1.2"/><path d="M1,10.9v8.4C1,19.7,1.3,20,1.7,20h20.6c0.4,0,0.7-0.3,0.7-0.7v-8.4c0-0.4-0.3-0.7-0.7-0.7H1.7 C1.3,10.2,1,10.5,1,10.9z M8.7,17.5H4.3c-0.4,0-0.7-0.3-0.7-0.7v-2.3c0-0.4,0.3-0.7,0.7-0.7h3.8c0.4,0,0.7,0.3,0.7,0.7L8.7,17.5 L8.7,17.5z M11.3,12.6H3.6v-1.2h7.7C11.3,11.4,11.3,12.6,11.3,12.6z M17.8,17.5c-0.4,0-0.7-0.1-1-0.2c-0.2-0.1-0.4-0.1-0.6,0 c-0.3,0.1-0.6,0.2-1,0.2c-1.9,0-3.5-2.1-2-3.9c0.6-0.7,1.5-1.1,2.4-1c0.3,0,0.7,0.2,1,0.4c0.4-0.2,0.8-0.3,1.3-0.3 c1.4-0.1,2.6,1,2.7,2.3c0.1,1.4-1,2.5-2.4,2.6C17.9,17.5,17.8,17.5,17.8,17.5z"/><path d="M17.8,13.8c-0.1,0-0.2,0-0.3,0.1c0.2,0.4,0.3,0.8,0.3,1.2s-0.1,0.8-0.3,1.2c0.1,0,0.2,0.1,0.3,0.1 c0.7,0,1.2-0.6,1.2-1.3C18.9,14.4,18.4,13.9,17.8,13.8z"/></g></g></svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold" >Payments Settings</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="subscriptionSettingsIcon"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div class="card-body" id="subscriptionSettings" >
                        <div class="">
                            <div class="" v-if="user.subscription_type === 'CONTRIBUTOR'">
                                <!-- <div><label>Amount :</label><label class="text-white" v-if="user.subscription_settings">${{user.subscription_settings.amount}}</label></div> -->
                                <div><label>Plan:</label><label :class="user.subscription_settings.subscription_status === 'Active' ? 'c-seven font-weight-bold px-1': 'c-fifth font-weight-bold px-1'" v-if="user.subscription_settings">{{user.subscription_settings.subscription_status}}</label></div>
                                <div v-if="user.contributor_type !== 'PERCENTAGE'"> <label>Subscription Start Date :</label><label class="text-white" v-if="user.subscription_settings">{{user.subscription_settings.date_subscription_start}}</label></div>
                                <div v-if="user.contributor_type !== 'PERCENTAGE'"><label>Payment Cycle :</label><label class="text-white" v-if="user.subscription_settings">the {{user.subscription_settings.payment_cycle}} st of every month</label></div>
                                <div v-if="user.contributor_type !== 'PERCENTAGE'"><label>Payment Method :</label><label class="text-white" v-if="user">**** {{user.card_last_four}} {{user.card_brand}}</label></div>
                            </div>
                            <div>
                                Payment Methods:
                                <div class="d-flex flex-column">
                                    <div class="cross-center">
                                        <button type="button" @click="showModalAddPaymentMethod" class="btn btn-outline-light rounded-pill">
                                            Add Card <i class="fas fa-plus-circle"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex flex-column justify-content-start align-items-start">
                                        <single-payment-method v-for="(payment, index) in payment_methods" :key="index" :payment="payment" :index="index" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" >
                    <div class="card-header " data-target="Payments">
                        <div>
                            <div>
                                <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" class="icon-md"><g><g id="Layer_2-2"><path d="M16.1,3.2c0-0.5,0.4-0.9,0.8-0.9V1H9.5C8.4,1,7.5,2,7.5,3.1c0,0,0,0,0,0v5.7h8.6V3.2z"/><path d="M18.2,1.4v2.2c-0.5,0-0.8,0.4-0.8,0.9V5H19V3.2C19,2.5,18.7,1.8,18.2,1.4z"/><path d="M17.3,6.4v3.7H6.3V6.4C5.5,6.7,5,7.4,5,8.2v12.9C5,22.1,5.8,23,6.9,23l0,0h9.9c1,0,1.9-0.9,1.9-1.9l0,0V8.2C18.6,7.4,18.1,6.7,17.3,6.4z M9.4,20.4h-2v-1.3h2V20.4z M9.4,17.8h-2v-1.3h2V17.8z M9.4,15.3h-2V14h2V15.3z M12.8,20.4h-2v-1.3h2V20.4z M12.8,17.8h-2v-1.3h2V17.8z M12.8,15.3h-2V14h2V15.3z M16.1,20.4h-2v-1.3h2V20.4z M16.1,17.8h-2v-1.3h2V17.8z M16.1,15.3h-2V14h2V15.3z M16.1,12.7H7.5v-1.3h8.6V12.7z"/></g></g></svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold">Your Payments</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="PaymentsIcon" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="Payments" class="card-body" style="height: 400px;overflow: scroll;">
                        <div class="">
                            <div class="table-responsive">
                                <table class="table text-white">
                                    <thead>
                                        <tr>
                                            <th><div>Date</div></th>
                                            <th><div>Type</div></th>
                                            <th><div>To Who?</div></th>
                                            <th><div>Amount</div></th>
                                            <th class="text-center"><div class="mx-auto">Invoice</div></th>
                                            <th class="text-center"><div class="mx-auto">Cancel</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(payment, index) in user.payments" :key="index">
                                            <td v-if="payment.type === 'reward' || payment.type === 'support' || payment.type === 'Payment PERCENTAGE'">{{payment.date}}</td>
                                            <td v-if="payment.type === 'reward' || payment.type === 'support' || payment.type === 'Payment PERCENTAGE'">{{payment.type}}</td>
                                            <td v-if="payment.type === 'reward' || payment.type === 'support' || payment.type === 'Payment PERCENTAGE'"><img class="img-fluid rounded-circle m-auto" :src="payment.to_who ? payment.to_who.avatar : ''" style="width: 2.2rem"/> {{payment.to_who ? payment.to_who.artistic_name : 'N/A'}}</td>
                                            <td v-if="payment.type === 'reward' || payment.type === 'support' || payment.type === 'Payment PERCENTAGE'">${{payment.amount}}</td>
                                            <td v-if="payment.type === 'reward' || payment.type === 'support' || payment.type === 'Payment PERCENTAGE'" @click="generateInvoice(payment, user)" class="text-center">
                                                <svg class="icon-md fill-fourth cursor-pointer" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M16.1,3.2c0-0.5,0.4-0.9,0.8-0.9V1H9.5C8.4,1,7.5,2,7.5,3.1c0,0,0,0,0,0v5.7h8.6V3.2z"/> <path d="M18.2,1.4v2.2c-0.5,0-0.8,0.4-0.8,0.9V5H19V3.2C19,2.5,18.7,1.8,18.2,1.4z"/> <path d="M17.3,6.4v3.7H6.3V6.4C5.5,6.7,5,7.4,5,8.2v12.9C5,22.1,5.8,23,6.9,23l0,0h9.9c1,0,1.9-0.9,1.9-1.9l0,0 V8.2C18.6,7.4,18.1,6.7,17.3,6.4z M9.4,20.4h-2v-1.3h2V20.4z M9.4,17.8h-2v-1.3h2V17.8z M9.4,15.3h-2V14h2V15.3z M12.8,20.4h-2 v-1.3h2V20.4z M12.8,17.8h-2v-1.3h2V17.8z M12.8,15.3h-2V14h2V15.3z M16.1,20.4h-2v-1.3h2V20.4z M16.1,17.8h-2v-1.3h2V17.8z M16.1,15.3h-2V14h2V15.3z M16.1,12.7H7.5v-1.3h8.6V12.7z"/> </svg>
                                            </td>
                                            <td v-if="payment.subscription_active" class="text-center d-flex justify-content-center" @click="showModalCancel">
                                                <svg class="icon-m close" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z"/> </svg>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" > <!-- v-if="user.subscription_type === 'CONTRIBUTOR'" -->
                    <div class="card-header" data-target="supportEarnings">
                        <div >
                            <div>
                                <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1418 1080" xml:space="preserve" class="icon-m"><g><path fill="#FFFFFF" d="M733.74,15c-83.18,0-160.99,38.09-212.28,101.74C470.18,53.09,392.36,15,309.18,15C158.77,15,36.43,137.38,36.43,287.8c0,118.11,70.57,254.91,209.77,406.56c107.31,116.88,224.01,207.42,257.22,232.36l18.03,13.52l18.02-13.52c33.22-24.94,149.94-115.44,257.22-232.32c139.22-151.65,209.79-288.49,209.79-406.6C1006.49,137.38,884.15,15,733.74,15z"/><g><g><path fill="#FFFFFF" d="M1148.27,921.73c-2.78,1.52-5.71,2.93-8.82,4.3c-24.29,10.74-56.16,16.59-89.77,16.59c-8.86,0-17.56-0.4-26.13-1.2c-0.18,15.36-2.71,30.11-7.3,43.99c10.7,1.52,21.98,2.39,33.43,2.39c28.3,0,55.69-4.95,75.21-13.56c16.08-7.12,23.38-15.28,23.38-19.88V921.73L1148.27,921.73z"/><path fill="#FFFFFF" d="M1049.68,617.6c-33.61,0-65.49-5.89-89.78-16.59c-3.07-1.37-6-2.82-8.82-4.34v32.67c0,4.59,7.34,12.76,23.42,19.88c19.48,8.6,46.88,13.52,75.18,13.52c28.3,0,55.69-4.92,75.21-13.52c16.08-7.12,23.38-15.29,23.38-19.88v-32.67c-2.78,1.52-5.71,2.96-8.82,4.34C1115.17,611.7,1083.29,617.6,1049.68,617.6z"/><path fill="#FFFFFF" d="M1049.68,698.88c-33.61,0-65.49-5.93-89.78-16.62c-3.07-1.37-6-2.82-8.82-4.3v32.64c0,4.59,7.34,12.79,23.42,19.88c19.48,8.6,46.88,13.52,75.18,13.52c28.3,0,55.69-4.91,75.21-13.52c16.08-7.08,23.38-15.29,23.38-19.88v-32.64c-2.78,1.48-5.71,2.93-8.82,4.3C1115.17,692.95,1083.29,698.88,1049.68,698.88z"/><path fill="#FFFFFF" d="M1139.45,763.5c-24.29,10.7-56.16,16.62-89.77,16.62c-33.61,0-65.49-5.93-89.78-16.62c-3.07-1.37-6-2.82-8.82-4.26v32.6c0,4.63,7.34,12.79,23.42,19.88c19.48,8.6,46.88,13.56,75.18,13.56c28.3,0,55.69-4.95,75.21-13.56c16.08-7.08,23.38-15.25,23.38-19.88v-4.05v-28.55C1145.49,760.68,1142.56,762.13,1139.45,763.5z"/><path fill="#FFFFFF" d="M1049.68,906.52c28.3,0,55.69-4.95,75.21-13.55c16.08-7.08,23.38-15.26,23.38-19.88v-32.6c-2.78,1.48-5.71,2.93-8.82,4.26c-24.29,10.74-56.16,16.62-89.77,16.62c-18.15,0-35.78-1.73-52.01-4.99c9.94,14.42,17.38,30.72,21.68,48.21C1029.15,905.87,1039.3,906.52,1049.68,906.52z"/><path fill="#FFFFFF" d="M1372.75,1003.23c-24.25,10.74-56.13,16.59-89.78,16.59c-33.61,0-65.49-5.85-89.74-16.59c-3.11-1.37-6.04-2.78-8.86-4.3v32.64c0,4.59,7.34,12.79,23.42,19.88c19.52,8.6,46.91,13.55,75.18,13.55c28.3,0,55.7-4.95,75.21-13.55c16.08-7.08,23.38-15.29,23.38-19.88v-32.64C1378.78,1000.45,1375.86,1001.86,1372.75,1003.23z"/><path fill="#FFFFFF" d="M1372.75,921.95c-24.25,10.73-56.13,16.62-89.78,16.62c-33.61,0-65.49-5.89-89.74-16.62c-3.11-1.34-6.04-2.78-8.86-4.27v32.64c0,4.59,7.34,12.76,23.42,19.84c19.52,8.6,46.91,13.55,75.18,13.55c28.3,0,55.7-4.95,75.21-13.55c16.08-7.08,23.38-15.25,23.38-19.84v-32.64C1378.78,919.17,1375.86,920.61,1372.75,921.95z"/><path fill="#FFFFFF" d="M1372.75,840.7c-24.25,10.7-56.13,16.63-89.78,16.63c-33.61,0-65.49-5.93-89.74-16.63c-3.11-1.37-6.04-2.78-8.86-4.26v32.6c0,4.63,7.34,12.79,23.42,19.88c19.52,8.6,46.91,13.55,75.18,13.55c28.3,0,55.7-4.95,75.21-13.55c16.08-7.08,23.38-15.25,23.38-19.88v-32.6C1378.78,837.92,1375.86,839.33,1372.75,840.7z"/><path fill="#FFFFFF" d="M974.5,567.94c19.48,8.6,46.88,13.55,75.18,13.55c28.3,0,55.69-4.95,75.21-13.55c16.08-7.08,23.38-15.29,23.38-19.84c0-4.63-7.3-12.79-23.38-19.88c-19.52-8.6-46.91-13.55-75.21-13.55c-28.3,0-55.7,4.95-75.18,13.55c-16.08,7.08-23.42,15.25-23.42,19.88C951.08,552.65,958.42,560.85,974.5,567.94z"/><path fill="#FFFFFF" d="M1207.8,807.67c19.52,8.6,46.91,13.52,75.18,13.52c28.3,0,55.7-4.91,75.21-13.52c16.08-7.08,23.38-15.25,23.38-19.88c0-4.59-7.3-12.76-23.38-19.88c-19.52-8.6-46.91-13.52-75.21-13.52c-28.26,0-55.66,4.91-75.18,13.52c-16.08,7.12-23.42,15.28-23.42,19.88C1184.38,792.42,1191.72,800.59,1207.8,807.67z"/><path fill="#FFFFFF" d="M987.48,939.59c0-61.08-49.7-110.74-110.78-110.74s-110.77,49.66-110.77,110.74s49.69,110.74,110.77,110.74S987.48,1000.67,987.48,939.59z M890.9,999.8v14.71h-25.95v-14.64c-14.42-4.59-25.41-16.91-28.66-32.74l-0.97-4.7l23.49-14.2l2.42,8.57c4.37,15.32,9.65,18.43,16.7,18.43c5.6,0,8.06-2.02,9.54-3.83c1.7-2.02,2.56-4.84,2.56-8.42c0-4.56-2.64-8.28-16.55-14.93c-9.22-4.19-13.88-7.01-19.8-12.14c-7.01-6.22-10.41-14.13-10.41-24.18c0-14.71,8.67-27.22,21.69-32.2V864.7h25.95v14.89c8.53,3.11,15.25,9.43,20.02,18.87l2.78,5.42l-22.19,14.39l-3.54-6.29c-4.26-7.59-7.37-8.17-11.28-8.17c-3.83,0-6.21,3.54-6.21,6.87c0,2.89,0.5,4.63,3.58,7.01l0.07,0.07c2.13,1.44,3.97,2.75,5.28,3.47l8.31,4.27c6.07,3.03,9.58,4.88,15.21,9.18c9.36,6.94,13.77,15.47,14.28,27.69l0.03,0.29c0,10.48-3.43,19.44-10.16,26.74C902.54,994.38,897.12,997.85,890.9,999.8z"/></g></g></g></svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold" >Your Earnings</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="supportEarningsIcon"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="supportEarnings" class="card-body card-simple">
                        <div >
                            <div class="card-body-style mb-4">
                                <h5 class="text-white mb-3"><b>Overview:</b></h5>
                                <div><label>Total Lifetime Earnings:&nbsp;</label><label class="text-white font-weight-bold">${{user.total_earnings}}</label></div>
                                <div><label>Total Lifetime Support Earnings:&nbsp;</label><label class="text-white font-weight-bold">${{user.total_support_earnings}}</label></div>
                                <div><label>Support Money Is Collected From Supporters at:&nbsp;</label><label class="text-white font-weight-bold"> The 1st of every month.</label></div>
                                <div><label>Total Lifetime Reward Earnings:&nbsp;</label><label class="text-white font-weight-bold">${{user.total_reward_earnings}}</label></div>
                            </div>
                            <div class="card-body-style mb-4">
                                <history-earnings></history-earnings>
                            </div>
                            <div class="card-body-style">
                                <history-invoices :user="user"></history-invoices>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="changePassword">
                        <div>
                            <div>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="icon-m" > <g> <path d="M19.4,9.8h-1.1V7.1C18.2,3.8,15.5,1,12,1S5.7,3.8,5.7,7.1v2.7H4.6C4.2,9.8,4,10.1,4,10.4v12 C4,22.8,4.3,23,4.6,23h14.8c0.4,0,0.6-0.3,0.6-0.6V10.5C20.1,10.1,19.8,9.8,19.4,9.8z M13,17.2v2.5c0,0.2-0.2,0.4-0.4,0.4h-1.2 c-0.2,0-0.4-0.2-0.4-0.4v-2.5c-0.4-0.3-0.7-0.8-0.7-1.4c0-0.9,0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C13.7,16.3,13.4,16.9,13,17.2z M15.3,9.8H8.7V7.1c0-1.8,1.4-3.2,3.3-3.2s3.3,1.4,3.3,3.2V9.8z"/> </g> </svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold" >Change Password</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="changePasswordIcon"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="changePassword" class="card-body">
                        <div class="">
                            <div class="d-flex justify-content-center my-3">
                                <button @click="showModalEditPassword" class="btn btn-outline-light rounded-pill">
                                    Change Password
                                    <svg class="icon-sm ml-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="linkedSocialMedia">
                        <div>
                            <div>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="icon-m" > <g> <g> <g> <path d="M22.7,15.6c0,0-0.1,0-0.1,0c-0.3,0.1-0.3,0-0.1-0.3c0.1-0.1,0.2-0.2,0.3-0.3c0.2-0.3,0-0.4-0.3-0.3 c-0.1,0-0.2,0.1-0.3,0.1c-0.3,0.1-0.7-0.1-1-0.2c-0.3-0.2-0.7-0.3-1.1-0.3c-0.6,0-1.1,0.2-1.5,0.6c-0.4,0.4-0.6,0.9-0.6,1.5 c0,0.1,0,0.2,0,0.3c0,0.1-0.2,0.2-0.5,0.2c-0.7-0.1-1.3-0.3-1.9-0.6c-0.6-0.3-1.1-0.7-1.6-1.2c-0.2-0.2-0.5-0.2-0.6,0.1 c0,0.2-0.1,0.4-0.1,0.6c0,0.4,0.1,0.7,0.3,1c0.1,0.2,0.2,0.3,0.3,0.4c0.2,0.2,0.2,0.3-0.1,0.3c-0.3-0.1-0.5-0.2-0.5-0.2s0,0,0,0 c0,0.5,0.2,1,0.5,1.4c0.2,0.2,0.4,0.4,0.7,0.6c0.3,0.1,0.4,0.2,0.3,0.2c-0.1,0-0.2,0-0.3,0c-0.1,0-0.1,0-0.2,0 c-0.1,0-0.1,0.2,0,0.5c0.1,0.2,0.3,0.4,0.5,0.6c0.2,0.2,0.4,0.3,0.7,0.4c0.3,0.1,0.4,0.2,0.1,0.4c-0.7,0.4-1.4,0.6-2.2,0.6 c-0.1,0-0.2,0-0.3,0c-0.1,0,0,0.1,0.2,0.3c0.9,0.5,1.8,0.7,2.8,0.7c0.8,0,1.5-0.1,2.1-0.4c0.7-0.2,1.2-0.6,1.7-1 c0.5-0.4,0.9-0.9,1.2-1.4c0.3-0.5,0.6-1.1,0.8-1.7c0.2-0.6,0.3-1.2,0.3-1.7c0-0.1,0-0.1,0-0.1c0-0.1,0.2-0.3,0.4-0.5 c0.1-0.1,0.2-0.2,0.3-0.3C23.1,15.6,23,15.5,22.7,15.6z"/> </g> </g> <g> <path d="M15.2,9.8c-0.9,0.7-2,1.2-3.2,1.2c-1.8,0-3.4-1-4.3-2.5L8.1,7l1.4-0.3c0.3,1.1,1.4,1.9,2.5,1.9 c0.6,0,1.1-0.2,1.5-0.5l1.4,0.2L15.2,9.8z"/> <g id="Connected_Home_1_"> <g> <g> <g> <path d="M9.4,6c0,0.3,0,0.5,0.1,0.8L7.7,8.5C7.3,7.8,7,6.9,7,6s0.3-1.8,0.7-2.5l1.4,0.3l0.4,1.5 C9.4,5.4,9.4,5.7,9.4,6L9.4,6z"/> </g> </g> </g> </g> <path d="M17,6c0,1.5-0.7,2.9-1.8,3.8l-1.7-1.7c0.3-0.2,0.6-0.6,0.8-1H12c-0.2,0-0.3-0.1-0.3-0.3V5.1 c0-0.2,0.1-0.3,0.3-0.3h4.6c0.1,0,0.3,0.1,0.3,0.2C16.9,5.4,17,5.7,17,6L17,6z"/> <path d="M15.3,2.4c0,0.1,0,0.1-0.1,0.2l-1.3,1.2c-0.1,0.1-0.3,0.1-0.4,0c-0.5-0.4-1-0.5-1.6-0.5 c-1.2,0-2.2,0.8-2.5,1.9L7.7,3.5C8.6,2,10.2,1,12,1c1.2,0,2.3,0.4,3.2,1.2C15.3,2.2,15.3,2.3,15.3,2.4L15.3,2.4z"/> </g> <g> <g id="Layer_2-2"> <path d="M2.5,23h1.2c0.3,0,0.5-0.2,0.5-0.5v-4c0-0.3,0.2-0.5,0.5-0.5h0.5c0.3,0,0.5-0.2,0.5-0.5c0-0.2,0-0.4,0.1-0.6 c0-0.3-0.2-0.6-0.5-0.6H4.8c-0.3,0-0.5-0.2-0.5-0.5v-0.6c0-0.2,0.2-0.4,0.5-0.4h0.7c0.3,0,0.5-0.2,0.5-0.5v-0.7 C6,13.2,5.8,13,5.5,13H4.4c-2.3,0-2.3,1.7-2.3,2v0.9c0,0.3-0.2,0.5-0.5,0.5H1.5c-0.3,0-0.5,0.2-0.5,0.5v0.6 c0,0.3,0.2,0.5,0.5,0.5l0,0c0.3,0,0.5,0.2,0.5,0.5v4C2,22.8,2.3,23,2.5,23z"/> </g> </g> </g> </svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold" >Linked Social Media</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="linkedSocialMediaIcon"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="linkedSocialMedia" class="card-body" aria-labelledby="headingFifth" >
                        <div class=" border-radius mx-md-5 mx-lg-5 my-3 p-3">
                            <div class="d-flex flex-column text-center social-login">
                                <div class="cross-center mb-2 facebook">
                                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 504 1080" xml:space="preserve" class="svg-social-icon"> <path fill="#535353" d="M107.78,1080h225.46V539.97h150.31c0,0,13.96-86.96,20.94-182.52H333.78V232.91 c4.56-23.88,24.6-41.72,48.85-43.48h121.86V0.47H338.61c-234.59,0-230.83,181.98-230.83,208.82v148.7H0.42v181.98h107.36V1080z"/> </svg>
                                    <span @click="auth_facebook.provider === 'FacebookProvider' ? disconnectAccount(auth_facebook) : windowReplace('/auth/facebook')" class="btn btn-social-media bg-facebook text-white rounded-pill font-weight-bold">{{ auth_facebook.provider === 'FacebookProvider' ? 'Disconnect From Facebook'  : 'Link With Facebook' }}</span>
                                </div>
                                <div class="cross-center mb-2 twitter">
                                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1313 1080" xml:space="preserve" class="svg-social-icon"> <path fill="#535353" d="M489.98,1077.7c-58.34-0.2-116.59-4.84-174.22-13.9c-83.32-16.21-163.58-45.43-237.82-86.58L-0.1,934.48 l84.44-27.26c91.92-30.46,148.04-49.17,217.51-78.56c-71.14-34.83-124.99-97.17-149.11-172.62l-19.24-59.32l16.03,2.67 c-13.78-13.87-26.13-29.09-36.88-45.43c-32.71-48.51-49.18-106.14-47.03-164.6l3.74-53.44l31,11.76 c-12.87-24.39-22.22-50.48-27.79-77.49c-12.96-69.26-0.83-140.88,34.2-202.02l26.72-49.7l36.34,43.82 C277.2,195.72,431.87,282.63,601.67,304.92c-7.16-46.17-1.8-93.41,15.5-136.81c21.97-50.27,59.42-92.21,106.89-119.71 c53.36-32.33,115.1-48.14,177.43-45.43c66.31,3.57,129.44,29.58,179.03,73.75c22.11-5.49,43.88-12.27,65.2-20.31l53.44-18.71 l72.68-26.72L1222.68,151h10.15l80.16-3.74l-47.03,64.13l-4.81,5.34c-3.74,5.88-8.55,12.83-73.22,99.94 c-16.73,23.04-24.86,51.22-22.98,79.63c6.56,102.34-8,204.94-42.75,301.42c-29.77,81.91-79.13,155.3-143.76,213.77 c-85.93,74.55-190.14,124.91-301.95,145.9C615.17,1070.47,552.68,1077.28,489.98,1077.7z"/> </svg>
                                    <span @click="auth_twitter.provider === 'TwitterProvider' ? disconnectAccount(auth_twitter) : windowReplace('/auth/twitter')"  class="btn btn-social-media bg-twitter text-white rounded-pill font-weight-bold">{{ auth_twitter.provider  === 'TwitterProvider' ? 'Disconnect From Twitter'  : 'Link With Twitter' }}</span>
                                </div>
                                <div class="cross-center mb-2 google">
                                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1682 1080" xml:space="preserve" class="svg-social-icon"> <path fill="#535353" d="M539.43,193.97c109.16,0.63,211.78,52.14,277.51,139.3l140.38-141.47 C764.89-37.49,423.01-67.38,193.71,125.05s-259.19,534.31-66.75,763.61s534.31,259.19,763.61,66.75 c122.69-102.97,193.56-254.93,193.59-415.1V491H587.13v197.84h262.88c-56.62,121.3-178.34,198.85-312.2,198.92 c-192.2-0.29-348.36-155.24-350.14-347.43C189.75,347.79,346.89,193.07,539.43,193.97z"/> <path fill="#535353" d="M1530.24,293.16h-198.38v148.51h-148.51v197.84h148.51v149.05h198.38V639.51H1682V441.67h-151.76V293.16z" /> </svg>
                                    <span @click="auth_google.provider === 'GoogleProvider' ? disconnectAccount(auth_facebook) : windowReplace('/auth/google')"  class="btn btn-social-media c-fifth bg-google rounded-pill font-weight-bold">{{ auth_google.provider === 'GoogleProvider' ? 'Disconnect From Google'  : 'Link With Google' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="linkedOtherNoisesharksProfile">
                        <div>
                            <div>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"class="icon-m"> <g> <g> <path d="M17.7,22.7c-0.1,0-0.2-0.1-0.2-0.2l-1.3-5.2L15,20.2c-0.1,0.1-0.1,0.2-0.2,0.2s-0.2-0.1-0.2-0.1l-0.9-1.6 h-2.3c-0.2,0-0.3-0.2-0.3-0.3c0-0.2,0.1-0.3,0.3-0.3h2.4c0.1,0,0.2,0.1,0.2,0.2l0.7,1.4l1.3-3.1c0.1-0.1,0.2-0.2,0.2-0.2 c0.1,0,0.2,0.1,0.2,0.2l1.2,4.8l1.3-7.7c0-0.2,0.1-0.3,0.3-0.3c0.1,0,0.2,0.1,0.2,0.3l0.4,4.9l0.6-0.4c0.1,0,0.1-0.1,0.1-0.1h2 c0.2,0,0.3,0.2,0.3,0.3c0,0.2-0.1,0.3-0.3,0.3h-1.8l-0.9,0.6c-0.1,0.1-0.2,0.1-0.2,0c-0.1-0.1-0.1-0.1-0.1-0.2l-0.4-3.5l-1.2,7 C17.9,22.6,17.8,22.7,17.7,22.7L17.7,22.7z"/> <path d="M17.7,23c-0.2,0-0.5-0.2-0.5-0.4l-1.1-4.4l-0.9,2.1c0,0.1-0.2,0.3-0.5,0.3c-0.2,0-0.3-0.1-0.4-0.2l0-0.1 l-0.8-1.5h-2.2c-0.3,0-0.5-0.3-0.5-0.6s0.2-0.6,0.5-0.6h2.4c0.3,0,0.4,0.2,0.5,0.3l0.5,0.9l1.1-2.6c0.1-0.2,0.3-0.3,0.5-0.3 c0.3,0,0.4,0.2,0.5,0.4l0,0.1l0.9,3.5l1.1-6.5c0-0.3,0.2-0.5,0.5-0.5c0.3,0,0.5,0.2,0.5,0.5L20,18l0.3-0.2c0,0,0.1-0.1,0.2-0.1h2 c0.3,0,0.5,0.3,0.5,0.6s-0.2,0.6-0.5,0.6h-1.7l-0.8,0.5c-0.2,0.1-0.4,0.1-0.6,0c-0.1-0.1-0.2-0.2-0.2-0.4L19,17.4l-0.9,5.1 C18.2,22.8,17.9,23,17.7,23z M14.8,20L14.8,20l1.4-3.4l0-0.1L14.8,20z M19.7,18.8L19.7,18.8l0.9-0.5h1.9c0,0,0,0,0-0.1 c0,0,0-0.1,0-0.1l-1.9,0c0,0,0,0-0.1,0L19.7,18.8z M11.3,18.3C11.3,18.3,11.3,18.3,11.3,18.3c0,0.1,0,0.1,0,0.1l2.4,0l0-0.1 c0,0,0,0,0,0H11.3z M19.1,13.7L19,14.5L19.1,13.7L19.1,13.7z"/> </g> <g> <path d="M7.9,1c2.3,0,4.2,2,3.8,4.4c-0.2,1.5-1.5,2.7-3.1,3C6.1,8.8,4,7,4,4.7C4,2.7,5.6,1,7.9,1L7.9,1z"/> <path d="M7.9,10.1c-3.6,0-6.5,2.7-6.9,6.1c0,0.4,0.2,0.6,0.6,0.6c2.2,0,10.5,0,12.7,0c0.3,0,0.5-0.2,0.5-0.5 C14.4,12.9,11.5,10.3,7.9,10.1z"/> </g> </g> </svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold" @click="showModalGeneralCommingSoon">Linked Other Noisesharks Profiles</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="linkedOtherNoisesharksProfileIcons" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="linkedOtherNoisesharksProfile" class="accordion-content card-body"  >
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis, rerum possimus! Quod nesciunt illum nihil aliquam commodi, nobis magni facere est excepturi. Accusamus, eligendi fugiat. Assumenda eaque voluptatibus ex fugiat!
<!--                        <div class="card-body bg-black">-->
<!--                            <div class="flex-column">-->
<!--                                <h3>Linked Other Noisesharks Proﬁles</h3>-->
<!--                                <p>-->
<!--                                    Link your personal proﬁle with the proﬁle of your band, vlog, podcast, or any other Noisesharks proﬁle-->
<!--                                    that you are a part of.-->
<!--                                </p>-->
<!--                                <div class="d-flex justify-content-center main-header bg-black">-->
<!--                                   <form btn  action="/" class="header-form-search d-none d-md-block">-->
<!--                                        <div class="form-group m-0">-->
<!--                                            <div class="input-group">-->
<!--                                                <input class="form-control pl-4" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none">-->
<!--                                                <div class="divider-vertical"></div>-->
<!--                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"-->
<!--                                                    width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">-->
<!--                                                <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594-->
<!--                                                    C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488-->
<!--                                                    l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719-->
<!--                                                    s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>-->
<!--                                                </svg>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="accountControl">
                        <div >
                            <div>
                                <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 838 1080" xml:space="preserve" class="icon-m"> <circle fill="#FFFFFF" cx="413.38" cy="953.36" r="126.64"/> <path fill="#FFFFFF" d="M413.38-0.69c-181.56,0-329.27,147.71-329.27,329.27v31.66H337.4v-31.66c0-41.9,34.09-75.99,75.99-75.99 c41.9,0,75.99,34.09,75.99,75.99c0,22.33-9.8,43.46-26.89,57.98L286.74,535.98v227.41h253.29v-110.3l86.49-73.53 c73.81-62.72,116.14-154.19,116.14-250.98C742.66,147.02,594.95-0.69,413.38-0.69z"/> </svg>
                                <button type="button" class="btn btn-link text-white font-weight-bold">Account Control</button>
                            </div>
                            <svg  class="icon-m float-right caret" id="accountControlIcon" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="accountControl" class="card-body">
                        <div class=" ">
                            <div class="d-flex flex-column justify-content-start">
                                <div class="mb-2 font-weight-bold">In Account Control you can choose what would you like to do with your Noisesharks account.</div>
                                <div>- Confirming “Delete Account” will remove all of your data from Noisesharks' system and will stop all and both of your
                                inbound and outbound supports.</div>
                                <div class="d-flex flex-column justify-content-center align-items-center my-4">
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-outline-light rounded-pill" @click="showAlert('Delete Account')">Delete Account</button>
                                    </div>
                                </div>
                                <div>- Confirming “Suspend Account” will only hide your account from other users and will also stop all of your in/outbound
                                supports, but it will not delete your account and you would still be able to login and view your account yourself.</div>
                                 <div class="d-flex flex-column justify-content-center align-items-center my-4">
                                    <div class="d-flex">
                                    <button type="button" class="btn btn-outline-light rounded-pill" @click="showAlert('Suspend Account')">Suspend Account</button>
                                    </div>
                                </div>
                                <div>- Confirming “Logout” just applies a standard browser logout.</div>
                                <div class="d-flex flex-column justify-content-center align-items-center my-4">
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-outline-light rounded-pill" @click="showAlert('logout')">Logout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal-edit-account :user="user" />
        <modal-edit-password :user="user" />
        <modal-edit-personal-details :user="user" />
        <modal-subscription-settings :user="user" />
        <modal-cancel :user="user" />
        <modal-general-soon></modal-general-soon>
        <modal-confirm-identity :user="user" ref="modalConfirmIdentity"></modal-confirm-identity>
        <modal-payment-method ref="ModalPaymentMethod"></modal-payment-method>
        <modal-activity-payment ref="ModalActivityPayment"></modal-activity-payment>
    </section>
</template>

<script>
import ModalEditAccount from "../Components/ModalEditAccount";
import ModalEditPassword from "../Components/ModalEditPassword";
import ModalEditPersonalDetails from "../Components/ModalEditPersonalDetails";
import ModalCancel from "../Components/ModalCancel";
import ModalGeneralSoon from "../../../CommingSoon/Components/GeneralCommingSoon";
import ModalSubscriptionSettings from "../Components/ModalSubscriptionSettings";
import ModalActivityPayment from "../Components/ModalActivityPayment";
import ModalConfirmIdentity from "../Components/ModalConfirmIdentity";
import ModalPaymentMethod from "../../../Payments/Components/ModalPaymentMethod";
import Auth from "../../../../helpers/Auth";
import Functionality from "../../../../helpers/Functionality";
import Followers from "../../../../helpers/Followers";
import SinglePaymentMethod from "../includes/SinglePaymentMethod";
import HistoryEarnings from "../includes/HistoryEarnings";
import HistoryInvoices from "../includes/HistoryInvoices";


export default {
    props:['user'],
    components:{
        ModalPaymentMethod,
        ModalConfirmIdentity,
        ModalEditAccount,
        ModalEditPassword,
        ModalEditPersonalDetails,
        ModalCancel,
        ModalGeneralSoon,
        ModalSubscriptionSettings,
        HistoryEarnings,
        HistoryInvoices,
        SinglePaymentMethod,
        ModalActivityPayment
    },
    data(){
        return {
            auth_facebook : '',
            auth_twitter : '',
            auth_google : '',
            payment_methods: [],
            filter_months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            filter_years: [],
        }
    },
    mounted(){
        Functionality.accordion('#AccordionAccountSettings')
        this.setDate()
        $('.c-main').addClass('bg-black')
        if (this.user.social_auth) {
            this.user.social_auth.map(auth =>{
                if (auth.provider === 'FacebookProvider') {
                    this.auth_facebook = auth
                }
                if (auth.provider === 'TwitterProvider') {
                    this.auth_twitter = auth
                }
                if (auth.provider === 'GoogleProvider') {
                    this.auth_google = auth
                }
            })
        }
        this.payment_methods = this.user.payment_methods
        this.showAlertSocialAccount()


    },
    updated() {
        this.showAlertSocialAccount()
        // esto es para que se abra el accordion en la seccion deseada
        var href = window.location.href.split('#')
        var tag = href[href.length-1]
        $(`.card [data-target='${tag}']`).click()
    },
    methods:{
        showAlertSocialAccount(){
            if(this.user.message === 'question'){
                swal({
                    icon: 'warning',
                    title: 'Re-link Account?',
                    text: `This social login was unlinked from this profile ${this.user.artistic_name}. Would you like to re-link it or create a separate account?`,
                    buttons: ['Create New Account', 'Re-link Account'],
                    closeOnClickOutside: false,
                }).then((willDelete) =>{
                    if(willDelete) {
                        axios.post(`/auth/CreateProvider/${this.user.id}`, this.user).then(res=>{
                            if(res.data.user){
                                this.user = res.data.user
                                swal('Success', 'Account Linked Successfully!!', 'success')
                            }
                        }).catch(err=>{
                            swal('Error', `Error ${err.data.message}`, 'error')
                        })
                    }
                })
            }else if(this.user.message === 'alert'){
                swal({
                    icon: 'warning',
                    title: 'Already has a separate Noisesharks!!',
                    text: `This Facebook account already has a separate Noisesharks profile, would you like to login to that profile?`,
                    buttons: ['Cancel', 'Login'],
                    closeOnClickOutside: false,
                }).then((willDelete) =>{
                    if(willDelete) $('#ModalLogin').modal('show')
                })
            }
        },
        showAlert(type){
            switch(type) {
                case 'logout':
                    swal({
                        title: 'Logout?',
                        text: 'Are you sure you would like to logout?',
                        buttons: ['Cancel', 'Logout'],
                        dangerMode: true,
                        closeOnClickOutside: false,
                    }).then((willDelete) => {
                        if(willDelete) {
                            Auth.logout()
                        }
                    })
                    break;
                case 'Suspend Account':
                    swal({
                        title: 'Suspend Account?',
                        text: 'Are you sure you would like to suspend your account?\n' +
                            '\n' +
                            'By going ahead we will NOT delete all of your content and your profile’s current existence on Noisesharks. But you will hide your presence for now until you choose to lift your suspension.\n' +
                            '\n' +
                            'The only data that will remain about your account is in the invoices of the Contributors that you have supported as this is required by the law so that they know who have paid them in the past',
                        buttons: ['Cancel', 'Suspend Account'],
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((willDelete) => {
                        if(willDelete){
                            this.$refs.modalConfirmIdentity.type = 'Suspend'
                            this.showModalConfirmIdentity()
                        }
                    })
                    break;
                case 'Delete Account':
                    swal({
                        title: 'Delete Account?',
                        text: 'Are you sure you would like to delete your account?\n' +
                            '\n'+
                            'By going ahead we will delete all of your content and your profile’s current existence on Noisesharks. \n' +
                            '\n'+
                            'The only data that will remain about your account is in the invoices of the Contributors that you have supported as this is required by the law so that they know who have paid them in the past',
                        buttons: ['Cancel', 'Delete Account'],
                        dangerMode: true,
                        closeOnClickOutside: false
                    }).then((willDelete) => {
                        if(willDelete){
                            this.$refs.modalConfirmIdentity.type = 'Delete'
                            swal({
                                title: 'Final Warning',
                                text: 'You are about to delete your account and remove ALL of your content of the Noisesharks.!',
                                buttons: ['Cancel', 'Confirm Account Deletion'],
                                dangerMode: true,
                                closeOnClickOutside: false,
                            }).then((willDelete) => {
                                if(willDelete) this.showModalConfirmIdentity()
                            })
                        }
                    })
                    break;
                default:
                    return
            }
        },
        showModalAddPaymentMethod(){
            this.$refs.ModalPaymentMethod.type_action = 'save'
            this.$refs.ModalPaymentMethod.initialize()
            $('#ModalPaymentMethod').modal('show')
        },
        showModalConfirmIdentity(){
            $('#modalConfirmIdentity').modal('show')
        },
        showModalSubscriptionEdit(){
            $('#ModalEditSubscriptionSettings').modal('show')
        },
        showModalEditAccount(){
            $('#ModalEditAccount').modal('show')
        },
        showModalEditPersonalDetails(){
            $('#ModalEditPersonalDetails').modal('show')
        },
        showModalEditPassword(){
            $('#ModalEditPassword').modal('show')
        },
        showModalCancel(){
            $('#ModalCancel').modal('show')
        },
        showModalGeneralCommingSoon(){
            $('#ModalGeneralCommingSoon').modal('show')
        },
        windowReplace(url){
            window.location.replace(url)
        },
        generateInvoice(payment, user){
            if(payment.type === 'reward receive' || payment.type === 'support receive'){
                window.location.replace(`/Payment/Invoice/Generate/${payment.type === 'reward receive' ? 'contributorInvoiceReward': 'contributorInvoiceSupport'}/${payment.invoice.id}/${user.token}`)
            }else if(payment.type === 'Percentage'){
                window.location.replace(`/Payment/Invoice/Generate/contributor/${payment.invoice.id}/${user.token}`)
            }else{
                window.location.replace(`/Payment/Invoice/Generate/${payment.type === 'reward' ? 'reward': 'support'}/${payment.invoice.id}/${user.token}`)
            }
        },
        async disconnectAccount(provider){
            let pro = ''
            if(this.auth_facebook){
                pro = this.auth_facebook
            }else if(this.auth_twitter){
                pro = this.auth_twitter
            }else if(this.auth_google){
                pro = this.auth_google
            }
            swal({
                title: `Disconnect From ${pro.provider.split('Provider')[0]}?`,
                text: `Are you sure you would like to disconnect from ${pro.provider.split('Provider')[0]}?\n` +
                    `You will not be able to do a Quick Login with ${pro.provider.split('Provider')[0]}`,
                className: 'swal-alert',
                buttons: ['Cancel','Disconnect'],
                dangerMode: true,
            }).then((willDelete) => {
                if(willDelete){
                    if(willDelete){
                        Auth.setSession()
                        axios.post(`/User/Settings/SocialAuth/${pro.id}`).then(res => {
                            if(res.data.verifyUrl){
                                swal({
                                    title: `Disconnected Successfuly!`,
                                    text: `Your Noisesharks account is now disconnected from your ${pro.provider.split('Provider')[0]} account`,
                                    className: 'swal-alert',
                                    buttons: [false,'Got it!'],
                                    dangerMode: true,
                                }).then((willDelete) => {
                                    if(willDelete){
                                        this.$toasted.show('Twitter Disconnected successfuly!', {
                                            position: "bottom-right",
                                            duration : 4000,
                                            className: "notification",
                                            keepOnHover: true
                                        })
                                        axios.get('/logout').then(res => {
                                            Auth.remove()
                                            Followers.remove()
                                        })
                                        window.location.replace(`${res.data.verifyUrl}`);
                                    }
                                })
                                $('.swal-footer').addClass('text-center')
                                $('.swal-title').addClass('c-seven')
                            }
                        }).catch(err =>{Auth.keepLogged(err.response.status)})
                    }
                }
            })
        },
        setDate(){
            //set data invoices period
            let data = new Date()
            let year = data.getFullYear()
            for(let i = year; i >= 2019; i--) this.filter_years.push(i)
        },
    }
}
</script>
<style lang="scss" scoped>
    i,svg{
        transition: all linear .3s;
        &.active{
            transform: rotate(180deg) !important;
        }
    }
    .table tr:nth-child(2n){
        background-color: #202020;
    }
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
    .icon-m.close{
        fill: var(--fourth-color);
        &:hover{
            fill: var(--fifth-color);
        }
    }
</style>
