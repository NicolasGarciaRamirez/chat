export default{
    data:{
        followers: null,
    },
    initialize(){
        this.data.followers = localStorage.getItem('followers')
    },
    set(followers){
        localStorage.setItem('followers', JSON.stringify(followers))
        this.initialize()
    },
    remove(){
        localStorage.removeItem('followers')
        this.initialize()
    }
}
