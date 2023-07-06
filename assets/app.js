import { registerVueControllerComponents } from '@symfony/ux-vue';
import './styles/app.scss';
import './bootstrap.js';

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));