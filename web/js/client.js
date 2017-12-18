
function appClient() {};

appClient.prototype.routeMapping = {
	get_all_users: {
		url: 'admin/users',
		method: 'GET'
	},
	create_user: {
		url: 'admin/user',
		method: 'POST'
	},
	delete_user: {
		url: 'admin/user/{id}',
		method: 'DELETE'
	}
};

appClient.prototype.getAllUsers = function(success, error, allways) {
	var xhttp = this.getXhttp(
		this.routeMapping.get_all_users.method,
		this.routeMapping.get_all_users.url,
		success,
		error, 
		allways
	);
	
	xhttp.send();
};

appClient.prototype.createUser = function(data, success, error, allways) {
	var xhttp = this.getXhttp(
		this.routeMapping.create_user.method,
		this.routeMapping.create_user.url,
		success,
		error, 
		allways
	);
	
	xhttp.send(data);
};

appClient.prototype.deleteUser = function(id, success, error, allways) {
	var xhttp = this.getXhttp(
		this.routeMapping.delete_user.method,
		this.routeMapping.delete_user.url.replace('{id}', id),
		success,
		error, 
		allways
	);
	
	xhttp.send();
};

appClient.prototype.getXhttp = function (method, url, success, error, allways) {
	var xhttp = new XMLHttpRequest();
	xhttp.open(method, url, true);
	xhttp.addEventListener("load", success);
	xhttp.addEventListener("error", error);
	xhttp.addEventListener("loadend", allways);
	
	return xhttp;
}
