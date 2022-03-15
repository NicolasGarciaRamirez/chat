<template>
    <section class="text-white">

        {{query}}
        <button type="button" @click="update" class="btn text-white">update</button>
    </section>
</template>

<script>
export default {
    data(){
        return {
            channel_information: {
                why_support: 'Hey there! You found your way to my channel! I work sincerely on my content aiming to add value to you, the Noisesharks community, and the music industry in general! Would really appreciate it if you help me reach my monthly goal!',
                monthly_goal_last:{
                    current_earnings: 0,
                    monthly_goal: 150,
                    date_end: '',
                    percentage_completed: ''
                },
                tiers: [
                    {
                        id: null,
                        name:'Tier1',
                        amount: '1',
                        description:`By selecting this tier you will support  by sending them a monthly subscription of 1!`,
                    },
                    {
                        id: null,
                        name:'Tier2',
                        amount: '5',
                        description:`By selecting this tier you will support  by sending them a monthly subscription of 5!`,
                    },
                    {
                        id: null,
                        name:'Tier3',
                        amount: '10',
                        description:`By selecting this tier you will support  by sending them a monthly subscription of 10!`,
                    }
                ]
            },
            query: null
        }
    },
    mounted(){
    },
    methods:{
        update(){
            let data = {
                channel_information: this.channel_information
            }
            // axios.post('/test1', data).then(res =>{
            //     if(res.data.update) {
            //         swal('Success','Success','Success')
            //         this.query = res.data.query
            //     }
            // })
        }
    }
}
</script>
