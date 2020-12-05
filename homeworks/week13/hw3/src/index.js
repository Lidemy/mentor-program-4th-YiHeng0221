import { fetchTop5ForNav, clickListener } from './functions';
import { apiSourse, ReqTemp } from './variables';
import './style.scss';

fetchTop5ForNav(`${apiSourse}games/top?limit=5`, ReqTemp);
clickListener();
