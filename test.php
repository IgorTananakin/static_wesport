<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Legend Holdings </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-select.css" rel="stylesheet" type="text/css"> -->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- <script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script> -->

  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="checkselect">
	<label><input type="checkbox" name="brands[]" value="1" > Google Inc.</label>
	<label><input type="checkbox" name="brands[]" value="2"> Apple Inc.</label>
	<label><input type="checkbox" name="brands[]" value="3"> Microsoft</label>
	<label><input type="checkbox" name="brands[]" value="4"> Facebook</label>
	<label><input type="checkbox" name="brands[]" value="5"> Amazon</label>
	<label><input type="checkbox" name="brands[]" value="6"> Verizon</label>
</div>
<script>
    (function($) {
	function setChecked(target) {
		var checked = $(target).find("input[type='checkbox']:checked").length;
		if (checked) {
			$(target).find('select option:first').html('Выбрано: ' + checked);
		} else {
			$(target).find('select option:first').html('Выберите из списка');
		}
	}
 
	$.fn.checkselect = function() {
		this.wrapInner('<div class="checkselect-popup"></div>');
		this.prepend(
			'<div class="checkselect-control">' +
				'<select class="form-control"><option></option></select>' +
				'<div class="checkselect-over"></div>' +
			'</div>'
		);	
 
		this.each(function(){
			setChecked(this);
		});		
		this.find('input[type="checkbox"]').click(function(){
			setChecked($(this).parents('.checkselect'));
		});
 
		this.parent().find('.checkselect-control').on('click', function(){
			$popup = $(this).next();
			$('.checkselect-popup').not($popup).css('display', 'none');
			if ($popup.is(':hidden')) {
				$popup.css('display', 'block');
				$(this).find('select').focus();
			} else {
				$popup.css('display', 'none');
			}
		});
 
		$('html, body').on('click', function(e){
			if ($(e.target).closest('.checkselect').length == 0){
				$('.checkselect-popup').css('display', 'none');
			}
		});
	};
})(jQuery);	
 
$('.checkselect').checkselect();
</script>
<style>
    .checkselect {
	position: relative;
	display: inline-block;
	min-width: 200px;
	text-align: left;
}
.checkselect-control {
	position: relative;
	padding: 0 !important;
}		
.checkselect-control select {
	position: relative;
	display: inline-block;
	width: 100%;
	margin: 0;
	padding-left: 5px;
	height: 30px;
}
.checkselect-over {
	position: absolute;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0; 			
	cursor: pointer;
}
.checkselect-popup {
	display: none;
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	width: 100%;
	height: auto;
	max-height: 200px;
	position: absolute;
	top: 100%;
	left: 0px; 
	border: 1px solid #dadada;
	border-top: none;
	background: #fff;
	z-index: 9999;
	overflow: auto;
	user-select: none;
}	
.checkselect label {
	position: relative;
	display: block;
	margin: 0;
	padding: 4px 6px 4px 25px;
	font-weight: normal;
	font-size: 1em;
	line-height: 1.1;
	cursor: pointer;
}			
.checkselect-popup input {
	position: absolute;
	top: 5px; 
	left: 8px;
	margin: 0 !important;
	padding: 0;
}
.checkselect-popup label:hover {
	background: #03a2ff;
	color: #fff;
}
.checkselect-popup fieldset {
	display: block;
	margin:  0;
	padding: 0;
	border: none;
}
.checkselect-popup fieldset input {
	left: 15px;
}		
.checkselect-popup fieldset label {
	padding-left: 32px;
}		
.checkselect-popup legend {
	display: block;
	margin: 0;
	padding: 5px 8px;
	font-weight: 700;
	font-size: 1em;
	line-height: 1.1;
}
</style>
</body>
</html>