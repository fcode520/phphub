<p>支持jpg、png格式图片</p>
<form id="fileSubmit" action="crop.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="demo-file" accept="image/*">
    <input type="text" name="ix" id="ix" style="display: none;">
    <input type="text" name="iy" id="iy" style="display: none;">
    <input type="text" name="iw" id="iw" style="display: none;">
    <input type="text" name="ih" id="ih" style="display: none;">
</form>

<div id="demo-preview"></div>

<input id="subImg" type="button" value="保存" onclick="saveIcon();" style="display: none;" />
