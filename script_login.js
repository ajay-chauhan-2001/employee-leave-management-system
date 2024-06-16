let emailError=document.getElementById('email-error');
let passError=document.getElementById('pass-error');




function validateEmail()
{
    let email =document.getElementById('content-email').value;

    if(email.length ==0)
    {
        emailError.innerHTML="Email  is requied";
        return false;
    }
    if(!email.match(/^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/))
    {
        emailError.innerHTML='Invalid Email format ';
        return false;
    }
    emailError.innerHTML = '';
    return true;
}

function validatePass()
{
    let pass =document.getElementById('content-pass').value;

    if(pass.length ==0)
    {
        passError.innerHTML="Password  is requied";
        return false;
    }
    if(!pass.match(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/))
    {

        passError.innerHTML='';
        return false;
        // passError.innerHTML='Password Minimum 8 characters, at least one letter and one number';
        // return false;
    }
    passError.innerHTML = '';
    return true;
}

function validateForm() {
// alert('data update');
    if ( !validateEmail() && !validatePass() ) {
      submitError.style.display='block';
      submitError.innerHTML="All Details must be filled out";
      setTimeout(function(){ submitError.style.display='none';},3000 );
      return false;
    }
  }