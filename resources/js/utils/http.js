// axios instance
import axios from 'axios'

// Laravel CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');

// Create an Instance
const instance = axios.create({
    // change this url to your api
    baseURL: window.location.origin,

    // any other headers you want to include
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': token ? token.content : null,
        'Accepts': 'application/json'
    }
});

// before a request is made start the nprogress
instance.interceptors.request.use(config => {
    //NProgress.start();
    return config;
  });
  

// Error interceptor can be used for global error handling
instance.interceptors.response.use(function (response) {
    // Do something with response data
    //NProgress.done();
    return response;
}, function (error) {
    if (error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx

        // redirect to root if un authenticated
        if(error.response.status === 401) {
            window.location = '/login';
        }
        throw error;
    } else if (error.request) {
        // The request was made but no response was received
        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
        // http.ClientRequest in node.js
        console.log('Error in request', error.request);
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', error.message);
    }
});

export default instance