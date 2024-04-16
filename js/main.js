$(function() {
    var last_url = document.location.pathname.split('/').pop();
    $('nav').find('a.active').removeClass('active');
    $('.mob_nav').find('a.active').removeClass('active');

    $('nav').find("a[href='"+last_url+"']").addClass('active');
    $('.mob_nav').find("a[href='"+last_url+"']").addClass('active');
});

AOS.init({
easing: 'ease-in-sine',
once: true,
});
$(window).scroll(function(){
    $(".explore").css("opacity", 1 - $(window).scrollTop() / 5);
});
$(document).ready(function(){
    $(this).scrollTop(0);
});

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var reachedTop = 150;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 50);

function hasScrolled() {
    var st = $(this).scrollTop();
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    if (st < reachedTop){
        // Scroll Down
        $('header').removeClass('nav_back');
    } else {
        // Scroll Up
        $('header').addClass('nav_back');
    }
    lastScrollTop = st;
}

//for mobile menu menu

$('#nav-icon').click(function(){
$(this).toggleClass('open');
});
$("#nav-icon.open").click(function(e) {
$(".mob_nav").hide();
e.stopPropagation();
});
$("#nav-icon").click(function(e){
$(".mob_nav").slideToggle(500);
e.stopPropagation();
console.log($(this).hasClass('open'));
if($(this).hasClass('open')){
$('body,html').attr('style','overflow:hidden;');
}
else{
$('body,html').attr('style','overflow-y:auto;height: auto;');
}
});
$('.menulist li a').click(function() {
$(".mob_nav").slideToggle(500, 'linear');
$('#nav-icon').toggleClass('open');
$('body,html').attr('style','overflow-y:auto;height: auto;');
});

/* for ios background scroll problem in open mob menu */
var fixed = document.getElementById('mob_fixed'); fixed.addEventListener('touchmove', function(e) { e.preventDefault(); }, false); 

$('.mob_nav .menulist li').click(function(){
$('.mob_nav .menulist li').removeClass('active');
$(this).addClass('active');
});

// scroll to open collapse accordian
$('.pill_accordian_data').on('shown.bs.collapse', function(e) {
    var $panel = $(this).closest('.pill_accordian');
    $('html,body').animate({
        scrollTop: $panel.offset().top
    }, 500);
});

// get system time
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var ampm = h >= 12 ? 'pm' : 'am';
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('sys-time').innerHTML =
    h + ":" + m + ' ' + ampm + ',';
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}