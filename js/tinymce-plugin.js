(function(){
  tinymce.create('tinymce.plugins.RandomNerds', {
    init: function(ed, url) {
      ed.addButton('blockquote_right', {
        title: 'Blockquote-Right',
        image: '../wp-content/themes/random-nerds/images/quote-right.png',
        cmd: 'blockquote_right'
      });
      ed.addCommand('blockquote_right', function(){
        var selectedText = ed.selection.getContent();
        var returnText = '';
        returnText = '<blockquote class="right">' + selectedText + '</blockquote>';
        ed.execCommand('mceInsertContent', 0, returnText);
      });
    },
    createControl : function(n, cm) {
      return null;
    },
    getInfo: function() {
      return { longname: 'Random Nerds', author: 'Friendly Design Co' };
    }
  });
  tinymce.PluginManager.add('randomnerds',tinymce.plugins.RandomNerds);
})();
