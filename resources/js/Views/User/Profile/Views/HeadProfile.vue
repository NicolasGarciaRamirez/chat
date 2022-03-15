<template>
    <section class="profile">
        <div class="profile__container bg-second">
            <img :src="`${user.cover}`" alt="ImagePortada" class="profile--bg-image" style="object-fit: cover; border-radius:0 0 .6rem .6rem;">
            <div class="profile__content">
                <div class="profile__content--edit-cover">
                    <label class="btn btn-sm btn-outline-light rounded-pill" for="change-image" @click="type_change_image = 'Cover'" v-if="auth.token && auth.token === user.token && route_name === `/${auth.username}/Edit` || route_name === `/${auth.username}/Channel/Edit`">
                        Edit Cover Photo
                        <svg   class="icon-sm mb-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                    </label>
                </div>
                <div class="profile__header">
                    <div class="profile__header--content-user pt-2">
                        <div class="profile__header--avatar">
                            <img :src="`${user.avatar}`" alt="ImageProfile" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <label for="change-image" @click="type_change_image = 'Profile'" v-if="auth.token && auth.token === user.token && route_name === `/${auth.username}/Edit` || route_name === `/${auth.username}/Channel/Edit`" >
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                            </label>
                        </div>
                        <div class="profile__header--content-data">
                            <h2 class="font-weight-bold mb-3">
                                {{ user.artistic_name }}
                                <img src="/images/icons/check.svg" alt="icon-check" class="icon-check" v-if="user.verification_date">
                                <svg class="icon-check" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" v-if="user.badge_verification"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
                            </h2>
                            <div class="d-flex mb-3">
                                <span class="title-tag" style="padding: 0.4rem .5rem 0.3rem .5rem;">{{ user.profile_information ? user.profile_information.title : 'Profile Title Not Chosen' }}</span>
                                <span class="contributor-tag" v-if="user.subscription_type  == 'CONTRIBUTOR'">
                                    <div class="mr-1">CONTRIBUTOR</div>
                                    <img src="/images/icons/music-red.svg" alt="music-red-icon" class="mt-1" style="width: 0.8rem; margin-bottom: 0.2rem">
                                </span>
                            </div>
                            <p  class="d-flex justify-content-center flex-wrap">
                                <span class="mr-3">{{user.followers_count}} Follower{{ user.followers_count >= 2 ? 's' : ''}}</span> •
                                <span class="mx-3">{{user.following_count}} Following{{ user.following_count >= 2 ? 's': ''}}</span> •
                                <span class="mx-3">{{user.supports_count}} Supporter{{ user.supports_count >= 2 ? 's': ''}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="profile__header--content-btns pt-2">
                        <div v-if="auth.token === user.token" class="d-flex flex-wrap  justify-content-center">
                            <a :href="`/${user.username}/Channel/Edit`" class="btn btn-sm btn-outline-light rounded-pill" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit`">
                                Edit Profile
                                <svg   class="icon-sm mb-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-light rounded-pill" @click="showModalShare">
                                <span> Share Profile </span>
                                <svg class="icon-sm mb-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.2,10.3l-8.8-8.8C13.1,1.2,12.7,1,12.3,1c-0.5,0-1.2,0.4-1.2,1.5v5.4C8.5,8.1,6,9.2,4.1,11.1 C2.1,13.2,1,16,1,18.9c0,1.3,0.2,2.5,0.6,3.7C1.7,22.8,2,23,2.2,23c0.3,0,0.5-0.2,0.6-0.4c1.3-3.6,4.6-6.1,8.4-6.4v5.3 c0,1.1,0.6,1.5,1.2,1.5c0.4,0,0.8-0.2,1.2-0.6l8.8-8.8c0.4-0.4,0.7-1,0.7-1.7C22.9,11.4,22.7,10.8,22.2,10.3z M21.3,12.8l-8.8,8.8 l-0.1,0.1v-0.1v-6c0-0.2-0.1-0.3-0.2-0.5c-0.1-0.1-0.3-0.2-0.5-0.2l0,0c-2.3,0-4.5,0.8-6.3,2.1c-1.3,0.9-2.4,2.1-3.1,3.5 c-0.1-0.5-0.1-1-0.1-1.5c0-5.3,4.3-9.7,9.6-9.7c0.4,0,0.6-0.3,0.6-0.6v-6c0-0.1,0-0.1,0-0.1l0.1,0.1l8.8,8.8 c0.2,0.2,0.3,0.5,0.3,0.8C21.6,12.3,21.5,12.6,21.3,12.8z" class="primary-color"></path> <path d="M22.2,10.3l-8.8-8.8C13.1,1.2,12.7,1,12.3,1c-0.5,0-1.2,0.4-1.2,1.5v5.4C8.5,8.1,6,9.2,4.1,11.1 C2.1,13.2,1,16,1,18.9c0,1.3,0.2,2.5,0.6,3.7C1.7,22.8,2,23,2.2,23c0.3,0,0.5-0.2,0.6-0.4c1.3-3.6,4.6-6.1,8.4-6.4v5.3 c0,1.1,0.6,1.5,1.2,1.5l0,0c0.4,0,0.8-0.2,1.2-0.6l8.8-8.8c0.4-0.4,0.7-1,0.7-1.7C22.9,11.4,22.7,10.8,22.2,10.3z" class="secondary-color"></path></svg>
                            </a>
                            <a :href="`/${user.username}/Profile`" class="btn btn-sm btn-outline-light rounded-pill">
                                <span>Preview Profile</span>
                                <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path d="M22.9,11.6C22.7,11.4,18,5,12,5S1.3,11.4,1.1,11.6c-0.2,0.2-0.2,0.5,0,0.7C1.3,12.6,6,19,12,19 s10.7-6.4,10.9-6.6C23,12.1,23,11.9,22.9,11.6z M12,16.5c-2.5,0-4.5-2-4.5-4.5s2-4.5,4.5-4.5s4.5,2,4.5,4.5S14.5,16.5,12,16.5z" /> <path d="M12,10.1c-1.1,0-1.9,0.9-1.9,1.9s0.9,1.9,1.9,1.9s1.9-0.9,1.9-1.9C13.9,10.9,13.1,10.1,12,10.1z"/> </svg>
                            </a>
                            <button class="btn btn-sm btn-outline-light rounded-pill d-lg-none" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <svg class="icon-m" style="fill: currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><path d="M22.2,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9C19.4,9,21.1,9,22.2,10.1"></path> <path d="M13.9,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0c-1.1-1.1-1.1-2.8,0-3.9S12.9,9,13.9,10.1"></path> <path d="M5.7,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9S4.6,9,5.7,10.1"></path></svg>
                            </button>
                            <button class="btn btn-sm btn-link rounded-pill d-none d-lg-block" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <svg class="icon-m  fill-fourth"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><path d="M22.2,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9C19.4,9,21.1,9,22.2,10.1"></path> <path d="M13.9,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0c-1.1-1.1-1.1-2.8,0-3.9S12.9,9,13.9,10.1"></path> <path d="M5.7,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9S4.6,9,5.7,10.1"></path></svg>
                            </button>
                            <div class="dropdown-menu text-white p-2" aria-labelledby="dropdown">
                                <div class="dropdown-item cursor-pointer" >Copy Profile Link</div>
                            </div>
                        </div>
                        <div v-else-if="!auth.token || auth.token !== user.token" class="d-flex flex-wrap  justify-content-center">
                            <div class="mr-3 d-none d-lg-block">
                                <button class="btn btn-sm btn-link rounded-pill ">
                                    <svg class="icon-m" @click="showModalShare" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.2,10.3l-8.8-8.8C13.1,1.2,12.7,1,12.3,1c-0.5,0-1.2,0.4-1.2,1.5v5.4C8.5,8.1,6,9.2,4.1,11.1 C2.1,13.2,1,16,1,18.9c0,1.3,0.2,2.5,0.6,3.7C1.7,22.8,2,23,2.2,23c0.3,0,0.5-0.2,0.6-0.4c1.3-3.6,4.6-6.1,8.4-6.4v5.3 c0,1.1,0.6,1.5,1.2,1.5c0.4,0,0.8-0.2,1.2-0.6l8.8-8.8c0.4-0.4,0.7-1,0.7-1.7C22.9,11.4,22.7,10.8,22.2,10.3z M21.3,12.8l-8.8,8.8 l-0.1,0.1v-0.1v-6c0-0.2-0.1-0.3-0.2-0.5c-0.1-0.1-0.3-0.2-0.5-0.2l0,0c-2.3,0-4.5,0.8-6.3,2.1c-1.3,0.9-2.4,2.1-3.1,3.5 c-0.1-0.5-0.1-1-0.1-1.5c0-5.3,4.3-9.7,9.6-9.7c0.4,0,0.6-0.3,0.6-0.6v-6c0-0.1,0-0.1,0-0.1l0.1,0.1l8.8,8.8 c0.2,0.2,0.3,0.5,0.3,0.8C21.6,12.3,21.5,12.6,21.3,12.8z" class="primary-color"></path> <path d="M22.2,10.3l-8.8-8.8C13.1,1.2,12.7,1,12.3,1c-0.5,0-1.2,0.4-1.2,1.5v5.4C8.5,8.1,6,9.2,4.1,11.1 C2.1,13.2,1,16,1,18.9c0,1.3,0.2,2.5,0.6,3.7C1.7,22.8,2,23,2.2,23c0.3,0,0.5-0.2,0.6-0.4c1.3-3.6,4.6-6.1,8.4-6.4v5.3 c0,1.1,0.6,1.5,1.2,1.5l0,0c0.4,0,0.8-0.2,1.2-0.6l8.8-8.8c0.4-0.4,0.7-1,0.7-1.7C22.9,11.4,22.7,10.8,22.2,10.3z"></path></svg>
                                </button>
                            </div>
                            <div :id="`support`+user.token" @click="storeSupport" class="mr-3 mb-3" v-if="user.subscription_type === 'CONTRIBUTOR' && user.username !== auth.username">
                                <button type="button" :class="`rounded-pill btn btn-sm btn-outline-red content-icon function-contributor-idle`">
                                    {{support_type === 'unSupport' ? 'Supporting' : 'Support'}}
                                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M17.1,2c-1.2,0-2.3,0.4-3.3,1.1c-0.9,0.7-1.5,1.6-1.9,2.4c-0.4-0.7-1-1.6-1.9-2.4C9,2.4,7.9,2,6.7,2 C3.5,2,1,4.8,1,8.5c0,4,3.1,6.8,7.8,10.9c0.8,0.7,1.7,1.5,2.7,2.4c0.1,0.1,0.3,0.2,0.5,0.2s0.3-0.1,0.5-0.2 c0.9-0.8,1.9-1.6,2.7-2.4c4.7-4.1,7.8-6.9,7.8-10.9C22.8,4.8,20.3,2,17.1,2z"/> </svg>
                                </button>
                            </div>
                            <div :id="`reward`+user.token" @click="storeReward" class="mr-3 mb-3" v-if="user.subscription_type === 'CONTRIBUTOR' && user.username !== auth.username">
                                <button type="button" :class="`btn btn-sm btn-outline-red rounded-pill content-icon function-contributor-idle`">
                                    Reward
                                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24; " xml:space="preserve"> <path d="M14.6,12.6V23h5.2c1.1,0,2-0.9,2-1.9v-8.4h-7.2V12.6z"/> <path d="M2.3,12.6V21c0,1.1,0.9,1.9,1.9,1.9h5.2V12.6H2.3z"/> <path d="M21.1,6.2h-2.6c0.4-0.5,0.7-1.2,0.7-1.9c0-1.8-1.4-3.2-3.2-3.2c-2.4-0.1-3,1.5-4,4C11,2.6,10.4,1,8.1,1 C6.4,1,4.9,2.4,4.9,4.2c0,0.7,0.3,1.4,0.7,1.9H2.9C1.9,6.2,1,7,1,8.1v1.3c0,1.1,0.9,1.9,1.9,1.9h6.5V6.2H8.1 C7,6.2,6.2,5.3,6.2,4.3s0.9-1.9,1.9-1.9c1.3,0,1.7,0.8,2.7,3.3C10.9,5.8,11,6,11,6.2h-0.3c0,9.6,0,7.2,0,16.8h2.6 c0-15.1,0-12.7,0-16.8H13c0-0.2,0.1-0.4,0.2-0.6c1-2.5,1.4-3.3,2.7-3.3c1.1,0,1.9,0.9,1.9,1.9s-0.9,1.9-1.9,1.9h-1.3v5.2h6.5 c1.1,0,1.9-0.9,1.9-1.9V8.1C23,7,22.1,6.2,21.1,6.2z"/> </svg>
                                </button>
                            </div>
                            <div :id="`follow`+user.token" class="follow-movile-button mr-3 mb-3" @click="!disable_follow ? storeFollow(follow_type) : ''" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit` && auth.username !== user.username">
                                <button type="button" class="btn btn-sm  btn-outline-light rounded-pill follow-idle" :style="(follow_type === 'unfollow')? 'border-color: transparent' : ''" v-if="user.subscription_type === 'CONTRIBUTOR' && user.username !== auth.username">
                                    <span> {{ follow_type === 'unfollow' ? 'Following' : 'Follow'}} </span>
                                    <svg class="icon-sm mb-1" style="fill: currentColor" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M23,9.4C22.9,9.2,22.7,9,22.5,9l-6.8-1.1l-3.1-6.5C12.5,1.2,12.3,1,12,1c-0.2,0-0.5,0.1-0.6,0.4l-3,6.4 L1.6,8.9C1.3,9,1.1,9.1,1,9.4c0,0.2,0,0.5,0.2,0.6l4.9,5.1L5,22.3c0,0.2,0.1,0.5,0.3,0.6C5.4,23,5.5,23,5.7,23 c0.1,0,0.2,0,0.3-0.1l6.1-3.4l6.1,3.4c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.3-0.4,0.3-0.6L18,15.1l4.9-5.1C23,9.9,23,9.6,23,9.4z"/> </svg>
                                </button>
                                <button type="button" class="btn btn-sm  btn-outline-light rounded-pill follow-idle" v-else>
                                    {{ follow_type === 'unfollow' ? 'Following' : 'Follow'}}
                                    <svg class="icon-sm mb-1" style="fill: currentColor" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M23,9.4C22.9,9.2,22.7,9,22.5,9l-6.8-1.1l-3.1-6.5C12.5,1.2,12.3,1,12,1c-0.2,0-0.5,0.1-0.6,0.4l-3,6.4 L1.6,8.9C1.3,9,1.1,9.1,1,9.4c0,0.2,0,0.5,0.2,0.6l4.9,5.1L5,22.3c0,0.2,0.1,0.5,0.3,0.6C5.4,23,5.5,23,5.7,23 c0.1,0,0.2,0,0.3-0.1l6.1-3.4l6.1,3.4c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.3-0.4,0.3-0.6L18,15.1l4.9-5.1C23,9.9,23,9.6,23,9.4z"/> </svg>
                                </button>
                            </div>
                            <button class="btn btn-sm mb-3 btn-outline-light rounded-pill d-lg-none" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <svg class="icon-m" style="fill: currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><path d="M22.2,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9C19.4,9,21.1,9,22.2,10.1"></path> <path d="M13.9,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0c-1.1-1.1-1.1-2.8,0-3.9S12.9,9,13.9,10.1"></path> <path d="M5.7,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9S4.6,9,5.7,10.1"></path></svg>
                            </button>
                            <button class="btn btn-sm mb-3 btn-link rounded-pill d-none d-lg-block" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <svg class="icon-m  fill-fourth"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><path d="M22.2,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9C19.4,9,21.1,9,22.2,10.1"></path> <path d="M13.9,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0c-1.1-1.1-1.1-2.8,0-3.9S12.9,9,13.9,10.1"></path> <path d="M5.7,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9S4.6,9,5.7,10.1"></path></svg>
                            </button>
                            <div class="dropdown-menu text-white p-2" aria-labelledby="dropdown">
                                <div class="dropdown-item cursor-pointer" >Copy Profile Link</div>
                                <a href="mailto:support@noisesahrks.com" class="dropdown-item">Report</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="file" class="d-none" accept=".jpeg,.jpg,.png,.svg" id="change-image"  @change="showChangeImage">
        </div>
        <modal-change-image />
        <modal-login />
        <modal-share-profile :user="user"></modal-share-profile>
        <modal-support ref="supportModal" :user="user_autenticate" :post="{user}" />
        <modal-reward ref="rewardModal" :user="user_autenticate" :post="{user}" />
    </section>
</template>

<script>
import ModalChangeImage from "../Components/Includes/ModalChangeImage";
import ModalShareProfile from "../Components/Includes/ModalShareProfile";
import ModalLogin from '../../../Auth/Components/Login';
import Auth from "../../../../helpers/Auth";
import StripeKeys from "../../../../helpers/StripeKeys";

export default {
    props:['user', 'user_autenticate'],
    components:{
        ModalChangeImage,
        ModalLogin,
        ModalShareProfile,
        StripeKeys
    },
    data(){
        return {
            img:null,
            resource:'',
            type_change_image: '',
            auth: Auth.state,
            disable_follow: false,
            disable_support: false,
            disable_reward: false,
            follow_type: 'follow',
            follow:{
                type: ''
            },
            reward_type:'reward',
            reward:{
                amount: 0
            },
            support_type: 'support',
            support:{
                monthly_amount: 0
            },
            route_name: window.location.pathname
        }
    },
    mounted(){
        Auth.initialize()
        this.getFollow()
        this.getSupport()
        this.initialize()
    },
    methods: {
        refreshCacheImage(){
            $('#change-image').val('')
        },
        initialize(){
            let self = this
            let modalReward = $("#modalReward")
            let modalSupport = $("#modalSupport")
            modalReward.on('show.bs.modal', function () {self.getIp()})
            modalSupport.on('show.bs.modal', function () {self.getIp()});
            modalReward.on('hidden.bs.modal', function () {
                self.$refs.rewardModal.$refs.summary.reset()
                self.$refs.rewardModal.view_summary = false
                self.$refs.rewardModal.summary = {
                    tier:'',
                    amount:'',
                    description:''
                }
            });
            modalSupport.on('hidden.bs.modal', function () {
                self.$refs.supportModal.$refs.summary.reset()
                self.$refs.supportModal.view_summary = false
                self.$refs.supportModal.summary = {
                    tier:'',
                    amount:'',
                    description:''
                }
            });
        },
        getIp(){
            if(!this.$refs.supportModal.user.payment_ip_data || !this.$refs.rewardModal.user.payment_ip_data){
                let self = this
                $.getJSON('https://api.ipstack.com/check?access_key='+StripeKeys.data_keys.CLIENT_IP_STACK_LOCATION, function (res){
                    self.$refs.supportModal.summary = {
                        tier:'',
                        amount:'',
                        description:'',
                    }
                    self.$refs.supportModal.currency = res.currency.symbol === 'CO$' ? '$' : res.currency.symbol
                    self.$refs.rewardModal.summary = {
                        tier:'',
                        amount:'',
                        description:'',
                    }
                    self.$refs.rewardModal.currency = res.currency.symbol === 'CO$' ? '$' : res.currency.symbol
                    self.$refs.rewardModal.getCurrencyClass(res.currency)
                    if(Auth.state.username){
                        axios.post(`/${Auth.state.username}/Payment/Save/Ip/Data`, res).then(res =>{
                            // res.data.saved ? swal('Success', `${res.data.saved}`, 'success') : swal('Error', `err`, 'error')
                        }).catch(err=>{
                            swal('Error', `${err}`, 'error')
                        })
                    }

                })
            } else {
                this.$refs.supportModal.user.payment_ip_data.currency = typeof this.$refs.supportModal.user.payment_ip_data.currency === 'string' ? JSON.parse(this.$refs.supportModal.user.payment_ip_data.currency) : this.$refs.supportModal.user.payment_ip_data.currency
                this.$refs.supportModal.summary = {
                    tier:'',
                    amount:'',
                    description:'',
                }
                this.$refs.supportModal.currency = this.$refs.supportModal.user.payment_ip_data.currency.symbol === 'CO$' ? '$' : this.$refs.supportModal.user.payment_ip_data.currency.symbol
                this.$refs.rewardModal.summary = {
                    tier:'',
                    amount:'',
                    description:'',
                }
                this.$refs.rewardModal.currency = this.$refs.supportModal.user.payment_ip_data.currency.symbol === 'CO$' ? '$' : this.$refs.supportModal.user.payment_ip_data.currency.symbol
                this.$refs.rewardModal.getCurrencyClass(this.$refs.supportModal.user.payment_ip_data.currency)
            }
        },
        showModalSupport(){
            this.$refs.supportModal.$refs.summary.getPaymentsMethods()
            $('#modalSupport').modal('show')
        },
        showModalReward(){
            this.$refs.rewardModal.$refs.summary.getPaymentsMethods()
            $('#modalReward').modal('show')
        },
        showModalShare(){
            $('#ModalShareProfile').modal('show')
        },
        showChangeImage(w){
            let input = w.target;
            this.resource = w.target.files[0]
            this.img = URL.createObjectURL(w.target.files[0])
            $('#ModalChangeImage').modal({
                backdrop: 'static'
            })
        },
        getFollow(){
            if(this.user.followers){
                this.user.followers.map(follow =>{
                    if(follow.user){
                        if (follow.user.username === Auth.state.username) {
                            $(`#follow`+this.user.token+` button`).addClass('follow-active').removeClass('follow-idle')
                            this.follow_type = 'unfollow'
                        }
                    }
                })
            }
        },
        async storeFollow(type){
            if (Auth.state.token) {
                await Auth.setSession()
                this.disable_follow = true
                let request = ''
                if (type === 'follow') {
                    if (Auth.state.username) {
                        this.follow.type = 'Followed'
                    }else{
                        this.follow.type = 'Follower'
                    }
                    request = this.follow
                    this.url = `/${Auth.state.username}/Follow/follow/${this.user.token}`
                }
                if (type === 'unfollow') {
                    request = this.follow
                    if (this.user.followers) {
                        this.user.followers.map(follow =>{
                            if (Auth.state.username === follow.user.username) {
                                this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                            }
                        })
                    }
                }
                await axios.post(this.url, request).then(res =>{
                    this.disable_follow = false
                    if (res.data.follow) {
                        this.user.followers.push(res.data.follow)
                        this.follow_type = 'unfollow'
                        this.$root.$refs.AppNav.followings = res.data.followings
                        this.$root.$refs.modalRelathion.followings = []
                        _.each(res.data.followings, following =>{
                            this.$root.$refs.modalRelathion.followings.push(following.following)
                        })
                        $(`#follow`+this.user.token+` button`).addClass('follow-active').removeClass('follow-idle')

                        if(window.location.href.match(`${window.location.origin}/${this.user.username}/Channel/Activity`)) {
                            this.$root.$refs.channelActivity.$children.map(children =>{
                                if(children.$options._componentTag === 'post'){
                                    children.$children.map(react =>{
                                        if(react.$options._componentTag === 'post-reactions') {
                                            react.follow_type = 'unfollow'
                                            react.follow = res.data.follow
                                            react.post.user.followers.push(res.data.follow)
                                        }
                                    })
                                }
                            })

                            this.$root.$refs.channelActivity.user.posts.map(post => {
                                $(`#follow`+post.token+' button').addClass('follow-active').removeClass('follow-idle')
                                $(`#followMovile`+post.token+' span').addClass('follow-active').removeClass('follow-idle')
                            })
                        }
                    }
                    if (res.data.unfollow) {
                        this.follow_type = 'follow'
                        $(`#follow`+this.user.token+` button`).addClass('follow-idle').removeClass('follow-active')
                        this.$root.$refs.AppNav.followings = res.data.followings
                        this.$root.$refs.modalRelathion.followings = []
                        _.each(res.data.followings, following =>{
                            this.$root.$refs.modalRelathion.followings.push(following.following)
                        })

                        if(window.location.href.match(`${window.location.origin}/${this.user.username}/Channel/Activity`)) {
                            this.$root.$refs.channelActivity.$children.map(children =>{
                                if(children.$options._componentTag === 'post'){
                                    children.$children.map(react =>{
                                        if(react.$options._componentTag === 'post-reactions'){
                                            react.follow_type = 'follow'
                                            react.follow = {user:''}
                                        }
                                    })
                                }
                            })
                            this.$root.$refs.channelActivity.user.posts.map(post => {
                                $(`#follow`+post.token+' button').addClass('follow-idle').removeClass('follow-active')
                                $(`#followMovile`+post.token+' span').addClass('follow-idle').removeClass('follow-active')
                            })
                        }
                    }
                }).catch(err =>{
                    this.disable_follow = false
                    Auth.keepLogged(err.response.status)
                })
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        getSupport(){
            if (Auth.state.username){
                if (this.user.supports) {
                    this.user.supports.map(support =>{
                        if (Auth.state.username === support.user.username) {
                            $('#support'+this.user.token+' button').addClass('function-contributor-active').removeClass('function-contributor-idle')
                            this.support_type = 'unSupport'
                        }
                    })
                }
            }
        },
        async storeSupport(){
            this.disable_support = true
            let url = ''
            if(Auth.state.username) {
                await Auth.setSession()
            }
            if(this.support_type === 'support'){
                this.showModalSupport()
                this.disable_support = false
                return false
            }
            if(this.support_type === 'support-payment'){
                url = `/${Auth.state.username}/Support/save/${this.user.username}`
            }
            if(this.support_type === 'unSupport'){
                if (this.user.supports) {
                    this.user.supports.map(support =>{
                        if (Auth.state.username === support.user.username) {
                            url = `/${Auth.state.username}/Support/delete/${support.id}`
                        }
                    })
                }
            }
            axios.post(url, this.support).then(res => {
                if(res.data.saved){
                    this.disable_support = false
                    this.support_type = 'unSupport'
                    this.user.supports.push(res.data.support)
                    $(`#support`+this.user.token+' button').addClass('function-contributor-active').removeClass('function-contributor-idle')

                    this.$root.$refs.modalRelathion.supportings = []
                    _.each(res.data.supportings , support =>{
                        this.$root.$refs.modalRelathion.supportings.push(support)
                    })

                    if(window.location.href.match(`${window.location.origin}/${this.user.username}/Channel/Activity`)) {
                        this.$root.$refs.channelActivity.$children.map(children =>{
                            if(children.$options._componentTag === 'post'){
                                children.$children.map(react =>{
                                    if(react.$options._componentTag === 'post-reactions') {
                                        react.support_type = 'unSupport'
                                        react.support = res.data.support
                                        react.post.user.supports.push(res.data.support)
                                    }
                                })
                            }
                        })
                        this.$root.$refs.channelActivity.user.posts.map(post => {
                            $(`#support`+post.token+' button').addClass('function-contributor-active').removeClass('function-contributor-idle')
                        })
                    }
                }
                if(res.data.unSupport){
                    this.disable_support = false
                    this.support_type = 'support'
                    $(`#support`+this.user.token+' button').addClass('function-contributor-idle').removeClass('function-contributor-active')
                    this.$root.$refs.modalRelathion.supportings = []
                    _.each(res.data.supportings , support =>{
                        this.$root.$refs.modalRelathion.supportings.push(support.supporting)
                    })

                    if(window.location.href.match(`${window.location.origin}/${this.user.username}/Channel/Activity`)) {
                        this.$root.$refs.channelActivity.$children.map(children =>{
                            if(children.$options._componentTag === 'post'){
                                children.$children.map(react =>{
                                    if(react.$options._componentTag === 'post-reactions') {
                                        react.support_type = 'support'
                                        react.support = res.data.support
                                        react.post.user.supports.push(res.data.support)
                                    }
                                })
                            }
                        })

                        this.$root.$refs.channelActivity.user.posts.map(post => {
                            $(`#support`+post.token+' button').addClass('function-contributor-idle').removeClass('function-contributor-active')
                        })
                    }
                }
            }).catch(err =>{Auth.keepLogged(err.response.status)})
        },
        async storeReward(){
            this.disable_reward = true
            let url = ''
            if(Auth.state.username) {
                await Auth.setSession()
            }
            if(this.reward_type === 'reward'){
                this.showModalReward()
                this.disable_reward = false
                return false
            }
            if(this.reward_type === 'reward-payment'){
                url = `/${Auth.state.username}/Reward/save/${this.user.username}`
            }
            if(this.reward_type === 'unReward'){
                this.showModalReward()
                this.disable_reward = false
                return false
            }
            await axios.post(url, this.reward).then(res => {
                this.disable_reward = false
                if(res.data.saved){
                    this.$root.$refs.modalRelathion.rewardings = []
                    _.each(res.data.rewardings , reward =>{
                        this.$root.$refs.modalRelathion.rewardings.push(reward)
                    })
                }
                if(res.data.unReward){
                    this.$root.$refs.modalRelathion.rewardings = []
                    _.each(res.data.rewardings , reward =>{
                        this.$root.$refs.modalRelathion.rewardings.push(reward)
                    })

                }
            }).catch(err =>{Auth.keepLogged(err.response.status)})
        },
    },
}
</script>

<style lang="scss">
    .icon-check{
        width: 1.2rem;
    }
    .btn{
        svg[class^="icon"]{
            fill: currentColor;
            @media (min-width: 993px){
                .secondary-color{ display: none; }
            }
        }
        &:active{
            svg[class^="icon"]{
                .secondary-color{ display: block; }
            }
        }
    }
</style>
