const Auth = {
    saveToken: function (token) {
        localStorage.setItem("authToken", token);
    },
    getToken: function () {
        return localStorage.getItem("authToken");
    },
    clearToken: function () {
        localStorage.removeItem("authToken");
    },
    isAuthenticated: function () {
        return !!this.getToken();
    },
};

export default Auth;
