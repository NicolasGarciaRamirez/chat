<template>
    <section>
        <div class="channel-container">
            <div class="row ">
                <div class="col-sm col-lg col-xl-8">
                    <div class="my-5">
                        <h2 class="text-white">Why Support Channel?</h2>
                        <p>I help msuic enthusiasts to find financial settelment or growth</p>
                    </div>
                    <div class="col border">
                        <div class="nav nav-container m-3">
                            <h2 class="btn bg-back text-white mr-2" @click="show">
                                Activity
                            </h2>
                            <h2 class="btn bg-back text-white" @click="show">
                                Playlist
                            </h2>
                        </div>
                        <transition name="fade">
                            <div v-if="activity">
                                <h2>Activity</h2>
                                <div class="row" >
                                    <div class="col-sm col-lg col-xl">
                                        <div class="card mt-1">
                                            <div class="bg-black card-body">
                                                <img src="/images/profile.png" alt="" >
                                                <h4  class="m-2">This is a title of a the video iI created</h4><br>
                                                <div class="d-flex justify-content-around bg-primary">
                                                    <i class="c-fourth"><img src="/images/percentage.svg" alt="percentage-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/flame.svg" alt="flame-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/chat.svg" alt="chat-icon">100</i>
                                                </div>
                                            </div>
                                            <div class="bg-black text-white card-footer">
                                                <div class="pt-2 c-fourth">
                                                    <span>11k views</span>
                                                    <span class="float-right">3 hrs ago</span>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm col-lg col-xl">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="/images/profile.png" alt="">
                                                <h4  class="m-2">This is a title of a the video iI created</h4><br>
                                                <div class="d-flex justify-content-around bg-primary">
                                                    <i class="c-fourth"><img src="/images/percentage.svg" alt="percentage-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/flame.svg" alt="flame-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/chat.svg" alt="chat-icon">100</i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="pt-2 c-fourth">
                                                    <span>11k views</span>
                                                    <span class="float-right">3 hrs ago</span>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm col-lg col-xl">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="/images/profile.png" alt="">
                                                <h4  class="m-2">This is a title of a the video iI created</h4><br>
                                                <div class="d-flex justify-content-around bg-primary">
                                                    <i class="c-fourth"><img src="/images/percentage.svg" alt="percentage-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/flame.svg" alt="flame-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/chat.svg" alt="chat-icon">100</i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="pt-2 c-fourth">
                                                    <span>11k views</span>
                                                    <span class="float-right">3 hrs ago</span>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else-if="playlist">
                                <h2>Playlist</h2>
                                <div class="row" >
                                    <div class=" col-sm col-lg col-xl">
                                        <div class="card mt-1">
                                            <div class="bg-black card-body">
                                                <img src="/images/profile.png" alt="" >
                                                <h4  class="m-2">This is a title of a the video iI created</h4><br>
                                                <div class="d-flex justify-content-around bg-primary">
                                                    <i class="c-fourth"><img src="/images/percentage.svg" alt="percentage-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/flame.svg" alt="flame-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/chat.svg" alt="chat-icon">100</i>
                                                </div>
                                            </div>
                                            <div class="bg-black text-white card-footer">
                                                <div class="pt-2 c-fourth">
                                                    <span>11k views</span>
                                                    <span class="float-right">3 hrs ago</span>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm col-lg col-xl">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="/images/profile.png" alt="">
                                                <h4  class="m-2">This is a title of a the video iI created</h4><br>
                                                <div class="d-flex justify-content-around bg-primary">
                                                    <i class="c-fourth"><img src="/images/percentage.svg" alt="percentage-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/flame.svg" alt="flame-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/chat.svg" alt="chat-icon">100</i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="pt-2 c-fourth">
                                                    <span>11k views</span>
                                                    <span class="float-right">3 hrs ago</span>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm col-lg col-xl">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="/images/profile.png" alt="">
                                                <h4  class="m-2">This is a title of a the video iI created</h4><br>
                                                <div class="d-flex justify-content-around bg-primary">
                                                    <i class="c-fourth"><img src="/images/percentage.svg" alt="percentage-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/flame.svg" alt="flame-icon">100</i>
                                                    <i class="c-fourth"><img src="/images/chat.svg" alt="chat-icon">100</i>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="pt-2 c-fourth">
                                                    <span>11k views</span>
                                                    <span class="float-right">3 hrs ago</span>      
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </transition>
                    </div>
                </div>
                
                <div class="col-sm col-lg col-xl-4 text-center">
                    <div class="row p-5 ">
                        <div class="col p-1">
                           <h2>Monthly Goal</h2>
                            £500 _______________ £150 <br>
                            243 Followers · 98 Supporters 
                        </div>
                    </div>
                    <div class="row p-5 border-top">
                        <div class="col ">
                            <h2>What Will Supporters Get?</h2><br>
                            <h5>The Nickels</h5><br>
                            <p>
                                For the $1 supporters I will send give you a
                                shoutout and mentions when you comment
                                on my content 
                            </p><br>
                            <button class="bg-fifth btn rounded-pill">$1</button><br>
                        </div>
                    </div>
                    <div class="row p-5 border-top">
                        <div class="col">
                            <h2 class="pb-1">The Silvers</h2>
                            <p>
                                For the $1 supporters I will send give you a
                                shoutout and mentions when you comment
                                on my content 
                            </p>
                            <button class="bg-fifth btn rounded-pill">$1.99</button><br>
                        </div>
                    </div>
                    <div class="row p-5 border-top">
                        <div class="col">
                            <h2>The Platinums</h2><br>
                            <p>
                                For the $1 supporters I will send give you a
                                shoutout and mentions when you comment
                                on my content 
                            </p><br>
                            <button class="bg-fifth btn rounded-pill">$4.99</button><br>
                        </div>
                    </div>
                    <div class="row p-5 border-top">
                        <div class="col">
                            <h2>The Golds</h2><br>
                            <p>
                                For the $1 supporters I will send give you a
                                shoutout and mentions when you comment
                                on my content 
                            </p><br>
                            <button class="bg-fifth btn rounded-pill">$7.77</button><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return {
            activity: true,
            playlist: false
        }
    },

    methods:{
        show(){
            if (this.activity && this.playlist == false) {
                this.playlist = true
                this.activity = false
            }
            else if (this.activity == false && this.playlist) {
                this.activity = true
                this.playlist = false
            }
            
        }
    }
}
</script>