<template>
    <section :class="`post ${!$parent.is_activity_panel ? 'stream' : '' } mx-auto ${(user_auth_is_privacy ? '': 'block')}`" v-if="view_post" :id="`post-${post.token}`" >
        <div class="post-head">
            <div>
                <div class="post-head__content-user">
                    <a :href="`/${post.user.username}/Channel/Activity`" class="post-head__content-user--avatar">
                        <img :src="`${post.user.avatar}`" alt="" class="post-user-image">
                    </a>
                    <div class="post-head__content-user__data">
                        <div class="post-head__content-user__data--name">
                            <post-reactions :post="post" :auth="auth" :only_reactions_contributor="false" :reaction_movile="true" ref="reactions" :key="1" ></post-reactions>
                        </div>
                        <div class="d-flex align-items-center post-user-type">
                            <span class="title-tag">{{ post.user.profile_information ? post.user.profile_information.title : 'Profile Title Not Chosen' }}</span>
                            <span class="contributor-tag" v-if="post.user.subscription_type === 'CONTRIBUTOR'">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red" class="contributor-icon"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-head__content-actions">
                <post-reactions :post="post" :auth="auth" :only_reactions_contributor="false" :reaction_movile="false"  ref="reactions" :key="2" ></post-reactions>

                <div class="dropdown">
                    <button class="btn p-0"  id="dropdownMenuPost"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon-m" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.2,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9C19.4,9,21.1,9,22.2,10.1"/> <path d="M13.9,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0c-1.1-1.1-1.1-2.8,0-3.9S12.9,9,13.9,10.1"/> <path d="M5.7,10.1c1.1,1.1,1.1,2.8,0,3.9s-2.8,1.1-3.9,0s-1.1-2.8,0-3.9S4.6,9,5.7,10.1"/> </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuPost">
                        <div v-if="!menuPlaylist">
                            <a :href="`/${post.user.username}/Channel/Activity`" target="_blank" class="dropdown-item" v-if="post.user.username !== auth.username">Go To User Profile</a>
                            <div class="dropdown-divider" v-if="post.user.username !== auth.username"></div>
                            <div class="dropdown-item cursor-pointer" @click="edit = true" v-if="auth.username === post.user.username">Edit description</div>
                            <div class="dropdown-item cursor-pointer" @click="showModalEditPrivacy" v-if="auth.username === post.user.username">Edit Exclusivity</div>
                            <div class="dropdown-item cursor-pointer" @click="deletePost" v-if="auth.username === post.user.username">Delete Post</div>
                            <a :href="`/Post/${post.token}`" target="_blank" class="dropdown-item">Go To Post</a>
                            <a href="#" class="dropdown-item link-post" @click="copyLink">Copy Link</a>
                            <a href="mailto:support@noisesahrks.com" class="dropdown-item" v-if="auth.username !== post.user.username">Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div :class="`post-body`" v-if="post.resource || post.resource_type === 'text'">
            <div >  <!-- :class="post.resource_type !== 'image' ? `shadow bg-second border-radius` : ''" -->
                <div :class="(user_auth_is_privacy ? (post.resource_type === 'video' || post.resource_type === 'link' || post.resource_type === 'image' ) ? '' :'' : 'content-mutimedia')">
                    <div class="content-icon" v-if="!user_auth_is_privacy && post.resource_type != 'docs' && post.resource_type != 'text' && post.resource_type != 'link' && post.resource_type != 'audio'">
                        <svg class="icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.4,9.8h-1.1V7.1C18.2,3.8,15.5,1,12,1S5.7,3.8,5.7,7.1v2.7H4.6C4.2,9.8,4,10.1,4,10.4v12 C4,22.8,4.3,23,4.6,23h14.8c0.4,0,0.6-0.3,0.6-0.6V10.5C20.1,10.1,19.8,9.8,19.4,9.8z M13,17.2v2.5c0,0.2-0.2,0.4-0.4,0.4h-1.2 c-0.2,0-0.4-0.2-0.4-0.4v-2.5c-0.4-0.3-0.7-0.8-0.7-1.4c0-0.9,0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C13.7,16.3,13.4,16.9,13,17.2z M15.3,9.8H8.7V7.1c0-1.8,1.4-3.2,3.3-3.2s3.3,1.4,3.3,3.2V9.8z"/> </svg>
                    </div>
                    <post-text :post="post" :user="user" :class="(post.resource_type == 'text')? 'shadow bg-second border-radius p-3' : 'mb-3'" id="description" v-if="!post.replace_caption && post.description && user_auth_is_privacy"></post-text>
                    <post-video :post="post" :user="user" class="content-mutimedia__video" v-if="post.resource_type === 'video'"></post-video>
                    <post-audio ref="audio" :post="post" :user="user"  class="content-mutimedia__audio shadow bg-second border-radius p-3" v-if="post.resource_type === 'audio'"></post-audio>
                    <post-document :post="post" :user="user" class="content-mutimedia__docs shadow bg-second border-radius p-3" v-if="post.resource_type === 'docs'"></post-document>
                    <post-image :post="post" :user="user" class="content-mutimedia__img" v-if="post.resource_type === 'image'"></post-image>
                    <post-link :post="post" :user="user" class="content-mutimedia__link shadow bg-second border-radius" v-if="post.resource_type === 'link'" :style="`height: ${link_is_youtube ? '28.7rem' : 'auto'} !important;`"></post-link>
                </div>
                <!-- component block content -->
                <div class="post-body__block mb-3" v-if="!user_auth_is_privacy && auth.username !== post.user.username && post.privacy !== 'Followers'">
                    <div class="flex-row">
                        <svg class="icon-m mr-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.4,9.8h-1.1V7.1C18.2,3.8,15.5,1,12,1S5.7,3.8,5.7,7.1v2.7H4.6C4.2,9.8,4,10.1,4,10.4v12 C4,22.8,4.3,23,4.6,23h14.8c0.4,0,0.6-0.3,0.6-0.6V10.5C20.1,10.1,19.8,9.8,19.4,9.8z M13,17.2v2.5c0,0.2-0.2,0.4-0.4,0.4h-1.2 c-0.2,0-0.4-0.2-0.4-0.4v-2.5c-0.4-0.3-0.7-0.8-0.7-1.4c0-0.9,0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C13.7,16.3,13.4,16.9,13,17.2z M15.3,9.8H8.7V7.1c0-1.8,1.4-3.2,3.3-3.2s3.3,1.4,3.3,3.2V9.8z"/> </svg>
                        <span class="pr-3">This content is exclusive for supporters of the tier {{post.privacy}} </span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm button-unlock border-white font-weight-bold rounded-pill text-white" style="font-size: 0.8rem" @click="showModalSupport">UNLOCK</button>
                    </div>
                </div>
            </div>
        </div>
        <post-reactions :post="post" :auth="auth" :only_reactions_contributor="true" :reaction_movile="true"  ref="reactions" :key="3" ></post-reactions>
        <!-- plays, y tiempo plicado -->
        <div class="post-data pb-2">
            <span class="c-fourth mr-2">{{post.views.length}} {{ post.resource_type === 'audio' || post.resource_type === 'video' ? 'Plays' : 'Views' }}</span>
            <span class="c-fourth">{{ post.time_ago }}</span>
        </div>
        <div>
            <!-- titulo, descripcion -->
            <div :class="`post-body__descript content img-fluid `" v-if="post.resource && user_auth_is_privacy">
                <post-text :id="`post-body${post.token}`" :post="post" :user="user" v-if="post.replace_caption && user_auth_is_privacy" class="d-flex justify-content-start align-items-center pb-3"></post-text>
            </div>
        </div>
        <div class="post-footer">
            <div class="post-footer__reactions">
                <div :id="`voteUp`+post.id" class="post-footer__reactions--item" @click="disable_vote_up ? '' : storeVoteUp(vote_type_up)">
                    <svg class="reaction" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                        <path class="primary-color__true"  d="M18.2,23H5.8c-0.3,0-0.5-0.2-0.5-0.5v-8c0-0.3-0.2-0.5-0.5-0.5H1.5c-0.5,0-0.7-0.6-0.4-0.9L11.5,1.2 c0.2-0.2,0.6-0.2,0.8,0l10.5,11.8c0.3,0.4,0.1,0.9-0.4,0.9h-3.2c-0.3,0-0.5,0.2-0.5,0.5v8C18.7,22.8,18.5,23,18.2,23z M7.1,21.7 h9.7c0.3,0,0.5-0.2,0.5-0.5v-8c0-0.3,0.2-0.5,0.5-0.5h1.5c0.5,0,0.7-0.6,0.4-0.9l-7.5-8.3c-0.2-0.2-0.6-0.2-0.8,0l-7.4,8.3 c-0.3,0.4-0.1,0.9,0.4,0.9H6c0.3,0,0.5,0.2,0.5,0.5v8C6.6,21.4,6.8,21.7,7.1,21.7z"/>
                        <path class="primary-color__false"  d="M22.8,12.9L12.4,1.2c-0.2-0.2-0.6-0.2-0.8,0L1.2,12.9c-0.4,0.4-0.1,1,0.4,1h3.2c0.3,0,0.5,0.2,0.5,0.5v8 c0,0.3,0.2,0.5,0.5,0.5h12.3c0.3,0,0.5-0.2,0.5-0.5v-8c0-0.3,0.2-0.5,0.5-0.5h3.2C22.9,13.9,23.2,13.4,22.8,12.9z"/>
                        <path class="secondary-color"  d="M11.3,11.3c0.3-0.4,0.5-0.8,0.5-1.3s-0.2-0.9-0.5-1.3c-0.4-0.4-0.8-0.5-1.3-0.5S9.1,8.4,8.7,8.7 C8.3,9,8.1,9.5,8.1,10s0.2,1,0.5,1.3c0.4,0.4,0.8,0.5,1.3,0.5C10.5,11.8,10.9,11.6,11.3,11.3z M9.5,9.5C9.6,9.4,9.8,9.3,10,9.3 s0.4,0.1,0.5,0.2l0,0c0.1,0.1,0.2,0.3,0.2,0.5s-0.1,0.4-0.2,0.5l0,0c-0.1,0.1-0.3,0.2-0.5,0.2s-0.4-0.1-0.5-0.2 c-0.1-0.1-0.2-0.3-0.2-0.5C9.3,9.8,9.4,9.6,9.5,9.5z"/>
                        <polygon class="secondary-color"  points="14.5,7.7 8.7,15.5 9.6,16.3 15.3,8.5"/>
                        <path  class="secondary-color"  d="M15.4,12.7c-0.4-0.4-0.8-0.5-1.3-0.5c-0.5,0-0.9,0.2-1.3,0.5c-0.4,0.4-0.5,0.8-0.5,1.3c0,0.5,0.2,1,0.5,1.3 c0.4,0.4,0.8,0.5,1.3,0.5c0.5,0,1-0.2,1.3-0.5c0.4-0.4,0.5-0.8,0.5-1.3C16,13.5,15.8,13.1,15.4,12.7z M14.6,14.5L14.6,14.5 c-0.1,0.1-0.3,0.2-0.5,0.2s-0.4-0.1-0.5-0.2c-0.1-0.1-0.2-0.3-0.2-0.5c0-0.2,0.1-0.4,0.2-0.5c0.1-0.1,0.3-0.2,0.5-0.2 s0.4,0.1,0.5,0.2l0,0c0.1,0.1,0.2,0.3,0.2,0.5C14.8,14.2,14.7,14.4,14.6,14.5z"/>
                    </svg>
                    <span>{{ votes.vote_up.length  }}</span>
                </div>
                <div :id="`voteDown`+post.id" class="post-footer__reactions--item" @click="disable_vote_down ? '' : storeVoteDown(vote_type_down)">
                    <svg class="reaction" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                        <path class="primary-color__true"  d="M5.8,1h12.4c0.3,0,0.5,0.2,0.5,0.5v8c0,0.3,0.2,0.5,0.5,0.5h3.2c0.5,0,0.7,0.6,0.4,0.9L12.5,22.8 c-0.2,0.2-0.6,0.2-0.8,0L1.1,11.1c-0.3-0.4-0.1-0.9,0.4-0.9h3.2c0.3,0,0.5-0.2,0.5-0.5v-8C5.3,1.2,5.5,1,5.8,1z M16.9,2.3H7.2 c-0.3,0-0.5,0.2-0.5,0.5v8c0,0.3-0.2,0.5-0.5,0.5H4.7c-0.5,0-0.7,0.6-0.4,0.9l7.5,8.3c0.2,0.2,0.6,0.2,0.8,0l7.4-8.3 c0.3-0.4,0.1-0.9-0.4-0.9H18c-0.3,0-0.5-0.2-0.5-0.5v-8C17.4,2.6,17.2,2.3,16.9,2.3z"/>
                        <path class="primary-color__false" d="M1.2,11.1l10.4,11.8c0.2,0.2,0.6,0.2,0.8,0l10.4-11.8c0.4-0.4,0.1-1-0.4-1h-3.2c-0.3,0-0.5-0.2-0.5-0.5v-8 c0-0.3-0.2-0.5-0.5-0.5H5.9C5.6,1,5.4,1.2,5.4,1.5v8c0,0.3-0.2,0.5-0.5,0.5H1.7C1.1,10.2,0.8,10.7,1.2,11.1z"/>
                        <path class="secondary-color" d="M12.7,12.7c-0.3,0.4-0.5,0.8-0.5,1.3s0.2,0.9,0.5,1.3c0.4,0.4,0.8,0.5,1.3,0.5s0.9-0.2,1.3-0.5 s0.6-0.8,0.6-1.3s-0.2-1-0.5-1.3c-0.4-0.4-0.8-0.5-1.3-0.5C13.5,12.2,13.1,12.3,12.7,12.7z M14.5,14.5c-0.1,0.1-0.3,0.2-0.5,0.2 s-0.4-0.1-0.5-0.2l0,0c-0.1-0.1-0.2-0.3-0.2-0.5s0.1-0.4,0.2-0.5l0,0c0.1-0.1,0.3-0.2,0.5-0.2s0.4,0.1,0.5,0.2 c0.1,0.1,0.2,0.3,0.2,0.5C14.7,14.3,14.6,14.4,14.5,14.5z"/>
                        <polygon class="secondary-color" points="9.5,16.3 15.3,8.4 14.4,7.7 8.7,15.5"/>
                        <path class="secondary-color" d="M8.6,11.3c0.4,0.4,0.8,0.5,1.3,0.5c0.5,0,0.9-0.2,1.3-0.5c0.4-0.4,0.5-0.8,0.5-1.3c0-0.5-0.2-1-0.5-1.3 c-0.4-0.4-0.8-0.5-1.3-0.5c-0.5,0-1,0.2-1.3,0.5C8.2,9,8.1,9.4,8.1,9.9C8,10.5,8.2,10.9,8.6,11.3z M9.4,9.4L9.4,9.4 c0.1-0.1,0.3-0.2,0.5-0.2c0.2,0,0.4,0.1,0.5,0.2c0.1,0.1,0.2,0.3,0.2,0.5c0,0.2-0.1,0.4-0.2,0.5c-0.1,0.1-0.3,0.2-0.5,0.2 c-0.2,0-0.4-0.1-0.5-0.2l0,0c-0.1-0.1-0.2-0.3-0.2-0.5C9.2,9.7,9.3,9.6,9.4,9.4z"/>
                    </svg>
                    <span>{{ votes.vote_down.length }}</span>
                </div>
                <div :id="`lit`+post.id" class="post-footer__reactions--item" @click="disable_like ? '': storeLike(lit.like)">
                    <svg class="reaction" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                        <path class="primary-color__true" d="M12,23c-4.4,0-8-3.5-8-7.7c0-1.8,0.7-3.1,1.4-4.6C5.8,9.9,6.3,9.1,6.7,8l0.4-1.1c0.6,0.1,0.4,0.1,1,0.2L8,8.3 c-0.1,1,0,2,0.5,3c0.2,0.4,0.4,0.7,0.7,1c-0.1-1.6,0.1-3.1,0.5-4.5c0.4-1.5,1.1-2.9,2.1-4.1c1.2-1.5,2.6-2.5,3.2-2.6L16.7,1 l-1.2,1.3c-0.5,0.6-0.8,1.3-0.8,2.1c0,1.5,1,2.6,2.1,3.8c0.7,0.8,1.5,1.7,2.2,2.8c0.7,1.3,1.1,2.7,1.1,4.2C20,19.5,16.4,23,12,23z M6.9,10.8c-0.1,0.2-0.2,0.3-0.3,0.5c-0.7,1.4-1.3,2.4-1.3,4c0,3.5,3,6.4,6.7,6.4c3.7,0,6.7-2.9,6.7-6.4c0-3-1.5-4.6-2.9-6.2 c-1.2-1.4-2.4-2.7-2.4-4.7c0-0.2,0-0.3,0-0.5c-0.4,0.4-0.8,0.9-1.1,1.5c-1.1,1.6-2.2,4.4-1.6,8.2l0.2,1.1l-1.1-0.4 c-1-0.4-1.9-1.3-2.5-2.5C7.1,11.5,7,11.2,6.9,10.8z"/>
                        <path class="primary-color__false" d="M19,11.1c-0.6-1-1.4-2-2.2-2.8c-1.1-1.2-2.1-2.3-2.1-3.8c0-0.8,0.3-1.5,0.8-2.1L16.7,1l-1.8,0.2 c-0.6,0.1-2,1.1-3.1,2.6C10.9,5,10.1,6.4,9.7,7.9s-0.6,3-0.5,4.5c-0.3-0.3-0.5-0.7-0.7-1c-0.4-0.9-0.6-2-0.5-3l0.2-1.2L7.1,7 L6.7,8c-0.3,1-0.8,1.9-1.2,2.8c-0.8,1.4-1.4,3-1.5,4.6c0,4.2,3.5,7.7,8,7.7s8-3.4,8-7.7C20,13.8,19.6,12.3,19,11.1z"/>
                    </svg>

                    <span>{{ post.likes ? post.likes.length : 0 }}</span>
                </div>
                <div class="post-footer__reactions--item" @click="$parent.view_comment = !$parent.view_comment">
                    <svg class="comment" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                        <path class="primary-color" d="M18.4,3.1H5.5C3,3.1,1,5.1,1,7.6v6.9c0,2,1.3,3.6,3.2,4.2l2.2,2.2c0.1,0.1,0.3,0.2,0.5,0.2 c0.2,0,0.3-0.1,0.5-0.2l2-2h9.2c2.5,0,4.5-2,4.5-4.4V7.6C22.9,5.1,20.9,3.1,18.4,3.1z M21.6,14.4c0,1.8-1.4,3.1-3.2,3.1H9 c-0.2,0-0.3,0.1-0.5,0.2l-1.7,1.7L5,17.6c-0.1-0.1-0.2-0.1-0.3-0.2c-1.4-0.4-2.4-1.6-2.4-3V7.5c0-1.8,1.4-3.1,3.2-3.1h12.9 c1.8,0,3.2,1.4,3.2,3.1V14.4z"/>
                        <path class="primary-color" d="M16,9.1H7.9c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6H16c0.4,0,0.6-0.3,0.6-0.6C16.6,9.4,16.3,9.1,16,9.1 z"/>
                        <path class="primary-color" d="M16,11.4H7.9c-0.4,0-0.6,0.3-0.6,0.6c0,0.3,0.3,0.6,0.6,0.6H16c0.4,0,0.6-0.3,0.6-0.6 C16.6,11.7,16.3,11.4,16,11.4z"/>
                        <path class="secondary-color" d="M18.4,3H5.5C3,3,1,5.1,1,7.5v6.9c0,2,1.3,3.6,3.2,4.2l2.2,2.2C6.5,20.9,6.7,21,6.9,21c0.2,0,0.3-0.1,0.5-0.2 l2-2h9.2c2.5,0,4.5-2,4.5-4.4V7.5C22.9,5.1,20.9,3,18.4,3z M7.3,12c0-0.4,0.3-0.6,0.6-0.6H16c0.4,0,0.6,0.3,0.6,0.6 s-0.3,0.6-0.6,0.6H7.9C7.6,12.6,7.3,12.3,7.3,12z M16,10.4H7.9c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H16 c0.4,0,0.6,0.3,0.6,0.6C16.6,10.1,16.3,10.4,16,10.4z"/>
                    </svg>
                    {{ post.comments.length }}
                </div>
                <div class="post-footer__reactions--item" @click="showModalSharePost">
                    <svg class="comment" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                        <path class="primary-color" d="M22.2,10.3l-8.8-8.8C13.1,1.2,12.7,1,12.3,1c-0.5,0-1.2,0.4-1.2,1.5v5.4C8.5,8.1,6,9.2,4.1,11.1 C2.1,13.2,1,16,1,18.9c0,1.3,0.2,2.5,0.6,3.7C1.7,22.8,2,23,2.2,23c0.3,0,0.5-0.2,0.6-0.4c1.3-3.6,4.6-6.1,8.4-6.4v5.3 c0,1.1,0.6,1.5,1.2,1.5c0.4,0,0.8-0.2,1.2-0.6l8.8-8.8c0.4-0.4,0.7-1,0.7-1.7C22.9,11.4,22.7,10.8,22.2,10.3z M21.3,12.8l-8.8,8.8 l-0.1,0.1v-0.1v-6c0-0.2-0.1-0.3-0.2-0.5c-0.1-0.1-0.3-0.2-0.5-0.2l0,0c-2.3,0-4.5,0.8-6.3,2.1c-1.3,0.9-2.4,2.1-3.1,3.5 c-0.1-0.5-0.1-1-0.1-1.5c0-5.3,4.3-9.7,9.6-9.7c0.4,0,0.6-0.3,0.6-0.6v-6c0-0.1,0-0.1,0-0.1l0.1,0.1l8.8,8.8 c0.2,0.2,0.3,0.5,0.3,0.8C21.6,12.3,21.5,12.6,21.3,12.8z"/>
                        <path class="secondary-color" d="M22.2,10.3l-8.8-8.8C13.1,1.2,12.7,1,12.3,1c-0.5,0-1.2,0.4-1.2,1.5v5.4C8.5,8.1,6,9.2,4.1,11.1 C2.1,13.2,1,16,1,18.9c0,1.3,0.2,2.5,0.6,3.7C1.7,22.8,2,23,2.2,23c0.3,0,0.5-0.2,0.6-0.4c1.3-3.6,4.6-6.1,8.4-6.4v5.3 c0,1.1,0.6,1.5,1.2,1.5l0,0c0.4,0,0.8-0.2,1.2-0.6l8.8-8.8c0.4-0.4,0.7-1,0.7-1.7C22.9,11.4,22.7,10.8,22.2,10.3z"/>
                    </svg>
                    <span>{{post.shares.length}}</span>
                </div>
                <div class="post-footer__reactions--item" @click="showModalSupport(post.resource_type)" v-if="post.allow_download">
                    <svg class="comment" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve">
                        <path class="primary-color" d="M1,12c0,6.1,4.9,11,11,11c6.1,0,11-4.9,11-11c0-6.1-4.9-11-11-11C5.9,1,1,5.9,1,12z M21.5,12 c0,5.3-4.3,9.5-9.5,9.5S2.5,17.3,2.5,12S6.7,2.5,12,2.5S21.5,6.7,21.5,12z"/>
                        <path class="primary-color" d="M10,6.8v4.4H7.9c-0.6,0-1,0.7-0.6,1.2l4.1,5.2c0.3,0.4,0.9,0.4,1.2,0l4.1-5.2c0.4-0.5,0-1.2-0.6-1.2H14 V6.8c0-0.4-0.3-0.7-0.7-0.7h-2.6C10.3,6.1,10,6.4,10,6.8z M12.6,7.6v4.4c0,0.4,0.3,0.7,0.7,0.7h1.3L12,16l-2.6-3.3h1.3 c0.4,0,0.7-0.3,0.7-0.7V7.6L12.6,7.6L12.6,7.6z"/>

                        <path class="secondary-color" d="M1,12c0,6.1,4.9,11,11,11c6.1,0,11-4.9,11-11c0-6.1-4.9-11-11-11C5.9,1,1,5.9,1,12z M13.3,6.1 c0.4,0,0.7,0.3,0.7,0.7v4.4h2.1c0.6,0,1,0.7,0.6,1.2l-4.1,5.2c-0.3,0.4-0.9,0.4-1.2,0l-4.1-5.2c-0.4-0.5,0-1.2,0.6-1.2H10V6.8 c0-0.4,0.3-0.7,0.7-0.7L13.3,6.1L13.3,6.1z"/>
                    </svg>
                    <span>0</span>
                <!-- </a> -->
                </div>
            </div>
        </div>
        <!-- post interactions -->
        <comments :post="post" :view_comment="view_comment"  class="post-footer__comments"/>
        <input type="text" :value="`https://www.noisesharks.com/Post/${post.token}`" :id="'myInput'+`${post.token}`" class="position-absolute" style="left: -500px; opacity: 1; transform: scale(0)">
<!--        <div class="backdrop-iframe" @mouseover="storeView()" v-if="post.resource_type !== 'link' && post.resource_type !== 'video' && post.resource_type !== 'audio'"></div>-->

    </section>
</template>

<script>
    import Comments from '../../Comments/Views/Comments'
    import Auth from "../../../helpers/Auth"
    import Video from './Video';
    import Image from "./Image";
    import Audio from "./Audio";
    import Text from "./Text";
    import Link from "./Link";
    import Document from "./Document";
    import Reactions from "./Reactions";
    import StripeKeys from "../../../helpers/StripeKeys";

    export default {
        name: "index",
        props:['post','user', 'index'],
        components:{
            'post-text': Text,
            'post-video': Video,
            'post-document': Document,
            'post-image': Image,
            'post-audio': Audio,
            'post-reactions': Reactions,
            'post-link' : Link,
            Comments,
        },
        data(){
            return {
                disable_like: false,
                disable_vote_up: false,
                disable_vote_down: false,
                disable_follow: false,
                disable_support: false,
                disable_reward: false,
                auth: Auth.state,
                menuPlaylist: false,
                view_comment: this.post.comments.length > 2 ? false : true,
                view_post: true,
                url : ``,
                lit:{
                    like: 'like',
                },
                vote_type_up: 'vote_up',
                vote_type_down: 'vote_down',
                vote:{
                    type_vote : ''
                },
                votes:{
                    vote_up:[],
                    vote_down:[]
                },
                link: '',
                view: 0,
                user_auth_is_privacy: false,
                is_activity_panel: false,
                edit: false,
                ready_view: false
            }
        },
        mounted(){
            this.post.privacy === "Everyone"  ? this.user_auth_is_privacy = true : ''
            Auth.initialize()
            this.getReactions()
            Auth.state.username ? this.getPrivacy() :   (this.post.privacy === 'Followers' ? this.showAlertPrivacy() : '')

        },
        destroyed() {
            this.getReactions()
            this.$forceUpdate()
        },
        computed: {
            resource_extension() {
                if (this.post.resource_type === 'docs'){
                    let extension = this.post.resource.split(".")
                    return _.last(extension)
                }else{ return 'not-document' }
            },
            link_is_youtube(){
                if(this.post.resource_type === 'link') return this.post.domain === 'www.youtube.com'
                return true
            },
        },
        methods:{
            showAlertPrivacy(){
                if(window.location.href.match(`${window.location.origin}/Post/${this.post.token}`)){
                    swal({
                        title: 'Warning',
                        text: 'You must be a follower of this user to view this post.',
                        className: 'swal-alert',
                        buttons: [false,'Ok'],
                        dangerMode: true,
                        icon: 'warning'
                    });
                    $('.swal-footer').addClass('text-center')
                    this.view_post = false;
                    this.user_auth_is_privacy = false;

                }else{
                    this.user_auth_is_privacy = false;
                    this.view_post = false;
                }
            },
            getReactions(){
                this.getLike()
                this.getVote()
            },
            getPrivacy(){
                if(this.post.user.username === Auth.state.username)
                {
                    this.user_auth_is_privacy = true
                }
                else
                {
                    if(this.post.privacy === 'Everyone'){
                        this.user_auth_is_privacy = true
                    }else if(this.post.privacy === 'Followers'){
                        let self = this

                        if(self.post.user.followers.length <= 0 ) {
                            this.view_post = false
                        }else{
                            if(_.findIndex(self.post.user.followers, function(o) {return o.user.username === Auth.state.username}) !== -1){
                                self.user_auth_is_privacy = true;
                                this.view_post = true
                            }else{
                                this.view_post = false
                                self.disable_like = false
                                self.disable_vote_up = false
                                self.disable_vote_down = false
                                self.disable_follow = false
                                self.disable_support = false
                                self.disable_reward = false
                                self.view_post = false
                            }
                        }
                    }else{
                        _.each(this.post.user.supports, support =>{
                            if(support.user.username === Auth.state.username){
                                this.validSubscription(support)
                            }
                        })
                    }
                }
            },
            async validSubscription(support){
                await axios.post(`/Valid/Subscription/${Auth.state.username}/${support.tier_id}`).then(res=>{
                    if(res.data.valid){
                        this.user_auth_is_privacy = true
                        this.$root.current_plan = support.tier_id
                    }else{
                        this.disable_like = false;this.disable_vote_up = false; this.disable_vote_down = false; this.disable_follow = false; this.disable_support = false; this.disable_reward = false
                    }
                }).catch(err=>{Auth.keepLogged(err.response.status)})
            },
            // methods show
            showModalSupport(type = this.post.resource_type){
                if(this.post.privacy === 'Followers'){
                    if(Auth.state.username){
                        this.$refs.reactions.storeFollow(this.$refs.reactions.follow_type)
                    }else{
                        $('#ModalLogin').modal('show')
                    }
                }else if(this.post.privacy !== 'Everyone'){
                    if (!this.user_auth_is_privacy){
                        this.$parent.post = this.post
                        $('#modalSupport').modal('show')
                    }else{
                        this.$parent.post = this.post
                        $('#modalSupport').modal('show')
                        setTimeout(function(){window.open(this.post.resource, '_blank')},1000)
                    }
                }else{
                    if(type === 'docs') {
                        window.open(this.post.resource, '_blank')
                    }else{
                        this.$parent.post = this.post
                        $('#modalSupport').modal('show')
                    }
                }
            },
            showModalReward(){
                this.$parent.post = this.post
                $('#modalReward').modal('show')
            },
            showModalRegister(){
                $('#ModalRegister').modal('show')
            },
            showModalNewPlaylist(){
                $('#ModalPlaylist').modal('show')
            },
            showModalSharePost(){
                this.$parent.post = this.post
                $('#ModalShare').modal('show')
            },
            showModalEditPrivacy(){
                this.$parent.post = this.post
                $('#ModalEditPrivacy').modal('show')
            },
            //end methods show
            copyLink(){
                let copyText = document.getElementById("myInput"+this.post.token);
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                this.$toasted.show('Link copied successfully!', {
                    position: "bottom-right",
                    duration : 4000,
                    className: "notification",
                    keepOnHover: true,
                    action: {
                        text:'x',
                        onClick:(e, toast) => {
                            toast.goAway(0);
                        }
                    }
                })
            },
            // methods reactions
            async storeView(){
                if(!this.ready_view) {
                    await axios.post(`/View/store/${this.post.id}`).then(res => {
                        res.data.saved ? this.post.views.push(res.data.view) : ''
                        this.ready_view = true
                    }).catch(err =>{})
                }
            },
            getLike(){
                if (this.post.likes) {
                    this.post.likes.map(val => {
                        if (Auth.state.username === val.user.username ) {
                            $(`#lit`+this.post.id+` svg`).addClass('active')
                            this.url = `/${Auth.state.username}/LitLike/unlike/${val.id}`
                            this.lit.like = 'unlike'
                        }
                    })
                }
            },
            async storeLike(type){
                if (Auth.state.token) {
                    await Auth.setSession()
                    let request =''
                    this.disable_like = true
                    this.disable_vote_down = true
                    this.disable_vote_up = true
                    if (type === 'unlike') {
                        request = this.lit
                        if (this.post.likes) {
                            this.post.likes.map(value => {
                                if (Auth.state.username === value.user.username) {
                                    this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                                }
                            })
                        }
                    }
                    if (type === 'like') {
                        request = this.lit
                        this.url =  `/${Auth.state.username}/LitLike/like/Post/${this.post.id}`
                    }
                    await axios.post(this.url, request).then(res =>{
                        if (res.data.like) {
                            this.disable_like = false
                            this.disable_vote_down = false
                            this.disable_vote_up = false
                            this.lit.like = 'unlike'
                            this.post.likes.push(res.data.like)
                            $(`#lit`+this.post.id+` svg`).addClass('active')
                        }
                        if (res.data.unlike) {
                            this.disable_like = false
                            this.disable_vote_down = false
                            this.disable_vote_up = false
                            this.lit.like = 'like'
                            let indice = this.post.likes.indexOf(res.data.like)
                            this.post.likes.splice(indice, 1)
                            $(`#lit`+this.post.id+` svg`).removeClass('active')
                        }
                    }).catch(err=>{Auth.keepLogged(err.response.status)})
                }else{$('#ModalLogin').modal('show')}
            },
            getVote() {
                if (Auth.state.token) {
                    if (this.post.votes) {
                        this.post.votes.map(vote => {
                            if (vote.type_vote === 'vote_up') {
                                this.votes.vote_up.push(vote)
                                if (vote.user.username === Auth.state.username) {

                                    $(`#voteUp` + this.post.id + ` svg`).addClass('active')
                                    $(`#voteDown` + this.post.id + ` svg`).removeClass('active')
                                    this.vote_type_up = 'unvote_up'
                                }
                            }
                            if (vote.type_vote === 'vote_down') {
                                this.votes.vote_down.push(vote)
                                if (vote.user.username === Auth.state.username) {
                                    $(`#voteUp` + this.post.id + ` svg`).removeClass('active')
                                    $(`#voteDown` + this.post.id + ` svg`).addClass('active')
                                    this.vote_type_down = 'unvote_down'
                                }
                            }
                        })
                    }
                }else{
                    this.post.votes.map(vote => {
                        if(vote.type_vote === 'vote_up') this.votes.vote_up.push(vote)
                        if(vote.type_vote === 'vote_down') this.votes.vote_down.push(vote)
                    })
                }
            },
            async storeVoteUp(type){
                if (Auth.state.token) {
                    await Auth.setSession()
                    let request = ''
                    this.disable_vote_up = true
                    this.disable_vote_down = true
                    this.disable_like = true
                    if (type === 'vote_up') {
                        this.vote.type_vote = 'vote_up'
                        request = this.vote
                        this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.post.id}`
                        if (this.votes.vote_down.length > 0) {
                            this.votes.vote_down.map(vote => {
                                if(vote.user.username === Auth.state.username){
                                    axios.post(`/${Auth.state.username}/VotePost/UnVoteDown/${vote.id}`).then(res =>{
                                        if(res.data.unvoteDown){
                                            this.vote_type_down = 'vote_down'
                                            let index = _.findIndex(this.votes.vote_down, function(o) { return o.id === res.data.unvoteDown.id; });
                                            this.votes.vote_down.splice(index, 1)
                                        }
                                    }).catch(err=>{Auth.keepLogged(err.response.status)})
                                }
                            })
                        }
                    }
                    if (type === 'unvote_up') {
                        this.vote.type_vote = 'unvote_up'
                        if (this.votes.vote_up.length > 0) {
                            this.votes.vote_up.map(vote => {
                                this.url =  `/${Auth.state.username}/VotePost/UnVoteUp/${vote.id}`
                            })
                        }
                    }

                    await axios.post(this.url, request).then(res => {
                        if (res.data.voteUp) {
                            this.disable_vote_up = false
                            this.disable_vote_down = false
                            this.disable_like = false
                            this.votes.vote_up.push(res.data.voteUp)
                            this.vote.type_vote = 'unvote_up'
                            this.vote_type_up = 'unvote_up'

                            $(`#voteUp` + this.post.id + ` svg`).addClass('active')
                            $(`#voteDown` + this.post.id + ` svg`).removeClass('active')
                        }
                        if (res.data.unvoteUp) {
                            this.disable_vote_up = false
                            this.disable_vote_down = false
                            this.disable_like = false

                            let index = _.findIndex(this.votes.vote_up, function(o) { return o.id === res.data.unvoteUp.id; });
                            this.votes.vote_up.splice(index, 1)

                            this.vote.type_vote = 'vote_up'
                            this.vote_type_up = 'vote_up'
                            $(`#voteUp` + this.post.id + ` svg`).removeClass('active')
                        }

                    }).catch(err =>{Auth.keepLogged(err.response.status)})
                }else{$('#ModalLogin').modal('show')}
            },
            async storeVoteDown(type){
                if (Auth.state.token) {
                    await Auth.setSession()
                    let request = ''
                    this.disable_vote_down = true
                    this.disable_vote_up = true
                    this.disable_like = true
                    if (type === 'vote_down'){
                        this.vote.type_vote = 'vote_down'
                        request = this.vote
                        this.url =  `/${Auth.state.username}/VotePost/VoteDown/${this.post.id}`
                        if (this.votes.vote_up.length > 0){
                            this.votes.vote_up.map(vote =>{
                                if (Auth.state.username === vote.user.username) {
                                    axios.post(`/${Auth.state.username}/VotePost/UnVoteUp/${vote.id}`).then(res =>{
                                        if(res.data.unvoteUp){
                                            this.vote_type_up = 'vote_up'
                                            let index = _.findIndex(this.votes.vote_up, function(o) { return o.id == res.data.unvoteUp.id; });
                                            this.votes.vote_up.splice(index, 1)
                                        }
                                    }).catch(err =>{Auth.keepLogged(err.response.status)})
                                }
                            })
                        }
                    }
                    if (type === 'unvote_down') {
                        this.vote.type_vote = 'unvote_down'
                        request = this.vote
                        if(this.votes.vote_down.length > 0){
                            this.votes.vote_down.map(vote =>{
                                if(Auth.state.username === vote.user.username){
                                    this.url = `/${Auth.state.username}/VotePost/UnVoteDown/${vote.id}`
                                }
                            })
                        }
                    }
                    await axios.post(this.url, request).then(res => {
                        if (res.data.voteDown) {
                            this.disable_vote_down = false;this.disable_vote_up = false ;this.disable_like = false;
                            this.votes.vote_down.push(res.data.voteDown)
                            this.vote.type_vote = 'unvote_down'; this.vote_type_down = 'unvote_down'
                            $(`#voteUp` + this.post.id + ` svg`).removeClass('active')
                            $(`#voteDown` + this.post.id + ` svg`).addClass('active')
                        }
                        if (res.data.unvoteDown) {
                            this.disable_vote_down = false; this.disable_vote_up = false; this.disable_like = false
                            let index = _.findIndex(this.votes.vote_down, function(o) { return o.id == res.data.unvoteDown.id; });
                            this.votes.vote_down.splice(index, 1)
                            this.vote.type_vote = 'vote_up'; this.vote_type_down = 'vote_down'
                            $(`#voteDown` + this.post.id + ` svg`).removeClass('active')
                        }
                    }).catch(err => {
                        Auth.keepLogged(err.response.status)
                    })
                }else{$('#ModalLogin').modal('show')}
            },
            // end methods reactions
            async update(){
                if(Auth.state.username){
                    await Auth.setSession()
                    await axios.post(`/${Auth.state.username}/Post/update/${this.post.token}`, this.post).then(res =>{
                        if (res.data.updated) {
                            this.edit = false
                            this.$toasted.show('Content has been updated successfully!', {
                                position: "bottom-right",
                                duration : 4000,
                                className: "notification",
                                keepOnHover: true,
                                action: {
                                    text:'x',
                                    onClick:(e, toast) => {
                                        toast.goAway(0);
                                    }
                                }
                            })
                        }
                    }).catch(err => {Auth.keepLogged(err.response.status)})
                }
            },
            async deletePost(){
                if(Auth.state.username) await Auth.setSession()
                swal({
                    title: 'Delete Post?',
                    text: 'You are about to delete this post. Would you like to proceed?',
                    className: 'swal-alert',
                    buttons: ['Cancel','Delete'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete){
                        const self = this
                        axios.delete(`/${Auth.state.username}/Post/delete/${self.post.id}`).then(res =>{
                            if (res.data.deleted) {
                                this.$toasted.show('Content deleted successfully!', {
                                    position: "bottom-right",
                                    duration : 4000,
                                    className: "notification",
                                    keepOnHover: true,
                                    action: {
                                        text:'x',
                                        onClick:(e, toast) => {
                                            toast.goAway(0);
                                        }
                                    }
                                })
                                let index = _.findIndex(this.$parent.posts, function(o) { return o.id === self.post.id; });
                                this.$parent.posts.splice(index, 1)
                            }
                        }).catch(err => {Auth.keepLogged(err.response.status)})
                    }
                })
            },
        },
    }
</script>
