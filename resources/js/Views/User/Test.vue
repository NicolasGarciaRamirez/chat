<template>
    <div v-click-outside="clickExterno" v-if="!hide">
        Hola, soy el div que deseas ocultar!
    </div>
</template>


<script>

import vClickOutside from 'v-click-outside'
export default {
    data(){
        return {
            hide: false
        }
    },
    directives: {
        clickOutside: vClickOutside.directive
    },
    methods: {
        clickExterno (event) {
            this.hide = true
            console.log('Click externo. Evento: ', event)
        }
    }
};


</script>
