(function ($) {
    "use strict"; // Start of use strict
    // Closes the sidebar menu
    $(".menu-toggle").click(function (e) {
        if ($(this).hasClass('active')) {
            $(".menu-toggle>.icon").css("background-position", "0px 0px");
        } else {
            $(".menu-toggle>.icon").css("background-position", "0px 25px");
        }
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
        $(".menu-toggle>icon").css("background-position", "0px 25px");
        $(this).toggleClass("active");
    });


    // Scroll to top button appear
    $(document).scroll(function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    $('#nav').mouseenter(function () {
        var $gnb = $('#gnb');
        if (!$gnb.is(':animated')) {
            $gnb.slideDown()
        }
    });
    $('#nav').mouseleave(function () {
        $('#gnb').slideUp('fast');
    });
    /*네비게이션*/

    var height = $('#main-gal .main-gallery>.img').css('width');
    $('#main-gal .main-gallery>.img').css('height', height);
    $('#main-gal .main-gallery>.text').css('height', height);

    $('.menu-m').click(function () {
        if (!$('#sidebar-wrapper').hasClass('active')) {
            $('#menu-bg').remove();
            $('#menu-bg').off('scroll touchmove mousewheel');
            $('#sidebar-wrapper').off('scroll touchmove mousewheel');
        } else {
            $('#page-top').prepend('<div id=\"menu-bg\"><\/div>');
            var winHeight = document.body.scrollHeight;
            $('#menu-bg').css('height', winHeight);
            $('#menu-bg').on('scroll touchmove mousewheel', function (event) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            });
            $('#sidebar-wrapper').on('scroll touchmove mousewheel', function (event) {
                event.preventDefault();
                event.stopPropagation();
                return false;
            });
        }
    });
    //사이드메뉴 배경처리

    $('.sidebar-nav-item').click(function () {
        $('.sidebar-nav-item').attr('aria-expanded', 'false');
        $('#sidebar-wrapper .collapse').attr('aria-expanded', 'false');
        $('#sidebar-wrapper .collapse').removeClass('in');
    });
    //사이드메뉴 클릭처리


})(jQuery); // End of use strict
var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

function login() {
    var search = $('#gallery .search-wrap>input').val();

    var id = $('#loginform .id').val();
    var password = $('#loginform .password').val();
    if (id.length < 1) {
        alert('아이디를 입력해주세요');
        return false;
    } else if (password.length < 1) {
        alert('비밀번호를 입력해주세요');
        return false;
    } else {
    	console.log(baseUrl);
        $.ajax({
            url: `${baseUrl}/index/action/login`,
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
                if (data == 'ok') {
                    alert('로그인을 성공했습니다.');
                    location.href = `${baseUrl}/index/index`;
                } else if (data == 'no') {
                    alert('아이디와 비밀번호를 다시 확인해주세요.');
                }
            }
        }); //ajax
    }
}
/*로그인*/


function insertScholar() {
    var year = $('#insert-scholar .year').val();
    var name = $('#insert-scholar .name').val();
    var school = $('#insert-scholar .school').val();
    var grade = $('#insert-scholar .grade').val();
    var local = $('#insert-scholar .local').val();
    var degree = $('#insert-scholar .degree:checked').val();
	var type='insert'
    if (year.length < 1) {
        alert('장학년도를 입력해주세요');
        return false;
    } else if (name.length < 1) {
        alert('학생성명을 입력해주세요');
        return false;
    } else if (degree.length < 1) {
        alert('학교분류를 입력해주세요');
        return false;
    } else if (school.length < 1) {
        alert('학교명을 입력해주세요');
        return false;
    } else if (grade.length < 1) {
        alert('학년을 입력해주세요');
        return false;
    } else if (local.length < 1) {
        alert('지역을 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/scholarAction`,
            type: 'POST',
            data: {
            	'type':type,
                'year': year,
                'name': name,
                'degree': degree,
                'school': school,
                'grade': grade,
                'local': local
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if(data){
                	alert('등록이 되었습니다.');
                	location.href=`${baseUrl}/index/info/scholarship/${year}`
				}
            }
        }); //ajax
    }
}
/*장학회등록*/

function deleteScholar(idx) {
    if (confirm('정말 삭제하시겠습니까?')) {
    	var type='delete';
        $.ajax({
            url: `${baseUrl}/index/action/scholarAction`,
            type: 'POST',
            data: {
            	'type':type,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data){
                	alert('정상적으로 삭제되었습니다.');
                	location.href=`${baseUrl}/index/info/scholarship`;
				}
            }
        }); //ajax
    }
}
/*장학회삭제*/

function updateScholar(idx) {
    var year = $('#insert-scholar .year').val();
    var name = $('#insert-scholar .name').val();
    var school = $('#insert-scholar .school').val();
    var grade = $('#insert-scholar .grade').val();
    var local = $('#insert-scholar .local').val();
    var degree = $('#insert-scholar .degree:checked').val();
	var type='update';
    if (year.length < 1) {
        alert('장학년도를 입력해주세요');
        return false;
    } else if (name.length < 1) {
        alert('학생성명을 입력해주세요');
        return false;
    } else if (degree.length < 1) {
        alert('학교분류를 입력해주세요');
        return false;
    } else if (school.length < 1) {
        alert('학교명을 입력해주세요');
        return false;
    } else if (grade.length < 1) {
        alert('학년을 입력해주세요');
        return false;
    } else if (local.length < 1) {
        alert('지역을 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/scholarAction`,
            type: 'POST',
            data: {
            	'type':type,
                'year': year,
                'name': name,
                'degree': degree,
                'school': school,
                'grade': grade,
                'local': local,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if(data){
                	alert('수정완료');
                	location.href=`${baseUrl}/index/info/scholarship`;
				}
            }
        }); //ajax
    }
}

function updateScholarCnt() {
    var grade1 = $('#grade1').val();
    var grade2 = $('#grade2').val();
    var grade3 = $('#grade3').val();
    var grade4 = $('#grade4').val();
    var type = 'update_cnt';
    var year = $('#year').val();
    if (grade1.length < 1 || grade2.length < 1 || grade3.length < 1 || grade4.length < 1) {
        alert('인원수를 제대로 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/scholarAction`,
            data: {
                'grade1': grade1,
                'grade2': grade2,
                'grade3': grade3,
                'grade4': grade4,
                'type': type,
                'year': year
            },
            type: 'POST',
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
}
/*장학회수정*/


function insertEvent() {
    var start = $('#insertEvent-form .start').val();
    var end = $('#insertEvent-form .end').val();
    var title = $('#insertEvent-form .title').val();
    var description = $('#insertEvent-form .description').val();

    if (start.length < 1) {
        alert('시작일을 입력해주세요');
        return false;
    } else if (end.length < 1) {
        alert('마지막일을 입력해주세요');
        return false;
    } else if (title.length < 1) {
        alert('행사명을 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/eventAction`,
            type: 'POST',
            data: {
                'start': start,
                'end': end,
                'title': title,
                'description': description
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if(data){
                	alert("등록이 되었습니다.");
                	location.href=`${baseUrl}/index/info/month`;
				}
            }
        }); //ajax
    }
}
/*행사등록하기*/

function deleteEvent(id) {
    if (confirm('정말 삭제하시겠습니까?')) {
        $.ajax({
            url: `${baseUrl}/index/action/eventDelete`,
            type: 'POST',
            data: {
                'id': id
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
				if(data){
					alert("성공적으로 삭제되었습니다.");
					location.href=`${baseUrl}/index/info/updateEvent`;
				}else{
					alert('오류가 발생했습니다.');
				}
            }
        }); //ajax
    }
}
/*행사삭제*/

function updateEvent(id) {
    var start = $('#insertEvent-form .start').val();
    var end = $('#insertEvent-form .end').val();
    var title = $('#insertEvent-form .title').val();
    var description = $('#insertEvent-form .description').val();

    if (start.length < 1) {
        alert('시작일을 입력해주세요');
        return false;
    } else if (end.length < 1) {
        alert('마지막일을 입력해주세요');
        return false;
    } else if (title.length < 1) {
        alert('행사명을 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/eventUpdate`,
            type: 'POST',
            data: {
                'start': start,
                'end': end,
                'title': title,
                'description': description,
                'id': id
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if(data){
                	alert('수정이 되었습니다.');
                	location.href=`${baseUrl}/index/info/month`;
				}else{
                	alert('오류가 있습니다.');
					location.href=`${baseUrl}/index/info/month`;
				}
            }
        }); //ajax
    }
}
/*행사수정하기*/

function insertNotice() {
    var title = $('#insertNotice-form .title').val();

	if (title.length < 1) {
		alert('제목을 입력해주세요');
		return false;
	} else {
		var formData = new FormData($("#insertNotice-form")[0]);
		$.ajax({
			url: `${baseUrl}/index/action/noticeAction`,
			processData: false,
			contentType: false,
			dataType: 'html',
			type: 'POST',
			data: formData,
			error: function (request, status, error) {
				console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
			},
			success: function (data) {
				if (data) {
					alert('성공적으로 등록되었습니다.');
					$('#insertNotice-form')[0].reset();
					location.href = `${baseUrl}/index/board/notice`;
				} else if (data.result == '0') {
					alert('오류가 발생하였습니다.');
					$('#insertNotice-form')[0].reset();
					console.log('result : ' + data.result + ', msg : ' + data.msg +
						', msg2 : ' + data.msg2);
				}
			}
		}); //ajax
	}
}
/*알림방 등록하기*/

function deleteNotice(idx) {
    if (confirm('정말 삭제하시겠습니까?')) {
        var file = $('#file-name').val();
        $.ajax({
			url: `${baseUrl}/index/action/noticeDelete`,
            dataType: 'html',
            type: 'POST',
            data: {
                'idx': idx,
                'file': file
            },
            error: function (request, status, error) {},
            success: function (data) {
				if(data){
					alert("성공적으로 삭제되었습니다.");
					location.href=`${baseUrl}/index/board/notice`;
				}else{
					alert('오류가 발생했습니다.');
				}
               /* if (data.result == '1') {
                    alert('성공적으로 삭제되었습니다.');
                    location.href = "../board/notice.php";
                } else if (data.result == '0') {
                    alert('오류가 발생하였습니다.');
                    console.log('result : ' + data.result + ', msg : ' + data.msg);
                }*/
            }
        }); //ajax
    }
}
/*알림방삭제*/

function notice_search() {
    var search = $('#notice .search-wrap>input').val();
    location.href = `${baseUrl}/index/board/notice/1/${search}`;
}
/*알림방 검색*/

function updateNotice(idx) {
    var type = 'update';
    var oldFile = $('#updatetNotice-form .old-file').val();
    var title = $('#updatetNotice-form .title').val();
    var contents = $('#updatetNotice-form .contents').val();

    if (title.length < 1) {
        alert('제목을 입력해주세요');
        return false;
    } else if (contents.length < 1) {
        alert('내용을 입력해주세요');
        return false;
    } else {
        var formData = new FormData($("#updatetNotice-form")[0]);

        $.ajax({
            url: `${baseUrl}/index/action/noticeUpdate`,
            dataType: 'html',
            type: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
            	 if (data) {
                    alert('성공적으로 수정되었습니다.');
                    $('#updatetNotice-form')[0].reset();
                    location.href = `${baseUrl}/index/board/notice`;
                } else {
                    alert('오류가 발생하였습니다.');
                    $('#updatetNotice-form')[0].reset();
                    console.log('result : ' + data.result + ', msg : ' + data.msg + ', msg2 : ' + data.msg2);
                }
            }
        }); //ajax
    }
}
/*알림방수정하기*/

function insertGallery() {
    var type = 'insert';
    var title = $('#insertGallery-form .title').val();
    var search = $('#gallery .search-wrap>input').val();


    if (title.length < 1) {
        alert('제목을 입력해주세요');
        return false;
    } else {
        var formData = new FormData($("#insertGallery-form")[0]);
        $.ajax({
            url: `${baseUrl}/index/action/galleryAction`,
            processData: false,
            contentType: false,
            dataType: 'html',
            type: 'POST',
            data: formData,
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data) {
                    alert('성공적으로 등록되었습니다.');
                    $('#insertGallery-form')[0].reset();
                    location.href = `${baseUrl}/index/board/gallery`;
                } else if (data.result == '0') {
                    alert('오류가 발생하였습니다.');
                    $('#insertGallery-form')[0].reset();
                    console.log('result : ' + data.result + ', msg : ' + data.msg +
                        ', msg2 : ' + data.msg2);
                }
            }
        }); //ajax
    }
}
/*알림방 등록하기*/

function gallery_search() {
    var search = $('#gallery .search-wrap>input').val();
    location.href = `${baseUrl}/index/board/gallery/1/${search}`;
}
/*갤러리 검색*/

function deleteGallery(idx) {
    if (confirm('정말 삭제하시겠습니까?')) {
        var type = 'delete';
        var file = $('#file_name').val();
        $.ajax({
            url: `${baseUrl}/index/action/galleryDelete`,
            type: 'POST',
            data: {
                'type': type,
                'idx': idx,
                'file': file
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data == '1') {
                    alert('성공적으로 삭제되었습니다.');
                    location.href = `${baseUrl}/index/board/gallery`;
                } else if (data == '0') {
                    alert('오류가 발생하였습니다.');
                    console.log('result : ' + data.result + ', msg : ' + data.msg);
                }
            }
        }); //ajax
    }
}
/*갤러리삭제*/

function updateGallery(idx) {
    var title = $('#updateGallery-form .title').val();
    if (title.length < 1) {
        alert('제목을 입력해주세요');
        return false;
    } else {
        var formData = new FormData($("#updateGallery-form")[0]);
        $.ajax({
            url: `${baseUrl}/index/action/galleryUpdate`,
            dataType: 'html',
            type: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data) {
                    alert('성공적으로 수정되었습니다.');
                    $('#updateGallery-form')[0].reset();
                    location.href = `${baseUrl}/index/board/gallery`;
                } else{
                    alert('오류가 발생하였습니다.');
                    $('#updateGallery-form')[0].reset();
                    console.log('result : ' + data.result + ', msg : ' + data.msg + ', msg2 : ' + data.msg2);
                }
            }
        }); //ajax
    }
}
/*갤러리수정하기*/

function insertExecutive() {
    var type = 'insert';
    var job = $('#insert-executive .job').val();
    var name = $('#insert-executive .name').val();
    var phone = $('#insert-executive .phone').val();
    if (job.length < 1) {
        alert('직무를 입력해주세요');
        return false;
    } else if (name.length < 1) {
        alert('성명을 입력해주세요');
        return false;
    } else if (phone.length < 1) {
        alert('연락처를 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/executiveAction`,
            type: 'POST',
            data: {
                'type': type,
                'job': job,
                'name': name,
                'phone': phone
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
               if(data){
               		alert('등록이 되었습니다');
               		location.href=`${baseUrl}/index/info/organization`;
			   }
            }
        }); //ajax
    }
}
/*임원등록*/

function deleteExecutive(idx) {
    if (confirm('정말 삭제하시겠습니까?')) {
        var type = 'delete';
        $.ajax({
            url: `${baseUrl}/index/action/executiveAction`,
            type: 'POST',
            data: {
                'type': type,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
				if(data){
					alert('삭제 되었습니다');
					location.href=`${baseUrl}/index/info/organization`;
				}
            }
        }); //ajax
    }
}
/*임원삭제*/

function updateExecutive(idx) {
    var type = 'update';
    var job = $('#insert-executive .job').val();
    var name = $('#insert-executive .name').val();
    var phone = $('#insert-executive .phone').val();

    if (job.length < 1) {
        alert('직무를 입력해주세요');
        return false;
    } else if (name.length < 1) {
        alert('성명을 입력해주세요');
        return false;
    } else if (phone.length < 1) {
        alert('연락처를 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/executiveAction`,
            type: 'POST',
            data: {
                'type': type,
                'job': job,
                'name': name,
                'phone': phone,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data) {
                    alert('성공적으로 수정되었습니다.');
                    location.href = `${baseUrl}/index/info/organization`;
					$('#insert-executive')[0].reset();
                } else if (data.result == '0') {
                    alert('오류가 발생하였습니다.');
                    $('#insert-executive')[0].reset();
                    console.log('result : ' + data.result + ', msg : ' + data.msg);
                }
            }
        }); //ajax
    }
}
/*임원수정*/

function moveExecutive(way, seq, test, idx) {
    var type = way;
    if (way == 'up' && seq == test) {
        console.log('seq 더 올라가지 않음.');
    } else if (way == 'down' && seq == test) {
        console.log('seq 더 내려가지 않음.');
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/executiveAction`,
            type: 'POST',
            data: {
                'type': type,
                'seq': seq,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
            	var data=JSON.parse(data);
            	if (data.result == '1') {
					$('#executive .exeTbody').html(data.table);
				} else if (data.result == '0') {
					alert('오류가 발생하였습니다.');
					console.log('result : ' + data.result + ', msg : ' + data.msg);
				}
            }
        }); //ajax
    }
}
/*임원이동*/

function insertSchedule(period) {
    var title = $('#insert-schedule .title').val();
    var contents = $('#insert-schedule .contents').val();
    if (title.length < 1) {
        alert('제목을 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/scheduleActions`,
            type: 'POST',
            data: {
                'title': title,
                'contents': contents,
                'period': period
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data) {
                    alert('성공적으로 입력되었습니다.');
                    $('#insert-schedule')[0].reset();
                    location.href = `${baseUrl}/index/info/schedule`;
                } else {
                    alert('오류가 발생하였습니다.');
                    $('#insert-schedule')[0].reset();
                    console.log('result : ' + data.result + ', msg : ' + data.msg);
                }
            }
        }); //ajax
    }
}
/*일정등록*/

function deleteSchedule(period, idx) {
    if (confirm('정말 삭제하시겠습니까?')) {
        $.ajax({
            url: `${baseUrl}/index/action/scheduleDelete`,
            type: 'POST',
            data: {
                'idx': idx,
                'period': period
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                console.log(data);
                if(data){
                	alert('삭제가 되었습니다.');
                	location.href=`${baseUrl}/index/info/schedule`;
				}
            }
        }); //ajax
    }
}
/*일정삭제*/

function updateSchedule(period, idx) {
    var title = $('#insert-schedule .title').val();
    var contents = $('#insert-schedule .contents').val();

    if (title.length < 1) {
        alert('제목을 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/scheduleUpdate`,
            type: 'POST',
            data: {
                'title': title,
                'contents': contents,
                'period': period,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if(data){
                	alert("수정이 되었습니다.");
                	location.href=`${baseUrl}/index/info/schedule`;
				}
            }
        }); //ajax
    }
}
/*일정수정*/

function insertSponsor() {
    var type = 'insert';
    var money = $('#insert-sponsor .money').val();
    var name = $('#insert-sponsor .name').val();
    var location2 = $('#insert-sponsor .location').val();

    if (money.length < 1) {
        alert('후원금액을 입력해주세요');
        return false;
    } else if (name.length < 1) {
        alert('성명을 입력해주세요');
        return false;
    } else if (location.length < 1) {
        alert('주소를 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/sponsorAction`,
            type: 'POST',
            data: {
                'type': type,
                'money': money,
                'name': name,
                'location': location2
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if(data){
                	alert('스퐅서 등록완료');
					location.href=`${baseUrl}/index/info/sponsor`;
				}
            }
        }); //ajax
    }
}
/*임원등록*/

function updateSponsor(idx) {
    var type = 'update';
    var money = $('#insert-sponsor .money').val();
    var name = $('#insert-sponsor .name').val();
    var location = $('#insert-sponsor .location').val();

    if (money.length < 1) {
        alert('후원금액을 입력해주세요');
        return false;
    } else if (name.length < 1) {
        alert('성명을 입력해주세요');
        return false;
    } else if (location.length < 1) {
        alert('주소를 입력해주세요');
        return false;
    } else {
        $.ajax({
            url: `${baseUrl}/index/action/sponsorAction`,
            type: 'POST',
            data: {
                'type': type,
                'money': money,
                'name': name,
                'location': location,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data) {
                    alert('성공적으로 수정되었습니다.');
                    history.back();
                } else {
                    alert('오류가 발생하였습니다.');
                    $('#insert-sponsor')[0].reset();
                    console.log('result : ' + data.result + ', msg : ' + data.msg);
                }
            }
        }); //ajax
    }
}
/*임원수정*/

function deleteSponsor(idx) {
    if (confirm('정말 삭제하시겠습니까?')) {
        var type = 'delete';
        $.ajax({
            url: `${baseUrl}/index/action/sponsorAction`,
            type: 'POST',
            data: {
                'type': type,
                'idx': idx
            },
            error: function (request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            },
            success: function (data) {
                if (data) {
                    alert('성공적으로 삭제되었습니다.');
                    location.href = `${baseUrl}/index/info/sponsor`;
                } else if (data.result == '0') {
                    alert('오류가 발생하였습니다.');
                    console.log('result : ' + data.result + ', msg : ' + data.msg);
                }
            }
        }); //ajax
    }
}
/*임원삭제*/
