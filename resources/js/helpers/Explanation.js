export default{
    data:{
        filter: false,
        menu: false,
        credit: false
    },
    initialize(){
        this.data = JSON.parse(localStorage.getItem('explanations'))
    },
    get(username){
        if(username){
            axios.post(`/User/GetExplanation/${username}`).then(res =>{
                let explanation = res.data.explanation !== null ? res.data.explanation : JSON.stringify({filter: false,menu: false,credit: false})
                localStorage.setItem('explanations', explanation)
                this.initialize()
            }).catch(err=>{
                console.log(err)
            })
        }
    },
    set(explanation, username){
        let data = {explanation}
        if(username){
            axios.post(`/User/SaveExplanation/${username}`, data).then(res =>{
                if(res.data.saved){
                    localStorage.setItem('explanations', JSON.stringify(res.data.user.explanation_ready))
                }
            }).catch(err =>{
                console.log(err)
            })
        }
    },
    remove(){
        localStorage.removeItem('explanations')
    }
}
