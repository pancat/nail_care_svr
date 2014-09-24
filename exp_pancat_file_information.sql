/*
* SQL file: exp_pancat_file_information.sql
*           provide upload file informatiom table
*           At first using,Admin must be execute it;
* @author: JogRunner
* @createtime:2014.9.19
* 
*/

create table fr_exp_pancat_file_information(
file_id int not null primary key auto_increment, #�ļ�id
file_name varchar(20) not null, #�ļ���
file_download_addr varchar(64) not null, #�ļ����ص�ַ
file_size_kb int not null, #�ļ���С,KB����
file_upload_time datetime not null, #�ļ��ϴ�ʱ��
file_twodim_image_addr varchar(64) not null, #�ļ���ɵĶ�ά��ͼ���ַ
file_type varchar(10) not null, #�ļ�����
file_upload_author varchar(20) not null default 'unknown', #�ļ��ϴ���
file_download_count int not null default 0, #�ļ����ش��� 
file_enabled_update boolean not null default false, #�ļ��ܷ����߸��� 
file_enabled_delete boolean not null default false, #�ļ��ܷ�����ɾ��
file_share_authority boolean not null default false #�ļ��Ƿ�����
);

create index FileNameIndex on fr_exp_pancat_file_information (file_name);

#insert into exp_pancat_file_information values(NULL,'abc.apk','http://www.fanrong.com/abc.apk',23,now(),'http://www.fanrong.com/images/abc_id.png','apk','jogrunner',0,false,false,false);
#insert into exp_pancat_file_information values(NULL,'cde.apk','http://www.fanrong.com/cde.apk',2,now(),'http://www.fanrong.com/images/cde_id1.png','apk','jogrunner',0,false,false,false);
