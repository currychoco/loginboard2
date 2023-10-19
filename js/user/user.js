// 로그인 체크
function loginCheckToLogin(userId) {
    if(userId) {
        alert("이미 로그인 되어 있습니다.")
        location.href = "/loginboard2/controller/board/BoardListController.php";
    }
}

// 삭제 시 로그인 체크
function loginCheckToDelete(userId ){
    if(!userId) {
        alert("로그인이 되어있지 않습니다.")
        location.href = "/loginboard2/controller/user/UserLoginController.php";
    }
}

// 회원가입 성공 시
function joinSuccess() {
    alert("회원가입 성공");
    location.href = "/loginboard2/controller/user/userLoginController.php";
}

// 로그인 버튼
function clickLoginButton(id, pw) {

    if(!idCheck(id)) {
        alert('아이디는 영문자로 시작하며, 영문자와 숫자를 합쳐서 6글자 이상, 20이하만 가능합니다.');
        return;
    }

    if(!pwCheck(pw)) {
        alert('비밀번호는 숫자와 영문자를 포함하여 8자 이상, 16자 미만만 가능합니다.');
        return;
    }

    $('#loginForm').submit();
}

// 회원가입 실패 시
function joinFail() {
    alert("회원가입 실패");
    history.go(-1);
}

// 아이디 유효성 검사
function idCheck(id) {

    const reg = /^[a-z]+[a-z0-9]{5,19}$/g;

    if(!reg.test(id)) {
        return false;
    }
    return true;
}

// 비밀번호 유효성 검사
function pwCheck(pw) {

    const reg = /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z]{8,16}$/;

    if(!reg.test(pw)) {
        return false;
    }
    return true;
}

// 로그인 시 아이디 없을 떄
function isNotId() {
    alert('일치하는 아이디가 없습니다.');
    history.go(-1);
}

// 로그인 시 비밀번호 일치하지 않을 때
function notEqualPw() {
    alert('비밀번호가 일치하지 않습니다.');
    history.go(-1);
}

// 로그인 되었을 때
function login() {
    location.href = '/loginboard2/controller/main/MainPageController.php';
}

// 로그아웃
function logout() {
    location.href = '/loginboard2/controller/main/MainPageController.php';
}

// 탈퇴 시
function deleteSuccess(result){

    if(result) {
        alert('탈퇴 성공하였습니다.');
    }
    else { 
        alert('탈퇴에 실패하였습니다. 잠시 후 다시 시도해 주세요.');
    }

    location.href = '/loginboard2/controller/board/BoardListController.php';
}

// 탈퇴버튼 클릭 시
function clickDeleteButton(){
    if(confirm('정말 탈퇴하시겠습니까?')) {
        location.href = '/loginboard2/process/user/delete.php';
    }
}

// 회원 정보 수정 버튼 클릭 시
function clickUpdateButton(){
    location.href = '/loginboard2/controller/user/UserUpdateController.php';
}

// 수정 취소 시
function updateCancel() {
    location.href = '/loginboard2/controller/user/UserInfoController.php';
}

// 수정 버튼 클릭 유효성검사 및 submit
function updateUser() {

    if(!nameValCheck($('#name').val())) {
        alert('이름은 한글로 2글자 이상, 4글자 이하만 가능합니다.');
        return;
    }

    if(!phoneNumValCheck($('#phoneNumber').val())) {
        alert("휴대폰 번호를 '-'기호를 포함하여 입력해 주십시오.");
        return;
    }

    if(!genderValCheck($('#gender').val())) {
        alert('성별 입력란을 확인해 주세요.');
        return;
    }

    if(confirm('정말 회원정보를 수정하시겠습니까?')) {
        $('#userUpdateForm').submit();
    }

}

// 수정 시
function updateSuccess(result){

    if(result) {
        alert('회원정보 수정에 성공하였습니다.');
    }
    else { 
        alert('회원정보 수정에 실패하였습니다. 잠시 후 다시 시도해 주세요.');
    }

    location.href = '/loginboard2/controller/user/UserInfoController.php';

}

// 이름 유효성 검사
function nameValCheck(name) {

    const nameReg = /^[가-힣]{2,4}$/;
    var result = false;
    
    if(nameReg.test(name)) {
        result = true;
    }
    
    return result;
}

// 휴대폰 번호 유효성 검사
function phoneNumValCheck(phoneNum) {

    const phoneReg = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;
    var result = false;

    if(phoneReg.test(phoneNum)) {
        result = true;
    }

    return result;
}

// 성별 유효성 검사
function genderValCheck(gender) {

    var result = false;

    if(gender >= 0 && gender <= 1){
        result = true;
    }

    return result;
}