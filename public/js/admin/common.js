jQuery(document).ready(function () {
    jQuery('.trumbowyg').trumbowyg();
    jQuery('.data-select-all').select2();
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $('body').on('click', '.showCommonModel:not(.disabled)', function (e) {
        e.preventDefault();
        jQuery.ajax({
            url: jQuery(this).attr('href')
        }).done(function (data) {
            jQuery('.common_ajax').html(data)
            console.log(data)
        }).fail(function () {
            alert('không thể tải , vui lòng thử lại');
        });
    });
    // $('body').on('click', '#btnConfirmDeleteCommon', function(e) {
    //     e.preventDefault();
    //     $('#confirmSaveCommon').plainModal('open', {overlay: {color: '#000', opacity: 0.9}});
    // });
    jQuery('body').on('click', '#btnConfirmDeleteCommon', function(e) {
        jQuery('.formConfirmDeleteCommon').submit();
    });
    jQuery('body').on('click', '.submitDelete', function(e) {
        e.preventDefault();
    });

    // jquery('body').on('click', '.submit-form', function (e) {
    //     $("#form").submit(function(e){
    //         e.preventDefault();
    //     });
    // })

    jQuery("input[name='image-service']").change( function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
        jQuery(".show_image").empty().fadeIn("fast").html('<img src="' + tmppath + '" />');
        jQuery(".show_image > img").attr('src', tmppath).css({'width' : '200px', 'margin-bottom': '10px'});
    });

//    gui
    var innerBlock = jQuery('.mother-grid-inner > .inner-block').outerHeight();
    console.log(innerBlock);
    var copyrights = jQuery('.copyrights').outerHeight();
    var heightContent = innerBlock + copyrights;
    console.log(heightContent);
    var wi =window.innerHeight;

    var he = window.innerHeight - heightContent;
    if (wi > innerBlock) {
        jQuery('.inner-block').css('padding-bottom', he, '!important');
        jQuery('.mother-grid-inner > .inner-block').css('padding-bottom', he);
    }
})