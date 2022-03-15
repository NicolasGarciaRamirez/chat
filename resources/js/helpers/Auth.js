import Followers from "./Followers";
export default{
    state:{
        token: null,
        username: null,
        avatar: null,
        session: null
    },
    initialize(){
        this.state.token = localStorage.getItem('token')
        this.state.username = localStorage.getItem('username')
        this.state.avatar = localStorage.getItem('avatar')
        this.state.session = localStorage.getItem('session')
    },
    set(token, username, avatar, session){
        localStorage.setItem('token', token)
        localStorage.setItem('username', username)
        localStorage.setItem('avatar', avatar)
        localStorage.setItem('session', session)
        this.initialize()
    },
    setSessionValue(session) {
        localStorage.setItem('session', session)
    },
    remove(){
        localStorage.removeItem('token')
        localStorage.removeItem('username')
        localStorage.removeItem('avatar')

        this.initialize()
    },
    async setSession(){
        await axios.post(`/setSession`, this.state).then(res => {
            if(!res.data.login){
                this.set(res.data.token, res.data.username, res.data.avatar, res.data.session)
            }
            return true
        }).catch(res=>{this.keepLogged(err.response.status)})
    },
    async logout(){
        await axios.get('/logout').then(res => {
            this.remove()
            Followers.remove()
            window.location.replace('/')
        })
    },
    keepLogged(status){
        if(status === 419) {
            if(this.state.session === 'false') {
                let content = document.createElement('div')
                content.innerHTML = ("<p>As you haven't checked the <b class='text-white'>Keep me logged in</b> option, your session has expired after 14 days!<br><br> What would you like to do?</p>")
                content.style.textAlign = 'initial'
                swal({
                    title: 'Session Expired!',
                    icon: 'warning',
                    content: content,
                    buttons: {
                        cancel: "Logout",
                        catch: {
                            text: "Login",
                            value: "catch"
                        },
                        defeat: {
                            text: 'Login & keep me logged in',
                            value: 'defeat'
                        }
                    },
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                }).then((value) => {
                    switch (value) {
                        case "defeat":
                            this.setSessionValue('true')
                            window.reload()
                            break;
                        case "catch":
                            window.location.replace('/login')
                            this.logout()
                            break;
                        default:
                            this.logout()
                    }
                    this.state.session === 'false' ? setTimeout(this.logout(), 20) : setTimeout(location.reload(), 20)
                })
            }else{
                swal('Your session has expired after 14 days, but don\'t worry, you just need to refresh the page!')
                window.reload()
            }
        }else{
            this.setSession()
        }
    }
}
