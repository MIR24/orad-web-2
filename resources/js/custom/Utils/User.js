const User = {
    isLoggedInBool: true,
    premisions: {
        'role': 'admin',
    },
    
    getPremissions () {
        console.log('test');
    },

    isRollAdmin () {
        if (this.premisions.role == 'admin') {
            return true;
        }
        return false;
    },

    isLoggedIn () {
        return this.isLoggedInBool;
    },
}
export default User