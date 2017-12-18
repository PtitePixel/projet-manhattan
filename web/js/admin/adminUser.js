
document.addEventListener("DOMContentLoaded", function() {
	var client = new appClient();

	var preventClick = function(button) {
		button.setAttribute('disabled', true);
	};
	
	var allowClick = function(button) {
		button.removeAttribute('disabled');
	};

	var error = function(){
		alert('An error occured');
	};

	var callback = function(response){
		var data = JSON.parse(response.target.response);

		var list = document.getElementById('userId');
		list.innerHTML = '';

		data.forEach(function(element){
			var deleteButton = '<button id="delete_user_'+element.id+'">Delete</button>';

			list.innerHTML = list.innerHTML.concat(
				'<li>{id}: {firstname} {lastname} {username} ( {password}@[{role}] ) {button}</li>'
					.replace('{id}', element.id)
					.replace('{firstname}', element.firstname)
					.replace('{lastname}', element.lastname)
					.replace('{password}', element.password)
					.replace('{role}', element.roles.join())  // cast role array to string
					.replace('{button}', deleteButton)
					.replace('{username}', element.username)
			);

			document.getElementById('delete_user_'+element.id).addEventListener("click", function(){
				if (this.hasAttribute('disabled')) {
					return;
				}
				preventClick(this);
				var selfref = this;
				client.deleteUser(element.id, function(){client.getAllUsers(callback, error);}, error, function(){allowClick(selfref);});
			}); 
		});
	}

	client.getAllUsers(callback, error);

	document.getElementById("btn_create_user").addEventListener("click", function(){
		if (this.hasAttribute('disabled')) {
			return;
		}
		preventClick(this);
		var selfref = this;
		var form = document.getElementById("form_create_user");
		var formData = new FormData(form);
		client.createUser(formData, function(){
			client.getAllUsers(callback, error);
		}, error, function(){allowClick(selfref);});
	}); 
});