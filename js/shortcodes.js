(function() {
    tinymce.create('tinymce.plugins.Rocket', {
        /**
         * Initialises the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished its initialisation so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init: function(ed, url) {
            // add a button by id
            ed.addButton('dropcap', {
                title: 'DropCap',
                cmd: 'dropcap',
                iamge: url + '/images/dropcap.png'
            });

            ed.addButton('showrecent', {
                title: 'Add recent posts shortcode',
                cmd: 'showrecent',
                image: url + '/images/showrecent.jpg'
            });

            ed.addCommand('dropcap', function() {
                var selected_text = ed.selection.getContent();
                var return_text = '';

                return_text = '<span class="dropcap">' + selected_text + '</span>';

                ed.execCommand('mceInsertContent', 0, return_text);
            });

            ed.addCommand('showrecent', function() {
                ed.windowManager.open({
                    title: 'How many posts do you want to show?',
                    body: [
                        {
                            type: 'textbox',
                            name: 'textboxName',
                            label: 'Text Box',
                            value: 'value'
                            // multiline: true,
                            // minWidth: 300,
                            // minHeight: 100
                        }
                        // {
                        //     type: 'listbox',
                        //     name: 'listboxName',
                        //     label: 'List Box',
                        //     'values': [
                        //         {text: 'Option 1', value: '1'},
                        //         {text: 'Option 2', value: '2'},
                        //         {text: 'Option 3', value: '3'}
                        //     ]
                        // }
                    ],
                    onsubmit: function(e) {
                        var number = e.data.textboxName;
                        var shortcode;

                        if (number != null) {
                            number = parseInt(number);

                            if (number > 0 && number <= 20) {
                                shortcode = '[recent-post number="' + number + '"/]';
                                // ed.execCommand('mceInsertContent', 0, shortcode);
                                ed.insertContent(shortcode);
                            } else {
                                alert('The number value is invalid. It should be from 0 to 20.');
                            }
                        }
                    }
                });

            });
        },

        /**
         * Creates control instances nased in the incoming name. This method is normally not needed since the
         * addButton method of the tinymce.Editor class is an easier way of adding buttons but you sometimes
         * need to create more complex controls like listboxes, split buttons etc. then this method can be
         * used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl: function(n, cm) {
            return null;
        },

        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl, and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function() {
            return {
                longname: 'Rocket Buttons',
                author: 'Claude Müller',
                authorurl: 'http://mediarocket.co.za',
                infourl: 'http://mediarocket.co.za',
                version: '0.1.'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('rocket', tinymce.plugins.Rocket); // using the plugin id and name
})();
