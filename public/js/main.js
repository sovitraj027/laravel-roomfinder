// $(document).ready(function () {


//******BELOW FUNCTIONS ARE ALSO IN HOME'S SECTION JS */
// function todominimize(to) {
//     $("#to").slideToggle("fast");
//     $('#aa').toggleClass('fa-angle-down fa-angle-up');
// }

// function closetodo() {
//     $("#todobox").hide();
//
// }

// function noticesminimize(obj) {
//     $('#notices').slideToggle("fast");
//     $(obj).toggleClass('fa-angle-down');
//     $(obj).toggleClass('fa-angle-up');
// }

// function closenotice() {
//     $("#noticebox").hide();
// }

// function closewelcome() {
//     $("#welcomebox").hide();
// }

// //  === login ===============
// function viewpass() {
//     var p = document.getElementById("password");
//     if (p.type === "password") {
//         p.type = "text";
//     } else {
//         p.type = "password";
//     }
//     $('#p_icon').toggleClass('fa-eye fa-eye-slash');
// }

// for sidebar toggle
$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
    $('#content').toggleClass('active');
});

// for enabling dropright by checking active status when clicking toggle
$('#sidebarCollapse').on('click', function () {
    if ($('#sidebar').hasClass('active')) {
        $('.dr').addClass('dropright');
        $('.drm').addClass('dropdown-menu w-100');
        // console.log("has active through button");
    } else {
        $('.dr').removeClass('dropright');
        $('.drm').removeClass('dropdown-menu w-100');
        // console.log("no actice through button");
    }
});

// for enabling dropright for small screens by checking window width
$(window).resize(function () {
    var ww = document.body.clientWidth;
    if (ww <= 768) {
        $('.dr').addClass('dropright');
        $('.drm').addClass('dropdown-menu w-100');
        // console.log("small screen ");
    } else if (ww >= 769) {
        $('.dr').removeClass('dropright');
        $('.drm').removeClass('dropdown-menu w-100');
        // console.log("big screen");
    };
});

// for enabling dropright according to sidbar's active status on window resize
$(window).resize(function () {
    if ($('#sidebar').hasClass('active')) {
        $('.dr').addClass('dropright');
        $('.drm').addClass('dropdown-menu w-100');
        // console.log("has active resizeeeee through WWWW");
    } else {
        $('.dr').removeClass('dropright');
        $('.drm').removeClass('dropdown-menu w-100');
        // console.log("no actice resizeeeee through WW");
    }
});

//for opening only one sidebar dropdown at a time
$("#sidebar a.dropdown-toggle").click(function () {
    $('.collapse').collapse('hide');
});

//for toggle sidebar fullscreen button
$('#full').on('click', function () {
    $('#i_full').toggleClass('fa-expand-arrows-alt fa-compress-arrows-alt');
});
// });




//      <script type="text/javascript">
//     if (typeof FullScreenHelper === "undefined") {
//       document.write("<p>FullScreenHelper is not loaded</p>");
//     } else if ($.fullScreenHelper("supported")) {
//       document.write("<p>Fullscreen is supported</p>");
//     } else {
//       document.write("<p>Your browser don't support fullscreen</p>");
//     }

//     //Use .bind or .on
//     $(document).on("fullscreenchange", function () {
//       if ($.fullScreenHelper("state")) {
//         console.log("In fullscreen", $(":fullscreen"));
//       } else {
//         console.log("Not in fullscreen");
//       }
//     });
//   </script>
