$(document).ready(function(){

    //Call actions player
    function callPlayer(frame_id, func, args, type) {
        let iframe = document.getElementById(frame_id);
        if (iframe && iframe.tagName.toUpperCase() !== 'IFRAME') {
            iframe = iframe.getElementsByTagName('iframe')[0];
        }
        if (iframe) {
            // Frame exists,
            iframe.contentWindow.postMessage(JSON.stringify({
                "event": "command",
                "func": func,
                "args": args || [],
                "id": frame_id
            }), "*");
        }
        if(type === 'video'){
            let video = document.getElementById(frame_id);
            if(video && video.tagName.toUpperCase() !== 'VIDEO'){
                video = video.getElementsByTagName('video')[0];
            }

            if(video){
                video.muted = true
                func === 'pauseVideo' ? video.pause() : video.play();
            }
        }

    }

    //Once
    $('iframe').each(function(i) {
        $(this).attr('id', 'iframe'+(i+1));

        var numsrc = $(this).attr('src');
        var existe = numsrc.indexOf("?enablejsapi=1");
        if(existe === -1){
            var res = numsrc.replace(numsrc, numsrc+"?enablejsapi=1");
            $(this).attr('src', res);
        }
    });
    $('video').each(function(i) {
        $(this).attr('id', 'video'+(i+1));
    });

    //On scroll
    $(window).scroll(function(){
        $('iframe').is(function() {
            let viwewing =  $(this).visible();
            let numvalue = $(this).attr('id');
            let numsrc = $(this).attr('src');

            //si es el ID visible
            if(viwewing){
                callPlayer( numvalue,"playVideo", [],'iframe');
                callPlayer( numvalue,"unMute", [],'iframe');
            }

            //pausa todos los videos
            else{
                callPlayer( numvalue,"pauseVideo", [],'iframe');
                callPlayer( numvalue,"mute", [],'iframe');
            }
        });
        $('video').is(function() {
            let viwewing =  $(this).visible();
            let numvalue = $(this).attr('id');
            let numsrc = $(this).attr('src');

            //si es el ID visible
            if(viwewing){
                callPlayer( numvalue,"playVideo", [], 'video');
            }
            //pausa todos los videos
            else{
                callPlayer( numvalue,"pauseVideo", [], 'video');
            }
        });
    })
})
