jQuery(document).ready(function($){
    $(".divgallerys").hide();
    $(".divgallerys_1").show();
    $(".add_img_10").hide();

    var meta_image_frame_1;
    $('.pic_img_btn_1').click(function(e){
        jQuery(".divgallerys_1 a").show();
        e.preventDefault();
        if ( meta_image_frame_1 ) {
            meta_image_frame_1.open();
            return;
        }
        meta_image_frame_1 = wp.media.frames.meta_image_frame_1 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_1.on('select', function(){
            var media_attachment = meta_image_frame_1.state().get('selection').first().toJSON();
            $('.pic_name_show_1').val(media_attachment.url);
            $('.pic_img_show_1').replaceWith('<img class="pic_img_show_1" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_1.open();
    });

    var meta_image_frame_2;
    $('.pic_img_btn_2').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_2 ) {
            meta_image_frame_2.open();
            return;
        }
        meta_image_frame_2 = wp.media.frames.meta_image_frame_2 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_2.on('select', function(){
            var media_attachment = meta_image_frame_2.state().get('selection').first().toJSON();
            $('.pic_name_show_2').val(media_attachment.url);
            $('.pic_img_show_2').replaceWith('<img class="pic_img_show_2" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_2.open();
    });

    var meta_image_frame_3;
    $('.pic_img_btn_3').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_3 ) {
            meta_image_frame_3.open();
            return;
        }
        meta_image_frame_3 = wp.media.frames.meta_image_frame_3 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_3.on('select', function(){
            var media_attachment = meta_image_frame_3.state().get('selection').first().toJSON();
            $('.pic_name_show_3').val(media_attachment.url);
            $('.pic_img_show_3').replaceWith('<img class="pic_img_show_3" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_3.open();
    });

    var meta_image_frame_4;
    $('.pic_img_btn_4').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_4 ) {
            meta_image_frame_4.open();
            return;
        }
        meta_image_frame_4 = wp.media.frames.meta_image_frame_4 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_4.on('select', function(){
            var media_attachment = meta_image_frame_4.state().get('selection').first().toJSON();
            $('.pic_name_show_4').val(media_attachment.url);
            $('.pic_img_show_4').replaceWith('<img class="pic_img_show_4" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_4.open();
    });

    var meta_image_frame_5;
    $('.pic_img_btn_5').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_5 ) {
            meta_image_frame_5.open();
            return;
        }
        meta_image_frame_5 = wp.media.frames.meta_image_frame_5 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_5.on('select', function(){
            var media_attachment = meta_image_frame_5.state().get('selection').first().toJSON();
            $('.pic_name_show_5').val(media_attachment.url);
            $('.pic_img_show_5').replaceWith('<img class="pic_img_show_5" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_5.open();
    });


    var meta_image_frame_6;
    $('.pic_img_btn_6').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_6 ) {
            meta_image_frame_6.open();
            return;
        }
        meta_image_frame_6 = wp.media.frames.meta_image_frame_6 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_6.on('select', function(){
            var media_attachment = meta_image_frame_6.state().get('selection').first().toJSON();
            $('.pic_name_show_6').val(media_attachment.url);
            $('.pic_img_show_6').replaceWith('<img class="pic_img_show_6" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_6.open();
    });

    var meta_image_frame_7;
    $('.pic_img_btn_7').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_7 ) {
            meta_image_frame_7.open();
            return;
        }
        meta_image_frame_7 = wp.media.frames.meta_image_frame_7 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_7.on('select', function(){
            var media_attachment = meta_image_frame_7.state().get('selection').first().toJSON();
            $('.pic_name_show_7').val(media_attachment.url);
            $('.pic_img_show_7').replaceWith('<img class="pic_img_show_7" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_7.open();
    });

    var meta_image_frame_8;
    $('.pic_img_btn_8').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_8 ) {
            meta_image_frame_8.open();
            return;
        }
        meta_image_frame_8 = wp.media.frames.meta_image_frame_8 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_8.on('select', function(){
            var media_attachment = meta_image_frame_8.state().get('selection').first().toJSON();
            $('.pic_name_show_8').val(media_attachment.url);
            $('.pic_img_show_8').replaceWith('<img class="pic_img_show_8" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_8.open();
    });

    var meta_image_frame_9;
    $('.pic_img_btn_9').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_9 ) {
            meta_image_frame_9.open();
            return;
        }
        meta_image_frame_9 = wp.media.frames.meta_image_frame_9 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_9.on('select', function(){
            var media_attachment = meta_image_frame_9.state().get('selection').first().toJSON();
            $('.pic_name_show_9').val(media_attachment.url);
            $('.pic_img_show_9').replaceWith('<img class="pic_img_show_9" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_9.open();
    });

    var meta_image_frame_10;
    $('.pic_img_btn_10').click(function(e){
        e.preventDefault();
        if ( meta_image_frame_10 ) {
            meta_image_frame_10.open();
            return;
        }
        meta_image_frame_10 = wp.media.frames.meta_image_frame_10 = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });
        meta_image_frame_10.on('select', function(){
            var media_attachment = meta_image_frame_10.state().get('selection').first().toJSON();
            $('.pic_name_show_10').val(media_attachment.url);
            $('.pic_img_show_10').replaceWith('<img class="pic_img_show_10" src="'+media_attachment.url+'" style="height: 35px;position: absolute;top: -5px;" />');
        });
        meta_image_frame_10.open();
    });

    $(".add_img").click(function(){
        $(this).parent().next().show(); // next div show
        $(this).hide(); // this button add. hide
        $(this).next().hide(); //this button del. hide
    }); 
    $(".remove_img").click(function(){
        $(this).parent().hide(); // this div hide
        $(this).parent().prev().show(); // prev div show 
    });
        $(".remove_img_1").click(function(){
            $(this).parent().show(); // div 1 show all time
            $(".pic_name_show_1").val(''); 
            $(".pic_img_show_1").hide();
        });
        $(".remove_img_2").click(function(){
            $(".divgallerys_1 a").show();
            $(".pic_name_show_2").val('');
            $(".pic_img_show_2").hide();
        });
        $(".remove_img_3").click(function(){
            $(".divgallerys_2 a").show();
            $(".pic_name_show_3").val('');
            $(".pic_img_show_3").hide();
        });
        $(".remove_img_4").click(function(){
            $(".divgallerys_3 a").show();
            $(".pic_name_show_4").val('');
            $(".pic_img_show_4").hide();
        });
        $(".remove_img_5").click(function(){
            $(".divgallerys_4 a").show();
            $(".pic_name_show_5").val('');
            $(".pic_img_show_5").hide();
        });
        $(".remove_img_6").click(function(){
            $(".divgallerys_5 a").show();
            $(".pic_name_show_6").val('');
            $(".pic_img_show_6").hide();
        });
        $(".remove_img_7").click(function(){
            $(".divgallerys_6 a").show();
            $(".pic_name_show_7").val('');
            $(".pic_img_show_7").hide();
        });
        $(".remove_img_8").click(function(){
            $(".divgallerys_7 a").show();
            $(".pic_name_show_8").val('');
            $(".pic_img_show_8").hide();
        });
        $(".remove_img_9").live('click', function() { 
            $(".divgallerys_8 a").show();
            $(".pic_name_show_9").val('');
            $(".pic_img_show_9").hide();
        });
        $(".remove_img_10").click(function(){
            $(".divgallerys_9 a").show();
            $(".pic_name_show_10").val('');
            $(".pic_img_show_10").hide();
        });


    if ($(".pic_name_show_2").val() != '') {
        $(".divgallerys_2").show();
        $(".divgallerys_1 a").hide();
    };
        
    if ($(".pic_name_show_3").val() != '') {
        $(".divgallerys_3").show();
        $(".divgallerys_2 a").hide();
    };
     
    if ($(".pic_name_show_4").val() != '') {
        $(".divgallerys_4").show();
        $(".divgallerys_3 a").hide();
    };

    if ($(".pic_name_show_5").val() != '') {
        $(".divgallerys_5").show();
        $(".divgallerys_4 a").hide();
    };

    if ($(".pic_name_show_6").val() != '') {
        $(".divgallerys_6").show();
        $(".divgallerys_5 a").hide();
    };

    if ($(".pic_name_show_7").val() != '') {
        $(".divgallerys_7").show();
        $(".divgallerys_6 a").hide();
    };

    if ($(".pic_name_show_8").val() != '') {
        $(".divgallerys_8").show();
        $(".divgallerys_7 a").hide();
    };

    if ($(".pic_name_show_9").val() != '') {
        $(".divgallerys_9").show();
        $(".divgallerys_8 a").hide();
    };

    if ($(".pic_name_show_10").val() != '') {
        $(".divgallerys_10").show();
        $(".divgallerys_9 a").hide();
    };      
});