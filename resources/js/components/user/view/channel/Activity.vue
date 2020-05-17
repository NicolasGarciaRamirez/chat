<template>
    <section class="movement">
        <div class="activities">
            <channel-activity :user="user" />
        </div>
    </section>
</template>

<script>
import ChannelActivity from '../../profile/ChannelActivity'
export default {
    props:['user'],
    components:{
        ChannelActivity
    }
}
</script>
