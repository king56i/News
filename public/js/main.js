

(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        dotsData: true,
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            }
        }
    });


    // Portfolio isotope and filter
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });
    $('#portfolio-filters li').on('click', function () {
        $("#portfolio-filters li").removeClass('active');
        $(this).addClass('active');

        portfolioIsotope.isotope({filter: $(this).data('filter')});
    });
    $('.noi-dung').each(function() {
        var text = $(this).text();  // Lấy nội dung hiện tại của phần tử
        if (text.length > 20) {
            $(this).text(text.slice(0, 50) + '...');  // Cắt 20 ký tự và thêm '...'
        }
    });
})(jQuery);
   CKEDITOR.ClassicEditor.create(document.getElementById("NoiDung"), {
         toolbar: {
            items: [
               'heading', '|','findAndReplace', 'selectAll', '|',
               'bold', 'italic', 'underline', 'subscript', 'superscript', 'removeFormat', '|',
               'bulletedList', 'numberedList', '|','outdent', 'indent', '|',
               '-',
               'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
               'alignment', '|',
               'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyBlock', '|',
               'link', 'insertImage', 'insertTable', 'mediaEmbed', '|',
                'horizontalLine', '|','sourceEditing'
            ],
            image: {
               toolbar: ['imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:side']
            },
            shouldNotGroupWhenFull: true
         },
         // Changing the language of the interface requires loading the language file using the <script> tag.
         // language: 'es',
         list: {
            properties: {
               styles: true,
               startIndex: true,
               reversed: true
            }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
         heading: {
            options: [
               { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
               { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
               { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
               { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
               { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
               { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
               { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
         placeholder: 'Welcome to CKEditor 5!',
         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
         fontFamily: {
            options: [
               'default',
               'Arial, Helvetica, sans-serif',
               'Courier New, Courier, monospace',
               'Georgia, serif',
               'Lucida Sans Unicode, Lucida Grande, sans-serif',
               'Tahoma, Geneva, sans-serif',
               'Times New Roman, Times, serif',
               'Trebuchet MS, Helvetica, sans-serif',
               'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
         fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
         },
         // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
         // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
         htmlSupport: {
            allow: [
               {
                     name: /.*/,
                     attributes: true,
                     classes: true,
                     styles: true
               }
            ]
         },
         // Be careful with enabling previews
         // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
         htmlEmbed: {
            showPreviews: true
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
         link: {
            decorators: {
               addTargetToExternalLinks: true,
               defaultProtocol: 'https://',
               toggleDownloadable: {
                     mode: 'manual',
                     label: 'Downloadable',
                     attributes: {
                        download: 'file'
                     }
               }
            }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
         mention: {
            feeds: [
               {
                     marker: '@',
                     feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                     ],
                     minimumCharacters: 1
               }
            ]
         },
         // The "super-build" contains more premium features that require additional configuration, disable them below.
         // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
         removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
         ]
   });
