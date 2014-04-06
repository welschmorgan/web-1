function toggle_submenu(elem_id)
{
	if (document && document.getElementById)
	{
		var e = document.getElementById(elem_id);
		if (!e)
			return (e);
		if (e.style.display == 'inline-block')
			e.style.display = 'none';
		else
			e.style.display = 'inline-block';
		return (e);
	}
	return (null);
}
