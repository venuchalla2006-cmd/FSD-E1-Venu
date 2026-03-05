function validateName(){

var name=document.getElementById("name").value;

if(name.length<3){
document.getElementById("nameError").innerHTML="Name must be at least 3 characters";
}
else{
document.getElementById("nameError").innerHTML="";
}

}

function validateEmail(){

var email=document.getElementById("email").value;
var pattern=/^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

if(!email.match(pattern)){
document.getElementById("emailError").innerHTML="Invalid Email";
}
else{
document.getElementById("emailError").innerHTML="";
}

}

function submitForm(){

alert("Feedback Submitted Successfully!");

}