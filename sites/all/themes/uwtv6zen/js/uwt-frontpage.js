/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - http://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {
var winwidth = $(window).width();

if(winwidth >= 801){
// 29th Drive's js
Drupal.behaviors.frontpage = {
  attach: function (context, settings) {

    // Disable the links on the homepage blocks in wide screen
    $("#persona #blocks h2 a").attr({href: "#"});

  $('.date-display-single').each(function() {
		$(this).html( $(this).html().replace('(All day)','') );
	});

  $('.jump-links-sub-list > a').click(function() {
    if ($('.jump-links-sub-list').find(':animated').length) return false;
    var item = $(this);
    item.closest('.jump-links-sub-list').toggleClass('selected');
    item.siblings('ul').animate({
      height: 'toggle'
    }, {
      complete: function() {
        $(this).toggleClass('expanded');
      }
    });

    $('.jump-links-sub-list.selected').find('.expanded').animate({
      height: 'toggle'
    }, {
      complete: function() {
        $(this).toggleClass('expanded').parents('.selected').toggleClass('selected');
      }
    });

    return false;
  });  
  
//	transformDate(2011);
	
    var blocks = $('#blocks h2 a');
    var b = blocks.length;
    SetPositions(blocks);
	
	for(var i=0;i<b;i++) {
		var currentBlock = $(blocks[i]);
		currentBlock
			.data('Persona', currentBlock.text().replace(/ |&/g, ''))
			
			.click(function () {
				PersonaBlockClick(blocks, this);
				//return false;
			})
			
			.hover(function () {hoverFades(1, $(this));}, 
				function () {hoverFades(0, $(this));
			})

			.find('.img').css({
				opacity: 0
			});
    }

    $('a[class="close"]').click(function () {
        ClosePersona(blocks);
        //return false;
    });
    newFade();
		
		var homepagePath = document.location.toString().split("#");
		var blockAnchor = (homepagePath.length > 1) ? homepagePath[1]: null;
		if(blockAnchor) {
			loadNoAnimate($("."+blockAnchor),blocks);
		}
		else {
			var blockAnchorCookie = getCookie('blockAnchor');
			if(blockAnchorCookie != "" && blockAnchorCookie != null && blockAnchorCookie != undefined) {
				loadNoAnimate($("."+getCookie('blockAnchor')),blocks);
			}
			else {
				personaLoadAnimation(blocks);
			}
		}

    $('li.more').hover(function () {
        $(this).find('ul').css({
            display: 'block'
        });
        animateHeight();
    }, function () {
        $(this).find('ul').css({
            display: 'none'
        });
        animateHeight();
    });
	
	$('#videoList').hover(function() {
	Shadowbox.init();
	});
	
	anchorJumpLinks(getCookie('blockAnchor'));
	
	// Automagically add external link icons to any links which leave the domain
	$('.editable-area a[href^="http"]').filter(':not([href*="tacoma.uw.edu"])').filter(':not([href*="tacoma.washington.edu"])').addClass('external');
    
    //end document ready



	function anchorJumpLinks(blockAnchor){
		$('.jump-links').children().each(function(index) { 
			if($(this).attr('id') == blockAnchor) {
				$(this).addClass('selected');
				$(this).find('ul').addClass('expanded');
			}
			else {
				$(this).removeClass('selected');
				$(this).find('ul').removeClass('expanded');
			}
		});
	}

	function loadNoAnimate(item, blocks) {
		
			$('#persona').removeAttr('style').css('minHeight', '720px').addClass('expanded');
			$('.trim').text('Support UW');
			
			blocks.each(function (index) {
				$(this).css({
					width: 120,
					height: 100,
					top: 120 * index,
					left: 0
				});
			});
			
			var SelectedPersona =  blocks.eq(blocks.index(item));
			var ActivePersona = $('#' + SelectedPersona.data('Persona'));
			$('#persona').animate({
				height: ActivePersona.height() + 10
			}, 500);
			ActivePersona.show().addClass('persona-active');
			item.find('.img').css({opacity: 1}).addClass('activated');
	}
function hoverFades(opacity, it) {
if(!(it.find('.img').hasClass('activated'))){
	it.find('.img').stop(false, false).animate({
		opacity: opacity
	}, 500);


	}
}
	
function animateHeight() {
    var ActivePersona = $('.persona-active').find('.content-container');
    $('#persona').stop(false, false).animate({
        height: ActivePersona.height() + 20
    }, 500);
}

function personaLoadAnimation(blocks) {
    $('#persona').removeAttr('style').css('minHeight', '0px').animate({
        minHeight: 540
    }, {
        duration: 700,
        easing: 'swing'
    });
	
	var blockIndex = 0;
    blocks.css({
        top: 0,
        left: 330
    }).each(function (index) {
        var it = $(this),
            originalPosition = it.data('originalPosition'),
            rand = Math.floor(Math.random() * 11) * 100;
        (index < 3) && (rand += 300);

        setTimeout(function () {
            fadeInOut(it);
        }, rand);

        it.animate({
            left: originalPosition[0],
            top: 270
        }, {
            duration: 700,
            easing: 'swing',
            complete: function () {
                toPosition(it);
                $('#persona').removeAttr('style').css('minHeight', '540px');
            }
        });
    });
}

function fadeInOut(it) {
    it.find('.img').animate({
        opacity: 1
    }, {
        duration: 1400,
        complete: function () {
            $(this).animate({
                opacity: 0
            }, {
                duration: 1400
            });
        }
    });
}

function toPosition(it) {
    var originalPosition = it.data('originalPosition');
    it.animate({
        left: originalPosition[0],
        top: [originalPosition[1], 'swing']
    }, {
        duration: 800
    });
}

function SetPositions(blocks) {
var b=blocks.length;
  for(var i=0;i<b;i++){
    var currentBlock = blocks[i],left=currentBlock.offsetLeft - 10,top=currentBlock.offsetTop - 10;

    $(currentBlock)
      .data('originalPosition', [left, top])
      .css({left: left,top: top});

    // Can you feel the ghettofabulusousness? Can you spell it? Neither can I.
    if(checkVersion() == "ie8") {
      $('a.current-students')
      .data('originalPosition', [0, 0]);
      
      $('a.freshmen')
        .data('originalPosition', [350, 0]);

      $('a.prospective-students')
        .data('originalPosition', [700, 0]);

      $('a.community')
        .data('originalPosition', [0, 270]);

      $('a.faculty-staff')
        .data('originalPosition', [350, 270]);

      $('a.support-uw-tacoma')
        .data('originalPosition', [700, 270]);
    }
  }
  blocks.css('position', 'absolute');
}

/* fade */

function newFade() {
    var imgList = ['/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage1.jpg',
                   '/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage2.jpg',
                   '/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage3.jpg',
                   '/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage4.jpg',
                   '/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage5.jpg',
                   '/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage6.jpg',
                   '/sites/all/themes/uwtv6zen/images/home/backgrounds/HomePage7.jpg',],
		img = '';
    $('#slide').append('<div id="slideWrap" />');
	
	var l = imgList.length;
	for(var i=0;i<l;i++) {
        img += '<img src="' + imgList[i] + '" />';
	}
    $('#slideWrap').append(img);
    startFade();
	
}

function startFade() {
    var imgs = $('#slideWrap > img');
    imgs.css('zIndex', -2).eq(0).addClass('current-slide').end()
		.filter(':not(:eq(0))').css('opacity', 0);
    setTimeout(function () {
        nextFade(imgs)
    }, 14000);
}

function nextFade(imgs) {
    var cs = $('.current-slide'),
		next = cs.next();
    (next.length === 0) && (next = imgs.eq(0));
    next.addClass('next').css({
        zIndex: -1
    }).animate({
        opacity: 1
    }, {
        duration: 4000,
        complete: function () {
            cs.css('opacity', 0).removeClass('current-slide');
            next.removeClass().addClass('current-slide').css({
                zIndex: -2
            });
            setTimeout(function () {
                nextFade(imgs)
            }, 14000);
        }
    })

} /* end fade */

function ClosePersona(blocks) {
	setCookie('blockAnchor', '', 1);
	$('.activated').removeClass('activated').css({opacity: 0});
    $('.persona-active').fadeOut('fast').removeClass('persona-active');
    $('.trim').text('Support UW Tacoma');
	
	var b=blocks.length;
		for (var i=0;i<b;i++) {
			var currentBlock = blocks[i],
			originalPosition = $(currentBlock).data('originalPosition');
			$(currentBlock)
			
			.css({top: 120 * i, left: 0, display: 'block'})
			
			.animate({
				width: 300,
				height: 240,
				left: originalPosition[0],
				top: [originalPosition[1], 'swing']
			}, {
				duration: 500,
				complete: function () {
					$('#persona').removeClass('expanded');
				}
			});
			
		}
		
		$('#persona').stop(true, true).animate({
			minHeight: 540, height:540
		}, 500);
}

function PersonaBlockClick(blocks, currentBlock) {
	setCookie('blockAnchor', $(currentBlock).attr('class'), 1);
	
    var SelectedPersona = blocks.index(currentBlock),
        persona = $('#persona'),
        firstTime = false;
    if (!(persona.hasClass('expanded'))) {
        persona.addClass('expanded').animate({
            minHeight: '720px'
        });
        firstTime = true
    }
    if (!firstTime) {
        blocks.show();
        expandedPersonaClick(blocks, SelectedPersona);
    } else {
        unexpandedPersonaClick(blocks, SelectedPersona);
    }

}

function unexpandedPersonaClick(blocks, SelectedPersona) {
    $('.trim').text('Support UW');
    var selected = blocks.eq(SelectedPersona).clone();
	selected.data('Persona',blocks.eq(SelectedPersona).data('Persona'));
	selected.find('.img').addClass('selected');
	blocks.eq(SelectedPersona).after(selected);
    blocks.each(function (index) {
        $(this).stop(true, true).animate({
            width: 120,
            height: 100,
            top: [120 * index, 'swing'],
            left: 0
        }, {
            duration: 500
        });
    });

	animatePersonaBlock(blocks, selected);
	blocks.eq(SelectedPersona).find('.img').css({opacity: 1}).addClass('activated');
}

function expandedPersonaClick(blocks, SelectedPersona) {
	$('.activated').removeClass('activated').animate({opacity: 0},{duration:400});
    $('.persona-active').fadeOut('fast').removeClass('persona-active');
	blocks.eq(SelectedPersona).find('.img').addClass('activated');
	var selected = blocks.eq(SelectedPersona).clone();
	selected.data('Persona',blocks.eq(SelectedPersona).data('Persona'));
	selected;
	blocks.eq(SelectedPersona).after(selected);
	selected.animate({
            left: 140
        }, {
            complete: function () {
                animatePersonaBlock(blocks, $(this));
            }
			});
			
}

function animatePersonaBlock(blocks, it) {
    it.animate({
        top: 0,
        left: [140, 'swing']
    }, {
        duration: 500,
        complete: function () {
            showPersonaContent(blocks, it)
        }
    });
}

function showPersonaContent(blocks, it) {
    it.hide();
    blocks.not(it).show();
    $('.persona-active').fadeOut('fast').removeClass('persona-active');
    var ActivePersona = $('#' + it.data('Persona'));
    $('#persona').animate({
        height: ActivePersona.height() + 10
    }, 500);
    ActivePersona.fadeIn('fast').addClass('persona-active');
	$('.selected').removeClass('selected').css({opacity: 1}).addClass('activated');
	it.remove();
}

function transformDate(year) {
	var dates = $('#events h4.date');
	$.each(dates,function() {
		var it = $(this),
			startDate = it.find('span[class^="date-display"]').eq(0).text(),
			months=/January|February|March|April|May|June|July|August|September|October|November|December/g,
			startMonth = startDate.match(months),
			startDay = startDate.replace(/\D/g,''),
			html = '<strong>' + startDay + '</strong>';
		
		if(it.find('.date-display-single').length === 0 ) {
			var endDate = it.find('.date-display-end').text(),
				endDay = endDate.replace(/\D/g,''),
				endMonth = endDate.match(months);			
			html = '<strong class="range">' + startDay + '-' + endDay + '</strong>';
			if(startMonth.toString() === endMonth.toString()) {
				html += startMonth.toString().substr(0,3) + ' ' + year;
			}
			else {
				html += startMonth.toString().substr(0,3) + '-' + endMonth.toString().substr(0,3);
			}
		}
		else{html += startMonth.toString().substr(0,3) + ' ' + year;}
		it.html('<span>' + html + '</span>');
	});
}

// Cookie functions
function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function deleteCookie(name) {
    setCookie(name,"",-1);
}


function getInternetExplorerVersion() {
  var rv = -1; // Return value assumes failure.
  if (navigator.appName == 'Microsoft Internet Explorer') {
    var ua = navigator.userAgent;
    var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat(RegExp.$1);
  }
  return rv;
}
function checkVersion() {
  var msg = "You're not using Windows Internet Explorer.";
  var ver = getInternetExplorerVersion();
  if (ver > -1) {
    if (ver >= 7.0)
      msg = "ie8"
    else
      msg = "You should upgrade your copy of Windows Internet Explorer.";
  }
  return msg;
}


  },

  detach: function (context, settings) { }

};
} else{ // mobile homepage swooshiness
  Drupal.behaviors.frontpage = {
  attach: function (context, settings) {
    //$(".current-students").click(function() {
      //$(".current-students").parent().append($("#CurrentStudents"));
      //$("#CurrentStudents").slideToggle("slow");
    //});
  },
  detach: function (context, settings) { }
};
}

})(jQuery, Drupal, this, this.document);


