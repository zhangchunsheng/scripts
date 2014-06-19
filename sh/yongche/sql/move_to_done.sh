#!/bin/bash


CURYEAR=`date '+%Y'`
TOPDIR=

function mv_help() {
    echo "usage: "
    echo "$0 <file1> <file2> ..."
    echo ""
    exit
}

function show_file_list() {
    num=0;
    files=()
    echo "what do you want to move?";
    for i in `ls`;do
        suffix=${i##*.}
        if [ $suffix == "sql" ];then
            num=$(($num+1));
            files[$num]=$i;
            echo $num. $i;
        fi
    done
    check_top_dir
    echo "enter num:";
    read CHOOSE_NUM
    move_to_dir ${files[$CHOOSE_NUM]};
    exit
}

function check_top_dir() {
    fullpath=`pwd`
    while [ x$fullpath != 'x' ]
    do
        if [ -e $fullpath/.git ];
        then
            TOPDIR=$fullpath
            break
        fi
        fullpath=${fullpath%/*}
    done
}

function move_to_dir() {
    file=$1;
    filename=${file%.*}
    db_name=${file%%-*}
    dest_dir="$TOPDIR/mysql/done/$db_name/$CURYEAR/"

    if [ ! -d $dest_dir ];
    then
        /bin/mkdir -p $dest_dir
    fi

    echo "=========================================="
    echo "INFO: Try to move $file to $dest_dir ... "

    /usr/bin/git mv $file $dest_dir

    if [ $? != 0 ];
    then
        echo "ERROR: move $file to $dest_dir faield"
    fi

    echo "INFO: Done"
    echo "=========================================="
}

if [ $# -lt 1 ]
then
    show_file_list
fi

if [ $1 == "--help" ]
then
    mv_help
fi


check_top_dir

if [ x$TOPDIR = x ]; 
then
    echo "ERROR: You must run this script under <common/sql> project"
    exit
fi

echo "INFO:====================================="
echo "INFO: Use $TOPDIR as <common/sql> project ROOT"
echo "INFO:====================================="

for file in $@;
do
    if [ ! -e $file ]; 
    then
        echo "ERROR: $file not exists!"
        break
    fi

    suffix=${file##*.}

    if [ x$suffix != 'xsql' ];
    then
        echo "ERROR: Only can move sql file to done"
        break
    fi

    filename=${file%.*}
    db_name=${file%%-*}
    dest_dir="$TOPDIR/mysql/done/$db_name/$CURYEAR/"

    if [ ! -d $dest_dir ];
    then
        /bin/mkdir -p $dest_dir 
    fi

    echo "=========================================="
    echo "INFO: Try to move $file to $dest_dir ... "

    /usr/bin/git mv $file $dest_dir

    if [ $? != 0 ]; 
    then
        echo "ERROR: move $file to $dest_dir faield"
        break;
    fi

    echo "INFO: Done"
    echo "=========================================="

done

echo "INFO: All Done!"
