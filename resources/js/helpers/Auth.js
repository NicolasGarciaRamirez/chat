export default {
    setAuthUser(username ) {
        localStorage.setItem("username", username , {expires: 1})
        localStorage.setItem("auth", true , {expires: 1});
    },
    getAuthUser() {
        return localStorage.getItem("auth");
    },
    getUserName(){
        return localStorage.getItem("username");
    },
    deleteAuthUser() {
        localStorage.removeItem("auth", "username");
    }
};
