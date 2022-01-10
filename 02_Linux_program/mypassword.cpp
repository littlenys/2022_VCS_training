//#define _BSD_SOURCE /* Get getpass() declaration from <unistd.h> */
//#define _GNU_SOURCE
#include <iostream>
#include <unistd.h>
#include <limits.h>
#include <pwd.h>
#include <shadow.h>
#include <crypt.h>
#include "lib/tlpi_hdr.h"
#include <sys/fsuid.h>
using namespace std;

int main(int argc, char *argv[])
{
    uid_t ruid, euid, suid, fsuid;
    gid_t rgid, egid, sgid, fsgid;

    char    *username, // username
            *oldpassword, // mk cu
            *encrypted, // ma hoa cua old password
            *p, 
            *newpassword, // mk moi, duoc doi khi nhap dung mat khau cu
            *confirmpassword, // check lai mk da nhap
            *newencrypted; // mk moi da ma hoa
    struct passwd *pwd;
    struct spwd *spwd;
    bool    authOk, // True khi nhap dung oldpassword, khong thi False
            confirm; // True khi newpassword == confirmpassword
    size_t len;
    long lnmax;
    char *getpass(const char *prompt); // Hidden mk duoc nhap
    lnmax = sysconf(_SC_LOGIN_NAME_MAX);
    if (lnmax == -1) /* If limit is indeterminate */
        lnmax = 256; /* make a guess */
    
    // Nhap Username
    username = (char *)malloc(lnmax);
    if (username == NULL)
        cout << "malloc";
    printf("Username: ");
    fflush(stdout);
    if (fgets(username, lnmax, stdin) == NULL)
        exit(EXIT_FAILURE); /* Exit on EOF */
    len = strlen(username);
    if (username[len - 1] == '\n')
        username[len - 1] = '\0'; /* Remove trailing '\n' */
    
    // Lay thong tin Username
    pwd = getpwnam(username);
    if (pwd == NULL) // thoat khi nguoi dung khong ton tai
    {
        cout << "couldn't get password record" << endl;
        return 0;
    }

    // Nhap mat khau hien tai
    oldpassword = getpass("Password: "); //  (char*)malloc(lnmax);//
    cout << oldpassword << endl; // just for test
    spwd = getspnam(username);
    if (spwd == NULL && errno == EACCES)
    {
        cout << "no permission to read shadow password file" << endl;
        return 0;
    }

    if (spwd != NULL)                   /* If there is a shadow password record */
        pwd->pw_passwd = spwd->sp_pwdp; /* Use the shadow password */

    /* Encrypt password and erase cleartext version immediately */
    encrypted = crypt(oldpassword, pwd->pw_passwd);
    for (p = oldpassword; *p != '\0';)
        *p++ = '\0';
    if (encrypted == NULL)
    {
        cout << "crypt";
        return 0;
    }

    //errExit("crypt");
    authOk = strcmp(encrypted, pwd->pw_passwd) == 0;
    if (!authOk) // Thoat khi nhap sai mk
    {
        printf("Incorrect password\n");
        exit(EXIT_FAILURE);
    }
    cout << "Successfully authenticated: UID= " << (long)pwd->pw_uid << endl;

    // Nhap mk moi
    newpassword = getpass(" Enter new password: ");
    string strnewpassword(newpassword);

    cout << newpassword << endl; // Just for test
    
    // Confirm
    confirmpassword = getpass(" Confirm new password : ");
    string strconfirmpassword(confirmpassword);
    confirm = strnewpassword == strconfirmpassword;
    if (!confirm) // Thoat neu 2 mk da nhap khong khop
    {
        cout << "Confirm password not match" << endl;
        exit(EXIT_FAILURE);
    }

    // ma hoa mk moi va ghi vao bien
    spwd->sp_pwdp = crypt(confirmpassword, pwd->pw_passwd);

    // mo file va ghi mk moi
    FILE *fps;
    fps = fopen("/etc/shadow", "r+");
    putspent(spwd, fps);
    fclose(fps);
    /* Now do authenticated work... */
    exit(EXIT_SUCCESS);
}
