<template>
<section>
    <div class="col-md-4 play">
        <img :src="playlist.image" alt="play" class="img-fluid">
        <!-- <i class="fas fa-video position-absolute"></i> -->
        <h3 class="my-1">{{ playlist.title }}</h3>
    </div>
</section>
</template>

<script>
export default {
    props:['playlist']

}
</script>