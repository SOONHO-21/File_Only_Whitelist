<?php
    include "../include/session.php";

    if(!$userid) {
        echo "<script>
                window.alert('회원 정보수정은 로그인한 사용자만 할 수 있습니다.');
                history.go(-1);
            </script>";
    }
    
    include "../include/db_connect.php";

    $sql = "SELECT * FROM _mem WHERE id='$userid'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);

    $id = $row["id"];
    $pass = $row["pass"];
    $name = $row["name"];
    $email = $row["email"];
    $profile_img = $row['profile_img'];
    $regist_day = date("Y-m-d (H:i)");
?>
<script>
    function check_id(){    // 아이디 중복 체크
        window.open("check_id.php?id=" + document.member.id.value,
            "IDcheck",
            "left=700,top=300,width=380,height=160,scrollbars=no,resizable=yes");
    }
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<body> 
    <h2>프로필</h2>
    <?php if($profile_img) { ?>
        <img src="./profile_upload/<?=$profile_img?>" width="220" height="150"><br>
    <?php } else { ?>
        <img src="../img/default_profile.png" width="220" height="150"><br>
    <?php } ?>

    <ul class="list-group">
        <li class="list-group-item">
            <span class="col1">아이디</span>
            <span class="col2"><?=$userid?></span>
        </li>
        <li class="list-group-item">
            <span class="col1">이름</span>
            <span class="col2"><?=$name?></span>
        </li>
        <li class="list-group-item">
            <span class="col1">이메일</span>
            <span class="col2"><?=$email?></span>
        </li>
    </ul>

    <span class="col1">내가 쓴 글</span>
    <br>
    <?php
        $sql = "SELECT * FROM board WHERE id='$userid' ORDER BY num DESC";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $num = $row["num"];
            $subject = $row["subject"];
    ?>
    <li class="list-group-item">
        <a href = "../mboard/view.php?num=<?=$num?>"><?=$subject?></a>
    </li>
    <?php
        }
    ?>
</body>
</html>