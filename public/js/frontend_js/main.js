/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$(document).ready(function(){

	// Change price with choice
	$("#selChoice").change(function(){
		var choice = $(this).val();
		if(choice == ""){
			return false;
		}
		$.ajax({
			type: 'get',
			url: '/get-product-price',
			data: {choice: choice},	
			success: function(resp){
				var arr = resp.split('#');
					$("#getPrice").html("Rs "+ arr[0]);		
					$("#price").val(arr[0]);			
				if(arr[1]==0){
					$('#cartButton').hide();
					$('#avaibility').text("Out of Stock");
				}else{
					$('#cartButton').show();
					$('#avaibility').text('In Stock');
				}
			},
			error: (error)=>{
				console.log(error);	
			}
		})
	});

	// Replace main image with viewing image
	$(".changingImages").hover(function(){
		var image = $(this).attr('src');
		$(".mainImage").attr('src', image);
	});
});


	// Image zoom with hover effect

	// Instantiate EasyZoom instances
	var $easyzoom = $('.easyzoom').easyZoom();

	// Setup thumbnails example
	var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

	$('.thumbnails').on('click', 'a', function(e) {
		var $this = $(this);

		e.preventDefault();

		// Use EasyZoom's `swap` method
		api1.swap($this.data('standard'), $this.attr('href'));
	});

	// Setup toggles example
	var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

	$('.toggle').on('click', function() {
		var $this = $(this);

		if ($this.data("active") === true) {
			$this.text("Switch on").data("active", false);
			api2.teardown();
		} else {
			$this.text("Switch off").data("active", true);
			api2._init();
		}
	});


	// Jquery validations on user login/register form

$().ready(function(){
	$("#registerForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			password:{
				required:true,
				minlength:6
			},
			email:{
				required:true,
				email:true,
				remote: '/check-email'
			}
		},
		messages:{
			name:{
				required:"Please Enter your Name",
				minlength: "Name must be atleast 2 characters long",
				accept: "Your Name must contain letters only"
			},
			password: {
				required: "Please provide the password",
				minlength: "Your password must be atleast 6 characters long"
			},
			email:{
				required: "The Email is required",
				email: "Please enter the valid Email",
				remote: "The Email alreay exists !!"
			}
		}
	});

	$("#accountForm").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				accept: "[a-zA-Z]+"
			},
			address:{
				required:true
			},
			city:{
				required:true
			},
			khalti_number:{
				required:true
			},
			mobile:{
				required:true,
				number: true
			}							
		},
		messages:{
			name:{
				required:"Please Enter your Name",
				minlength: "Name must be atleast 2 characters long",
				accept: "Your Name must contain letters only"
			},
			address: {
				required: "Please provide the address",
			},
			city: {
				required: "Please provide the address",
			},
			khalti_number: {
				required: "Please provide the khalti number"
			},
			mobile: {
				required: "Please provide the mobile number",
				number: "Please provide the number"
			}

		}
	});

	// Check current user password

	$("#current_pwd").keyup(function(){
		var current_pwd= $(this).val();
		$.ajax({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  },			
			type: 'post',
			url: '/check-current-pwd',
			data: {current_pwd:current_pwd},
			success:function(resp){
				if(jQuery.trim(resp) === "false"){
					$("#chkPwd").html("<font color = 'red'>Current Password is Incorrect</font>")
				}else if(jQuery.trim(resp) === "true"){
					$("#chkPwd").html("<font color = 'green'>Current Password is Correct</font>")
				}
			},
			error:function(){
				alert("Error");
			}
		})
	});


	$("#loginForm").validate({
		rules:{
			email:{
				required:true,
				email:true,
				remote: '/check-email-for-login'
			},
			password:{
				required:true,
			}
		},
		messages:{
			email:{
				required: "The Email is required",
				email: "Please enter the valid Email",
				remote: "The Email is not Registered !!"
			},
			password: {
				required: "Please provide the password",
			},

		}
	});	

	$("#passwordForm").validate({
	rules:{
		new_pwd:{
			required:true,
			minlength:6,
			maxlength:20
			},
		confirm_pwd:{
			required:true,
			minlength:6,
			maxlength:20,
			equalTo: "#new_pwd"			
		}
	},
	messages:{
		new_pwd:{
			required: "New Password is required",
			minlength: "Atleast 6 characters",
			maxlength: "Atmost 6 characters!!"
		},
		confirm_pwd:{
			required: "New Password is required",
			minlength: "Atleast 6 characters",
			maxlength: "Atmost 6 characters!!",
			equalTo: "This doesn't match with the New Password!!"
		},

	}
});

	// Password Strength Script
	$("#myPassword").passtrength({
		minChars: 4,
		passwordToggle: true,
		tooltip: true,
		eyeImg:'/images/frontend_images/eye.svg'
	});
});

