<template>
  <section class="profile-container">
    <div>
		<div class="nav-container text-white my-2" v-if="!profile">

			<h2 class="m-2 bg-black active" @click="show('channel')">
				Channel
			</h2>
			<h2 class="m-2 bg-black" v-on:click="profile = !profile">
				Profile
			</h2>
		</div>

		<transition  name="fade" >
			<div v-if="profile" class="details-container">
				<div class="d-flex justify-content-around bg-black mt-5" >
					<div >
						<h2 class="c-white">Personal Details <i class="fas fa-pencil-alt"></i></h2>
						<label>Name: Thamek</label><br>
						<label>Gender: Male</label><br>
						<label>Location: asd</label><br>
						<label>Email: asd@gmail.com</label>
					</div>
					<div >
						<h2 class="c-white">Subscription</h2><br>
						<label>Acount Type: <span class="c-fifth">CONTRIBUTOR</span></label><br>
						<a href="#" class="btn bg-black text-white border rounded-pill">Account Setings <i class="fas fa-cog ml-2"></i></a>
					</div>
				</div>

				<div class="nav-container text-white my-5">

					<h2 class="bg-black mr-5" v-on:click="accordionprofile = !accordionprofile">
						Profile
					</h2>
					<h2 class="bg-black" @click="show('channel-config')">
						Channel
					</h2>
				</div>

				<transition name="fade">
					<div v-if="accordionprofile">
						<accordion-profile />
					</div>
					<div v-else-if="accordionchannel">
						<accordion-channel />
					</div>
				</transition>
			</div>

			<div v-else-if="channel">
				<channel />
			</div>
		</transition>

    </div>
  </section>
</template>

<script>
import channel from './Channel'
import accordionProfile from './Accordion-profile'
import accordionChannel from './Accordion-channel'

export default {
	data(){
		return {
			channel: true,
			profile: false,
			accordionchannel: true,
			accordionprofile: false,
		}
	},
	components:{
		channel,
		accordionProfile,
		accordionChannel
	},
	methods:{
		
		show(name){
			if (name == 'channel') {
				if (this.channel && this.profile) {
					this.profile = false
				}
			}

			if (name == 'channel-config') {
				if(this.accordionchannel && this.accordionprofile){
					this.accordionprofile = false
				}
			}
		}
	}
}
</script>
