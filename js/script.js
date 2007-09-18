var title = document.title;

function updateTitle(href) {
    document.title = $('#nav>li>a[@href="'+href+'"]').text() + ' @ ' + title;
}

$(function() {
        $('#devcontent').load('developer.html');
        $('#discovercontent').load('discover.html');
        $('#aboutcontent').load('about.html');

        updateTitle(this.location.hash);

        $('#container').tabs({ 
            //fxFade: 'true',
            //fxSpeed: 'fast',
            fxAutoHeight: true,
            onShow: function(){
                updateTitle(this.location.hash);
                }
            });
        });
