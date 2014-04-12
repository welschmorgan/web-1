function $(id)
{
	if (document && document.getElementById)
		return (document.getElementById(id));
	alert("'document.getElementById' method does not exist !");
	return (null);
}

function setCookie(cname,cvalue,exdays)
{
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = cname + "=" + escape(cvalue) + "; " + expires;
}

function getCookie(cname)
{
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
	{
		var c = ca[i].trim();
		if (c.indexOf(name)==0)
			return c.substring(name.length,c.length);
	}
	return "";
}

function TodoList(elem_id)
{
	var items;
	var elem;

	this.userAdd = function()
	{
		var p = prompt('Name of the action:');
		if (!p)
			return (false);
		return (this.add(p));
	}
	this.has = function(name)
	{
		for (var i = 0; i < this.elem.length; i++) {
			if (this.elem[i].firstChild.innerHTML == name)
				return (true);
		};
		return (false);
	}
	this.add = function(name)
	{
		if (this.has(name))
			return (false);
		var elem = document.createElement('div');
		var link = document.createElement('a');
		link.href = "javascript: tl.remove('" + this.items.length + "')";
		link.innerHTML = name;
		if (this.elem.firstChild)
			this.elem.insertBefore(elem, this.elem.firstChild);
		else
			this.elem.appendChild(elem);
		elem.appendChild(link);
		this.items.push(name);
		var cooked = '';
		for(var i = 0; i < this.items.length; i ++)
			cooked += this.items[i] + ";";
		setCookie('list', cooked, 7);
		return (true);
	}
	this.clear = function(){
		while (this.elem.firstChild)
			this.elem.removeChild(this.elem.firstChild);
		while (this.items.length > 0)
			this.items.pop();
		setCookie('list', '', -1);
	}
	this.reload = function(){
		var lst = getCookie('list');
		if (!lst)
			return (false);
		lst = unescape(lst);
		var vec = lst.split(';');
		for (var i = 0;
			i < vec.length;
			i++)
		{
			if (vec[i])
				this.add(vec[i]);
		}
		return (true);
	}
	this.remove = function(id)
	{
		alert('Remove');
		if (id < this.items.length)
			this.items = this.items.splice(id, 1);
	}
	this.items = new Array();
	this.elem = $(elem_id);
}

function on_ready(){
	tl = new TodoList('ft_list');
	tl.reload();
	//window.setInterval('on_refresh()', 1000);
}
