#!/bin/bash
 
#
# Retrieving system utilization (CPU, RAM) from proc filesystem
#
 
 
calculate_cpu_load () {
 
 
    #Getting first idle
    prevIdle=$(grep 'cpu ' /proc/stat | awk '{idle=($5+$6)} END {print idle}')
    #Getting first nonIdle
    prevNonIdle=$(grep 'cpu ' /proc/stat | awk '{nonIdle=($2+$3+$4+$7+$8+$9)} END {print nonIdle}')
 
 
    #sleep an amount of time
    sleep $1
 
    #Getting second idle
    idle=$(grep 'cpu ' /proc/stat | awk '{idle=($5+$6)} END {print idle}')
    #Getting second nonIdle
    nonIdle=$(grep 'cpu ' /proc/stat | awk '{nonIdle=($2+$3+$4+$7+$8+$9)} END {print nonIdle}')
 
    #Getting total values
    PrevTotal=$(($prevIdle+$prevNonIdle))
    Total=$(($idle+$nonIdle))
 
    #Getting diffs
    totald=$(($Total-$PrevTotal))
    idled=$(($idle-$prevIdle))
 
    #Calculating CPU_PERCENTAGE
    CPU_PERCENTAGE=$(awk "BEGIN {print ($totald - $idled)/$totald*100}")
 
}
 
 
getting_free_ram () {
 
    #Getting Meminfo
    MEM_FREE=$(cat /proc/meminfo | awk 'NR==2' | awk '{freeMem=($2)} END {print freeMem}')
 
}
 
returning_json () {
 
    #Returning values as JSON
    echo "{ \"cpu_usage_percentage\":\"$CPU_PERCENTAGE\", \"mem_free\":\"$MEM_FREE\" }"
 
}
 
print_usage () {
 
    echo "usage: sysUtilization.sh 5 (time window in seconds)"
    exit
}
 
 
#check time window param
if [ -z $1 ]
then
    print_usage;
fi
 
if [ $1 -gt 0 ];
 
then
 
    #1. calculation of cpu load in percent of given time window from /proc/stat
        calculate_cpu_load $1
 
    #2. getting free mem from /proc/meminfo
        getting_free_ram
     
    #3. returning json
    returning_json
 
else
 
        print_usage
 
fi
