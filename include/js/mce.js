(function() {
  tinymce.PluginManager.add('biol_beautify_link_mcebutton', function( editor, url ) {
      editor.addButton('biol_beautify_link_mcebutton', {
                 title: 'Add New BIOL Link',
                 image: url + '/img/icon.png',
                  onclick: function() {
                     var winManager=editor.windowManager;
                    var win = winManager.open({
                       title: 'Add New BIOL Link',
                       inline: 1,
                       resizable: false,
                       body: [
                         {
                           type: 'textbox',
                           name: 'ltext',
                           label: 'Link Text',
                           minWidth: 300,
                           placeholder:'Link to more content',
                           value: ''
                         },
                         {
                           type: 'textbox',
                           name: 'url',
                           label: 'URL',
                           placeholder:'https://domain.com',
                           minWidth: 300,
                           value: ''
                         },
                         {
                           type: 'checkbox',
                           name: 'check',
                           label: 'Nofollow',
                           value: ''
                         },  
                         {
                           type: 'checkbox',
                           name: 'openTab',
                           label: 'Open in New Tab',
                           value: ''
                         }, 
                       ],
                         buttons: [
                           {
                             text: "Add",
                             subtype: "primary",
                             onclick: function() {
                               win.submit();
                             }
                           },
                           {
                             text: "Cancel",
                             onclick: function() {
                               win.close();
                             }
                           }
                       ],
                          onsubmit: function( e ) { 
                           var params=[];
                           var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                           '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                           '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                           '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                           '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                           '(\\#[-a-z\\d_]*)?$','i');
                          if(e.data.ltext.length == 0&&e.data.url.length == 0)
                          {
                           winManager.alert('Add a text and URL');
                            e.preventDefault();
                          }
                          else if( e.data.ltext.length == 0 )
                          {
                           winManager.alert('Add Link text');
                            e.preventDefault();
                          }
                          else if(e.data.ltext.length == 0 ||!pattern.test(e.data.url))
                          {
                           winManager.alert('Oops! URL is not valid');
                           e.preventDefault();
                          }
                          else{
                           params.push('ltext="' + e.data.ltext + '"');
                           params.push('url="' + e.data.url + '"');
                          }
                          
                          if( e.data.url.length > 0 && e.data.ltext.length > 0&& pattern.test(e.data.url)) {
                            if( e.data.check == true ) {
                              params.push('follow="no"');
                            }
                            if(e.data.openTab==true)
                            {
                            params.push('opentab="yes"');
                           }
                            paramsString=params.join(' ');
                            var stagf='<!-- wp:shortcode -->';
                            var stagb='<!-- /wp:shortcode -->';
                            var returnText =stagf+ '[biol ' + paramsString  + ']'+stagb;
                          editor.insertContent(returnText);
                          }  
                      }
                            
                     });
                 },
        });
  });
})();