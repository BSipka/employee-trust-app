export function getAuthUser() {
    const authUser = localStorage.getItem("auth_user");
    return JSON.parse(authUser);
}

export function authUserLoader() {
    return getAuthUser();
}

export function getAuthToken() {
    const user = getAuthUser();

    if (user) {
        return user[1];
    }
    return;
}
