
<!-- 标题栏 -->
<div class="body_header">
	<div id="title">
		资源下载页面
	</div>
	<div id="header_right_bottom">
		<a href="<?php echo site_url('pancat/upload/uploadfile')?>">上传文件>></a>
	</div>
</div> <!-- end body_header -->

<!-- 表格资源展示
<div id="resourcetable">
	<table id="res_table" border="1" cellpadding="3" cellspacing="0">
		<col width="5%" align="center"/> <col width="20%" align="center"/> <col width="10%" align="center"/> <col width="50%" align="center"/> <col width="15%" align="center"> 
		<tr> <th>二维码</th>    <th>文件名</th> <th> 文件大小 </th> <th>文件下载地址</th> <th>文件上传时间 </th>  </tr>
		<?php foreach ($fileinfo as $record):?>
		<tr><td> <img src="<?php echo site_url('pancat/upload/twodim/'.$record[Fileupload_model::FILE_ID]); ?>" /></td>
			<td> <?php echo $record[Fileupload_model::FILE_NAME];?></td>
			<td> <?php  echo $record[Fileupload_model::FILE_SIZE_KB].'KB';?></td>
			<td> <a href="<?php  echo $record[Fileupload_model::FILE_DOWNLOAD_ADDR];?>"><?php  echo $record[Fileupload_model::FILE_DOWNLOAD_ADDR];?></a></td>
			<td> <?php  echo $record[Fileupload_model::FILE_UPLOAD_TIME];?></td>
		</tr>
		<?php endforeach;?>
		</table>
</div> 
 -->
 
 <div id="resourcearea">
 <?php $i=0; foreach($fileinfo as $record):
  if($i %2 == 0): $en = "even"; else: $en = "odd"; $i++; endif; ?>
 <div class="box <?php echo $en."box";?>">
 	 
 	 <!-- 二维码区域 -->
	 <div class="twodimleft ">
	  <img src="<?php echo site_url('pancat/upload/twodim/'.$record[Fileupload_model::FILE_ID]); ?>" />
	 </div> <!-- end twodimleft -->
	 
	 <!-- 文件信息显示 -->
	 <div class="fileinfo">
	 文  件  名：<?php echo $record[Fileupload_model::FILE_NAME];?> <br />
	 文件大小：<?php  echo $record[Fileupload_model::FILE_SIZE_KB].'KB';?> <br />
	 上传时间：<?php  echo $record[Fileupload_model::FILE_UPLOAD_TIME];?> <br />
	 <a href="<?php  echo $record[Fileupload_model::FILE_DOWNLOAD_ADDR];?>">点击下载</a>
	 </div> <!--  end fileinfo -->
	 
 </div> <!-- end box -->
 <?php endforeach;?>
 </div>
 
<!-- 版权信息 -->
<div class="com">
</div> <!--  end com -->