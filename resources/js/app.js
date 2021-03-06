
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

setTimeout(() => {
    (function() {
        $('#flash-overlay-modal').modal();
        var sidebarProgress = false;
        $('.sidebar').bind('click touchstart', function(e) {
            if ($(e.target).closest('.sidebar').length !== 0) {
                sidebarProgress = true;
            } else {
                sidebarProgress = false;
                e.stopPropagation();
            }
        });
        
        $(document).bind('click touchstart', function(e) {
            if ($(e.target).closest('.sidebar').length === 0) {
                sidebarProgress = false;
            }
            if (!e.isPropagationStopped() && sidebarProgress !== true) {
                if ($('#page-container').hasClass('page-sidebar-toggled')) {
                    sidebarProgress = true;
                    $('#page-container').removeClass('page-sidebar-toggled');
                }
                if ($(window).width() <= 767) {
                    if ($('#page-container').hasClass('page-right-sidebar-toggled')) {
                        sidebarProgress = true;
                        $('#page-container').removeClass('page-right-sidebar-toggled');
                    }
                }
            }
        });
        
        $('[data-click=right-sidebar-toggled]').click(function(e) {
            e.stopPropagation();
            var targetContainer = '#page-container';
            var targetClass = 'page-right-sidebar-collapsed';
                targetClass = ($(window).width() < 979) ? 'page-right-sidebar-toggled' : targetClass;
            if ($(targetContainer).hasClass(targetClass)) {
                $(targetContainer).removeClass(targetClass);
            } else if (sidebarProgress !== true) {
                $(targetContainer).addClass(targetClass);
            } else {
                sidebarProgress = false;
            }
            if ($(window).width() < 480) {
                $('#page-container').removeClass('page-sidebar-toggled');
            }
            $(window).trigger('resize');
        });
        
        $('[data-click=sidebar-toggled]').click(function(e) {
            e.stopPropagation();
            var sidebarClass = 'page-sidebar-toggled';
            var targetContainer = '#page-container';
    
            if ($(targetContainer).hasClass(sidebarClass)) {
                $(targetContainer).removeClass(sidebarClass);
            } else if (sidebarProgress !== true) {
                $(targetContainer).addClass(sidebarClass);
            } else {
                sidebarProgress = false;
            }
            if ($(window).width() < 480) {
                $('#page-container').removeClass('page-right-sidebar-toggled');
            }
        });
    })();
    (function() {
        "use strict";
        
        var expandTime = ($('.sidebar').attr('data-disable-slide-animation')) ? 0 : 250;
        $('.sidebar .nav > .has-sub > a').click(function() {
            var target = $(this).next('.sub-menu');
            var otherMenu = $('.sidebar .nav > li.has-sub > .sub-menu').not(target);
    
            if ($('.page-sidebar-minified').length === 0) {
                $(otherMenu).closest('li').addClass('closing');
                $(otherMenu).slideUp(expandTime, function() {
                    $(otherMenu).closest('li').addClass('closed').removeClass('expand closing');
                });
                if ($(target).is(':visible')) {
                    $(target).closest('li').addClass('closing').removeClass('expand');
                } else {
                    $(target).closest('li').addClass('expanding').removeClass('closed');
                }
                $(target).slideToggle(expandTime, function() {
                    var targetLi = $(this).closest('li');
                    if (!$(target).is(':visible')) {
                        $(targetLi).addClass('closed');
                        $(targetLi).removeClass('expand');
                    } else {
                        $(targetLi).addClass('expand');
                        $(targetLi).removeClass('closed');
                    }
                    $(targetLi).removeClass('expanding closing');
                });
            }
        });
        $('.sidebar .nav > .has-sub .sub-menu li.has-sub > a').click(function() {
            if ($('.page-sidebar-minified').length === 0) {
                var target = $(this).next('.sub-menu');
                if ($(target).is(':visible')) {
                    $(target).closest('li').addClass('closing').removeClass('expand');
                } else {
                    $(target).closest('li').addClass('expanding').removeClass('closed');
                }
                $(target).slideToggle(expandTime, function() {
                    var targetLi = $(this).closest('li');
                    if (!$(target).is(':visible')) {
                        $(targetLi).addClass('closed');
                        $(targetLi).removeClass('expand');
                    } else {
                        $(targetLi).addClass('expand');
                        $(targetLi).removeClass('closed');
                    }
                    $(targetLi).removeClass('expanding closing');
                });
            }
        });
    })();
},500);

import VueSweetalert2 from 'vue-sweetalert2';
import VueCountdown from '@xkeshi/vue-countdown';
import VueClipboard from 'vue-clipboard2'


window.Vue = require('vue');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueSweetalert2);
Vue.use(VueClipboard)
//Vue.config.devtools = false;

import axios from './utils/http';
Vue.use(require('vue-axios'), axios);
Vue.component('countdown', VueCountdown);
Vue.component('investment-component', require('./components/InvestmentComponent.vue'));
Vue.component('investments-component', require('./components/Investments/InvestmentsComponent.vue'));
Vue.component('transactions-component', require('./components/Transactions/TransactionsComponent.vue'));
Vue.component('admin-transaction-component', require('./components/Transactions/AdminTransactionComponent.vue'));
Vue.component('coming-soon-component', require('./components/ComingSoonComponent.vue'));
Vue.component('verify-phone-component', require('./components/VerifyPhoneComponent.vue'));
const app = new Vue({
    el: '#app',
});
