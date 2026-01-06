<script>
	function submit1(){
		if(!document.login.id.value) {
			alert("아이디를 입력하세요.");
			document.login_form.id.focus();
			return;
		}

		if(!document.login.pass.value) {
			alert("비밀번호를 입력하세요.")
			document.login.pass.focus();
			return;
		}
		document.login.submit();	// 아이디 비밀번호 제출했으면 login.php 로직으로 제출
	}

	function submit2(frm){
		if(!document.login.id.value) {
			alert("아이디를 입력하세요.");
			document.login_form.id.focus();
			return;
		}

		if(!document.login.pass.value) {
			alert("비밀번호를 입력하세요.")
			document.login.pass.focus();
			return;
		}
		frm.action='./login2.php';
		frm.submit();
		frm.submit();	//아이디 비밀번호 제출했으면 login.php 로직으로 제출
	}

	function submit3(frm){
		if(!document.login.id.value) {
			alert("아이디를 입력하세요.");
			document.login_form.id.focus();
			return;
		}

		if(!document.login.pass.value) {
			alert("비밀번호를 입력하세요.")
			document.login.pass.focus();
			return;
		}
		frm.action='./login3.php'; 
		frm.submit();
		frm.submit();	//아이디 비밀번호 제출했으면 login.php 로직으로 제출
	}

	function submit4(frm){
		if(!document.login.id.value) {
			alert("아이디를 입력하세요.");
			document.login_form.id.focus();
			return;
		}

		if(!document.login.pass.value) {
			alert("비밀번호를 입력하세요.")
			document.login.pass.focus();
			return;
		}
		frm.action='./login4.php'; 
		frm.submit();
		frm.submit();	//아이디 비밀번호 제출했으면 login.php 로직으로 제출
	}

	function submit5(frm){
		if(!document.login.id.value) {
			alert("아이디를 입력하세요.");
			document.login_form.id.focus();
			return;
		}

		if(!document.login.pass.value) {
			alert("비밀번호를 입력하세요.")
			document.login.pass.focus();
			return;
		}
		frm.action='./login5.php'; 
		frm.submit();
		frm.submit();	//아이디 비밀번호 제출했으면 login.php 로직으로 제출
	}
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
	<title>로그인 페이지</title>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
	<form name="login" method="post" action="login.php">		       	
	<div class="container-fluid">
		<h2 class="card-title mb-4">로그인</h2>
		<ul>
			<li>
				<span class="badge bg-primary">아이디</span>
				<span class="col2"><input type="text" name="id" placeholder="아이디"></span>
			</li>
			<li>
				<span class="badge bg-primary">비밀번호</span>
				<span class="col2"><input type="password" name="pass" placeholder="비밀번호"></span>
			</li>
		</ul>
		<input type="button" class="btn btn-primary" onclick="submit1()" value="로그인1">
		<input type="button" class="btn btn-primary" onclick="return submit2(this.form)" value="로그인2">
		<input type="button" class="btn btn-primary" onclick="return submit3(this.form)" value="로그인3">
		<input type="button" class="btn btn-primary" onclick="return submit4(this.form)" value="로그인4">
		<input type="button" class="btn btn-primary" onclick="return submit5(this.form)" value="로그인5">
	</div>
</form>
</body>
</html>