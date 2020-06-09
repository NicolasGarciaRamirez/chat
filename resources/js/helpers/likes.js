import Auth from './Auth' 
export default {
    lit:{
        like : null,
    },
    url: null,
    type:null,
    
    getLike(like, url, type, model){
        if (type == 'Post') 
        {
            model.likes.map(val => {
                if (Auth.state.username == val.user.username ) {
                    $(`#lit`+model.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="25">')
                    this.url = `/${Auth.state.username}/LitLike/store/Post/${model.id}/unlike/${val.id}`
                    this.lit.like = 'unlike'
                }
            })
        }
        if(type == 'Comment')
        {
            model.likes.map(val => {
                if (Auth.state.username == val.user.username ) {
                    $(`#litComment`+model.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="25">')
                    this.url = `/${Auth.state.username}/LitLike/store/Comment/${model.id}/unlike/${val.id}`
                    this.lit.like = 'unlike'
                }
            })
        }
    }
}