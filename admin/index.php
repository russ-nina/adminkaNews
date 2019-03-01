<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./jquery-3.3.1.min.js"></script>
    <script src="./script.js"></script>
    <title>News&Articles Admin</title>
</head>
<body>
<div class="cover">
    <!--    Menu-->
    <nav class="menu">
        <a href="#" class="logo">news &<br>articles</a>
        <ul>
            <li class="item active">
                <a href="#titleAll">Articles</a>
                <ul class="innerMenu">
                    <li><a href="#titleAll">All articles</a></li>
                    <li><a href="#titleCreate">Create article</a></li>
                </ul>
            </li>
            <li class="item">
                <a href="#media">Mediafile</a></li>
            <li class="item">
                <a href="#pagesAll">Pages</a>
                <ul class="innerMenu">
                    <li><a href="#pagesAll">All pages</a></li>
                    <li><a href="#pagesCreate">Create page</a></li>
                </ul>
            </li>
            <li class="item">
                <a href="#categoryAll">Category</a>
                <ul class="innerMenu">
                    <li><a href="#categoryAll">All category</a></li>
                    <li><a href="#categoryCreate">Create category</a></li>
                </ul>
            </li>
        </ul>
        <a href="#" class="logOut">Out</a>
    </nav>

    <div class="wrap">

        <!--    Articles-->

        <div class="wrap-section wrap-section__titleAll active" data-target="titleAll">
            <h2>All articles</h2>
            <div class="wrap-section-content ">
            </div>
        </div>
        <div class="wrap-section wrap-section__titleCreate" data-target="titleCreate">
            <h2>Create articles</h2>
            <p class="headlineArticle">Headline:</p>
            <input type="text" class="wrap-section-input headlineArticleInput" name="name">
            <div class="bigCover">
                <div class="smallCover">
                    <p class="authorArticle">Author:</p>
                    <input type="text" class="wrap-section-input-author" name="author">
                </div>
                <div class="smallCover">
                    <p class="tagArticle">Tag:</p>
                    <input type="text" class="wrap-section-input-tag" name="tag">
                </div>
            </div>
            <p class="categoryArticle">Category:</p>
            <select name="categorySite" class="categorySite categorySiteCreate"></select>
            <p class="filterArticle">Filter:</p>
            <div class="coverOptionFilter">
                <p><input class="optionFilter" type="radio" name="optionFilter" value="weighty">Weighty</p>
                <p><input class="optionFilter" type="radio" name="optionFilter" value="popular">Popular</p>
                <p><input class="optionFilter" type="radio" name="optionFilter" value="archived">Archived</p>
            </div>
<!--            <form enctype="multipart/form-data" method="post" class="formDownloadPreview">-->
<!--                <p class="previewArticle">Preview:</p>-->
<!--                <p><input class="preview" type="file" name="img" accept="image/png,image/jpeg" value="choose">-->
<!--                    <input type="submit" value="Send"></p>-->
<!--            </form>-->
            <form enctype="multipart/form-data" method="post" class="formDownloadImg formDownloadImgCreate">
                <p class="imgArticle">Picture:</p>
                <p><input class="upload" type="file" name="img" multiple accept="image/png,image/jpeg" value="choose">
<!--                    <input type="submit" value="Send"></p>-->
            </form>
            <div class="wrap-section-btnText">
                <input type="button" class="btnText-btn btnText-btn__bold" value="B" data-action="bold">
                <input type="button" class="btnText-btn btnText-btn__addImg" value="img" data-action="insertImage">
            </div>
            <p class="wrap-section-textarea wrap-section-textarea-style" contenteditable="true"></p>
            <a href="#" class="save">Publish</a>
        </div>
<!--        Modal-->
        <div id="myModalArticle" class="modal_window__articleRedact">
            <div class=" wrap_section__articleRedact" data-target="articleRedact">
                <h2>Redact articles</h2>
                <p class="headlineArticle">Headline:</p>
                <input type="text" class="wrap-section-input headlineArticleInput" name="name">
                <div class="bigCover">
                    <div class="smallCover">
                        <p class="authorArticle">Author:</p>
                        <input type="text" class="wrap-section-input-author" name="author">
                    </div>
                    <div class="smallCover">
                        <p class="tagArticle">Tag:</p>
                        <input type="text" class="wrap-section-input-tag" name="tag">
                    </div>
                </div>
                <p class="categoryArticle">Category:</p>
                <select name="categorySite" class="categorySite categorySiteModal"></select>
                <p class="filterArticle">Filter:</p>
                <div class="coverOptionFilter">
                    <p><input class="optionFilter" type="radio" name="optionFilterModal" value="weighty">Weighty</p>
                    <p><input class="optionFilter" type="radio" name="optionFilterModal" value="popular">Popular</p>
                    <p><input class="optionFilter" type="radio" name="optionFilterModal" value="archived">Archived</p>
                </div>
<!--                <form enctype="multipart/form-data" method="post" class="formDownloadPreview">-->
<!--                    <p class="previewArticle">Preview:</p>-->
<!--                    <p><input class="preview" type="file" name="img" accept="image/png,image/jpeg" value="choose">-->
<!--                        <input type="submit" value="Send"></p>-->
<!--                </form>-->
                <form enctype="multipart/form-data" method="post" class="formDownloadImg">
                    <p class="imgArticle">Picture:</p>
                    <p><input type="file" name="img[]" multiple accept="image/png,image/jpeg" value="choose">
<!--                        <input type="submit" value="Send"></p>-->
                </form>
                <div class="wrap-section-btnText">
                    <input type="button" class="btnText-btn btnText-btn__bold" value="B" data-action="bold">
                    <input type="button" class="btnText-btn btnText-btn__addImg" value="img" data-action="insertImage">
                </div>
                <p class="wrap-section-textarea wrap_section_textarea_style article_content" contenteditable="true"></p>
                <div class="coverButtons">
                    <a href="#" class="save_article">Save</a>
                    <a href="#" class="cancel_article">Cancel</a>
                </div>
            </div>
        </div>
        <!--    Articles-->

        <!--    Mediafile-->

        <div class="wrap-section wrap-section__media " data-target="media">
            <h2>Mediafile</h2>
            <ul class="media">
                <li class="media-item "><a href="#media-all">All</a></li>
                <li class="media-item active"><a href="#media-download">Download</a></li>
            </ul>
            <div class="media-wrap">
                <div class="media-wrap-section media-all " data-target="media-all">
                    <h3>All</h3>

                </div>
                <div class="media-wrap-section media-download active" data-target="media-download">
                    <h3>Download</h3>
                    <form action="#">
                        <input type="file" class="upload">
                        <input type="submit" class="uploadSend">
                    </form>
                </div>
            </div>
        </div>

        <!--    Mediafile-->

        <!--    Pages-->

        <div class="wrap-section wrap-section__pagesAll" data-target="pagesAll">
            <h2>All pages</h2>
            <div class="wrap-section-content-pages">
            </div>
        </div>
        <div class="wrap-section wrap-section__pagesCreate" data-target="pagesCreate">
            <h2>Create page</h2>
            <input type="text" class="wrap-section-input alias" name="name">
            <div class="wrap-section-btnText">
                <input type="button" class="btnText-btn btnText-btn__bold" value="B" data-action="bold">
            </div>
            <p class="wrap-section-textarea-pages wrap-section-textarea-style" contenteditable="true"></p>
            <a href="#" class="save-pages">Publish</a>
        </div>
<!--        Modal-->
        <div id="myModal"class="modal_window__pagesRedact" data-id="0">
            <div class="wrap_section__pagesRedact" data-target="pagesRedact">
                <h2>Redact page</h2>
                <input type="text" class="wrap-section-input input_name alias" name="name">
                <div class="wrap_section_btnText">
                    <input type="button" class="btnText_btn btnText_btn__bold" value="B" data-action="bold">
                </div>
                <p class="wrap_section_textarea_pages wrap_section_textarea_style page_content" contenteditable="true"></p>
                <div class="coverButtons">
                    <a href="#" class="save_page">Save</a>
                    <a href="#" class="cancel_page">Cancel</a>
                </div>
            </div>
        </div>

        <!--    Pages-->

        <!--    Category-->

        <div class="wrap-section wrap-section__categoryAll" data-target="categoryAll">
            <h2>All category</h2>
            <div class="wrap-section-content-category">
            </div>
        </div>
        <div class="wrap-section wrap-section__categoryCreate" data-target="categoryCreate">
            <h2>Create category</h2>
            <input type="text" class="wrap-section-input aliasCat" name="name">
            <a href="#" class="save-category">Publish</a>
        </div>

        <!--    Category-->
    </div>
</div>
</body>
</html>
