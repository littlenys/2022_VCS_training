#include <iostream>
#include <string.h>
#include <fstream>
#include <vector>
using namespace std;

//
// Ham dung de tach mot chuoi theo ky tu "delim" thanh mot chuoi cac vector 
// input (string,char) . Ex: str = "a;b;c;d" , delim = ";"
// output : {a,b,c,d} 
//
vector<string> vctSplit(const string& str, const string& delim)
{
    vector<string> tokens;
    size_t prev = 0, pos = 0;
    do
    {
        pos = str.find(delim, prev);
        if (pos == string::npos) pos = str.length();
        string token = str.substr(prev, pos-prev);
        if (!token.empty()) tokens.push_back(token);
        prev = pos + delim.length();
    }
    while (pos < str.length() && prev < str.length());
    return tokens;
} // end vector<string> vctSplit

//
// Doc mot file theo dong
// input : filePath
// output : cac dong duoi dang vector
//
vector<string> vctReadfile(string filename){    
    vector<string> lines;
    string line;
    //Mở file bằng ifstream
    ifstream ifsFile(filename);
    //Kiểm tra file đã mở thành công hay chưa
    if(!ifsFile){
        cerr << "Error: " << filename << " not opened." << endl;
        ifsFile.close();
        return {NULL};
    }
    else{
        //cout << "open done" << endl;
        //Đọc từng dòng trong
        while (getline(ifsFile,line)){
            line += "\n";
            lines.push_back(line);//Lưu từng dòng như một phần tử vào vector lines.
        }
        //Đóng file
        ifsFile.close();
        cout << "read " << filename <<" done..."<< endl;
        return lines;
    }
} // end vector<string> vctReadfile

//
// In ra cac thong tin theo yeu cau
//
void printInfo(vector<string> vctInfo){
    // 0: username
    // 1: password
    // 2: UserID
    // 3: GroupID
    // 4: GECOS
    // 5: Home directory
    // 6: Shell 
    cout << endl << "==== User Info ===="<< endl;
    cout << "ID: "      << vctInfo[2] << endl; 
    cout << "Name: "    << vctInfo[0] << endl;
    cout << "Home: "    << vctInfo[5] << endl;
    //cout << "Group:"    << vctInfo[3] << endl;
}

int main(){

    // filePath
    string strPasswdFilename("/etc/passwd");
    string strGroupFilename("/etc/group");

    // Nhap username
    cout << "Insert username: ";
    char    inpusername[64]// bien username nhap bang ban phim
            , username[64]; // Bien tam cua inpusername co ky tu cuoi de danh dau ket thuc
    fgets(inpusername, sizeof(inpusername)+1, stdin);

    // Xoa ky tu xuong dong
    strcat(username,inpusername);
    username[strlen(username)-1] = '\0';
    // Danh dau ket thuc username bang ky tu ':'. Tranh truong hop "user" , "userA"
    strcat(username,":");

    // Doc noi dung file Passwd va Group
    vector<string> linePasswd = vctReadfile(strPasswdFilename);
    vector<string> lineGroup  = vctReadfile(strGroupFilename);

    // for (const auto &i : lines) cout << endl << i;
    //Xuất từng dòng từ lines và in ra màn hình
    for (const auto &i : linePasswd){
        // Chi thuc thi cac phan khac khi user ton tai
        if (strncmp(username,i.c_str(), strlen(username)) == 0){
            // In ID, name, home
            vector<string> vctInfo = vctSplit(i,":");
            printInfo(vctInfo);

            // In cac Group 
            cout << "Group: " ;
            username[strlen(username)-1] = ',';
            for (const auto &j : lineGroup){
                // grp name - passwd - GID - User
                //     0    -   1    -  2  -   3
                vector<string> vctGroup = vctSplit(j,":");                
                if (vctGroup[3].find(inpusername) != string::npos // truong hop username o cuoi dong
                    || vctGroup[3].find(username) != string::npos ){ // truong hop username o giua danh dau ket thuc username bang dau ,
                    cout << vctGroup[0] << ", ";
                }
                vctGroup[3] = "";
            }
            cout << endl << "======== END =========" << endl;
            return 0;
        }
    }

    cout << endl << "================" << 
            endl << "username not found" << 
            endl << "===============" << endl;

    return 0;
}