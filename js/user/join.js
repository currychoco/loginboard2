$(function(){

    $('#checkdResult').val(-1);

    $('#name').keyup(function() {
        nameCheck($("#name").val());
    });

    $("input[type='tel']").keyup(function() {
        phoneNumCheck($("#phoneNumber").val());
    });

    $('#idCheckButton').click(function() {
        idCheck($("#userId").val());
    });

    $('#password').keyup(function() {
        pwValCheck($("#password").val());
    });

    $('#checkPassword').keyup(function() {
        pwCheck($("#password").val(), $("#checkPassword").val());
    });

    $('#joinButton').click(function() {
        userJoin();
    });

    // 다양한 이벤트 써보기

    $('#nameTooltip').tooltip();

    $("input[type='tel']").mouseenter(function() {
        $("input[type='tel']").tooltip();
    })
    
});

function idCheck(id) {

    const reg = /^[a-z]+[a-z0-9]{5,19}$/g;

    if(!reg.test(id)) {
        $("#checkResult").text("아이디는 영문자로 시작하며, 영문자와 숫자를 합쳐서 6글자 이상, 20이하만 가능합니다.");
        return false;
    }

    $.ajax({
        url : "/loginboard2/process/user/idCheck.php",
        type : "GET",
        data : {
            userId : id
        },
        dataType : 'json',

        success : function(data) {
            if(data.count < 1) {
                $("#checkResult").text("사용 가능");
                $('#checkedId').val(id);
            }
            else {
                $("#checkResult").text("중복된 아이디입니다.");
                $('#checkedId').val('');
            }

        },
        error : function(request, status, error) {
            console.log(status);
        }
    });

}

function pwValCheck(pw) {

    const reg = /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z]{8,16}$/;

    if(!reg.test(pw)) {
        $("#checkPwValResult").text("비밀번호는 숫자와 영문자를 포함하여 8자 이상, 16자 미만만 가능합니다.");
        return false;
    }
    else {
        $("#checkPwValResult").text("사용 가능");
        return true;
    }
}

function pwCheck(pw, checkPw) {

    const reg = /^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z]{8,16}$/;

    if(reg.test(pw) && (pw == checkPw)) {
        $("#checkPwResult").text("비밀번호가 일치합니다.");
        return true;
    } 
    else if (!reg.test(pw) && (pw == checkPw)) {
        $("#checkPwResult").text("비밀번호는 숫자와 영문자를 포함하여 8자 이상, 16자 미만만 가능합니다.");
        return false;
    }
    else {
        $("#checkPwResult").text("비밀번호가 일치하지 않습니다.");
        return false;
    }
}

function nameCheck(name) {

    const nameReg = /^[가-힣]{2,4}$/;

    if(!nameReg.test(name)) {
        $("#checkNameResult").text("이름은 한글로 2글자 이상, 4글자 이하만 가능합니다.");
        return false;
    }
    else {
        $("#checkNameResult").text("사용 가능");
        return true;
    }

}

function phoneNumCheck(phone) {

    const phoneReg = /^01(?:0|1|[6-9])-(?:\d{3}|\d{4})-\d{4}$/;

    if(!phoneReg.test(phone)){
        $("#checkNumResult").text("휴대폰 번호를 '-'기호를 포함하여 입력해 주십시오.");
        return false;
    }
    else {
        $("#checkNumResult").text("사용 가능");
        return true;
    }
}

function userJoin(){

    var name = $('#name').val();
    var phoneNumber = $('#phoneNumber').val();
    var userId = $('#checkedId').val();
    var password = $('#checkPassword').val();
    var gender = $('#gender').val();

    if(!nameCheck(name)) {
        alert("이름을 확인해 주세요.");
        return;
    }

    if(!phoneNumCheck(phoneNumber)) {
        alert("휴대폰 번호를 확인해 주세요.");
        return;
    }

    if(userId.length < 1 || (userId != $('#userId').val())) {
        alert("아이디를 확인해 주세요.");
        return;
    }
    
    if(!pwCheck($('#password').val(), password)) {
        alert("비밀번호를 확인해 주세요.");
        return;
    }

    $.ajax({
        url : '/loginboard2/process/user/join.php',
        type : 'POST',
        data : $('#joinForm').serialize(),
        dataType : 'json',
        
        success : function(data) {

            console.log(data);
            if(data.result) {
                alert('회원가입 성공');
                location.href = '/loginboard2/controller/user/UserLoginController.php';
            }
            else {
                alert('회원가입 실패');
            }

        },
        error : function(request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
        }
    });
}