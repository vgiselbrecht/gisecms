	<form action="index.php?inhalt=suchen&seite=<?php echo $name; ?>" method="post">
		<p><label for="suchbegriff">Auf der Seite suchen:</label>
		<input type="text" name="q" id="suchbegriff" value="Suchbegriff" size="13" title=" Suchbegriff hier eingeben " onblur="if(this.value=='')this.value='Suchbegriff';" onfocus="if(this.value=='Suchbegriff')this.value='';" />
		<input type="submit" value="Los !" />
		</p>
	</form>