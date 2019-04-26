
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import VTooltip from 'v-tooltip'
import { debounce } from "debounce";
//import DatatableFactory from 'vuejs-datatable';
import { TableComponent, TableColumn } from 'vue-laravel-table-component';
import axios from 'axios';
import Datatable from 'vue2-datatable-component';


Vue.use(Datatable) // done!
Vue.component('table-component', TableComponent);
Vue.component('table-column', TableColumn);
//Vue.use(DatatableFactory);
Vue.use(VTooltip);
Vue.use(debounce);
Vue.prototype.$axios = axios //to solve problem reed DOM emidio

require('./bootstrap');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
    'example-component',
    require('./components/ExampleComponent.vue')
);

Vue.component('search', require('./components/search.vue').default);
Vue.component('searchsal', require('./components/searchsal.vue').default);

const app = new Vue({
    el: '#app'
    
});


var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('ul.dropdown-menu');

if (notificationsCount <= 0) {
    notificationsWrapper.hide();
    
}


var updateNotifications = function (data) {
    var existingNotifications = notifications.html();
    var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
    var newNotificationHtml = `
        <li class="notification active">
            <div class="media">
                <div class="media-left">
                <div class="media-object">
                    <img src="https://api.adorable.io/avatars/71/`+ avatar + `.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                </div>
                </div>
                <div class="media-body">
                <strong class="notification-title">`+ data.message + `</strong>
                <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                </div>
                </div>
            </div>
        </li>
        `;

    notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
};

if($('body').data('user-id')){
   Echo.private('App.User.' + $('body').data('user-id'))
       .notification((notification) => {
           updateNotifications(notification);
   });
}



Echo.private('App.User.27' + $('body').data('user-id'))
    .notification((notification) => {
        console.log(notification.type);
    });
