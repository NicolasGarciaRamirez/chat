<template>
    <div>
        <div :class="`text item ${!post.replace_caption && post.resource_type === 'link' ? 'py-3 px-2' : ''} `" id="description" v-if="!post.replace_caption && post.description && $parent.user_auth_is_privacy" @click="$parent.storeView()">
            <span v-if="showMore && !$parent.edit && !post.replace_caption && post.resource_type !== 'docs'">{{description}}</span>
            <span v-if="!showMore && !$parent.edit && !post.replace_caption && post.resource_type !== 'docs'">{{descriptionLess}}</span>
            <span class="show-more" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description.length > 200 && !$parent.edit && !post.replace_caption && post.resource_type !== 'docs'">{{!showMore ? 'Show more...' : 'Show less'}}</span>

            <span v-if="showMore && post.resource_type === 'docs'">{{description}}</span>
            <span v-if="!showMore && post.resource_type === 'docs'">{{descriptionLess}}</span>
            <span class="show-more" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description.length > 200 && post.resource_type === 'docs'">{{!showMore ? 'Show more...' : 'Show less'}}</span>

            <span v-if="showMore && post.resource_type === 'docs' && $parent.resource_extension !== 'pdf'">{{description}}</span>
            <span v-if="!showMore && post.resource_type === 'docs' && $parent.resource_extension !== 'pdf'">{{descriptionLess}}</span>
            <span class="show-more mx-4" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description.length > 200 && post.resource_type === 'docs' && $parent.resource_extension !== 'pdf'">{{!showMore ? 'Show more...' : 'Show less'}}</span>

            <form @submit.prevent="$parent.update"  v-if="$parent.edit && !post.replace_caption " class="d-flex flex-column w-100">
                <div>
                    <textarea class="form-control mb-3" rows="5" placeholder="Add Some value to the music industry..."  v-model="post.description"></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn text-white rounded-pill float-right mx-3" @click="$parent.edit = false">Cancel Edit</button>
                    <button type="submit" class="btn text-white bg-fifth rounded-pill float-right">Save Edit</button>
                </div>
            </form>
        </div>
        <div class="d-flex flex-column w-100" v-if="post.replace_caption" >
            <div class="d-flex">
                <a :href="`${post.resource}`" class="text-white no-underline" v-if="post.resource_type === 'docs' && $parent.resource_extension === 'pdf'">
                    <h4 class="font-weight-bold">{{ post.replace_caption }}</h4>
                </a>
                <h4 :class="`font-weight-bold ${post.resource_type === 'link' ? 'underline cursor-pointer' : '' }`" v-if="$parent.resource_extension !== 'pdf' && !$parent.edit" @click="post.resource_type === 'link' ? redirect() : '' ">{{ post.replace_caption }}</h4>
            </div>
            <div>
                <span v-if="showMore && !$parent.edit && description !== ''">{{description}}</span>
                <span v-if="!showMore && !$parent.edit && description !== ''">{{descriptionLess}}</span>
                <span class="show-more" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description !== '' && description.length > 200">{{!showMore ? 'Show more...' : 'Show less'}}</span>
                <form @submit.prevent="$parent.update"  v-if="$parent.edit && post.replace_caption " class="d-flex flex-column w-100">
                    <div class="d-flex flex-column mb-3">
                        <input type="text" class="form-control rounded-pill my-2" v-model="post.replace_caption" />
                        <textarea class="form-control text-white" rows="5" placeholder="Add Some value to the music industry..." id="textarea" v-model="post.description"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn text-white bg-primary rounded-pill float-right mx-3" @click="$parent.edit = false">Cancel Edit</button>
                        <button type="submit" class="btn text-white bg-fifth rounded-pill float-right">Save Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Post-Text",
        props:['post','user'],
        data(){
            return {
                showMore:false,
            }
        },
        computed:{
            descriptionLess(){
                if(this.post.description !== null && this.post.description !== ''){
                    let text = this.post.description
                    return text.substr(0,200)
                }else{
                    return null
                }
            },
            description(){
                return this.post.description
            },
            // tags(){
            //     let reg = /#[\w]+|#(?:[\u2700-\u27bf]|(?:\ud83c[\udde6-\uddff]){2}|[\ud800-\udbff][\udc00-\udfff]|[\u0023-\u0039]\ufe0f?\u20e3|\u3299|\u3297|\u303d|\u3030|\u24c2|\ud83c[\udd70-\udd71]|\ud83c[\udd7e-\udd7f]|\ud83c\udd8e|\ud83c[\udd91-\udd9a]|\ud83c[\udde6-\uddff]|[\ud83c[\ude01-\ude02]|\ud83c\ude1a|\ud83c\ude2f|[\ud83c[\ude32-\ude3a]|[\ud83c[\ude50-\ude51]|\u203c|\u2049|[\u25aa-\u25ab]|\u25b6|\u25c0|[\u25fb-\u25fe]|\u00a9|\u00ae|\u2122|\u2139|\ud83c\udc04|[\u2600-\u26FF]|\u2b05|\u2b06|\u2b07|\u2b1b|\u2b1c|\u2b50|\u2b55|\u231a|\u231b|\u2328|\u23cf|[\u23e9-\u23f3]|[\u23f8-\u23fa]|\ud83c\udccf|\u2934|\u2935|[\u2190-\u21ff])/g
            //     return this.post.description.match(reg)
            // }

        },
        methods:{
            redirect(){
                window.open(this.post.link);
            }
        }
    }
</script>

<style scoped>

</style>
