#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<time.h>
#include<mysql/mysql.h>
#include<unistd.h>
#include<sys/types.h>
#include<sys/wait.h>

#define OJ_WT  0    //waiting
#define OJ_QI  1    //queueing
#define OJ_CI  2    //compiling
#define OJ_RI  3    //running
#define OJ_AC  4    //accepted
#define OJ_PE  5    //presentation error
#define OJ_WA  6    //wrong answer
#define OJ_TL  7    //time limit exceeded
#define OJ_ML  8    //time limit exceeded
#define OJ_OL  9    //output limit exceeded
#define OJ_RE 10    //runtime error
#define OJ_CE 11    //compile error
#define OJ_TC 12    //test completed
#define OJ_SK 13    //skipped


char *db_host;
char *db_port;
char *db_user;
char *db_pass;
char *db_name;

const char *lang[15]={"c","cpp","java","py"}; //��������

MYSQL *mysql;    //���ݿ����Ӷ���
MYSQL_RES *mysql_res;   //sql��ѯ���
MYSQL_ROW mysql_row;    //sql��ѯ���ĵ�������
char sql[256];   //�ݴ�sql���



void judge(int sid)
{
    sprintf(sql,"UPDATE solutions SET result=%d WHERE id=%d",OJ_RI,sid); //����running״̬
    mysql_real_query(mysql,sql,strlen(sql));
    printf("judging!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!: %d\n",sid);
    sleep(3);
    printf("judging end   !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!: %d\n",sid);
}

int main (int argc, char* argv[])
{
    if(argc!=6+1){
        printf("Judge argv error!\n");
        exit(1);
    }
    db_host=argv[1];
    db_port=argv[2];
    db_user=argv[3];
    db_pass=argv[4];
    db_name=argv[5];
    int sid=atoi(argv[6]); //solution id

    mysql = mysql_init(NULL);   //��ʼ�����ݿ����ӱ���
    mysql = mysql_real_connect(mysql,db_host,db_user,db_pass,db_name,atoi(db_port),NULL,0);
    if(!mysql){
        printf("Judge Error: Can't connect to database!\n\n");
        exit(1);
    }
    judge(sid);
    mysql_close(mysql);
    return 0;
}
