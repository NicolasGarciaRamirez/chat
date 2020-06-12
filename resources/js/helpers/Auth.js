export default{
    state:{
        token: null,
        username: null,
        avatar: null
    },
    initialize(){
        this.state.token = localStorage.getItem('token')
        this.state.username = localStorage.getItem('username')
        this.state.avatar = localStorage.getItem('avatar')
    },
    set(token, username, avatar){
        localStorage.setItem('token', token)
        localStorage.setItem('username', username)
        localStorage.setItem('avatar', avatar)
        
        this.initialize()
    },
    remove(){
        localStorage.removeItem('token')
        localStorage.removeItem('username')
        localStorage.removeItem('avatar')
        this.initialize()
    },
    getExpire(){
        
    }
}
