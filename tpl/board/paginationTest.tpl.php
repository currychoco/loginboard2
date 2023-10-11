<!DOCTYPE html>
<html>
	<head>
	    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script src='/loginboard2/js/common/common.js'></script>
        <script>
            $(function() {
                header();
                pagination();

                $('.table tbody tr:nth-child(odd)').css('background', '#9F9F9F');

                $('#toWrite').click(function() {
                    location.href = '/loginboard2/controller/board/BoardWriteController.php?no=' + $('#no').val() + '&search=' + $('#search').val() + '&keyword=' + $('#keyword').val() + '&category=' + $('#urlCategoryId').val() + '&menu=' + $('#urlMenuId').val();
                });

                $('#searchButton').click(function() {
                    search();
                });

                $('#textList').click(function() {
                    setList('text');
                });

                $('#imageList').click(function() {
                    setList('image');
                });

            })
        </script>

        <link rel = 'stylesheet' href='/loginboard2/css/imageList.css' />

	</head>
	<body>
        <!-- header -->
        <?php // include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/header.php'?>
        <div id='header'>

        </div>

        <div class="container body-container">

            <div>
                <h3><?=$menu['name']?></h3>
                <p><?=$menu['content']?></p>
            </div>

            <!-- 검색창 -->
            <div class="form-inline" style="margin-bottom: 15px; text-align: right;">

                    <select class="form-control" id="search" name="search">
                        <option value="title">제목</option>
                        <option value="writer" <?php if($search == 'writer')  {?> selected='selected' <?php } ?>>작성자</option>
                    </select>

                <input type="text" class="form-control" id="keyword" placeholder="제목 검색" value="<?=$keyword?>"/><button class='glyphicon glyphicon-search btn btn-primary' id='searchButton'></button><br>
            </div>
            
            <!-- 출력형 -->
            <div style="float: right;">
                <ul style="float: right;">
                    <li><a href='#' class='glyphicon glyphicon-th-list' id='textList' title='글 목록 형태'></a></li>
                    <li><a href='#' class='glyphicon glyphicon-th-large' id='imageList' title='이미지 목록 형태'></a></li>
                </ul>
            </div>

            <!-- text 형 -->
            <?php if($list == 'text') { ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>번호</td>
                            <td>제목</td>
                            <td>글쓴이</td>
                            <td>날짜</td>
                            <td>조회수</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($listResult); $i++) { ?>
                        <tr>
                            <td>
                                <a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>&search=<?=$search?>&keyword=<?=$keyword?>&category=<?=$urlCategoryId?>&menu=<?=$urlMenuId?>"><?=$listResult[$i]['id']?></a>
                            </td>
                            <td>
                                <a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>&search=<?=$search?>&keyword=<?=$keyword?>&category=<?=$urlCategoryId?>&menu=<?=$urlMenuId?>"><?=$listResult[$i]['title']?></a>
                            </td>
                            <td>
                                <p><?=$listResult[$i]['user_id']?></p>
                            </td>
                            <td>
                                <p><?=$listResult[$i]['reg_date']?></p>
                            </td>
                            <td>
                                <p><?=$listResult[$i]['view_count']?></p>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
                
            <!-- image 형 -->
            <?php if($list == 'image') { ?>
            <div class='imageList'>
                <?php for($i = 0; $i < count($listResult); $i++) { ?>

                    <div class='contentBox'>
                        <div>
                            <a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>&search=<?=$search?>&keyword=<?=$keyword?>&category=<?=$urlCategoryId?>&menu=<?=$urlMenuId?>"><img src="http://myimage.com<?=$listResult[$i]['path']?>" onerror="this.src='http://myimage.com/loginboard2/img/no_image.png'"/></a>
                         </div>
                         <table>
                            <tr>
                                <th>제목</th>
                                <td><a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>&search=<?=$search?>&keyword=<?=$keyword?>&category=<?=$urlCategoryId?>&menu=<?=$urlMenuId?>"><?=$listResult[$i]['title']?></a></td>
                            </tr>
                            <tr>
                                <th>작성자</th>
                                <td><?=$listResult[$i]['user_id']?></td>
                            </tr>
                            <tr>
                                <th>작성일</th>
                                <td><?=$listResult[$i]['reg_date']?></td>
                            </tr>
                            <tr>
                                <th>조회수</th>
                                <td><?=$listResult[$i]['view_count']?></td>
                            </tr>
                        </table>
                    </div>

                <?php } ?>
            </div>
            <?php } ?>    

            <form>
                <input type="hidden" value="<?=$no?>" id='no'>
                <input type="hidden" value="<?=$totalRow?>" id='totalRow'>
                <input type="hidden" value="<?=$pageSize?>" id='pageSize'>
                <input type="hidden" value="<?=$pageListSize?>" id='pageListSize'>
                <input type='hidden' value="<?=$list?>" id='list'>
                <input type='hidden' id='urlCategoryId' value="<?=$urlCategoryId?>">
                <input type='hidden' id='urlMenuId' value="<?=$urlMenuId?>">

            </form>

            <div class="text-center" id='pagination'></div>

            <div style="float:right;">
                <button class="btn btn-primary" id='toWrite' style="margin-bottom: 20px">글쓰기</button>
            </div>
        </div>
	</body>
</html>