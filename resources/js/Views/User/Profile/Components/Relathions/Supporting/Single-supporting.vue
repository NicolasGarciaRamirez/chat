<template>
    <tr v-if="supporting.supporting">
        <td class="d-flex align-items-center" style="min-width: max-content">
            <a :href="`/${supporting.supporting.username}/Channel/Activity`">
                <img :src="supporting.supporting.avatar" class="rounded-circle " style="width: 4rem" />
            </a>
            <div class="d-flex flex-column align-items-start ml-3">
                <label class="font-weight-bold">Name</label>
                <label>
                    {{supporting.supporting.artistic_name}}
                    <img src="/images/icons/check.svg" alt="" class="icon-check ml-1" v-if="supporting.supporting.verification_date">
                    <svg class="icon-check d-none" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
                </label>
            </div>
        </td>
        <td class="mx-3">
            <div class="d-flex flex-column align-items-start">
                <label class="font-weight-bold">Monthly Amount:</label>
                <span> ${{supporting.monthly_amount}}</span>
            </div>
        </td>
        <td>
            <div class="d-flex flex-column align-items-start">
                <label class="font-weight-bold">Start Date:</label>
                <span>{{supporting.start_date}}</span>
            </div>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary">
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M21.1,4.9h-7.5l2.8-2.8c0.3-0.3,0.3-0.7,0-0.9c-0.3-0.3-0.7-0.3-0.9,0L12,4.6L8.6,1.2c-0.3-0.3-0.7-0.3-0.9,0 c-0.3,0.3-0.3,0.7,0,0.9l2.8,2.8H2.9C1.9,4.9,1,5.8,1,6.8v12.9c0,1.1,0.9,1.9,1.9,1.9h1.9v0.6c0,0.4,0.3,0.6,0.6,0.6 s0.6-0.3,0.6-0.6v-0.6h11.6v0.6c0,0.4,0.3,0.6,0.6,0.6s0.6-0.3,0.6-0.6v-0.6h2c1.1,0,1.9-0.9,1.9-1.9V6.8C23,5.8,22.1,4.9,21.1,4.9 z M17.8,18.5c0,0.4-0.3,0.6-0.6,0.6H4.2c-0.4,0-0.6-0.3-0.6-0.6V8.1c0-0.4,0.3-0.6,0.6-0.6h12.9c0.4,0,0.6,0.3,0.6,0.6V18.5z M20.4,17.2c0,0.4-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6v-2.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6V17.2z M19.7,12.6 c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,12.4,20.1,12.6,19.7,12.6z M19.7,10.1c-0.4,0-0.6-0.3-0.6-0.6 c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,9.8,20.1,10.1,19.7,10.1z"/> <path d="M4.9,8.8h11.6v9.1H4.9V8.8z"/> </g> </svg>
                </button>
                <button type="button" class="btn btn-secondary">
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M12,1c3.2,0,5.8,2.8,5.2,6.1c-0.3,2.1-2.1,3.7-4.3,4.2c-3.4,0.6-6.2-1.9-6.2-5.1C6.7,3.4,8.9,1,11.9,1H12z"/> <path d="M12,13.7c-5,0-9,3.7-9.5,8.5c0,0.5,0.3,0.8,0.8,0.8c3.1,0,14.5,0,17.5,0c0.4,0,0.7-0.3,0.7-0.7 C21,17.6,17,13.9,12,13.7z"/> </svg>
                </button>
                <button type="button" class="btn btn-secondary btn-close singleSupporting">
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z"/> </svg>
                </button>
            </div>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "Single-supporting",
        props:['supporting']
    }
</script>
<style lang="scss">
    .btn-close.singleSupporting:hover{
        background: var(--fifth-color);
        svg{
            fill: white;
        }
    }
</style>
