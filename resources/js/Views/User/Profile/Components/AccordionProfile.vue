<template>
    <div class="container-fluid px-0">
        <form @submit.prevent="save" enctype="multipart/form-data" ref="form_profile_update_information">
            <div class="accordion">
                <div class="card">
                    <div class="card-header" data-target="profileType">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">Profile Type <span class="c-fifth">*</span></button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="profileType" class="card-body">
                        <div>
                            <div class="d-flex justify-content-around flex-wrap">
                                <label class="check-button mb-0 ml-3">
                                    <input type="radio" value="A Person or A Project" class="detected-change" v-model="profile_information.profile_type" required>
                                    <span> <b>Musician/Project/Channel</b></span>
                                </label>
                                <label class="check-button mb-0 ml-3">
                                    <input type="radio" id="aBand" value="A Band" class="detected-change" v-model="profile_information.profile_type"  required>
                                    <span><b>Band/Group/Duet</b></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="title">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">Title <span class="c-fifth">*</span></button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="title" class="card-body"> <!--  data-target="headingOne" -->
                        <div>
                            <div class="row text-justify ">
                                <div class="col text-center select">
<!--
                                    <div class="dropdown mr-2 dropdown">
                                        <div :class="`dropdown-btn  ${profile_information.title ? '' : 'dropdown-required'}`" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <b> {{ profile_information.title ? (profile_information.title.length >= 10) ? profile_information.title.substring(0, 10) + '...' : profile_information.title : 'Select Genre' }} </b>
                                            <div class="icon">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="ml-1"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                            </div>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdown"> -->
                                            <!-- <div class="dropdown-item" @click="profile_information.title = ''"> </div> -->
                                            <!-- <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                            <div class="dropdown-item">asdasds </div>
                                        </div>
                                    </div>-->

                                    <select class="select-form font-weight-bold btn bgn-outline-light detected-change" v-model="profile_information.title">
                                        <option value="Select Title">Select Title</option>
                                        <optgroup  v-if="profile_information.profile_type == 'A Person or A Project'">
                                            <option value="Talking Music Channel">Talking Music Channel</option>
                                            <option value="Gear Channel">Gear Channel</option>
                                            <option value="Instruments Channel">Instruments Channel</option>
                                            <option value="Music Podcast">Music Podcast</option>
                                            <option value="Vlog Channel">Vlog Channel</option>
                                            <option value="Composer">Composer</option>
                                            <option value="Instrument Tutor">Instrument Tutor</option>
                                            <option value="Vocal Coach">Vocal Coach</option>
                                            <option value="Mixing Engineer">Mixing Engineer</option>
                                            <option value="Music Producer">Music Producer</option>
                                            <option value="Mastering Engineer">Mastering Engineer</option>
                                            <option value="Recording Engineer">Recording Engineer</option>
                                            <option value="Audio Engineer">Audio Engineer</option>
                                            <option value="Sound Designer">Sound Designer</option>
                                            <option value="One Person Band">One Person Band</option>
                                            <option value="Rapper">Rapper</option>
                                            <option value="Singer">Singer</option>
                                            <option value="Singer Songwriter">Singer Songwriter</option>
                                            <option value="Guitarist">Guitarist</option>
                                            <option value="Guitar Channel">Guitar Channel</option>
                                            <option value="Drummer">Drummer</option>
                                            <option value="Drum Channel">Drum Channel</option>
                                            <option value="Bassist">Bassist</option>
                                            <option value="Bass Channel">Bass Channel</option>
                                            <option value="Keyboardist">Keyboardist</option>
                                            <option value="Pianist">Pianist</option>
                                            <option value="DJ">DJ</option>
                                            <option value="Beatmaker">Beatmaker</option>
                                            <option value="Music Studio">Music Studio</option>
                                            <option value="Manager">Manager</option>
                                            <option value="A&R">A&R</option>
                                        </optgroup>
                                        <optgroup v-if="profile_information.profile_type == 'A Band'">
                                            <option value="Band">Band</option>
                                            <option value="Duet">Duet</option>
                                            <option value="Orchestra">Orchestra</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="artisticName">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">
                                Channel Name <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="artisticName" class="card-body"> <!--  data-target="headingOne" -->
                        <div >
                            <input type="text" class="form-control mb-3 detected-change" placeholder="Channel Name" v-model="profile_information.artistic_name">
<!--                            <input type="checkbox"> Use channel Name Instead of Personal Name-->
                            <span class="text-white">Adding a channel name will change your display name to the channel name. This means that you will only appear with your channel name in searches and other parts of Noisesharks.</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="aboutYou">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold" data-target="aboutYou"> About You </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="aboutYou" class="card-body"> <!--  data-target="headingOne" -->
                        <div >
                            <textarea class="form-control p-3 detected-change" cols="180" rows="10" placeholder="Write About You..." v-model="profile_information.about_you"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="members">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">
                                Members <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="members" class="card-body"> <!--  data-target="headingOne" -->
                        <div>
                            <div class="mb-4">
                                <h5 class="mr-3 mb-3">Current Members</h5>
                                <div class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill detected-change" v-on:click="addMember('current')">
                                        Add Current Member
                                        <svg class="icon-sm ml-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path  d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17.7,12.7h-5v5c0,0.4-0.3,0.7-0.7,0.7 s-0.7-0.3-0.7-0.7v-5h-5c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h5v-5c0-0.4,0.3-0.7,0.7-0.7s0.7,0.3,0.7,0.7v5h5 c0.4,0,0.7,0.3,0.7,0.7C18.5,12.4,18.1,12.7,17.7,12.7z"/> </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <single-member v-for="(current, index) in current_members" :key="index" :member="current" :index="index" :type="'current'" />
                            </div>
                            <div class="mb-4">
                                <h5 class="mr-3 mb-3">Former Members</h5>
                                <div class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill detected-change" v-on:click="addMember('past')">
                                        Add Former Member
                                        <svg class="icon-sm ml-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path  d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17.7,12.7h-5v5c0,0.4-0.3,0.7-0.7,0.7 s-0.7-0.3-0.7-0.7v-5h-5c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h5v-5c0-0.4,0.3-0.7,0.7-0.7s0.7,0.3,0.7,0.7v5h5 c0.4,0,0.7,0.3,0.7,0.7C18.5,12.4,18.1,12.7,17.7,12.7z"/> </svg>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <single-member  v-for="(past, index) in past_members" :key="index" :member="past" :index="index" :type="'past'" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="releases">
                        <div class="text-center">
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold " >
                                Releases <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="releases" class="card-body">
                        <div class="text-center" >
                            <button type="button" class="btn btn-outline-light rounded-pill mb-3 detected-change" v-on:click="addRelease">
                                Add Release
                                <svg class="icon-sm ml-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path  d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17.7,12.7h-5v5c0,0.4-0.3,0.7-0.7,0.7 s-0.7-0.3-0.7-0.7v-5h-5c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h5v-5c0-0.4,0.3-0.7,0.7-0.7s0.7,0.3,0.7,0.7v5h5 c0.4,0,0.7,0.3,0.7,0.7C18.5,12.4,18.1,12.7,17.7,12.7z"/> </svg>
                            </button>
                            <div >
                                <single-release v-for="(release, index) in releases_information" :key="index" :release="release" :index="index" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header " data-target="workedWith">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">
                                Worked With <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="workedWith" class="card-body">
                        <div>
                            <div class="">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-column justify-content-center align-items-center text-center header-form-search">
                                        <button type="button" class="btn btn-outline-light rounded-pill mb-3" @click="addWork = true" v-if="!addWork">
                                            Add Worked With
                                            <svg class="icon-sm ml-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path  d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17.7,12.7h-5v5c0,0.4-0.3,0.7-0.7,0.7 s-0.7-0.3-0.7-0.7v-5h-5c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h5v-5c0-0.4,0.3-0.7,0.7-0.7s0.7,0.3,0.7,0.7v5h5 c0.4,0,0.7,0.3,0.7,0.7C18.5,12.4,18.1,12.7,17.7,12.7z"/> </svg>
                                        </button>

                                        <div class="form-group m-0" v-else>
                                            <div class="input-group">
                                                <input class="form-control my-2 detected-change"  v-model="addWorkName" @keypress.enter.prevent="addedWork($event)"   autofocus>
                                                <div class="divider-vertical"></div>
                                                <svg class="icon cursor-pointer detected-change" v-on:click.prevent="addedWork($event)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M11.7,18L7,13.2c-0.3-0.3-0.1-0.7,0.3-0.7 h3.2c0.2,0,0.4-0.2,0.4-0.4v-6c0-0.2,0.2-0.4,0.4-0.4h1.6c0.2,0,0.4,0.2,0.4,0.4v6c0,0.2,0.2,0.4,0.4,0.4h3.2 c0.4,0,0.5,0.4,0.3,0.7L12.3,18C12.1,18.2,11.9,18.2,11.7,18z"/> </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row flex-wrap content-text-work">
                                        <span v-for="(work , index) in worked_with" :key="index" @click="deleteWorkWith(work)" class="shadow">
                                            {{work.name}}<i class="fas fa-times cursor-pointer mx-2 py-1" ></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="genre">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">
                                Genre <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="genre" class="card-body">
                        <div>
                            <div class="text-center select">
                                <button type="button" class="btn btn-outline-light rounded-pill mb-3" @click="showModalSelectGenres">Select Genre(s)</button>
                            </div>
                            <div class="text-left d-flex flex-row flex-wrap">
                                <dl class="p-3" v-for="(item , index) in genres_display" :key="index" >
                                    <dt class="text-white font-wight-bold">- {{ item.principal_genre }}</dt>
                                    <dd class="text-white ml-3" v-for="(specific_genre, index) in item.specific_genres" :key="index">- {{specific_genre}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header " data-target="services">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">
                                Services <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="services" class="card-body">
                        <div >
                            <div class="text-center select">
                                <button type="button" class="btn btn-outline-light rounded-pill mb-3" @click="showModalSelectServices">Select Service(s)</button>
                                <div class="text-left d-flex flex-row flex-wrap">
                                    <dl class="p-3" v-for="(item , index) in services_display" :key="index" >
                                        <dt class="text-white font-wight-bold">- {{ item.principal_service }}</dt>
                                        <dd class="text-white ml-3" v-for="(specific_service, index) in item.specific_services" :key="index">- {{specific_service}}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header " data-target="socialMedia">
                        <div>
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold"  >
                                Social Media  <small>(If Applicable)</small>
                            </button>
                            <svg  class="icon-m float-right caret"  version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="socialMedia" class="card-body">
                        <div >
                            <div class="form-group row">
                                <label class="col-sm-2">Youtube</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Youtube">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Twitch</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Twitch">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Instagram</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Instagram">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Facebook</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Facebook">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Twitter</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Twitter">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">TikTok</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.TikTok">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">LinkedIn</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.LinkedIn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">SnapChat</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.SnapChat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">SoundCloud</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.SoundCloud">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Bandcamp</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Bandcamp" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Spotify</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control detected-change"  placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Spotify" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center text-center m-5 btn-save" style="transition: all linear .3s">
                <button type="button" class="btn rounded-pill bg-black text-white font-weight-bold" @click="reload">Cancel</button>
                <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="button" v-if="!disable" @click="save()">Save</button>
                <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        <modal-select-genres />
        <modal-select-services />
        <modal-change-release />
    </div>
</template>

<script>
    import ModalSelectGenres from "./Includes/ModalSelectGenres";
    import ModalSelectServices from "./Includes/ModalSelectServices";
    import ModalChangeRelease from "./Includes/ModalChangeRelease";
    import SingleRelease from "./Releases/SingleRelease";
    import SingleMember from "./Members/SingleMember";
    import Auth from "../../../../helpers/Auth";
    import Functionality from "../../../../helpers/Functionality";
    import Genres from "../../../../helpers/Genres";
    export default {
        props:['user'],
        components:{
            ModalChangeRelease,
            ModalSelectGenres,
            ModalSelectServices,
            SingleRelease,
            SingleMember,
        },
        data(){
            return {
                detectedChange: false,
                disable: false,
                url: `/${this.user.username}/Save/Profile`,
                imageReleases:'/images/profile/default.png',
                imageData: '/images/profile/default.png',
                genres_display:[],
                services_display:[],
                profile_information:{
                    profile_type: '',
                    title: 'Select Title',
                    artistic_name: '',
                    about_you: '',
                    genres: [],
                    services: [],
                    social_media: {
                        Youtube: '',
                        Twitch: '',
                        Instagram: '',
                        Facebook: '',
                        Twitter: '',
                        TikTok: '',
                        LinkedIn: '',
                        SnapChat: '',
                        SoundCloud: '',
                        Bandcamp: '',
                        Spotify: '',
                    }
                },
                current_members:[],
                past_members:[],
                releases_information: [],
                addWork: false,
                addWorkName: '',
                worked_with:[]
            }
        },
        mounted(){
            Functionality.accordion('.accordion')
            this.initializeVariable()
            Auth.initialize()
            if(this.profile_information.profile_type === ''){
                this.$toasted.show('Please add "Profile Title" and "Type" if you would like to post your content!', {
                    duration : 4000,
                    className: "notification",
                    keepOnHover: true,
                    iconPack: 'fontawesome',
                    action: {
                        icon:'fa-times',
                        onClick:(e, toast) => {
                            toast.goAway(0);
                        }
                    },
                })
            }
            $('.c-main').addClass('bg-black')
        },
        methods:{
            getChanges(){
                let fields = [
                    ".detected-change"
                ]

                fields.forEach(field => {
                    $(field).on('change', (e) => {
                        this.showAlertChange(e)
                    })
                    $(field).on('keypress', (e) => {
                        this.showAlertChange(e)
                    })
                });
            },

            showAlertChange(e){
                if(this.detectedChange){ return true }

                this.detectedChange = true

                this.$toasted.show('You have made unsaved changes', {
                    duration : 8000000,
                    className: "notification",
                    keepOnHover: true,
                    position: 'bottom-right',
                    fullWidth : true,
                    singleton:true,
                    action: [
                        {
                            text:'Cancel',
                            class: 'button-cancel',
                            onClick:(e, toast) => {
                                this.detectedChange = false
                                toast.goAway(0);
                                this.reset()
                            }
                        },
                        {
                            text:'Save',
                            class: 'button-save',
                            onClick:(e, toast) => {
                                this.save()
                                this.detectedChange = false
                                toast.goAway(0);
                            }
                        }
                    ],
                    onComplete: function () {
                        $('.toasted-container ')
                    }
                })
            },
            reset(){
                this.profile_information = this.$parent.user.profile_information
                this.initializeVariable()
            },
            async save(){
                await Auth.setSession()
                this.disable = true

                if(!this.validateData()){
                    this.disable = false
                    return false
                }
                this.profile_information.display_genres = this.genres_display
                this.profile_information.display_services = this.services_display
                let data_send =  {
                    profile_information: this.profile_information,
                    members_information: this.current_members.concat(this.past_members),
                    releases_information: this.releases_information,
                    worked_with_information: this.worked_withx
                }
                await axios.post(this.url, data_send).then(res => {
                    if (res.data.updated || res.data.saved) {
                        this.disable = false
                        this.$toasted.show('Your profile information has been updated successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "p-4 notification bg-primary",
                            keepOnHover: true,
                            iconPack: 'fontawesome',
                            action: {
                                icon:'fa-times',
                                onClick:(e, toast) => {
                                    toast.goAway(0);
                                    location.replace(`/${Auth.state.username}/Profile`)
                                }
                            }
                        })

                        setTimeout(() => {
                            location.replace(`/${Auth.state.username}/Profile`)
                        }, 4000)
                    }
                    if (res.data.saved) {
                        this.url =`/${this.user.username}/Edit/Profile`
                    }
                }).catch(err => {
                    this.disable = false
                    Auth.keepLogged(err.response.status)
                })
            },

            initializeVariable(){
                if (this.user.profile_information) {
                    this.url = `/${this.user.username}/Edit/Profile`
                    this.profile_information = this.user.profile_information
                    this.genres_display = this.user.profile_information.display_genres !== "null" ? JSON.parse(this.user.profile_information.display_genres) : []
                    this.services_display = this.user.profile_information.display_services !== "null" ? JSON.parse(this.user.profile_information.display_services) : []
                    this.profile_information.genres = this.user.profile_information.genres ? (this.user.profile_information.genres.length > 0 ? this.user.profile_information.genres.split(",") : '' ) : []
                    this.profile_information.services = this.user.profile_information.services ? (this.user.profile_information.services.length > 0 ? this.user.profile_information.services.split(",") : '' ) : []
                
                    this.profile_information.social_media = this.user.profile_information.social_media !== null && this.user.profile_information.social_media !== "null"
                        ? ( typeof this.user.profile_information.social_media === 'object' ?  this.user.profile_information.social_media : JSON.parse(this.user.profile_information.social_media))
                        : {
                            Youtube: '',
                            Twitch: '',
                            Instagram: '',
                            Facebook: '',
                            Twitter: '',
                            TikTok: '',
                            LinkedIn: '',
                            SnapChat: '',
                            SoundCloud: '',
                            Bandcamp: '',
                            Spotify: '',}

                    this.profile_information.members.map(val =>{
                        if (val.member_type === 'current') {
                            this.current_members.push(val)
                        }
                        if (val.member_type === 'past') {
                            this.past_members.push(val)
                        }
                    })
                    this.releases_information = this.user.profile_information.releases
                    this.worked_with = this.user.profile_information.worked_with
                }
                this.getChanges()
            },
            validateData(){
                let validate = true

                if(this.profile_information.profile_type === "") {
                    validate = false;
                    swal({
                        text: 'Please fill out the fields marked with (*)',
                        className: 'swal-alert',
                        buttons: [false,'Ok'],
                        dangerMode: true,
                    })
                    $('.swal-footer').addClass('text-center')
                }
                if(this.profile_information.title === "Select Title") {
                    validate = false;
                    swal({
                        text: 'Please fill out the fields marked with (*)',
                        className: 'swal-alert',
                        buttons: [false,'Ok'],
                        dangerMode: true,
                    })
                    $('.swal-footer').addClass('text-center')
                }
                if(this.current_members.length > 0){
                    this.current_members.map(member =>{
                        if(member.member_name === '' || member.role_instrument === '') {
                            swal({
                                text: 'Please fill out the fields marked with (*) to add the current members',
                                className: 'swal-alert',
                                buttons: [false,'Ok'],
                                dangerMode: true,
                            })
                            $('.swal-footer').addClass('text-center')
                            validate = false
                        }
                    })
                }
                if (this.past_members.length > 0){
                    this.past_members.map(past =>{
                        if (past.member_name === '' || past.role_instrument === '') {
                            swal({
                                text: 'Please fill out the fields marked with (*) to add the past members',
                                className: 'swal-alert',
                                buttons: [false, 'Ok'],
                                dangerMode: true,
                            })
                            $('.swal-footer').addClass('text-center')
                            validate = false
                        }

                    })
                }
                if(this.releases_information.length > 0){
                    this.releases_information.map(release =>{
                        if(release.genre === '' || release.album_name === '') {
                            swal({
                                text: 'Please fill out the fields marked with (*) to add the release',
                                className: 'swal-alert',
                                buttons: {
                                    cancel: false,
                                    confirm: 'Ok'
                                },
                                dangerMode: true,
                            })
                            $('.swal-footer').addClass('text-center')
                            validate = false
                        }
                    })
                }

                return validate
            },
            async addedWork(event){
                event.preventDefault()
                if(this.addWorkName === '') return false
                let work = {
                    name: this.addWorkName,
                    id: null
                }
                await this.saveWorkedWith(work)
                this.showAlertChange()
            },
            async saveWorkedWith(work, index){
                await axios.post(`/${this.user.username}/WorkWith/save`, work).then(res =>{
                    if(res.data.save){
                        this.worked_with.push({
                            name: res.data.workWith.name,
                            id: res.data.workWith.id
                        })
                        this.addWorkName = ''
                    }
                }).catch(err =>{
                    console.log(err)
                    Auth.keepLogged(err.response.status)
                })

            },
            async deleteWorkWith(work){
                await axios.post(`/${this.user.username}/WorkWith/delete/${work.id}`, this.user).then(res => {
                    let index = _.findIndex(this.worked_with, function(o) { return o.id === work.id; });
                    this.worked_with.splice(index, 1)
                    this.$toasted.show('Your profile information has been updated successfully!', {
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
                }).catch(err=>{Auth.keepLogged(err.response.status)})
                this.showAlertChange()
            },
            addRelease(){
                this.releases_information.push({
                    id: null,
                    album_name:'',
                    artistic_name:'',
                    genre:'',
                    image:'/images/default-releases.png',
                    label:'',
                    release_date:''
                })
            },
            addMember(type){
                if (type === 'current') {
                    this.current_members.push({
                        id: null,
                        member_type: type,
                        member_name:"",
                        link_profile:'',
                        role_instrument:'',
                    })
                }
                if (type === 'past') {
                    this.past_members.push({
                        id: null,
                        member_type: type,
                        member_name:"",
                        link_profile:'',
                        role_instrument:'',
                    })
                }
            },
            showModalSelectGenres(){
                $('#ModalSelectGenres').modal('show')
            },
            showModalSelectServices(){
                $('#ModalSelectServices').modal('show')
            },
            reload(){
                window.location.replace(`/${Auth.state.username}/Profile`)
            },
        }
    }
</script>

<style lang="scss" scoped>

    .content-text-work{
        span{
            background: var(--third-color);
            padding: 0.4em;
            margin: 0.4em;
            border-radius: .375rem;
            transition: all linear .3s;
            cursor: pointer;
            &:hover{
                background: var(--third-color-secondary);
                box-shadow: none !important;
            }
        }
    }

        .toasted{
            .action.repple{
                color: red !important;
                // &:first-child{
                //     color: white;
                // }
                // &:last-child{
                //     color: var(--fifth-color);
                // }
            }
        }
</style>
