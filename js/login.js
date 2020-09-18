function onSignIn(googleUser) {
	//get access_token
	var Name = 'Name=' + googleUser.getBasicProfile().getName();
	var Email = 'Email=' + googleUser.getBasicProfile().getEmail();
	var Avatar = 'Avatar=' + googleUser.getBasicProfile().getImageUrl();
	var Picture = 'Picture=' + googleUser.getBasicProfile().getImageUrl();
	document.cookie = Name;
	document.cookie = Email;
	document.cookie = Avatar;
	document.cookie = Picture;
	//쿠키 적용을 위하여 로그인 이후 페이지를 리로드하고 반복 적용 되지 않도록 로그아웃한다. 2020/02/06
	window.location.href = "";
	signOut();
}

function signOut() {
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function() {
		console.log('User signed out.');
	});
}

// function onSignIn(googleUser) {
// 	var profile = googleUser.getBasicProfile();
// 	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
// 	console.log('Name: ' + profile.getName());
// 	console.log('Image URL: ' + profile.getImageUrl());
// 	console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
// }

// function signOut() {
// 	var auth2 = gapi.auth2.getAuthInstance();
// 	auth2.signOut().then(function() {
// 		console.log('User signed out.');
// 	});
// }