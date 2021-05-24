const login = async(email, password) => {
    const headers = new Headers();
    headers.set('Authorization', 'Basic ' + btoa(email + ":" + password));

    const res = await fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: headers,
    });
    const objs = await res.json();
    return objs;
}

const getProducts = async(jwt) => {
    const headers = new Headers();
    headers.set('Authorization', 'Bearer ' + jwt);
    headers.set('Accept', 'application/json');
    headers.set('Content-Type', 'application/json');

    const res = await fetch('http://127.0.0.1:8000/api/products', {
        method: 'GET',
        headers: headers,
    });
    const objs = await res.json();
    return objs;
}

window.pb = {
    login,
    getProducts
}