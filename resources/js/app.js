import {createApp} from 'vue';
import TaskApp from './components/TaskApp.vue';
import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

createApp(TaskApp).mount('#app');

const token=
document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}
