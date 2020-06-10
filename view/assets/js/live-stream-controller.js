function updateStreamLink(){
    var fd = new FormData();
    fd.append('vid_id', $('#vid_id').val())
    $.ajax({
        url: CONSTANTS.YOUTUBE_LIVE_LINK_URL,
        dataType: 'text',
        type: 'post',
        data: fd,
        cache     : false,
        contentType: false,
        processData: false,

        beforeSend: function () {
         $('.loading-overlay').show();
        },

        success : function(output){
          alert(output)
          $("#youtube").html(output);
        }
    });
}