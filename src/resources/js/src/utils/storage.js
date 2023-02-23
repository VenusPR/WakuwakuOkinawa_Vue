class Storage {
    setRememberLoggedIn(isRemember) {
        localStorage.setItem('rememberLoggedIn', isRemember);
    }
    getRememberLoggedIn() {
        return localStorage.getItem('rememberLoggedIn') == 'true';
    }
    setUserAccessToken(accessToken) {
        localStorage.setItem('userAccessToken', accessToken);
    }
    getUserAccessToken() {
        return localStorage.getItem('userAccessToken');
    }
}
export const storage = new Storage();
