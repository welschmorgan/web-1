function elem(id)
{
	if (document && document.getElementById)
		return (document.getElementById(id));
	return null;
}

function value(id)
{
	return (elem(id) ? elem(id).value : null);
}

function validate(id)
{
	var e = elem(id);
	var val = value(id);
	if (val !== '')
	{
		e.style.background = "palegreen";
		e.style.color = "green";
		e.style.fontWeight = "bold";
	}
	else
	{
		e.style.background = "#FF6666";
		e.style.color = "#800000";
		e.style.fontWeight = "bolder";
	}
	return (val !== "");
}
function validate_login(elem)
{
	var ret = true;
	if (!validate("username"))
		ret = false;
	if (!validate("password"))
		ret = false;
	return (ret);
}
