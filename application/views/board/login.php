<section class="img-bar login">
      <div class="inner">
        <div class="title">로그인</div>
        <div class="contents">어서오세요 성불사 홈페이지입니다.</div>
      </div>
    </section>
<section id="loginform">
      <div class="inner">
        <div class="form-wrap">
          <form>
            <input type="text" class="form-control id" placeholder="아이디" onkeypress="if(event.keyCode==13){login();}">
            <input type="password" class="form-control password" placeholder="비밀번호" onkeypress="if(event.keyCode==13){login();}">
          </form>
          <div class="btn" onclick="login();">로그인</div>
        </div>
      </div>
    </section>
    <script>
    function login() {
        var search = $('#gallery .search-wrap>input').val();
        var getUrl = window.location;
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
        var id = $('#loginform .id').val();
        var password = $('#loginform .password').val();
        if (id.length < 1) {
            alert('아이디를 입력해주세요');
            return false;
        } else if (password.length < 1) {
            alert('비밀번호를 입력해주세요');
            return false;
        } else {
            $.ajax({
                url: `${baseUrl}/index/board/action`,
                dataType: 'html',
                type: 'POST',
                data: {
                    'id': id,
                    'password': password
                },
                error: function (request, status, error) {
                    console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                },
                success: function (data) {
                    console.log(data);
                    /*if (data..result == 'ok') {
                        alert('로그인을 성공했습니다.');
                        location.href = '../index/index.php';
                    } else if (data.result == 'no') {
                        alert('아이디와 비밀번호를 다시 확인해주세요.');
                    }*/
                }
            }); //ajax
        }
    }
    </script>