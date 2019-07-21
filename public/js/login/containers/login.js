import React, { Component } from 'react';
import Form from './../components/login.js';


class Login extends Component{
	handleKeyUp = (event) => {
		if($(event.target).hasClass('state-error')){
			$('#txt-password').addClass("state-error");
		}
	}
	send = () => {
		var email = $('#txt-email').val();
		var password = $('#txt-password').val();
		if(!email)
			$('#txt-email').addClass("state-error");
		else if(!password)
			$('#txt-password').addClass("state-error");

		if (!$("#login-form").find(".state-error").length) {
			var data = {
			    'email':email,
			    'password':password
			};
			$.ajax({
			    type: "POST", //GET, POST, PUT
			    url: "/user/login",  //the url to call
			    data: JSON.stringify(data),    //Data sent to server
			    beforeSend: function (xhr) {   //Include the bearer token in header
			        xhr.setRequestHeader("Content-Type", 'application/json');
			    }
			}).done(function (response) {
				console.log(response);
			    //Response ok. process reuslt
			}).fail(function (err)  {
			    //Error during request
			    console.log(err.responseText);
			});
		}
	}
    render() {
        return (
        	<div className="fix">
	        	<Form 
	        		send={this.send}
	        		handleKeyUp={this.handleKeyUp}
	        	/>
	        </div>
        )
    }
}

export default Login;