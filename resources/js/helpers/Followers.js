export default{
    data:{
        followers: null,
    },
    initialize(){
        this.data.followers = sessionStorage.getItem('followers')
    },
    set(followers){
        sessionStorage.setItem('followers', JSON.stringify(followers))
        this.initialize()
    },
    remove(){
        sessionStorage.removeItem('followers')
        this.initialize()
    }
}
