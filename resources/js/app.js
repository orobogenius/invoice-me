require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import App from './components/App.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
        { path: '/dashboard', component: require('./components/Dashboard.vue').default, name: 'dashboard' }
    ]
});

export default router;

const app = new Vue({
    router,
    render: h => h(App)
}).$mount('#app');
