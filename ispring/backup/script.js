
	$(document).ready(function(){ 


		$("#login").click(function(e) {
		e.preventDefault();
		var email = document.getElementById("email").value;  
		var pass = document.getElementById("pass").value;
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	    if (email == '' && pass == '') {
	        document.getElementById("error-msg").innerHTML = "please enter email id and password.";
	        //alert("please enter email id and password.");       
	    }
	    else if (email == '') {
	        document.getElementById("error-msg").innerHTML = "please enter email id.";
	        //alert("please enter email id.");
	    }
	    else if(!filter.test(email))
		{
			document.getElementById("error-msg").innerHTML = "Enter valid email id.";
		}
	    else if (pass == '') {
	        document.getElementById("error-msg").innerHTML = "please enter password.";
	        //alert("please enter password.");    
	    }
	    else if (email != 'admin@gmail.com' && pass == 'admin@123') {
	        document.getElementById("error-msg").innerHTML = "please enter valid email id.";	
	        //alert("please enter valid email id.");       
	    } 
	    else if (email == 'admin@gmail.com' && pass != 'admin@123') {
	        document.getElementById("error-msg").innerHTML = "please enter valid password.";
	        //alert("please enter valid password.");	        
	    } 
	    else if (email != 'admin@gmail.com' && pass != 'admin@123') {
	        document.getElementById("error-msg").innerHTML = "please enter valid email id and password.";
	        //alert("please enter valid email id and password.");
	    }
		else
		{
			$("#submit").submit();
		}
		});

		/* logout-tooltip-script */	

		$(".tooltip").click(function(){
			$(".tooltiptext").toggle();
		});

		/* search-bar-script */	

		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
		});

		/* pdf-script */
		var a = $('#mydiv').data('myval'); //getter
		var str =a.replace(/\s/g, '');

		$('#downloadPDF').click(function () {
/*			$('.change1').css("font-size","22px");
			$('.change').css("font-size","20px");
			$('.changeMe').css("font-size","18px");
			$('.container').css("max-width","100%");*/
            let doc = new jsPDF('p', 'pt', [$('#studentDetails').width(), $('#studentDetails').height()]);
        	doc.addHTML(document.body, function () {
            doc.save(str+'.pdf');
        });
		});

		


	});
