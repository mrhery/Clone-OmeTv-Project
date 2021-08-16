<!DOCTYPE html>
<html>
<head>
	<title>{PAGE_TITLE}</title>
	{META_TOP}
	
	<script>
	function base64_encode(str) {
		return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
			function toSolidBytes(match, p1) {
				return String.fromCharCode('0x' + p1);
		}));
	}
	
	function base64_decode(str) {
		return decodeURIComponent(atob(str).split('').map(function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
		}).join(''));
	}
	</script>
	{TOP_TAG}
</head>

<body {BODY_ATTR}>
	

