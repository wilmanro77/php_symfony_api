import React from 'react';
import ReactDOM from 'react-dom';
import Login from './../login/containers/login.js';

//ReactDOM.render(que voy a renderizar, donde lo haré);
const app = document.getElementById('app');
console.log('hello');
ReactDOM.render(<Login />, app);