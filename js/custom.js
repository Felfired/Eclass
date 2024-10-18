$("#student").click(function(e)
{
    if($('#static-centered-row').css('display')!='none')
    {
        $('#static-centered-row').html($('#dynamic-centered-row-1').html()).show().siblings('div').hide();
    }
});

$("#professor").click(function(e)
{
    if($('#static-centered-row').css('display')!='none')
    {
        $('#static-centered-row').html($('#dynamic-centered-row-2').html()).show().siblings('div').hide();
    }
});

$("#add_course").click(function(e)
{
    if($('#static-centered-row').css('display')!='none')
    {
        $('#static-centered-row').html($('#dynamic-centered-add-1').html()).show().siblings('div').hide();
    }
});

function hideCourses(hide)
{
    document.getElementById(hide).style.display = 'none';
}
function displayCourses(display)
{
    document.getElementById(display).style.display = 'block';
    
}

function passwdValidate()
{
    var pass = document.getElementById('inputPassword').value;
    var repass = document.getElementById('inputrePassword').value;

    if(pass.length >= 8) 
    {
        if(pass == repass)
        {
            return true;
        }
        else
        {
            alert("Passwords don't match.");
        }
        return false;
    }
    else 
    {
        alert("Password should be at least 8 characters long.");
    }
    return false;
    
}
