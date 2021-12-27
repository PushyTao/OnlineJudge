#!/bin/bash

###############################################################
# 判题端配置文件
###############################################################

###############################################################
# 数据库连接信息
###############################################################
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lduoj
DB_USERNAME=lduoj
DB_PASSWORD=123456789

###############################################################
# 判题机设置
# JG_DATA_DIR      测试数据路径（允许改为绝对路径）
# JG_NAME          评测机名称
# JG_MAX_RUNNING   最大并行判题数；建议值 = 剩余(GB) / 2
###############################################################
JG_DATA_DIR=storage/app/data
JG_NAME="Master"
JG_MAX_RUNNING=1
