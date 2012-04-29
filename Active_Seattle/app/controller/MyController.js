/*
 * File: app/controller/MyController.js
 *
 * This file was generated by Sencha Architect version 2.0.0.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Sencha Touch 2.0.x library, under independent license.
 * License of Sencha Architect does not include license for Sencha Touch 2.0.x. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('MyApp.controller.MyController', {
    extend: 'Ext.app.Controller',
    config: {
        control: {
            "selectfield": {
                change: 'onFirstPageSelectfieldChange'
            }
        }
    },

    onFirstPageSelectfieldChange: function(selectfield, newValue, oldValue, options) {

        var mainNav = selectfield.up('navigationview');
        mainNav.push({
            xtype: 'page2',
            title: "Let's Play Now"
        });

        var page2 = mainNav.child('page2');

        var textfield = page2.down('#mytextfield');
        var str = 'Join a ' + newValue.data.text + ' game';
        textfield.setLabel(str);


    }

});