define([
  'jquery',
  'jquery/validate',
], function($) {
  'use strict';
  $.widget('mage.mailchimp', {

    options: {      
      messagesSelector: '[data-placeholder="messages"]',
      successSubscriptionMessage: '¡Done! You were added to Newsletter',
      errorSubscriptionMessage: '¡Oops! Error in subscription process',
    },

    /** @inheritdoc */
    _create: function () {
      const self = this;

      $('#form-newsletter').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
        },
        submitHandler: function(form) {
          self.ajaxSubmit(form);
        }
        
      });

    },

    /**
     * Handler for the form submit event
     *
     * @param {jQuery} form
     */
    ajaxSubmit: function(form) {
      var self = this;

      /*
         Request Mailchimp API
         Add email to an existing list
         ---
         https://developer.mailchimp.com/documentation/mailchimp/guides/manage-subscribers-with-the-mailchimp-api/
       */
      const emailData = {
        email_address: $('.email-newsletter').val(),
        status: 'subscribed'
      } 
      
      const formId = form.id;
      const URL = form.action;

      $.ajax({
        url: URL,
        method: 'GET',
        data: emailData,
        dataType: 'json',
        
        /** @inheritdoc */
        beforeSend: function() {
          self.disableAddEmailNewsletter(formId);
        },

        /** @inheritdoc */
        success: function(res) {
          if (res.status != 200)
            {
              var textMessage;
              if (res.response.errors === undefined) {
                textMessage = self.options.errorSubscriptionMessage;
              } else {
                textMessage = res.response.errors[0].field + ': ' + res.response.errors[0].message;
              }              
              $(self.options.messagesSelector).html(textMessage);              
            }
          else
            {
              $(self.options.messagesSelector).html(self.options.successSubscriptionMessage);
              self.cleanTextEmailNewsletter(formId);
            }
        },

        /** @inheritdoc */
        error: function(res) {
          $(self.options.messagesSelector).html(self.options.errorSubscriptionMessage);
        },

        /** @inheritdoc */
        complete: function() {
          self.enableAddEmailNewsletter(formId);
        },

      });        
    },

    /**
     * @param {String} form
     */
    disableAddEmailNewsletter: function (form) {
      $('#'+form).find('button').attr('disabled', true).text('Adding...');
    },

    /**
     * @param {String} form
     */
    enableAddEmailNewsletter: function (form) {
      $('#'+form).find('button').attr('disabled', false).text('Subscribe');
    },

    /**
     * @param {String} form
     */
    cleanTextEmailNewsletter: function (form) {     
      $('#'+form).find('input[type="text"]').val('');
    },

  });
  return $.mage.newsletter;
});
