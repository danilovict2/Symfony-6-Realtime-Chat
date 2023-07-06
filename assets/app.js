import { registerVueControllerComponents } from '@symfony/ux-vue';
import './styles/app.scss';

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));