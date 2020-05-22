import Cookies from "js-cookie";

export default {
    setAuthUser(Boolean, avatar, username ) {
        Cookies.set("username", username , {expires: 1})
        Cookies.set("avatar", avatar , {expires: 1})
        Cookies.set("auth", Boolean , {expires: 1});
    },
    getAuthUser() {
        return Cookies.get("auth");
    },
    getUserAvatar(){
        return Cookies.get("avatar")
    },
    getUserName(){
        return Cookies.get("username");
    },
    deleteAuthUser() {
        Cookies.remove('auth','avatar', 'username');
    }
};