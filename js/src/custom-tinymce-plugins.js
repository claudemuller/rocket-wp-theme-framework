(function() {
    tinymce.create('tinymce.plugins.quote', {  // create plugin called quote
        init: function(ed, url) {  // ed points to editor; url points to url of the plugin code
            console.log(url);
            ed.addButton('quote', {
                title: 'Add a quote',
                image: url + '/images/quote.png',
                onclick: function() {
                    ed.selection.setContent('[quote]' + ed.selection.getContent() + '[/quote]');  // gets selected text and wraps it
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);
})();
