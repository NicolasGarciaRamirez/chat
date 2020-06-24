export default {
    posts : [],
    filter: null,

    initialize(posts){
        console.log(posts)
        this.posts = posts
    },
    filter(filters){
        // if (type == 'genre'){
            var object = ''
            console.log(this.posts)
            filters.map(fil =>{
                object = _.filter(this.posts, function(o) { return o.genre === fil  })
            })
            console.log(object)     
        // }
        // if (type == 'category') {
        //     return _.filter(this.posts, function(post) { return post.category == filter })
        // }
    }
}