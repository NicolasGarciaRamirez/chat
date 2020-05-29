<template>
    <section>
        <div class="company-container">
            <div class="nav-container text-white my-5">
                <h2 class="m-2 bg-black active" @click="show('activity')">
                    Activity
                </h2>
                <h2 class="m-2 bg-black" @click="show('analytics')">
                    Analytics
                </h2>
                <h2 class="m-2 bg-black" @click="show('manager')">
                    Ad Manager
                </h2>
            </div>

            <transition name="fade">
                <div v-if="activity">
                    <activity />
                </div>
                <div v-else-if="analytics">
                    <analytics />
                </div>
                <div v-else-if="manager">
                    <manager />
                </div>
            </transition>
        </div>
    </section>
</template>

<script>
import Activity from './Activity'
import Analytics from './Analytics'
import Manager from './Manager'

export default {
    data(){
        return {
            activity: true,
            analytics: false,
            manager: false
        }
    },
    components:{
        Activity,
        Analytics,
        Manager
    },
    methods:{
        show(name){
            if (name == "activity") {
                this.activity = true
                this.analytics = false
                this.manager = false
            }

            if (name == "analytics") {
                this.activity = false
                this.manager = false
                this.analytics = true
            }

            if (name == "manager") {
                this.activity = false
                this.analytics = false
                this.manager = true
            }
        }
    }
}
</script>