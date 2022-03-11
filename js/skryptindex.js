var space = " ";
var speed = "500";
var pos = 0;
var msg = "< < < IRON NEWS > > >";
function Scroll()
{
  document.title = msg.substring(pos, msg.length) + space + msg.substring(0,pos);
  pos++;
  if (pos > msg.length) pos = 0;
  window.setTimeout("Scroll()", speed);
}
Scroll();

$(document).ready(function(){
	
	$(window).scroll(function(){
		if ($(this).scrollTop() > 200) {
			$('#scrollToTop').fadeIn();
		} else {
			$('#scrollToTop').fadeOut();
		}
	});
	
	$('#scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},700);
		return false;
	});
    
    $('#c').click(function(e){
        if ( $('#chatt').is(":visible")){
            $('#chatt').hide();
            return false;
        }
        else {
            $('#chatt').show().css('bottom','-1px').css('left','+2px');
            return false;
        }    
    });
    
    $('#user').click(function(e){
        if ( $('#login').is(":visible")){
            $('#login').hide();
            return false;
        }
        else {
            $('#login').show();
            return false;
        }    
    });
});

window.setInterval(function(){

var Time = new Date();
var Hours = Time.getHours();
var Minutes = Time.getMinutes();
var Seconds = Time.getSeconds();

$.ajax({
   success: function(clock){ 
       if(Minutes.toString().length == 1)
       {
           Minutes = "0" + Minutes;
       }
       if(Seconds.toString().length == 1)
       {
          Seconds = "0" + Seconds;
       }
      
       document.getElementById("clock").innerHTML = Hours + ":" + Minutes + ":" + Seconds;
   }
});
}, 999);		