/*
 * File: app/view/Step2Panel.js
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

Ext.define('MyApp.view.Step2Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.step2',

    config: {
        items: [
            {
                xtype: 'fieldset',
                title: 'Choose an operation',
                items: [
                    {
                        xtype: 'radiofield',
                        label: 'Add',
                        value: 'add',
                        checked: true
                    },
                    {
                        xtype: 'radiofield',
                        label: 'Subtract',
                        value: 'subtract'
                    },
                    {
                        xtype: 'radiofield',
                        label: 'Multiply',
                        value: 'multiply'
                    },
                    {
                        xtype: 'radiofield',
                        label: 'Divide',
                        value: 'divide'
                    }
                ]
            },
            {
                xtype: 'button',
                ui: 'confirm-round',
                text: 'Calculate that shit!'
            }
        ]
    }

});