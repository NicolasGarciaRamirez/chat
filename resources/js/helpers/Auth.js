export default {
    setAuthUser(Boolean, avatar, username ) {
        localStorage.setItem("username", username , {expires: 1})
        localStorage.setItem("avatar", avatar , {expires: 1})
        localStorage.setItem("auth", Boolean , {expires: 1});
    },
    getAuthUser() {
        return localStorage.getItem("auth");
    },
    getUserAvatar(){
        return localStorage.getItem("avatar")
    },
    getUserName(){
        return localStorage.getItem("username");
    },
    deleteAuthUser() {
        localStorage.removeItem("auth","avatar","username");
    }
};