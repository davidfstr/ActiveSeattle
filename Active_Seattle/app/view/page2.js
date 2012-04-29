/*
 * File: app/view/page2.js
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

Ext.define('MyApp.view.page2', {
    extend: 'Ext.Panel',
    alias: 'widget.page2',

    config: {
        id: 'two',
        items: [
            {
                xtype: 'container',
                items: [
                    {
                        xtype: 'textfield',
                        label: 'Join a basketball game'
                    }
                ]
            },
            {
                xtype: 'container',
                items: [
                    {
                        xtype: 'map',
                        height: 200
                    }
                ]
            }
        ]
    }

});