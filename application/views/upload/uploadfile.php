<script src="assets/js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="assets/css/uploadify/upload.css" rel="stylesheet" type="text/css" />
<link href="assets/css/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
<!-- body start -->
<script type="text/javascript">
<!-- //-->
$(document).ready(function(){
	$('#file_upload').uploadify({
		'swf'	: "<?php echo base_url();?>assets/res/video/uploadify.swf",
		'uploader' : "<?php echo site_url('Pancat/upload/handle') ?>",
		'auto'	: true,
		'buttonText' : '上传文件',
		'fileSizeLimit' : '100MB',
		 'fileTypeDesc' : 'Apk Files',
		 'fileTypeExts' : '*.apk',
		 'height'   : 25,
		 'itemTemplate' : '<div id="${fileID}" class="uploadify-queue-item" style="width:100%">\
             <div class="cancel">\
                 <a href="javascript:$(\'#${instanceID}\').uploadify(\'cancel\', \'${fileID}\')">X</a>\
             </div>\
             <span class="fileName">${fileName} (${fileSize})</span><span class="data"></span>\
         </div>',
		'method' : 'post',
		'formData' : {'<?php echo session_name();?>' : '<?php echo session_id();?>'},
		'onUploadSuccess' : function(file, data, response) {
		   if(data.substr(0,1)=="0"){
			   showError(file,data.substr(1)); return ;
		   }
		   data = data.substr(1);
		   var $ele = $('#file_table tr:last');
		   var $e = $('#file_table tr:last td');
		   var d = new Date();
		   var t = "" + d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+'  '+d.getHours()+":"+d.getMinutes(); 
		   var id = isNaN(parseInt($e.text()))?1:(parseInt($e.text())+1);
		   var v = "";
		   var divide = 1024;
		   filesize = file.size;
		   if((filesize = filesize/divide)<0.0) 
		   		v = filesize*divide + 'B';
		   else if ((filesize = filesize/divide)<0.0) 
		   		v = filesize*divide + 'KB';
		   else 
		   		v = filesize + 'MB';
		      
		   var count = parseInt($('#file_count').text())+1;
		   $('#file_count').text(count);
		   
		   if($ele)
	       		$ele.after('<tr><td>'+id+'</td>  <td>'+file.name +
	    	       '</td> <td>'+v+' </td> <td> <a href="' +data+'">'+data+'</a> </td> <td>' + t +'</td> </tr>');
	       $('#file_show').addClass('show');
	    },
	    'onUploadError' : function(file, errorCode, errorMsg, errorString) {
          	 showError(file,errorMsg);
        },
		});
});

function showError(file,errorMsg)
{
	var ele = $('#error_label');
	ele.after('<li class="error_item">The file ' + file.name + ' could not be uploaded: ' + errorMsg +"</li>");
	$('.error').addClass('show');
}

</script>
<!-- 标题栏 -->
<div class="body_header">
	<div id="title">
		文件上传页面
	</div>
	<div id="header_right_bottom">
	</div>
</div> <!-- end body_header -->

<!-- 内容区 -->
<div class="bkg">
	<!-- 菜单栏，显示按钮 及上传文件的总信息 -->
	<div id="menu">
		<div id="fileupload">
			<input type="file" name="file_upload" id="file_upload" />
		</div>
		<div id="twodimscan">
			<a href="<?php echo $topage;/*site_url('Pancat/upload/scan') */?>">进入资源下载页面 >></a>
		</div>
		<div id="info">
			文件上传数：
			<div id="file_count">0</div>
		</div>
	</div><!-- end menu -->
	
	<!--  上传文件显示信息 -->
	<div id="file_show" class="display">
		<div id="success_label">上传成功信息：</br></div>
		<table id="file_table" border="1" cellpadding="3" cellspacing="0">
		<col width="5%" align="center"/> <col width="20%" align="center"/> <col width="10%" align="center"/> <col width="50%" align="center"/> <col width="15%" align="center"> 
		<tr> <th>文件ID</th>    <th>文件名</th> <th> 文件大小 </th> <th>文件下载地址</th> <th>文件上传时间 </th> </tr>
		
		</table>
	</div><!--  end file_show -->
	
	
	<!-- 错误信息 -->
	<div class="error display" >
	<div id="error_label">Error Information: </br></div>
	
	</div><!--  end error -->
</div> <!--  end bkg -->

<!-- 版权信息 -->
<div class="com">
</div> <!--  end com -->
