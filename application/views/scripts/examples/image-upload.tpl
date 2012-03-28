<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype='multipart/form-data' action='{$siteRoot}/examples/image-upload' method='POST'>
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name='uploadForm[image1]' type='file' /><br />
	Send this file: <input name='uploadForm[image2]' type='file' /><br />
    <input type='submit' value='Upload' />
</form>
