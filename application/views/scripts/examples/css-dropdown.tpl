{rialtoExample}

<ul class='dropdown'>
	<li>
		<a href='#'>Link 1</a>
		<ul>
			<li><a href='#'>Sublink 1</a></li>
			<li><a href='#'>Sublink 2</a></li>
		</ul>
	</li>
	<li>
		<a href='#'>Link 2</a>
		<ul>
			<li><a href='#'>Sublink 1</a></li>
			<li><a href='#'>Sublink 2</a></li>
			<li><a href='#'>Sublink 3</a></li>
		</ul>
	</li>
	<li>
		<a href='#'>Link 3</a>
		<ul>
			<li><a href='#'>Sublink 1</a></li>
		</ul>
	</li>
</ul>

{literal}
<style>
	ul.dropdown, ul.dropdown ul {
		position: relative;
		margin: 0px;
		padding: 0px;
		list-style-type: none;
	}
	
	ul.dropdown {
		display: block;
	}
	
	ul.dropdown li {
		position: relative;
		margin: 0px;
		padding; 0px;
		-webkit-transition: all 0.3s;
	}
	
	ul.dropdown li a {
		display: block;
		padding: 5px 10px;
	}
	
	ul.dropdown ul {
		visibility: hidden;
		opacity: 0;
		position: absolute;
		top: 100%;
		left: 0px;
		width: 150px;
		background-color: rgba(100, 100, 100, 0.8);
		border-radius: 0px 4px 4px 4px;
		box-shadow: 1px 2px 2px rgba(100, 100, 100, 0.8);
		-webkit-transition: all 0.3s;
	}
	
	ul.dropdown ul li:first-of-type {
		border-radius: 4px 4px 0px 0px;
	}
	
	ul.dropdown ul li:last-of-type {
		border-radius: 0px 0px 4px 4px;
	}
	
	ul.dropdown > li {
		display: inline-block;
		margin: 0px 0px;
		border-radius: 4px 4px 0px 0px;
	}
	
	ul.dropdown > li:first-of-type {
		margin-left: 0px;
	}
	
	ul.dropdown li:hover {
		background-color: rgba(100, 100, 100, 0.8);
	}
	
	ul.dropdown li:hover a {
		color: #fff;
	}
	
	ul.dropdown li:hover ul {
		visibility: visible;
		opacity: 1;
	}
	
</style>
{/literal}

{/rialtoExample}