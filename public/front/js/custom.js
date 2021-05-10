"use strict";


  /**
   * Manages custom events
   *
   * @class Event
   * @private
   */
  var Event = {
    /**
     * Lazily evaluates which create method needed
     * @param eventName
     * @param [eventType=HTMLEvents] - type of event
     */
    create: function(eventName, eventType) {
      var method;
      var self = this;

      eventType = eventType || 'HTMLEvents';

      if (document.createEvent) {
        method = function(eventName) {
          var event = document.createEvent(eventType);

          // dont bubble
          event.initEvent(eventName, false, true);

          return event;
        };
      } else {
        // ie < 9
        // BUGFIX: Infinite loop on keypress in ie8
        // will update when i fix this
        method = function(eventName, eventType) {
          var _event = document.createEventObject(
            window.event
          );

          _event.cancelBubble = true;
          _event.eventType = eventName;
          return _event;
        };
      }

      self.create = method;
      return method(eventName);
    },

    /**
     * Lazily evaluates which fire event method is needed
     * @param el
     * @param eventName
     */
    fire: function(el, eventName, eventType, code) {
      var method;
      var self = this;

      if(document.createEvent) {
        method = function(el, eventName, eventType, code) {
          var event = self.create(eventName, eventType);

          if(eventType === 'KeyboardEvent') {
            var get = { get: function() { return code } };
            var defineProperty = Object.defineProperty;

            defineProperty(event, 'which', get);
            defineProperty(event, 'keyCode', get);
          }

          el.dispatchEvent(event);
        };
      } else {
        // ie < 9
        method = function(el, eventName, eventType, code) {
          var onEventName = ['on', eventName].join('');

          // Event names recognised by old ie
          // (without the 'on').
          // any event not in this list must be
          // handled differently in ie < 9
          var ieEvents = [
            'load',
            'unload',
            'blur',
            'change',
            'focus',
            'reset',
            'select',
            'submit',
            'abort',
            'keydown',
            'keypress',
            'keyup',
            'click',
            'dblclick',
            'mousedown',
            'mousemove',
            'mouseout',
            'mouseover',
            'mouseup'
          ];

          // no indexOf in old ie
          var isIeEvent = function(event) {
            for(var i = 0, l = ieEvents.length; i < l; i++) {
              if(ieEvents[i] === event) {
                return true;
              }
            }

            return false;
          };

          if(isIeEvent(eventName)) {
            // Existing ie < 9 event name
            var _event = self.create(eventName);

            _event.keyCode = code;

            el.fireEvent(onEventName, _event);
          } else if(el[onEventName]) {
            el[onEventName]();
          }
        };
      }

      self.fire = method;
      method(el, eventName);
    }
  };
  
  
// Global vars
var TWITTER_USERNAME = 'envato',
    GOOGLE_MAP_LAT = 40.7564971,
    GOOGLE_MAP_LNG = -73.9743277;


// Countdown
$(function() {
    $('.countdown').each(function() {
        var count = $(this);
        $(this).countdown({
            zeroCallback: function(options) {
                var newDate = new Date(),
                    newDate = newDate.setHours(newDate.getHours() + 130);

                $(count).attr("data-countdown", newDate);
                $(count).countdown({
                    unixFormat: true
                });
            }
        });
    });
});


// Bootstrap carousel
$('.carousel').carousel({
    interval: 6000
});

// Responsive video
$("body").fitVids();

// Sticky search
if ($('body').hasClass('sticky-search')) {
    var theLoc = $('.search-area').position().top;
    if ($('body').hasClass('sticky-header')) {
        var header_h = $('header.main').outerHeight();
    } else {
        header_h = 0;
    }

    $(window).scroll(function() {
        if (theLoc >= $(window).scrollTop()) {
            if ($('.search-area').hasClass('fixed')) {
                $('.search-area').removeClass('fixed').css({
                    top: 0
                });
            }
        } else {
            if (!$('.search-area').hasClass('fixed')) {
                $('.search-area').addClass('fixed').css({
                    top: header_h
                });
            }
        }
    });
}

// Sticky header
if ($('body').hasClass('sticky-header')) {
    var theLoc = $('header.main').position().top;
    $(window).scroll(function() {
        if (theLoc >= $(window).scrollTop()) {
            if ($('header.main').hasClass('fixed')) {
                $('header.main').removeClass('fixed');
            }
        } else {
            if (!$('header.main').hasClass('fixed')) {
                $('header.main').addClass('fixed');
            }
        }
    });
}

// Price slider
$("#price-slider").ionRangeSlider({
    min: 130,
    max: 575,
    type: 'double',
    prefix: "$",
    prettify: false,
    hasGrid: false
});

// Responsive navigation
$('#flexnav').flexNav();



// Lighbox text
$('.popup-text').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});

// Lightbox iframe
$('.popup-iframe').magnificPopup({
    dispableOn: 700,
    type: 'iframe',
    removalDelay: 160,
    mainClass: 'mfp-fade',
    preloader: false
});


$('#star-rating > li').each(function() {
    var list = $(this).parent(),
        listItems = list.children(),
        itemIndex = $(this).index();

    $(this).hover(function() {
        for (var i = 0; i < listItems.length; i++) {
            if (i <= itemIndex) {
                $(listItems[i]).addClass('hovered');
            } else {
                break;
            }
        };
        $(this).click(function() {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('selected');
                } else {
                    $(listItems[i]).removeClass('selected');
                }
            };
        });
    }, function() {
        listItems.removeClass('hovered');
    });
});


// Bootstrap tooltips
$('[data-toggle="tooltip"]').tooltip();



// Twitter
$("#twitter").tweet({
    username: TWITTER_USERNAME,
    count: 3
});

$("#twitter-ticker").tweet({
    username: TWITTER_USERNAME,
    page: 1,
    count: 20
});


// Checkboxes and radio
$('.i-check, .i-radio').iCheck({
    checkboxClass: 'i-check',
    radioClass: 'i-radio'
});


// Item quantity control (shopping cart)
$(".cart-item-plus").click(function() {
    var currentVal = parseInt($(this).prev(".cart-quantity").val());

    if (!currentVal || currentVal == "" || currentVal == "NaN") currentVal = 0;

    $(this).prev(".cart-quantity").val(currentVal + 1);
});

$(".cart-item-minus").click(function() {
    var currentVal = parseInt($(this).next(".cart-quantity").val());
    if (currentVal == "NaN") currentVal = 0;
    if (currentVal > 0) {
        $(this).next(".cart-quantity").val(currentVal - 1);
    }
});


// Card form
$('.form-group-cc-number input').payment('formatCardNumber');
$('.form-group-cc-date input').payment('formatCardExpiry');
$('.form-group-cc-cvc input').payment('formatCardCVC');


// Google map
if ($('#map-canvas').length) {
    var map,
        service;
    jQuery(function($) {
        $(document).ready(function() {
            var latlng = new google.maps.LatLng(GOOGLE_MAP_LAT, GOOGLE_MAP_LNG);
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);


            var marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
            marker.setMap(map);


            $('a[href="#google-map-tab"]').on('shown.bs.tab', function(e) {
                google.maps.event.trigger(map, 'resize');
                map.setCenter(latlng);
            });
        });
    });
}


$('.bg-parallax').each(function() {
    var $obj = $(this);

    $(window).scroll(function() {
        // var yPos = -($(window).scrollTop() / $obj.data('speed'));
        var animSpeed;
        if ($obj.hasClass('bg-blur')) {
            animSpeed = 10;
        } else {
            animSpeed = 15;
        }
        var yPos = -($(window).scrollTop() / animSpeed);
        var bgpos = '50% ' + yPos + 'px';
        $obj.css('background-position', bgpos);

    });
});

// Document ready functions
$(document).ready(function() {


    $('html').niceScroll({
        cursorcolor: "#000",
        cursorborder: "0px solid #fff",
        railpadding: {
            top: 0,
            right: 0,
            left: 0,
            bottom: 0
        },
        cursorwidth: "5px",
        cursorborderradius: "0px",
        cursoropacitymin: 0,
        cursoropacitymax: 0.7,
        boxzoom: true,
        horizrailenabled: false,
        zindex: 9999
    });


    // Owl Carousel
    var owlCarousel = $('#owl-carousel'),
        owlItems = owlCarousel.attr('data-items'),
        owlCarouselSlider = $('#owl-carousel-slider'),
        owlNav = owlCarouselSlider.attr('data-nav');
    // owlSliderPagination = owlCarouselSlider.attr('data-pagination');

    owlCarousel.owlCarousel({
        items: owlItems,
        navigation: true,
        navigationText: ['', '']
    });

    owlCarouselSlider.owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        // pagination: owlSliderPagination,
        singleItem: true,
        navigation: true,
        navigationText: ['', ''],
        transitionStyle: 'goDown',
        // autoPlay: 4500
    });


    // Twitter Ticker
    var ul = $('#twitter-ticker').find(".tweet-list");
    var ticker = function() {
        setTimeout(function() {
            ul.find('li:first').animate({
                marginTop: '-9em',
                opacity: 0
            }, 700, function() {
                $(this).detach().appendTo(ul).removeAttr('style');
            });
            ticker();
        }, 5000);
    };
    ticker();


     // footer always on bottom
    var docHeight = $(window).height();
   var footerHeight = $('#footer').height();
   var footerTop = $('#footer').position().top + footerHeight;
   
   if (footerTop < docHeight) {
    $('#footer').css('margin-top', (docHeight - footerTop) + 'px');
   }

});


// Lighbox gallery
$('#popup-gallery').each(function() {
    $(this).magnificPopup({
        delegate: 'a.popup-gallery-image',
        type: 'image',
        gallery: {
            enabled: true
        }
    });
});


// Lighbox image
$('.popup-image').magnificPopup({
    type: 'image'
});

$(window).load(function() {
    if ($(window).width() > 992) {
        $('#masonry').masonry({
            itemSelector: '.col-masonry'
        });
    }
});

$('.size_li').click(function(){
var id=$(this).data('id');
$('.size_li').removeClass('active');
$(this).addClass('active');

$('.color_li').removeClass('active');
$('.color_li').hide();
$('[data-sizeid="'+id+'"]').show();
$('.color_ul').find('li:visible:first').addClass('active');
	
});

$('.color_li').click(function(){
var id=$(this).data('id');
$('.color_li').removeClass('active');
$(this).addClass('active');
	
});

$('.add_to_cart').click(function(){
var size_id=$('.size_ul .active').data('id');
var color_id=$('.color_ul .active').data('id');
var target=$(this);
target.html('Adding to cart...');
var product_id=target.data('pid');

$.post(base_url+"product/add_to_cart",
		{size_id: size_id,
		 color_id:color_id,
		 product_id:product_id},
	 function(result){
		 if(result && result!="fail")
		 {
			 $(".shopping-cart-box").html(result); 
			 target.html('<i class="fa fa-shopping-cart"></i>Add to Cart');
			 target.parent().parent().append('<li><div class="alert alert-success fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Item Added to Cart</strong></div></li>');
		 }
		 else
		 {
			 
			 target.parent().parent().append('<li><div class="alert alert-warning fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Product Currenlty Not Available</strong></div></li>');
			 target.html('<i class="fa fa-shopping-cart"></i>Add to Cart');
		 }
     
    });


	
});


$('.service_single_select').change(function(){
var id=$(this).val();
var price=$(this).find(':selected').data('price');
	$('.product-info-price').html(price);
});


$('.add_service').click(function(){
var target=$(this);
var service_id=target.data('sid');
target.html('Adding to cart...');

$.post(base_url+"service/add_to_cart",
		{service_id:service_id},
	 function(result){
		 if(result && result!="fail")
		 {
			 $(".shopping-cart-box").html(result); 
			 target.html('<i class="fa fa-shopping-cart"></i> Add to Cart');
			 target.parent().parent().append('<li><div class="alert alert-success fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Item Added to Cart</strong></div></li>');
		 }
		 else
		 {
		
			 target.parent().parent().append('<li><div class="alert alert-warning fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Service Currenlty Not Available</strong></div></li>');
			 target.html('<i class="fa fa-shopping-cart"></i>Add to Cart');
		 }
     
    });

});


$('.add_service_list').click(function(){
var target=$(this)
var pid=target.data('id');

target.html('Adding to cart...');

$.post(base_url+"service/add_to_cart_list",
		{pid:pid},
	 function(result){
		 if(result && result!="fail")
		 {
			 $(".shopping-cart-box").html(result); 
			target.html('<i class="fa fa-shopping-cart"></i> To Cart');
			target.parent().parent().append('<li><div class="alert alert-success fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Item Added to Cart</strong></div></li>');
		 }
		 else
		 {
		
			 target.parent().parent().append('<li><div class="alert alert-warning fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Service Currenlty Not Available</strong></div></li>');
			 target.html('<i class="fa fa-shopping-cart"></i> To Cart');
		 }
     
    });


	
});


$(document).on('change', '#cart-quantity' ,function (e) {
var qty=$(this).val();
var pid=$(this).data('id');

			$.post(base_url+"product/qty_update",   // url
			  {pid:pid,qty:qty}, // data to be submit
			   function(data, status, jqXHR) { // success callback
			   var resp=JSON.parse(data);
			
			   
			   if(resp.status=='success')
			   {
				
					 $(".shopping-cart-box").html(resp.html); 
					 $("#cart_gst").html('₹'+resp.gst); 
					 $("#cart_subtotal").html('₹'+resp.subtotal); 
					 $("#cart_total").html('₹'+resp.gtotal); 
					 	 $("#td_subt").html('₹'+resp.subtotal); 
			   }
			   else
		 {
			 alert('Item can not be removed try again');
		 }
				}).done(function() { })
				  .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });
	
	
});

$('.cart-item-plus').click(function(){

var qty=$('#cart-quantity').val();
var pid=$('#cart-quantity').data('id');

			$.post(base_url+"product/qty_update",   // url
			  {pid:pid,qty:qty}, // data to be submit
			   function(data, status, jqXHR) { // success callback
			   var resp=JSON.parse(data);
			
			   
			   if(resp.status=='success')
			   {
				
					 $(".shopping-cart-box").html(resp.html); 
					 $("#cart_gst").html('₹'+resp.gst); 
					 $("#cart_subtotal").html('₹'+resp.subtotal); 
					 $("#cart_total").html('₹'+resp.gtotal); 
					 	 $("#td_subt").html('₹'+resp.subtotal); 
			   }
			   else
		 {
			 alert('Item can not be removed try again');
		 }
				}).done(function() { })
				  .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });


	
});

$('.cart-item-minus').click(function(){
if($('#cart-quantity').val()==0)
{
	$('#cart-quantity').val(1);
}

var qty=$('#cart-quantity').val();
var pid=$('#cart-quantity').data('id');

			$.post(base_url+"product/qty_update",   // url
			  {pid:pid,qty:qty}, // data to be submit
			   function(data, status, jqXHR) { // success callback
			   var resp=JSON.parse(data);
			
			   
			   if(resp.status=='success')
			   {
				
					 $(".shopping-cart-box").html(resp.html); 
					 $("#cart_gst").html('₹'+resp.gst); 
					 $("#cart_subtotal").html('₹'+resp.subtotal); 
					 $("#cart_total").html('₹'+resp.gtotal); 
					 $("#td_subt").html('₹'+resp.subtotal); 
					 
			   }
			   else
		 {
			 alert('Item can not be removed try again');
		 }
				}).done(function() { })
				  .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });


	
});



$('.add_to_cart_list').click(function(){
var target=$(this);
target.html('Adding to cart...');
var pid=target.data('id');

$.post(base_url+"product/add_to_cart_list",
		{pid:pid},
	 function(result){
		 if(result && result!="fail")
		 {
			 $(".shopping-cart-box").html(result); 
			 target.html('<i class="fa fa-shopping-cart"></i> To Cart');
			 target.parent().parent().append('<li><div class="alert alert-success fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Item Added to Cart</strong></div></li>');
		 }
		 else
		 {
			target.parent().parent().append('<li><div class="alert alert-warning fade in alert-dismissible" style="margin-top:10px;margin-bottom:0;padding:8px">'+'<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+'<strong>Product Currenlty Not Available</strong></div></li>');
			 target.html('<i class="fa fa-shopping-cart"></i> To Cart');
		 }
     
    });


	
});

$(document).ready(function() {
    $('.select2').select2();
	
	$('.select2').on('change', function (e) {
    var data = $(this).val();
	$.post(base_url+"home/set_city",
		{city:data},
	 function(result){
		 window.location.reload();
     
    });
    
});

	$('[name="add_profile_state"]').on('change', function (e) {
		var val=$(this).val();
		$('.city_sel_li').hide();
		$('.sel_li_'+val).show();
    
});

	$('#profile_state').on('change', function (e) {
		var val=$(this).val();
		$('.city_sel_li').hide();
		$('.sel_li_'+val).show();
    
});

});


	 $('.address-box-edit').click(function(){
	 
	 $('[name="edit_profile_address"]').val($(this).data('address'));
	 $('[name="edit_profile_state"]').val($(this).data('state'));
	 $('[name="edit_profile_city"]').val($(this).data('city'));
	 $('[name="edit_profile_zip"]').val($(this).data('zip'));
	 $('[name="edit_id"]').val($(this).data('eid'));
	 if($(this).data('default')==1)
	 {
		 
		$('[name="edit_is_default"]').attr('checked',true);
	 }
	 
	 
	 });
	 
	 
		 $('.cart-item-remove').click(function(){
			var pid=$(this).data('id');
			var type=$(this).data('type');
			$.post(base_url+type+"/remove_from_cart",   // url
			   { pid: pid}, // data to be submit
			   function(data, status, jqXHR) { // success callback
			   var resp=JSON.parse(data);
			
			   
			   if(resp.status=='success')
			   {
				   if(type=='product')
				   {
					  $("#"+pid).remove();  
				   }
				   else
				   {
					  $("#s"+pid).remove();   
				   }
					
					 $(".shopping-cart-box").html(resp.html); 
					 $("#cart_gst").html('₹'+resp.gst); 
					 $("#cart_subtotal").html('₹'+resp.subtotal); 
					 $("#cart_total").html('₹'+resp.gtotal); 
					
			   }
			   else
		 {
			 alert('Item can not be removed try again');
		 }
				}).done(function() { })
				  .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });


			});
			
			


				   $("#price_slider").ionRangeSlider({
						type: "double",
						grid: true,
						min: 100,
						max: 10000,
						from: service_price_from,
						to: service_price_to,
						prefix: "₹",
						onFinish: function (data) {
            console.log(data.fromNumber+' | '+data.toNumber);
			filter_by_price(data.fromNumber,data.toNumber);

        },
				   });
				   
				   
				   function updateQueryStringParameter(uri, key, value) {
      var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
      var separator = uri.indexOf('?') !== -1 ? "&" : "?";
      if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
      }
      else {
        return uri + separator + key + "=" + value;
      }
    }
				   
				   


