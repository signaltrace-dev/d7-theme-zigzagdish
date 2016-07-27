/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 (function ($) {
   Drupal.behaviors.zigzagdish = {
     attach: function (context, settings) {
       var theme = this;

       // Register AdWords click for "Create New Account" link
       $('#user-login-block-form-fields .item-list a').once('adwords-click', function(){
         $(this).on('click', function(e){
           var rootUrl = window.location.protocol + '//' + window.location.hostname;
           var href = '';
           if($(this).attr('href')){
             var href = $(this).attr('href');
             if(href === '/user/register'){
               var fullUrl = rootUrl + href;
               goog_report_conversion(fullUrl);
             }
           }
         });
       });
     }
   };
 }(jQuery));
