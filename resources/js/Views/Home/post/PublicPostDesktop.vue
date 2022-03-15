<template>
    <div class="public-post mb-0">
        <div class="card shadow public-post__container mb-0">
            <div class="card-header public-post__header">
                <ul class="public-post__header-icons">
                    <input type="file" id="input-file" accept="" class="d-none" v-on:change="saveFile" ref="Input">
                    <li :class="`public-post__header-icon ${(post.resource_type == 'text') ? 'active' : ''}`" @click.prevent="changeTypePost('text')" style="border-bottom-left-radius: 0.8rem;">
                        <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M18.3,22v-0.8c0-0.5-0.4-1-0.9-1c-0.4,0-0.8-0.1-1.2-0.1c-0.8-0.1-1.6-0.2-1.6-1.1l0-15 c3.1,0,4.7,1.7,5.6,4.4c0.1,0.4,0.5,0.7,1,0.7H22c0.6,0,1-0.5,1-1V2c0-0.6-0.5-1-1-1H12h0H2C1.5,1,1,1.5,1,2v6c0,0.6,0.5,1,1,1h0.8 c0.4,0,0.8-0.3,1-0.7c0.9-2.6,2.6-4.4,5.6-4.4l0,15c0,1-0.9,1.1-1.6,1.1c-0.4,0-0.8,0.1-1.2,0.1c-0.5,0-0.9,0.5-0.9,1V22 c0,0.6,0.5,1,1,1H12h0h5.3C17.9,23,18.3,22.5,18.3,22z"/> </svg>
                        <b>Text</b>
                    </li>
                    <li :class="`public-post__header-icon ${(post.resource_type == 'audio') ? 'active' : ''}`" @click.prevent="changeTypePost('audio')">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path class="audio-icon" d="M13.4,21c-0.2,0-0.4-0.2-0.4-0.4l-2.4-9.9l-2.2,5.5c-0.1,0.2-0.2,0.3-0.4,0.3s-0.3-0.1-0.4-0.2l-1.7-3.1H1.5 c-0.3,0-0.5-0.3-0.5-0.6C1,12.3,1.2,12,1.5,12H6c0.2,0,0.3,0.1,0.4,0.3l1.4,2.6L10.2,9c0.1-0.2,0.3-0.3,0.4-0.3 c0.2,0,0.3,0.2,0.4,0.4l2.2,9.1l2.4-14.7c0-0.3,0.2-0.5,0.5-0.5c0.2,0,0.4,0.2,0.4,0.5l0.8,9.3l1.2-0.8c0.1,0,0.1-0.1,0.2-0.1h3.7 c0.3,0,0.5,0.3,0.5,0.6s-0.2,0.6-0.5,0.6H19l-1.7,1.1c-0.1,0.1-0.3,0.1-0.4,0c-0.1-0.1-0.2-0.2-0.2-0.4L16,7.2l-2.2,13.3 C13.8,20.8,13.6,21,13.4,21L13.4,21z"/> </svg>
                        <b>Audio</b>
                    </li>
                    <li :class="`public-post__header-icon ${(post.resource_type == 'video') ? 'active' : ''}`" @click.prevent="changeTypePost('video')">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M22,10.8l-3.1,2v-0.2c0-0.7-0.3-1.4-0.8-1.8c-0.3-0.3-0.6-0.5-0.9-0.6c1.1-0.9,1.7-2.1,1.7-3.6 c0-2.5-2.1-4.7-4.8-4.7c-1.8,0-3.3,1-4.1,2.3C9.1,3,7.6,2,5.8,2C3.1,2,1,4,1,6.7c0,1.5,0.7,2.7,1.7,3.6c-0.3,0.1-0.7,0.3-0.9,0.6 C1.3,11.3,1,12,1,12.7v6.7C1,20.8,2.2,22,3.7,22h12.5c1.5,0,2.7-1.2,2.7-2.6v-0.2l3.1,2c0.4,0.3,1,0,1-0.5v-9.4 C23,10.8,22.4,10.5,22,10.8z M9.9,9c0.2,0.4,0.5,0.8,0.9,1.1H9.1C9.4,9.8,9.7,9.4,9.9,9z"/> </svg>
                        <b>Video</b>
                    </li>
                    <li :class="`public-post__header-icon ${(post.resource_type == 'image') ? 'active' : ''}`" @click.prevent="changeTypePost('image')">
                        <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M20.5,1h-17C2.1,1,1,2.2,1,3.7v16.7C1,21.8,2.1,23,3.5,23h17c1.4,0,2.5-1.2,2.5-2.7V3.7 C23,2.2,21.9,1,20.5,1z M15.2,4.9c1.3,0,2.4,1.1,2.4,2.6s-1.1,2.6-2.4,2.6c-1.3,0-2.4-1.1-2.4-2.6S13.9,4.9,15.2,4.9z M19.7,20.5 H12H4.6c-0.7,0-1-0.5-0.7-1.1l4.1-8.7c0.3-0.6,0.9-0.7,1.3-0.1l4.1,5.8c0.4,0.6,1.1,0.6,1.6,0.1l1-1.1c0.5-0.5,1.2-0.4,1.5,0.1 l2.6,4C20.6,20.1,20.4,20.5,19.7,20.5z"/> </svg>
                        <b>Image</b>
                    </li>
                    <li :class="`public-post__header-icon ${(post.resource_type == 'docs') ? 'active' : ''}`" @click.prevent="changeTypePost('docs')">
                        <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M20,6.8c0-0.1-0.1-0.1-0.1-0.1l-5.3-5.5l-0.1-0.1c-0.1,0-0.1,0-0.2,0H5.8C4.8,1.1,4,1.9,4,2.9v18.4 c0,1,0.8,1.8,1.8,1.8h12.4c1,0,1.8-0.8,1.8-1.8V7C20,6.9,20,6.8,20,6.8z M16,17.5H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2 C16.7,17,16.4,17.5,16,17.5z M16,13.8H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2C16.7,13.3,16.4,13.8,16,13.8z M16,10.2H7.8 C7.3,9.8,7.6,9.3,8,9.3h8.2C16.7,9.7,16.4,10.2,16,10.2z M15.1,6.5c-0.2,0-0.4-0.2-0.4-0.5V3.5c0-0.3,0.4-0.5,0.6-0.2l2.6,2.7 c0.2,0.2,0.1,0.6-0.3,0.6H15.1z"/> </svg>
                        <b>File</b>
                    </li>
                    <li :class="`public-post__header-icon ${(post.resource_type == 'link') ? 'active' : ''}`" @click.prevent="changeTypePost('link')">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.1,4.8L19.3,2c-1.2-1.3-3.3-1.3-4.5,0l-3.2,3c-1.3,1.2-1.3,3.3,0,4.5l1.8-1.8c-0.2-0.6,0-1.2,0.5-1.6l2-2 c0.6-0.6,1.6-0.6,2.3,0l1.7,1.7c0.6,0.6,0.6,1.6,0,2.3l-2,2c-0.4,0.4-1.1,0.6-1.6,0.5l-1.7,1.8c1.2,1.3,3.3,1.3,4.5,0l3.1-3.1 C23.3,8.1,23.3,6.1,22.1,4.8z"/> <path d="M10.6,16.2c0.1,0.5-0.1,1.3-0.5,1.7l-1.9,1.9c-0.6,0.6-1.7,0.6-2.3,0L4.2,18c-0.6-0.6-0.6-1.7,0-2.3l1.9-1.9 c0.5-0.4,1.1-0.7,1.7-0.5l1.8-1.8c-1.3-1.3-3.3-1.3-4.6,0l-3,3c-1.3,1.3-1.3,3.3,0,4.6L4.8,22c1.3,1.3,3.3,1.3,4.6,0l3-3 c1.3-1.3,1.3-3.3,0-4.6L10.6,16.2z"/> <path d="M8.7,15.4c0.4,0.4,1.1,0.4,1.5,0l5.1-5.2c0.4-0.4,0.4-1.1,0-1.6c-0.4-0.4-1.1-0.4-1.5,0l-5.1,5.2 C8.3,14.2,8.3,14.9,8.7,15.4z"/> </svg>
                        <b>Link</b>
                    </li>
                </ul>
                <ul class="public-post__header-icons">
                    <li class="public-post__header-icon" @click.prevent="changeTypePost('go live')">
                        <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="1.3rem"><path d="M21.1,7.3h-1.3c-0.4-1.1-1.1-2.1-1.9-2.9c-1.3-1.3-3-2.1-4.7-2.4c-2.9-0.4-5.7,0.8-7.6,3.1 C5,5.8,4.6,6.5,4.3,7.3H2.9c-1,0-1.9,0.9-1.9,2V12c0,1.1,0.9,2,1.9,2h2.6l-0.3-0.9C4.5,10.6,4.9,8,6.5,6s4-2.9,6.4-2.6 c3.1,0.4,5.5,2.9,6,6.1c0.3,2.1-0.2,4.3-1.6,6C16,17.1,14.1,18,12,18c-1.1,0-1.9,0.9-1.9,2c0,1.1,0.9,2,1.9,2c1.1,0,1.9-0.9,1.9-2 v-0.9c1.7-0.4,3.3-1.4,4.4-2.8c0.6-0.7,1-1.5,1.4-2.3H21c1.1,0,1.9-0.9,1.9-2V9.3C23,8.2,22.1,7.3,21.1,7.3z M12.6,20 c0,0.4-0.3,0.7-0.6,0.7c-0.3,0-0.6-0.3-0.6-0.7c0-0.4,0.3-0.7,0.7-0.7c0.2,0,0.4,0,0.6,0L12.6,20L12.6,20z"/> <path d="M12,4.7c-3.2,0-5.8,2.7-5.8,6c0,1.3,0.9,3,0.9,3c0.2,0.4,0.2,0.9,0,1.2c-0.2,0.3-0.9,0.8-0.9,1.1 c0,0.3,0.3,0.6,0.8,0.6h4.3c0.4,0,1.1-0.1,1.4-0.3c0,0,5.1-2.4,5.1-5.7S15.2,4.7,12,4.7z M10.1,10.6c0,0.4-0.3,0.7-0.6,0.7 c-0.4,0-0.7-0.3-0.7-0.7S9.1,10,9.5,10C9.8,10,10.1,10.3,10.1,10.6z M12.6,10.6c0,0.4-0.3,0.7-0.6,0.7c-0.4,0-0.7-0.3-0.7-0.7 S11.6,10,12,10C12.3,10,12.6,10.3,12.6,10.6z M15.2,10.6c0,0.4-0.3,0.7-0.7,0.7s-0.6-0.3-0.6-0.7s0.3-0.6,0.6-0.6 C14.9,10,15.2,10.3,15.2,10.6z"/></svg>
                        <b>GO LIVE <span class="text-danger ml-1">•</span></b>
                    </li>
                </ul>
            </div>
            <div class="card-body public-post__content p-0">
                <div :class="(post.resource_type == 'video')  ? '' : 'p-3'">
                    <component-text  ref="Text"  :class="(post.resource_type === 'text') ?  'public-post__content--text' : 'd-none'" ></component-text>
                    <component-audio ref="Audio" :file="fileInput" :class="(post.resource_type === 'audio') ? 'public-post__content--audio' : 'd-none'"></component-audio>
                    <component-video ref="Video" :file="fileInput" :class="(post.resource_type === 'video') ? 'public-post__content--video' : 'd-none'"></component-video>
                    <component-image ref="Image" :file="fileInput" :class="(post.resource_type === 'image') ? 'public-post__content--image' : 'd-none'"></component-image>
                    <component-file  ref="File"  :file="fileInput" :class="(post.resource_type === 'docs') ?  'public-post__content--file' : 'd-none'"></component-file>
                    <component-link  ref="Link"  :file="fileInput" :class="(post.resource_type === 'link') ?  'public-post__content--link' : 'd-none'"></component-link>
                </div>
                <hr v-if="editPost && post.resource_type != 'text' && post.resource_type != 'video'">
                <div :class="`mx-3 animate__animated ${editPost ? 'animate__fadeInUp' : 'd-none'}`" v-if="post.resource_type !== 'text' && post.resource_type !== 'video'">
                    <div class="text-center mb-2">
                        <b>Write Caption (Optional):</b>
                    </div>
                    <div class="content-checkbox" v-if="fileInput.resource != null" >
                        <div>
                            <label class="check-button">
                                <input type="checkbox"  v-on:change="toggleSlow('replace_caption_content')" v-model="replace_caption">
                                <span><b class="ml-1">Replace Caption with Title & Discription (YouTube Style)</b></span>
                            </label>
                        </div>
                    </div>
                    <div id="replace_caption_content" class="mb-2" v-if="replace_caption">
                        <input type="text" class="form-control " v-model="post.replace_caption" placeholder="Add title..">
                    </div>
                    <textarea class="form-control mb-3 px-3" style="background-color: #252525;border-radius: 30px;" rows="5" placeholder="Add Some value to the music industry..." id="textarea" v-model="post.description"></textarea>
                    <div class="checkbox" v-if="post.resource_type === 'image' || post.resource_type === 'docs'">
                        <label class="check-button mb-3">
                            <input type="checkbox" name="" id="allow_download" class="m-2"  v-model="post.allow_download">
                            <span><b class="ml-1">Allow Download</b></span>
                        </label>
                    </div>
                </div>
                <hr v-if="editPost && post.resource_type != 'text'">
                <!-- filtros -->
                <div :class="`mx-3 mb-3 ${(editPost) ? '' : 'd-none'}`"> <!--   ${}  -->
                    <div class="filters row">
                        <div class="col-12 col-xl-7 d-flex align-items-center flex-wrap">
                            <b :class="`white-space--nowrap mr-2 animate__animated  ${(editPost) ? 'animate__fadeInUp' : ''}`">Select Filters:</b>
                            <div class="dropdown mr-2 dropdown-sm">
                                <div :class="`dropdown-btn animate__animated  ${post.genre ? '' : 'dropdown-required'} ${(editPost) ? 'animate__fadeInUp' : ''}`" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b> {{ post.genre ? (post.genre.length >= 10) ? post.genre.substring(0, 10) + '...' : post.genre : 'Select Genre' }} </b>
                                    <div class="icon">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="ml-1"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdown">
                                    <div class="dropdown-item" @click="post.genre = 'Pop'">Pop</div>
                                    <div class="dropdown-item" @click="post.genre = 'Rap & Hip-Hop'">Rap & Hip-Hop</div>
                                    <div class="dropdown-item" @click="post.genre = 'EDM'">EDM</div>
                                    <div class="dropdown-item" @click="post.genre = 'Rock & Metal'">Rock & Metal</div>
                                    <div class="dropdown-item" @click="post.genre = 'Jazz & Blues'">Jazz & Blues</div>
                                    <div class="dropdown-item" @click="post.genre = 'Classical'">Classical</div>
                                    <div class="dropdown-item" @click="post.genre = 'Funk'">Funk</div>
                                    <div class="dropdown-item" @click="post.genre = 'World'">World</div>
                                    <div class="dropdown-item" @click="post.genre = 'Latin'">Latin</div>
                                    <div class="dropdown-item" @click="post.genre = 'LoFi'">LoFi</div>
                                    <div class="dropdown-item" @click="post.genre = 'Not Specific'">Not Specific</div>
                                </div>
                            </div>
                            <div class="dropdown mr-2 dropdown-sm">
                                <div :class="`dropdown-btn ${post.category ? '' : 'dropdown-required'} animate__animated ${(editPost) ? 'animate__fadeInUp' : ''}`" id="dropdownCategory"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b> {{ post.category ? (post.category.length >= 10) ? post.category.substring(0, 10) + '...' : post.category : 'Select Topic' }} </b>
                                    <div class="icon">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="ml-1"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                                    <div class="dropdown-item" @click="post.category = 'Talking Music!'">Talking Music</div>
                                    <div class="dropdown-item" @click="post.category = 'Performances and Jams'">Performances & Jams</div>
                                    <div class="dropdown-item" @click="post.category = 'Production & Engineering'">Production & Engineering</div>
                                    <div class="dropdown-item" @click="post.category = 'Lessons and Tips'">Lessons & Tips</div>
                                    <div class="dropdown-item" @click="post.category = 'Vlogs'">Vlogs</div>
                                    <div class="dropdown-item" @click="post.category = 'Instruments/Gear'">Instruments & Gear</div>
                                    <div class="dropdown-item" @click="post.category = 'Music Podcasts'">Music Podcasts</div>
                                    <div class="dropdown-item" @click="post.category = 'Releases'">Releases</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-5 d-flex align-items-center justify-content-xl-end">
                            <b :class="`white-space--nowrap mr-2 animate__animated ${(editPost) ? 'animate__fadeInUp' : ''}`">Select Exclusivity:</b>
                            <div :class="`dropdown dropdown-sm`">
                                <div class="dropdown-btn" id="dropdownEveryone"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b> {{ post.privacy ? post.privacy : 'Everyone' }} </b>
                                    <div class="icon">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="ml-1"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu " aria-labelledby="dropdownEveryone">
                                    <div class="dropdown-item" @click="post.privacy = 'Everyone'">Everyone</div>
                                    <div class="dropdown-item" @click="post.privacy = 'Followers'">Followers Only</div>
                                    <div v-if="auth.username && user.channel_information">
                                        <div class="dropdown-item" v-for="(tier, index) in user.channel_information.tiers" :key="index" @click="post.privacy = tier.name">{{ tier.name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr v-if="editPost">
                <div :class="` mb-3 mx-3 animate__animated ${(editPost) ? 'animate__fadeInUp ' : 'd-none'} `">
                    <div class="public-post__content--share-redes">
                        <div class="share-redes">
                            <span class="share-redes--title">Also Post On:</span>
                            <div class="share-redes__content">
                                <div :class="`share-redes__icon ${facebook_active ? 'active' : ''}`" @click="facebook_active = (!facebook_active)" facebook>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M9.9,23h2.6c0.6,0,1.1-0.5,1.1-1.1V13c0-0.6,0.5-1.1,1.1-1.1h1.2c0.6,0,1-0.4,1.1-1c0.1-0.4,0.1-0.9,0.2-1.4 c0.1-0.7-0.4-1.3-1.1-1.3h-1.2c-0.6,0-1.1-0.5-1.1-1.1V5.7c0.1-0.5,0.5-0.9,1.1-0.9h1.5c0.6,0,1.1-0.5,1.1-1.1V2.1 C17.5,1.5,17,1,16.4,1h-2.4C8.9,1,9,4.7,9,5.3v1.9c0,0.6-0.5,1.1-1.1,1.1H7.6C7,8.3,6.5,8.8,6.5,9.4v1.3c0,0.6,0.5,1.1,1.1,1.1h0 c0.6,0,1.1,0.5,1.1,1.1v8.8C8.8,22.5,9.3,23,9.9,23z"/> </svg>
                                </div>
                                <div :class="`share-redes__icon ${twitter_active ? 'active' : ''}`" @click="twitter_active = (!twitter_active)" twitter>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.4,5.2c-0.1,0-0.2,0.1-0.3,0.1c-0.7,0.2-0.7-0.1-0.2-0.6C22,4.5,22.2,4.3,22.4,4c0.4-0.6,0-0.8-0.6-0.6 c-0.2,0.1-0.5,0.2-0.7,0.3c-0.6,0.2-1.6-0.1-2.1-0.5c-0.7-0.5-1.6-0.7-2.5-0.7c-1.3,0-2.4,0.5-3.3,1.4c-0.9,0.9-1.4,2.1-1.4,3.4 c0,0.2,0,0.4,0,0.6c0,0.3-0.5,0.5-1.1,0.4C9.2,8.1,7.8,7.6,6.5,6.9C5.2,6.2,4,5.4,3,4.3C2.5,3.8,1.9,3.9,1.7,4.5 C1.6,4.9,1.5,5.4,1.5,5.8c0,0.8,0.2,1.6,0.6,2.3C2.3,8.4,2.5,8.7,2.8,9c0.4,0.5,0.4,0.8-0.2,0.6c-0.6-0.2-1-0.4-1-0.4s0,0,0,0 c0,1.2,0.4,2.2,1.1,3.1c0.4,0.5,0.9,1,1.5,1.2C4.7,13.8,5,14,4.7,14.1c-0.2,0-0.4,0-0.6,0c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.3,0.5,0.1,1.1C4,15.6,4.4,16,4.8,16.4c0.5,0.4,1,0.6,1.5,0.8c0.7,0.2,0.8,0.5,0.2,0.9c-1.5,0.9-3.1,1.3-4.8,1.3 c-0.2,0-0.4,0-0.6,0c-0.3,0-0.1,0.3,0.5,0.6c1.9,1,3.9,1.5,6.1,1.5c1.7,0,3.2-0.3,4.7-0.8c1.5-0.5,2.7-1.3,3.8-2.2 c1-0.9,1.9-1.9,2.7-3.1c0.8-1.2,1.3-2.4,1.7-3.7c0.4-1.3,0.6-2.6,0.6-3.9c0-0.1,0-0.2,0-0.3c0-0.2,0.4-0.6,0.9-1.1 c0.2-0.2,0.4-0.4,0.6-0.7C23.2,5.2,23,5,22.4,5.2z"/> </svg>
                                </div>
                                <div :class="`share-redes__icon ${reddit_active ? 'active' : ''}`" @click="reddit_active = (!reddit_active)" reddit>
                                    <svg id="Bold" enable-background="new 0 0 24 24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path d="m21.325 9.308c-.758 0-1.425.319-1.916.816-1.805-1.268-4.239-2.084-6.936-2.171l1.401-6.406 4.461 1.016c0 1.108.89 2.013 1.982 2.013 1.113 0 2.008-.929 2.008-2.038s-.889-2.038-2.007-2.038c-.779 0-1.451.477-1.786 1.129l-4.927-1.108c-.248-.067-.491.113-.557.365l-1.538 7.062c-2.676.113-5.084.928-6.895 2.197-.491-.518-1.184-.837-1.942-.837-2.812 0-3.733 3.829-1.158 5.138-.091.405-.132.837-.132 1.268 0 4.301 4.775 7.786 10.638 7.786 5.888 0 10.663-3.485 10.663-7.786 0-.431-.045-.883-.156-1.289 2.523-1.314 1.594-5.115-1.203-5.117zm-15.724 5.41c0-1.129.89-2.038 2.008-2.038 1.092 0 1.983.903 1.983 2.038 0 1.109-.89 2.013-1.983 2.013-1.113.005-2.008-.904-2.008-2.013zm10.839 4.798c-1.841 1.868-7.036 1.868-8.878 0-.203-.18-.203-.498 0-.703.177-.18.491-.18.668 0 1.406 1.463 6.07 1.488 7.537 0 .177-.18.491-.18.668 0 .207.206.207.524.005.703zm-.041-2.781c-1.092 0-1.982-.903-1.982-2.011 0-1.129.89-2.038 1.982-2.038 1.113 0 2.008.903 2.008 2.038-.005 1.103-.895 2.011-2.008 2.011z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr v-if="editPost">
                <div :class="`checkbox mx-3 animate__animated ${(editPost) ? 'animate__fadeInUp ' : 'd-none'} `">
                    <label class="check-button mb-3">
                        <input type="checkbox" id="copyright" class="m-2" v-model="copyright" > <!-- v-model="post.copyright" -->
                        <span><b class="ml-1">I consent that this content is my original work and is not infringing any copyright.</b></span>
                    </label>
                </div>
            </div>
            <div class="card-footer public-post__footer">
                <button  type="button" class="btn" @click="confirmResetData()" v-if="editPost"><b>Cancel</b></button>
                <button :class="`btn btn-red rounded-pill ${ (!editPost) ? 'disabled':'' }`" type="submit" :disabled="!editPost||loading" v-on:click.prevent="store()">
                    <b v-if="!loading">Post</b>
                    <!-- spinner-border spinner-border-sm -->
                    <div class="spinner-border spinner-border-sm text-white" role="status" v-else>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
        <alert-maximum-size></alert-maximum-size>
        <modal-share ref="sharePosting"/>
    </div>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import text from './includes/Text';
    import audio from './includes/Audio';
    import video from './includes/Video';
    import image from './includes/Image';
    import document from './includes/Document';
    import link from "./includes/Link";
    import AlertMaximumSize from "../Components/AlertMaximumSize";
    import Share from "./includes/Share";
    export default {
        components:{
            'component-text'  : text,
            'component-audio' : audio,
            'component-video' : video,
            'component-image' : image,
            'component-file'  : document,
            'component-link'  : link,
            'modal-share'     : Share,
            Auth,
            AlertMaximumSize,
        },
        props:['users'],
        data(){
            return{
                loading: false,
                editPost: false,
                componentActive: null,
                auth : Auth.state,
                fileInput: {},
                replace_caption: false,
                post:{},
                copyright: null, /* Creado como testing */
                facebook_active: false,
                twitter_active: false,
                reddit_active: false,
            }
        },
        computed:{
            user(){
                return this.users;
            }
        },
        mounted(){
            this.resetData()
            this.changeTypePost("text")
            $('.hide-field').slideUp()
        },
        methods:{
            changeTypePost(post){
                if(post == 'go live'){
                    $("#CommingSoonLive").modal('show')
                    return true
                }
                if(this.editPost){
                    swal({
                        title: "Are you sure?",
                        text: "Changes made may not be saved.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if(willDelete) {
                            this.componentActive.reset()
                            this.changeComponentActive(post)
                        }
                    })
                    return true
                }
                this.changeComponentActive(post)
            },
            async changeTypeIfLink(post){
                this.post.resource_type = post
                this.fileInput.resource_type = post
                this.componentActive = this.$refs.Link
                this.editPost = true
            },
            changeComponentActive(post){
                this.resetData()
                this.post.resource_type = post
                this.fileInput.resource_type = post

                switch(post){
                    case 'text':
                        this.componentActive = this.$refs.Text
                        break;
                    case 'audio':
                        this.fileInput.accept =  ".mp3"
                        this.componentActive = this.$refs.Audio
                        break;
                    case 'video':
                        this.fileInput.accept =  "video/*"
                        this.componentActive = this.$refs.Video
                        break;
                    case 'image':
                        this.fileInput.accept =  ".jpg, .png, .jpeg"
                        this.componentActive = this.$refs.Image
                        break;
                    case 'docs':
                        this.fileInput.accept =  ".pdf, .docx, .xlsx, .pptx"
                        this.componentActive = this.$refs.File
                        break;
                    case 'link':
                        this.componentActive = this.$refs.Link
                        break;

                }
                this.editPost = false

                let input_file = $('#input-file')
                input_file.attr('accept', this.fileInput.accept)
                if(this.post.resource_type !== "text" && this.post.resource_type !== "link" ){
                    input_file.click()
                }
            },
            confirmResetData(def = 'text'){
                swal({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.componentActive.reset()
                        this.resetData(def)
                        return false
                    }
                });
            },
            resetData(def = "text"){
                $('.dropdown-required').removeClass('animate__animated animate__flash')
                $('#input-file').val('')
                $('.slide-show').slideUp()
                this.replace_caption = false
                this.editPost = false
                this.fileInput = {
                    accept: '',
                    resource: null,
                    extension: null,
                    name: null,
                }
                this.post = {
                    replace_caption: '',
                    allow_download: false,
                    description: '',
                    resource: null,
                    resource_type: def,
                    genre: '',
                    category: '',
                    privacy: 'Everyone',
                    appearance: '', /* solo funciona en el video */
                    thumbnail: '', /* solo video => /images/default-video.svg*/
                    link: '',
                    domain: '',
                    link_info: {},
                }
                if(this.post.resource_type == "video"){
                    $('#input-file').click()
                }
            },
            changeFileInput(){
                this.componentActive.btnShow = false
                if(this.post.resource_type != "text"){
                    $('#input-file').val('')
                    $('#input-file').click()
                }
            },
            saveFile(event){
                if(event.target.files[0].size > 209715200){
                    $("#AlertMaximumSize").modal('show')
                    return false
                }

                if(event.target.files.length > 0){
                    this.post.resource = event.target.files[0]
                    this.fileInput.name = (event.target.files[0].name.split('.')).shift()
                    this.fileInput.extension = (event.target.files[0].name.split('.')).pop()
                    var input = event.target;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = (e) => {
                            this.editPost = true
                            this.fileInput.resource = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                        if(this.post.resource_type === 'video'){
                            this.fileInput.resource = event.target.files[0]
                            this.componentActive.loadVideo()
                        }

                    }
                }else{
                    // alert('no tiene')
                    // this.refreshInput('input-image')
                }
            },
            async store(){
                if(!this.auth.token){
                    $('#ModalLogin').modal('show')
                    return false

                }else if(this.post.genre === '' || this.post.category === ''){
                    $('.dropdown-required').removeClass('animate__animated animate__flash')

                    swal({
                        text: 'Please select a genre and topic',
                        className: 'swal-alert',
                        buttons: [false, 'Ok'],
                        dangerMode: true,
                    })
                    .then((res) => {
                        $('.dropdown-required').addClass('animate__animated animate__flash')
                    })
                    return false
                }else if(!this.copyright){
                    swal({
                        text: 'You must consent that you´re not infringing any copyright in order for you to publish your content.',
                        className: 'swal-alert',
                        buttons: [false, 'Ok'],
                        dangerMode: true,
                    })
                    return false;
                }
                if(this.loading) { return false} /* evita que se repita el metodo */

                this.loading = true
                await Auth.setSession()

                let imagePost = new FormData();

                if(!this.componentActive.store()){
                    alert('error')
                    return false
                }

                imagePost.append('resource_type', this.post.resource_type)
                imagePost.append('description', this.post.description)
                imagePost.append('genre', this.post.genre)
                imagePost.append('category', this.post.category)
                imagePost.append('privacy', this.post.privacy)

                /* Si tiene Archivo multimedia */
                if (this.post.resource != null && this.post.resource_type !== 'text') {
                    this.post.resource_type !== 'link'
                        ? imagePost.append('resource', this.post.resource, this.post.resource.name)
                        : imagePost.append('resource', this.post.resource)
                    if(this.post.resource_type === 'link'){
                        imagePost.append('link', this.post.link)
                        imagePost.append('domain', this.post.domain)
                        imagePost.append('link_info', JSON.stringify(this.post.link_info))
                        imagePost.append('thumbnail', this.post.thumbnail)
                    }
                    imagePost.append('allow_download', this.post.allow_download)
                    imagePost.append('replace_caption', this.post.replace_caption)
                    imagePost.append('appearance', this.post.appearance)

                    if(this.post.resource_type === 'video'){
                        let video = this.componentActive.video
                        this.post.thumbnail ? imagePost.append('thumbnail', this.post.thumbnail, this.post.thumbnail.name) : imagePost.append('thumbnail', video.thumbnail1, video.thumbnail1.name)
                    }
                }

                // esto se deberia poner en un helper para no tener que modificar datos en dos componentes diferentes //
                let upload_meter = this.$parent.$refs.alertUploadMeter
                // este token se crea para poder cancelar la peticion
                upload_meter.source = axios.CancelToken.source();
                let self = this

                await axios.post(
                    `/${this.auth.username}/Post/store`,
                    imagePost,{
                        cancelToken: upload_meter.source.token,
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress (e) {
                            let progress = Math.round(((e.loaded * 100.0) / e.total) + 10);
                            upload_meter.display = true
                            upload_meter.weight = self.getValuesUploadMeter(e.total)
                            upload_meter.load = self.getValuesUploadMeter(e.loaded)
                            upload_meter.porcentage = progress
                            if(progress === 100){
                                upload_meter.status = 'success'
                            }else{
                                upload_meter.status = 'btn'
                            }
                        }
                    }
                ).then(res =>{
                    if (!res.data.valid){
                        this.loading = false
                        $('#ModalAlert').modal('show')
                        return false
                    }

                    if (!res.data.saved) {
                        this.loading = false
                    }else{
                        if(this.facebook_active || this.twitter_active || this.reddit_active){
                            $('#ModalShared').modal('show')
                            this.$refs.sharePosting.post = res.data.post
                        }
                        this.componentActive.reset()
                        this.resetData()
                        this.loading = false
                        this.$parent.orderPost()
                        this.$parent.$forceUpdate();
                        this.$parent.all_post.unshift(res.data.post)
                        this.$root.$refs.home.$refs.posts.updateComponent()
                        this.users = res.data.user;

                        $('html, body').animate({ scrollTop: 0 }, 'fast');
                        this.$toasted.show('Content Published Successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "notification",
                            keepOnHover: true
                        })

                        if(res.data.credit_first_video){
                            swal('success', "You've earned $5 in credit for uploading your first video", 'success');
                        }

                        if(res.data.credit_post_week){
                            swal('success', "You've earned $1 in credit for uploading your first post of the week", 'success');
                        }

                        if (window.screen.width <= 768) window.location.replace('/')
                        this.changeTypePost('text')

                        upload_meter.status = 'success'
                        setTimeout(function(){
                            upload_meter.display = false
                        },1000)


                    }
                }).catch(err => {
                    if(err.status) {
                        this.loading = false
                        upload_meter.status = 'error'
                        swal({
                            text: 'We had an error uploading the ' + this.post.resource_type + ':(',
                            className: 'swal-alert',
                            buttons: [false, 'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                        Auth.keepLogged(err.response.status)
                    }else{
                        swal('Error','Operation canceled by the user.','error')
                        upload_meter.status = 'error'
                        this.loading = false
                        upload_meter.display = false
                        this.componentActive.reset()
                        setTimeout(this.resetData(), 10000)

                    }
                })
            },
            //esta funcion tambien esta en otro componente duplicado se debe colocar en el helper//
            getValuesUploadMeter(bytes, decimals = 2){
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + '' + sizes[i];
            },
            toggleSlow(item){
                this.post.replace_caption = ''
                $(`#${item}`).addClass('slide-show')
                $(`#${item}`).slideToggle()
            },
        },
    }
</script>
