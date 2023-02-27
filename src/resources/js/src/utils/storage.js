class Storage {
    setItem(key, value, option = { type : 'local' }) {
        if (option.type == 'session') {
            sessionStorage.setItem(key, value);
        } else {
            localStorage.setItem(key, value);
        }
    }

    getItem(key, option = { type : 'local'}) {
        if (option.type == 'session') {
            return sessionStorage.getItem(key);
        } else {
            return localStorage.getItem(key);
        }
    }

    removeItem(key, option = { type : 'local'}) {
        if (option.type == 'session') {
            sessionStorage.removeItem(key);
        } else if (option.type == 'local') {
            localStorage.removeItem(key);
        } else if (option.type == 'all') {
            sessionStorage.removeItem(key);
            localStorage.removeItem(key);
        }
    }

    setRememberLoggedIn(isRemember) {
        localStorage.setItem('rememberLoggedIn', isRemember);
    }

    getRememberLoggedIn() {
        return localStorage.getItem('rememberLoggedIn') == 'true';
    }

    setUserToken(accessToken, rememberLoggedIn = true) {
        this.removeItem('userToken', { type: 'all' });
        this.setItem('userToken', accessToken, { type: rememberLoggedIn ? 'local' : 'session' });
    }

    getUserToken() {
        var token = this.getItem('userToken', {type: 'local'});
        if (token) {
            return token;
        }
        return this.getItem('userToken', {type: 'session'});
    }

    removeUserToken() {
        this.removeItem('userToken', { type: 'all' });
    }
}
export const storage = new Storage();
