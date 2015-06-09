#!/usr/bin/python
#coding=utf-8
import os
import time
mysql_comm = 'mysqldump'
mysql_user = 'qwe7002'
mysql_passwd = '123456'
mysql_bak_database = 'qwe7002_smxyradio'
bak_dir = '~/bak'
log_file = open('~/bak/mysql_bak.log','a')
today = time.strftime('%Y-%m-%d')
while True:
    if os.path.exists(bak_dir):
        bak_shell = '{0} -u{1} -p{2} {3} >{4}{5}.sql'.format(mysql_comm,mysql_user,\
        mysql_passwd,mysql_bak_database,bak_dir,mysql_bak_database)
        tgzfile = 'tar -zcvf {0}{1}.{2}.tar.gz  {3}{4}.sql 1>/dev/null 2>/dev/null'\
        .format(bak_dir,mysql_bak_database,today,bak_dir,mysql_bak_database)
        rm_file = 'rm -rf {0}{1}.sql'.format(bak_dir,mysql_bak_database)
        os.system(bak_shell)
        os.system(tgzfile)
        os.system(rm_file)
        print >>log_file,'时间：{0} 备份数据库成功!'.format(today)
        break
    elif not os.path.exists(bak_dir):
        os.mkdir(bak_dir)
        print >>log_file,'备份文件夹创建成功!\n'
    else:
        print >>log_file,'时间：{0} 备份数据库失败!'.format(today)
log_file.close()
