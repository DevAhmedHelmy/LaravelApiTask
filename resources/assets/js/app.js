require('./bootstrap');

window.Vue = require('vue');
import vuetify from '../plugins/vuetify' // path to vuetify export
import router from './Router/routes';
import VueForm from 'vue-form';
// or var VueForm = require('vue-form') or window.VueForm if you are linking directly to the dist file
 
// install globally
Vue.use(VueForm);
// Vue.use(VueForm, options);


Vue.config.productionTip = false
Vue.component('AppHome', require('./components/AppHome').default);
 

const app = new Vue({
    el: '#app',
     vuetify,
    router:router
});
