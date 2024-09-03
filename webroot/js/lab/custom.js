$('document').ready(function() {
    

    
        $('input[type=radio][name=rad1]').change(function() {
                if (this.value == 'Breached System') {
                   $('#braacheddiv').show(); 
                }
                else {
                    $('#braacheddiv').hide();
                }
            });
        
        
       $('input[type=radio][name=redacted_info]').change(function() {
                if (this.value == 'No') {
                   $('#redaction').show(); 
                }
                else {
                    $('#redaction').hide();
                }
            });
             
       $('input[type=radio][name=external_parties1]').change(function() {
                if (this.value == 'Yes') {
                   $('#external_p').show(); 
                }
                else {
                    $('#external_p').hide();
                }
            });
        
     $('input[type=radio][name=pastmonth]').change(function() {
                if (this.value == 'Yes') {
                   $('#astool').show(); 
                }
                else {
                    $('#astool').hide();
                }
            });
    
    
      $('input[type=radio][name=binding]').change(function() {
                if (this.value == 'Yes') {
                   $('#binding').show(); 
                }
                else {
                    $('#binding').hide();
                }
            });
    
    $('input[type=radio][name=multiple_accounts]').change(function() {
                if (this.value == 'Yes') {
                   $('#multiple_account').show(); 
                }
                else {
                    $('#multiple_account').hide();
                }
            });
    
	
	

	/* Scroll  window add navbar class */

	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();

	    if (scroll >= 5) {
	        $(".navbar").addClass("fixedtop");
	    } else {
	        $(".navbar").removeClass("fixedtop");
	    }
	});

        
 

});
$(window).scroll(function() {
      if($(window).scrollTop() > 20) {
        $(".navbar").addClass("fixedtop");
          $(".brand-text").removeClass("colorwhite");
      }
      else{
        $(".navbar").removeClass("fixedtop");
          $(".brand-text").addClass("colorwhite");
      }
    });