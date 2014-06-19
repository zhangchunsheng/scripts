#!/bin/bash
for i in `ls`;do
    echo $i
done

function lsdir() {
    for i in `ls`;do
        if [ -d "$i" ] ;then
            cd ./$i
            lsdir
        else
            echo $i
        fi
    done
}
lsdir